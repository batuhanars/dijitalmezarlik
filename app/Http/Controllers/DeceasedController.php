<?php

namespace App\Http\Controllers;

use App\FileUpload\FileUpload;
use App\Http\Requests\DeceasedRequest;
use App\Http\Requests\DeceasedUpdateRequest;
use App\Models\Cemetery;
use App\Models\Comment;
use App\Models\Deceased;
use App\Models\District;
use App\Models\Neighborhood;
use App\Models\Organisation;
use App\Models\OrganisationDeceased;
use App\Models\Province;
use App\Models\UserOrganisation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Throwable;

class DeceasedController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $deceased = Deceased::with("province", "district", "cemetery", "creator");
        $districts = null;
        $neighborhoods = null;
        $cemeteries = null;

        if (request()->get("mevta")) {
            $deceased = $deceased->where("full_name", "LIKE", "%" . request()->get("mevta") . "%");
        }
        if (request()->get("il")) {
            $deceased = $deceased->where("province_id", request()->get("il"));
            $districts = District::where("province_id", request()->get("il"))->get();
            $cemeteries = Cemetery::where("province_id", request()->get("il"))->get();
        }
        if (request()->get("ilce")) {
            $deceased = $deceased->where("district_id", request()->get("ilce"));
            $neighborhoods = Neighborhood::where("district_id", request()->get("ilce"))->get();
        }
        if (request()->get("mahalle")) {
            $deceased = $deceased->where("neighborhood_id", request()->get("mahalle"));
        }
        if (request()->get("mezarlik")) {
            $deceased = $deceased->where("cemetery_id", request()->get("mezarlik"));
        }
        $deceased = $deceased->orderBy("created_at", "DESC")->paginate(10)->withQueryString();
        $provinces = Province::all();

        if (UserOrganisation::where("user_id", Auth::user()->id)->where("organisation_id", "0")->first()) {
            $organisations = Organisation::all();
        } else {
            $organisations = Auth::user()->organisations;
        }
        $jobs = DB::table("jobs")->get();
        $countries = DB::table("countries")->get();
        return view("back.dead-management.deceased", compact("deceased", "provinces", "districts", "neighborhoods", "cemeteries", "organisations", "jobs", "countries"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::all();
        if (UserOrganisation::where("user_id", Auth::user()->id)->where("organisation_id", "0")->first()) {
            $organisations = Organisation::all();
        } else {
            $organisations = Auth::user()->organisations;
        }
        $jobs = DB::table("jobs")->get();
        $countries = DB::table("countries")->get();
        return view("back.dead-management.add-dead", compact("provinces", "organisations", "jobs", "countries"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DeceasedRequest $request)
    {
        if ($request->hasFile("image")) {
            $fileNameWithUpload = FileUpload::disk("/upload/deceased")->file($request->image)->upload();
            $request->merge([
                "image" => $fileNameWithUpload
            ]);
        }
        $content = $request->content;
        $dom = new \DomDocument();
        $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $key => $img) {
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name = "/upload/deceased/" . time() . $key . ".png";
            $path = public_path() . $image_name;

            file_put_contents($path, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $content = $dom->saveHTML();

        $request->merge([
            "content" => $content
        ]);

        // foreach (explode(' ', $request->full_name) as $name) {
        //     $request->merge([
        //         "full_name" => Str::ucfirst(Str::lower($name))
        //     ]);
        // }

        $request->merge([
            "status" => "1",
        ]);

        if (isset(explode(" ", $request->first_name)[1])) {
            $request->merge([
                "full_name" => Str::ucfirst(Str::lower(explode(" ", $request->first_name)[0])) . " " . Str::ucfirst(Str::lower(explode(" ", $request->first_name)[1])) . " " . Str::upper($request->last_name)
            ]);
        } else {
            $request->merge([
                "full_name" => Str::ucfirst(Str::lower($request->first_name)) . " " . Str::upper($request->last_name)
            ]);
        }

        if ($request->cemetery_id === null) {
            $request->merge([
                "cemetery_id" => 0,
            ]);
        }
        $dead = Deceased::create($request->post());

        foreach ($request->organisation_id as $organisation) {
            OrganisationDeceased::create([
                "organisation_id" => $organisation,
                "deceased_id" => $dead->id,
            ]);
        }

        return back()->withSuccess("Mevta başarıyla eklendi!");
    }

    public function updateStatus(Request $request, $id)
    {
        Deceased::find($id)->update(["status" => $request->status]);
        return back()->withSuccess("Durum başarıyla güncellendi");
    }

    public function show($id)
    {
        $dead = Deceased::with("province", "district", "cemetery", "comments", "neighborhood", "organisations")->find($id) ?? abort(404, "Mevta bulunamadı");
        $comments = $dead->comments()->where("status", "1")->orderBy("created_at", "DESC")->get();
        $funeralCemeteries = Cemetery::all();
        $selectboxProvinces = Province::all();
        $selectboxCemeteries = Cemetery::all();
        $selectboxOrganisations = Organisation::all();
        $jobs = DB::table("jobs")->get();
        $countries = DB::table("countries")->get();
        return view("front.deceased-detail", compact("dead", "comments", "selectboxProvinces", "selectboxCemeteries", "selectboxOrganisations", "funeralCemeteries", "jobs", "countries"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $dead = Deceased::with("province", "district", "organisations", "cemetery")->find($id) ?? abort(404, "Mevta bulunamadı");
        $provinces = Province::all();
        $districts = District::where("province_id", $dead->province->id ?? "")->get();
        $cemeteries = Cemetery::where("province_id", $dead->province->id ?? "")->get();
        $neighborhoods = Neighborhood::where("district_id", $dead->district->id ?? "")->get();

        $organisations = Organisation::whereDoesntHave("deceased", function ($query) use ($id) {
            $query->where("deceased_id", $id);
        })->get();
        $jobs = DB::table("jobs")->get();
        $countries = DB::table("countries")->get();
        return view("back.dead-management.edit-dead", compact("dead", "provinces", "districts", "cemeteries", "organisations", "neighborhoods", "jobs", "countries"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(DeceasedUpdateRequest $request, $id)
    {
        $deceased = Deceased::find($id);
        if ($request->hasFile("image")) {
            @unlink(public_path($deceased->image));
            $fileNameWithUpload = FileUpload::disk("/upload/deceased")->file($request->image)->upload();
            $request->merge([
                "image" => $fileNameWithUpload
            ]);
        }
        try {
            $content = $request->content;
            $dom = new \DomDocument();
            $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('img');
            $bs64 = 'base64';
            foreach ($imageFile as $key => $img) {
                $data = $img->getAttribute('src');
                if (strpos($data, $bs64) == true) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/deceased/" . time() . $key . ".png";
                    $path = public_path() . $image_name;

                    file_put_contents($path, $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                } else {
                    $image_name = $data;
                    $img->setAttribute('src', $image_name);
                }
            }
            $content = $dom->saveHTML();
            $request->merge([
                "content" => $content
            ]);
            Deceased::find($id)->update($request->post());
        } catch (Throwable $e) {
            $deceased = Deceased::find($id);
            return redirect()->route("deceased.edit", $deceased->id)->withSuccess("Mevta başarıyla güncellendi!");
        }
        $deceased = Deceased::find($id);
        return redirect()->route("deceased.edit", $deceased->id)->withSuccess("Mevta başarıyla güncellendi!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $dead = Deceased::find($id);
        $dead->comments()->delete();
        OrganisationDeceased::where("deceased_id", $id)->delete();
        Deceased::find($id)->delete();
        return back();
    }

    public function deleteOrganisation($deadId, $organisationId)
    {
        OrganisationDeceased::where("deceased_id", $deadId)->where("organisation_id", $organisationId)->first()->delete();
        return back();
    }

    public function addOrganisation(Request $request, $deadId)
    {
        foreach ($request->organisation_id as $org) {
            OrganisationDeceased::where("dead_id", $deadId)->create([
                "organisation_id" => $org,
                "deceased_id" => $deadId,
            ]);
        }
        return back();
    }
}

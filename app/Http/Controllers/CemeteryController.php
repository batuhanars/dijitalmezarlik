<?php

namespace App\Http\Controllers;

use App\FileUpload\FileUpload;
use App\Http\Requests\CemeteryRequest;
use App\Models\Cemetery;
use App\Models\District;
use App\Models\Neighborhood;
use App\Models\Organisation;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Throwable;

class CemeteryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cemeteries = Cemetery::with("province", "district", "deceased", "neighborhood");
        $districts = null;
        $neighborhoods = null;

        if (request()->get("mezarlik")) {
            $cemeteries = $cemeteries->where("title", "LIKE", "%" . request()->get("mezarlik") . "%");
        }
        if (request()->get("il")) {
            $cemeteries = $cemeteries->where("province_id", request()->get("il"));
            $districts = District::where("province_id", request()->get("il"))->get();
        }
        if (request()->get("ilce")) {
            $cemeteries = $cemeteries->where("district_id", request()->get("ilce"));
            $neighborhoods = Neighborhood::where("district_id", request()->get("ilce"))->get();
        }
        $cemeteries = $cemeteries->orderBy("created_at", "DESC")->paginate(10)->withQueryString();
        $provinces = Province::all();

        return view("back.cemetery-management.cemeteries", compact("cemeteries", "provinces", "districts", "neighborhoods"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::all();
        return view("back.cemetery-management.add-cemetery", compact("provinces"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CemeteryRequest $request)
    {
        if ($request->hasFile("image")) {
            $fileNameWithUpload = FileUpload::disk("/upload/cemeteries")->file($request->image)->upload();
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
            $image_name = "/upload/cemeteries/" . time() . $key . ".png";
            $path = public_path() . $image_name;

            file_put_contents($path, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $content = $dom->saveHTML();
        $request->merge([
            "content" => $content
        ]);

        Cemetery::create($request->post());
        return back()->withSuccess("Mezarlık başarıyla eklendi!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $cemetery = Cemetery::with("province", "district", "deceased", "neighborhood")->where("slug", $slug)->first() ?? abort(404, "Mezarlık bulunamadı");
        $selectboxProvinces = Province::all();
        $selectboxCemeteries = Cemetery::all();
        $selectboxOrganisations = Organisation::all();
        $funeralCemeteries = Cemetery::all();
        $jobs = DB::table("jobs")->get();
        $countries = DB::table("countries")->get();
        return view("front.cemetery-detail", compact("cemetery", "selectboxProvinces", "selectboxCemeteries", "selectboxOrganisations", "funeralCemeteries", "jobs", "countries"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $cemetery = Cemetery::with("province")->where("slug", $slug)->first() ?? abort(404, "Mezarlık bulunamadı");
        $provinces = Province::all();
        $districts = District::where("province_id", $cemetery->province->id)->get();
        $neighborhoods = Neighborhood::where("district_id", $cemetery->district->id)->get();
        return view("back.cemetery-management.edit-cemetery", compact("cemetery", "provinces", "districts", "neighborhoods"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CemeteryRequest $request, $id)
    {
        $control = Cemetery::find($id);
        if ($request->hasFile("image")) {
            @unlink(public_path($control->image));
            $fileNameWithUpload = FileUpload::disk("/upload/cemeteries")->file($request->image)->upload();
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
                    $image_name = "/upload/cemeteries/" . time() . $key . ".png";
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
            Cemetery::find($id)->update($request->post());
        } catch (Throwable $e) {
            $cemetery = Cemetery::find($id);
            return redirect()->route("cemeteries.edit", $cemetery->slug)->withSuccess("Mezarlık başarıyla güncellendi!");
        }
        $cemetery = Cemetery::find($id);
        return redirect()->route("cemeteries.edit", $cemetery->slug)->withSuccess("Mezarlık başarıyla güncellendi!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cemetery::find($id)->delete();
        return back();
    }
}

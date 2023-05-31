<?php

namespace App\Http\Controllers;

use App\FileUpload\FileUpload;
use App\Http\Requests\PrayerRequest;
use App\Models\Cemetery;
use App\Models\Organisation;
use App\Models\Prayer;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class PrayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prayers = new Prayer;
        if (request()->get("dua")) {
            $prayers = $prayers->where("title", "LIKE", "%" . request()->get("dua") . "%");
        }
        $prayers = $prayers->orderBy("created_at", "DESC")->paginate(10)->withQueryString();
        return view("back.prayer-management.prayers", compact("prayers"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("back.prayer-management.add-prayer");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PrayerRequest $request)
    {
        if ($request->hasFile("video_image")) {
            $fileNameWithUpload = FileUpload::disk("/upload/prayers")->file($request->video_image)->upload();
            $request->merge([
                "video_image" => $fileNameWithUpload,
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
            $image_name = "/upload/prayers/" . time() . $key . ".png";
            $path = public_path() . $image_name;

            file_put_contents($path, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $content = $dom->saveHTML();
        $request->merge([
            "content" => $content
        ]);
        Prayer::create($request->post());
        return back()->withSuccess("Dua başarıyla eklendi!");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $prayer = Prayer::where("slug", $slug)->first() ?? abort(404, "Dua Bulunamadı");
        $prayers = Prayer::orderBy("created_at", "DESC")->get();
        $funeralCemeteries = Cemetery::all();
        $selectboxProvinces = Province::all();
        $selectboxCemeteries = Cemetery::all();
        $selectboxOrganisations = Organisation::all();
        return view("front.prayer-detail", compact("prayer", "prayers", "selectboxProvinces", "selectboxCemeteries", "selectboxOrganisations", "funeralCemeteries"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $prayer =  Prayer::where("slug", $slug)->first() ?? abort(404, "Dua Bulunamadı");
        return view("back.prayer-management.edit-prayer", compact("prayer"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PrayerRequest $request, $id)
    {
        $control = Prayer::find($id);
        if ($request->hasFile("video_image")) {
            @unlink(public_path($control->video_image));
            $fileNameWithUpload = FileUpload::disk("/upload/prayers")->file($request->video_image)->upload();
            $request->merge([
                "video_image" => $fileNameWithUpload,
            ]);
        }
        try {
            $content = $request->content;
            $dom = new \DomDocument();
            $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('img');
            $bs64 = "base64";
            foreach ($imageFile as $key => $img) {
                $data = $img->getAttribute('src');
                if (strpos($data, $bs64) == true) {
                    list($type, $data) = explode(';', $data);
                    list(, $data)      = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/prayers/" . time() . $key . ".png";
                    $path = public_path() . $image_name;

                    file_put_contents($path, $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                } else {
                    $image_name = $data;
                    $img->setAttribute("src", $image_name);
                }
            }

            $content = $dom->saveHTML();
            $request->merge([
                "content" => $content
            ]);
            Prayer::find($id)->update($request->post());
        } catch (Throwable $e) {
            $prayer = Prayer::find($id);
            return redirect()->route("prayers.edit", $prayer->slug)->withSuccess("Dua başarıyla güncellendi!");
        }
        $prayer = Prayer::find($id);
        return redirect()->route("prayers.edit", $prayer->slug)->withSuccess("Dua başarıyla güncellendi!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Prayer::find($id)->delete();
        return back();
    }
}

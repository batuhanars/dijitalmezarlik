<?php

namespace App\Http\Controllers;

use App\FileUpload\FileUpload;
use App\Http\Requests\CemeteryServiceRequest;
use App\Models\CemeteryService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Throwable;

class CemeteryServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cemeteryServices = new CemeteryService;
        if (request()->get("hizmet")) {
            $cemeteryServices = $cemeteryServices->where("title", "LIKE", "%" . request()->get("hizmet") . "%");
        }
        $cemeteryServices = $cemeteryServices->orderBy("created_at", "DESC")->paginate(10)->withQueryString();
        return view("back.page-management.cemetery-services", compact("cemeteryServices"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CemeteryServiceRequest $request)
    {
        if ($request->hasFile("image")) {
            $fileNameWithUpload = FileUpload::disk("/upload/cemetery-service")->file($request->image)->upload();
            $request->merge([
                "image" => $fileNameWithUpload,
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
            $image_name = "/upload/cemetery-services/" . time() . $key . ".png";
            $path = public_path() . $image_name;

            file_put_contents($path, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $content = $dom->saveHTML();
        $request->merge([
            "content" => $content
        ]);
        CemeteryService::create($request->post());
        return back()->withSuccess("Hizmet başarıyla kaydedildi!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $cemeteryService = CemeteryService::where("slug", $slug)->first();
        return view("back.page-management.cemetery-service-edit", compact("cemeteryService"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CemeteryServiceRequest $request, $id)
    {
        $control = CemeteryService::find($id);
        if ($request->hasFile("image")) {
            @unlink(public_path($control->image));
            // $fileName = Str::slug($request->title) . "." . $request->image->extension();
            // $fileNameWithUpload = "/upload/cemetery-services/" . $fileName;
            // $request->image->move(public_path("/upload/cemetery-services"), $fileName);
            $fileNameWithUpload = FileUpload::disk("/upload/cemetery-service")->file($request->image)->upload();
            $request->merge([
                "image" => $fileNameWithUpload,
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
                    $image_name = "/upload/cemetery-services/" . time() . $key . ".png";
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
            CemeteryService::find($id)->update($request->post());
        } catch (Throwable $e) {
            $cemeteryService = CemeteryService::find($id);
            return redirect()->route("cemetery-services.edit", $cemeteryService->slug)->withSuccess("Hizmet başarıyla güncellendi!");
        }
        $cemeteryService = CemeteryService::find($id);
        return redirect()->route("cemetery-services.edit", $cemeteryService->slug)->withSuccess("Hizmet başarıyla güncellendi!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CemeteryService::find($id)->delete();
        return back();
    }
}

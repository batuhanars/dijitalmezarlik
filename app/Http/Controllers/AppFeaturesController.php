<?php

namespace App\Http\Controllers;

use App\FileUpload\FileUpload;
use App\Http\Requests\AppFeatureRequest;
use App\Models\AppFeature;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AppFeaturesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $appFeatures = new AppFeature;
        if (request()->get("ozellik")) {
            $appFeatures = $appFeatures->where("title", "LIKE", "%" . request()->get("ozellik") . "%");
        }
        $appFeatures = $appFeatures->orderBy("created_at", "DESC")->paginate(10)->withQueryString();
        return view("back.site-management.app-features", compact("appFeatures"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AppFeatureRequest $request)
    {
        if ($request->hasFile("icon")) {
            $fileNameWithUpload = FileUpload::disk("/upload/app_features")->file($request->icon)->upload();
            $request->merge([
                "icon" => $fileNameWithUpload,
            ]);
        }
        AppFeature::create($request->post());
        return back()->withSuccess("Uygulama özelliği başarıyla kaydedildi!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $appFeature = AppFeature::where("slug", $slug)->first();
        return view("back.site-management.app-features-edit", compact("appFeature"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AppFeatureRequest $request, $id)
    {
        $appFeatures = AppFeature::find($id);
        if ($request->hasFile("icon")) {
            @unlink(public_path($appFeatures->icon));
            $fileNameWithUpload = FileUpload::disk("/upload/app_features")->file($request->icon)->upload();
            $request->merge([
                "icon" => $fileNameWithUpload,
            ]);
        }
        AppFeature::find($id)->update($request->post());
        return redirect()->route("app-features.index", $appFeatures->slug)->withSuccess("Uygulama özelliği başarıyla güncellendi!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AppFeature::find($id)->delete();
        return back();
    }
}

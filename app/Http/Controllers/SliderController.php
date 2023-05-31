<?php

namespace App\Http\Controllers;

use App\Http\Requests\SliderRequest;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::orderBy("created_at", "DESC")->paginate(10)->withQueryString();
        return view("back.slider-management.sliders", compact("sliders"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("back.slider-management.add-slider");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SliderRequest $request)
    {
        if ($request->hasFile("images")) {
            foreach ($request->file("images") as $image) {
                $fileName = uniqid() . "." . $image->extension();
                $image->move(public_path("/upload/sliders"), $fileName);
                Slider::create([
                    "image" => "/upload/sliders/" . $fileName,
                ]);
            }
        }
        return back()->withSuccess("Slider başarıyla eklendi!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $slider = Slider::find($id);
        @unlink(public_path($slider->image));
        Slider::find($id)->delete();
        return back();
    }
}

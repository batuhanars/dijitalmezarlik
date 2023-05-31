<?php

namespace App\Http\Controllers;

use App\Http\Requests\FuneralNoticeRequest;
use App\Models\District;
use App\Models\FuneralNotice;
use App\Models\Neighborhood;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FuneralNoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $funerals = FuneralNotice::with("province", "district", "neighborhood");
        if (request()->get("olum_tarihi")) {
            $funerals = $funerals->where("date_of_death", request()->get("olum_tarihi"));
        }
        $funerals = $funerals->orderBy("created_at", "DESC")->paginate(10);
        return view("back.funeral-management.funeral-notices", compact("funerals"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FuneralNoticeRequest $request)
    {
        $request->merge([
            "status" => "1",
        ]);
        FuneralNotice::create($request->post());
        return response()->json(["success" => "Cenaze ilanı başarıyla kaydedildi!"]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $funeral = FuneralNotice::with("province", "district", "neighborhood")->find($id);
        $provinces = Province::all();
        $countries = DB::table("countries")->get();
        return view("back.funeral-management.funeral-notice-edit", compact("funeral", "provinces", "countries"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(FuneralNoticeRequest $request, $id)
    {
        FuneralNotice::find($id)->update($request->post());
        $funeral = FuneralNotice::find($id);
        return redirect()->route("funeral-notice.edit", $funeral->id)->withSuccess("Cenaze ilanı başarıyla güncellendi!");
    }

    public function funeralUpdateStatus(Request $request, $id)
    {
        FuneralNotice::find($id)->update([
            "status" => $request->status
        ]);
        return back()->withSuccess("Cenaze başarıyla onaylandı!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FuneralNotice::find($id)->delete();
        return back();
    }
}

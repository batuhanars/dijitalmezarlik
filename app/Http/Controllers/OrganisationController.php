<?php

namespace App\Http\Controllers;

use App\Http\Requests\OrganisationRequest;
use App\Models\District;
use App\Models\Organisation;
use App\Models\Province;
use App\Models\Deceased;
use Illuminate\Http\Request;

class OrganisationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $organisations = new Organisation;
        $provinces = Province::all();
        $districts = District::all();
        if (request()->get("kurum")) {
            $organisations = $organisations->where("name", "LIKE", "%" . request()->get("kurum") . "%");
        }
        $organisations = $organisations->orderBy("created_at", "DESC")->paginate(10)->withQueryString();
        return view("back.organisation-management.organisations", compact("organisations", "provinces", "districts"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::all();
        return view("back.organisation-management.add-organisation", compact("provinces"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(OrganisationRequest $request)
    {
        Organisation::create($request->post());
        return back()->withSuccess("Kurum başarıyla eklendi!");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $organisation = Organisation::where("slug", $slug)->first() ?? abort(404, "Kurum bulunamadı");
        $provinces = Province::all();
        $districts = District::all();
        return view("back.organisation-management.edit-organisation", compact("organisation", "provinces", "districts"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(OrganisationRequest $request, $id)
    {
        Organisation::find($id)->update($request->post());
        $organisation = Organisation::find($id);
        return redirect()->route("organisations.edit", $organisation->slug)->withSuccess("Kurum başarıyla güncellendi!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $organisation = Organisation::find($id);
        Deceased::where("organisation_id", $organisation->id)->delete();
        Organisation::find($id)->delete();
        return back();
    }
}

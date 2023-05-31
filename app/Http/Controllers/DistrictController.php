<?php

namespace App\Http\Controllers;

use App\Models\District;
use App\Models\Province;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DistrictController extends Controller
{
    public function index(Request $request)
    {
        $districts = District::where("province_id", $request->province_id)->get();
        return response()->view("selectbox-districts", compact("districts"));
    }
    public function homePageDistricts(Request $request)
    {
        $districts = District::where("province_id", $request->province_id)->get();
        return response()->view("homepage-selectbox-districts", compact("districts"));
    }
    public function getDistrictsUserPageSelectBox(Request $request)
    {
        $provinces = Province::find($request->province_id);
        return response()->view("selectbox-districts-userpage", compact("provinces"));
    }
    public function authDistrict()
    {
        return response()->view("auth-districts");
    }
}

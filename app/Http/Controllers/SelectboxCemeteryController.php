<?php

namespace App\Http\Controllers;

use App\Models\Cemetery;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SelectboxCemeteryController extends Controller
{
    public function getSelectboxCemeteries(Request $request)
    {
        if ($request->province_id) {
            $cemeteries = Cemetery::where("province_id", $request->province_id)->get();
        }
        if ($request->district_id) {
            $cemeteries = Cemetery::where("district_id", $request->district_id)->get();
        }
        return response()->view("selectbox-cemeteries", compact("cemeteries"));
    }

    public function getHomePageSelectboxCemeteries(Request $request)
    {
        $cemeteries = Cemetery::where("province_id", $request->province_id)->get();
        return response()->view("homepage-selectbox-cemeteries", compact("cemeteries"));
    }
}

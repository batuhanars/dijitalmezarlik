<?php

namespace App\Http\Controllers;

use App\Models\Neighborhood;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NeighborhoodController extends Controller
{
    public function index(Request $request)
    {
        if ($request->province_id) {
            $neighborhoods = Neighborhood::where("province_id", $request->province_id)->get();
        } else {
            $neighborhoods = Neighborhood::where("district_id", $request->district_id)->get();
        }
        return response()->view("selectbox-neighborhoods", compact("neighborhoods"));
    }

    public function homePageNeighborhoods(Request $request)
    {
        $neighborhoods = Neighborhood::where("district_id", $request->district_id)->get();
        return response()->view("homepage-selectbox-neighborhoods", compact("neighborhoods"));
    }
}

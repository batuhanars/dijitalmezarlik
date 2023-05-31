<?php

namespace App\Http\Controllers;

use App\FileUpload\FileUpload;
use App\Http\Requests\UserRequest;
use App\Models\District;
use App\Models\Organisation;
use App\Models\Province;
use App\Models\User;
use App\Models\UserDistrict;
use App\Models\UserOrganisation;
use App\Models\UserProvince;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redis;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::with("provinces", "districts", "organisations");
        if (request()->get("kullanici")) {
            $users = $users->where("full_name", "LIKE", "%" . request()->get("kullanici") . "%");
        }
        $users = $users->orderBy("created_at", "DESC")->paginate(10)->withQueryString();
        $provinces = Province::all();
        $districts = District::all();
        $organisations = Organisation::all();
        return view("back.user-management.users", compact("users", "provinces", "districts", "organisations"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $provinces = Province::all();
        $organisations = Organisation::all();
        return view("back.user-management.add-user", compact("provinces", "organisations"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        if ($request->hasFile("image")) {
            $fileName = uniqid() . "." . $request->image->extension();
            $fileNameWithUpload = "/upload/users/" . $fileName;
            $request->image->move(public_path("/upload/users"), $fileName);
            $request->merge([
                "image" => $fileNameWithUpload,
            ]);
        }
        $request->merge([
            "full_name" => $request->first_name . " " . $request->last_name
        ]);
        $user = User::create($request->post());
        $user->role()->create();
        $user->provinces()->attach($request->provinces);
        $user->districts()->attach($request->districts);
        $user->organisations()->attach($request->organisations);
        return back()->withSuccess("Kullanıcı başarıyla eklendi! Onay sürecinden geçtikten sonra panele giriş yapabilecek.");
    }

    public function updateStatus(Request $request, $id)
    {
        User::find($id)->update(["status" => $request->status]);
        return back()->withSuccess("Kullanıcı durumu başarıyla güncellendi!");
    }

    public function show($id)
    {
        $user = User::find($id);
        $selectboxProvinces = Province::all();
        $selectboxOrganisations = Organisation::all();
        $selectboxDistricts = District::all();

        $provinces = $user->provinces();
        if (request()->get("il")) {
            $provinces = $provinces->where("name", "LIKE", "%" . request()->get("il") . "%");
        }
        $districts = $user->districts();
        if (request()->get("ilce")) {
            $districts = $districts->where("name", "LIKE", "%" . request()->get("ilce") . "%");
        }
        $organisations = $user->organisations();
        if (request()->get("kurum")) {
            $organisations = $organisations->where("name", "LIKE", "%" . request()->get("kurum") . "%");
        }
        $provinces = $provinces->get();
        $districts = $districts->get();
        $organisations = $organisations->get();
        return view("back.user-management.user-detail", compact("user", "selectboxProvinces", "selectboxDistricts", "selectboxOrganisations", "provinces", "districts", "organisations"));
    }

    public function addProvince(Request $request, $id)
    {
        $user = User::find($id);
        UserProvince::create([
            "user_id" => $id,
            "province_id" => $request->province_id,
        ]);
        return redirect()->route("users.show", $user->id)->withSuccess("Başarıyla il atandı");
    }

    public function deleteProvince($userId, $provinceId)
    {
        $user = User::find($userId);
        UserProvince::where("user_id", $userId)->where("province_id", $provinceId)->delete();
        return redirect()->route("users.show", $user->id);
    }

    public function addDistrict(Request $request, $id)
    {
        $user = User::find($id);
        $user->districts()->attach($request->district_id);
        return redirect()->route("users.show", $user->id)->withSuccess("Başarıyla il atandı");
    }

    public function deleteDistrict($userId, $districtId)
    {
        $user = User::find($userId);
        UserDistrict::where("user_id", $userId)->where("district_id", $districtId)->delete();
        return redirect()->route("users.show", $user->id);
    }

    public function addOrganisation(Request $request, $id)
    {
        $user = User::find($id);
        $checkOrganisation = $user->organisations()->where("organisation_id", $request->organisation_id)->first();
        if (!$checkOrganisation) {
            $user->organisations()->attach($request->organisation_id);
        } else {
            return redirect()->route("users.show", $user->id);
        }
        return redirect()->route("users.show", $user->id)->withSuccess("Başarıyla kurum atandı");
    }

    public function deleteOrganisation($userId, $organisationId)
    {
        $user = User::find($userId);
        UserOrganisation::where("user_id", $userId)->where("organisation_id", $organisationId)->delete();
        return redirect()->route("users.show", $user->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        return redirect()->route("users.edit", $user->id)->withSuccess("Ayarlar başarıyla güncellendi!");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        User::find($id)->delete();
        UserRole::where("user_id", $id)->delete();
        return back();
    }
}

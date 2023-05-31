<?php

namespace App\Http\Controllers;

use App\FileUpload\FileUpload;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\UserRequest;
use App\Models\Organisation;
use App\Models\Province;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login()
    {
        return view("auth.login");
    }

    public function loginPost(LoginRequest $request)
    {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            return redirect()->route("panel")->withSuccess("Merhaba, " . Auth::user()->first_name . " " . Auth::user()->last_name . " başarıyla giriş yaptınız!");
        } else {
            return back()->with(["error" => "Email veya şifre yanlış. Lütfen tekrar deneyiniz."]);
        }
    }

    public function register()
    {
        $provinces = Province::all();
        $organisations = Organisation::all();
        return view("auth.register", compact("provinces", "organisations"));
    }

    public function registerPost(UserRequest $request)
    {
        if ($request->hasFile("image")) {
            $fileNameWithUpload = FileUpload::disk("/upload/users")->file($request->image)->upload();
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
        return redirect()->route("home")->withSuccess("Hesabınız başarıyla oluşturuldu! Üyeliğiniz onaylandıktan sonra panele giriş yapabilirsiniz.");
    }

    function profile()
    {
        return view("back.profile-management.settings");
    }

    public function profileUpdate(ProfileRequest $request, $id)
    {
        $user = User::find($id);
        if ($request->hasFile("image")) {
            @unlink(public_path($user->image));
            $fileNameWithUpload = FileUpload::disk("/upload/users")->file($request->image)->upload();
            $request->merge([
                "image" => $fileNameWithUpload,
            ]);
        }
        User::find($id)->update($request->post());
        return back()->withSuccess("Profil başarıyla güncellendi!");
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route("login");
    }
}

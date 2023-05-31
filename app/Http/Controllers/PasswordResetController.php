<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Http\Requests\PasswordRequest;
use App\Mail\PasswordReset;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class PasswordResetController extends Controller
{
    public function forgotPassword()
    {
        return view("auth.email");
    }

    public function sendEmail(EmailRequest $request)
    {
        $user = User::where("email", $request->email)->first();
        if (!$user) {
            return back()->with(["error" => "Email adresi yanlış"]);
        }

        $token = Str::random(20);
        $user->update([
            "token" => $token,
        ]);

        Mail::to($user->email)->send(new PasswordReset($user, $token));
        return back()->withSuccess("Şifre yenileme linki email hesabınıza gönderildi");
    }

    public function resetPassword($token, $email)
    {
        return view("auth.password-reset", compact("email", "token"));
    }

    public function resetPasswordPost(PasswordRequest $request, $token, $email)
    {
        $user = User::where("email", $email)->where("token", $token)->first();
        if ($user) {
            $user->update([
                "password" => $request->password,
            ]);
        } else {
            return back()->with(["error" => "Token eşleşmiyor"]);
        }
        return redirect()->route("login")->withSuccess("Şifre yenileme işlemi başarılı");
    }
}

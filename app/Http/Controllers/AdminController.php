<?php

namespace App\Http\Controllers;

use App\FileUpload\FileUpload;
use App\Http\Requests\BurialProcedureRequest;
use App\Http\Requests\CemeteryEtiquetteRequest;
use App\Http\Requests\SettingRequest;
use App\Models\AboutApp;
use App\Models\AboutAppImage;
use App\Models\AppFeature;
use App\Models\BurialProcedure;
use App\Models\Cemetery;
use App\Models\CemeteryEtiquette;
use App\Models\ContactManagement;
use App\Models\CookiePolicy;
use App\Models\District;
use App\Models\Province;
use App\Models\Setting;
use App\Models\Deceased;
use App\Models\FuneralNotice;
use App\Models\Maintenance;
use App\Models\Slider;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SocialMedia;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Visitor;
use Carbon\Carbon;
use Throwable;

class AdminController extends Controller
{
    public function index()
    {
        $deceasedInfo = new Deceased;

        $totalCemetery = Cemetery::count();
        $totalProvince = Province::count();
        $totalDistrict = District::count();

        $visitorsInfo = new Visitor();

        $sliders = Slider::orderBy("created_at", "DESC")->get();

        return view("back.index", compact(
            "totalCemetery",
            "totalProvince",
            "totalDistrict",
            "deceasedInfo",
            "visitorsInfo",
            "sliders",
        ));
    }

    public function settings()
    {
        return view("back.site-management.settings");
    }

    public function saveSettings(SettingRequest $request)
    {
        $control = Setting::find(1);
        if ($request->hasFile("dark_logo")) {
            @unlink(public_path($control->dark_logo));
            $fileNameWithUpload = FileUpload::disk("/upload/settings")->file($request->dark_logo)->upload();
            $request->merge([
                "dark_logo" => $fileNameWithUpload,
            ]);
        }
        if ($request->hasFile("white_logo")) {
            @unlink(public_path($control->white_logo));
            $fileNameWithUpload = FileUpload::disk("/upload/settings")->file($request->white_logo)->upload();
            $request->merge([
                "white_logo" => $fileNameWithUpload,
            ]);
        }
        if ($request->hasFile("favicon")) {
            @unlink(public_path($control->favicon));
            $fileNameWithUpload = FileUpload::disk("/upload/settings")->file($request->favicon)->upload();
            $request->merge([
                "favicon" => $fileNameWithUpload,
            ]);
        }
        if ($request->hasFile("pages_image")) {
            @unlink(public_path($control->pages_image));
            $fileNameWithUpload = FileUpload::disk("/upload/settings")->file($request->pages_images)->upload();
            $request->merge([
                "pages_image" => $fileNameWithUpload,
            ]);
        }
        Setting::find(1)->update($request->post());
        return back()->withSuccess("Ayarlar başarıyla kaydedildi!");;
    }

    public function maintenance()
    {
        $maintenance = Maintenance::find(1);
        return view("back.site-management.maintenance-mode", compact("maintenance"));
    }

    public function saveMaintenance(Request $request)
    {
        Maintenance::find(1)->update($request->post());
        return back()->withSuccess("Ayarlar başarıyla kayıt edildi!");;
    }

    public function burialProcedures()
    {
        $burialProcedure = BurialProcedure::find(1);
        return view("back.page-management.burial-procedures", compact("burialProcedure"));
    }

    public function saveBurialProcedures(BurialProcedureRequest $request)
    {
        try {
            $content = $request->content;
            $dom = new \DomDocument();
            $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('img');
            $bs64 = 'base64';
            foreach ($imageFile as $key => $img) {
                $data = $img->getAttribute('src');

                if (strpos($data, $bs64) == true) {
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/burial-procedures/" . time() . "." . $key . ".png";
                    $path = public_path() . $image_name;

                    file_put_contents($path, $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                } else {
                    $image_name = $data;
                    $img->setAttribute('src', $image_name);
                }
            }

            $content = $dom->saveHTML();
            $request->merge([
                "content" => $content
            ]);
            BurialProcedure::find(1)->update($request->post());
        } catch (Throwable $e) {
            return back()->withSuccess("Defin işlemleri başarıyla kaydedildi!");
        }
        return back()->withSuccess("Defin işlemleri başarıyla kaydedildi!");
    }

    public function cemeteryEtiquette()
    {
        $cemeteryEtiquette = CemeteryEtiquette::find(1);
        return view("back.page-management.cemetery-etiquette", compact("cemeteryEtiquette"));
    }

    public function saveCemeteryEtiquette(CemeteryEtiquetteRequest $request)
    {
        try {
            $content = $request->content;
            $dom = new \DomDocument();
            $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $bs64 = 'base64';
            $imageFile = $dom->getElementsByTagName('img');

            foreach ($imageFile as $key => $img) {
                $data = $img->getAttribute('src');
                if (strpos($data, $bs64) == true) {
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/cemetery-etiquette" . time() . "." . $key . ".png";
                    $path = public_path() . $image_name;

                    file_put_contents($path, $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                } else {
                    $image_name = $data;
                    $img->setAttribute('src', $image_name);
                }
            }

            $content = $dom->saveHTML();
            $request->merge([
                "content" => $content
            ]);
            CemeteryEtiquette::find(1)->update($request->post());
        } catch (Throwable $e) {
            return back()->withSuccess("Mezarlık adabı başarıyla kaydedildi!");
        }
        return back()->withSuccess("Mezarlık adabı başarıyla kaydedildi!");
    }

    public function cookiePolicy()
    {
        $cookiePolicy = CookiePolicy::find(1);
        return view("back.page-management.cookie-policy", compact("cookiePolicy"));
    }

    public function cookiePolicySave(Request $request)
    {
        try {
            $content = $request->content;
            $dom = new \DomDocument();
            $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('img');
            $bs64 = 'base64';
            foreach ($imageFile as $key => $img) {
                $data = $img->getAttribute('src');
                if (strpos($data, $bs64) == true) {
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/cookie-policy/" . time() . "." . $key . ".png";
                    $path = public_path() . $image_name;

                    file_put_contents($path, $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                } else {
                    $image_name = $data;
                    $img->setAttribute('src', $image_name);
                }
            }

            $content = $dom->saveHTML();
            $request->merge([
                "content" => $content
            ]);
            CookiePolicy::find(1)->update($request->post());
        } catch (Throwable $e) {
            return back()->withSuccess("Ayarlar başarıyla kaydedildi!");
        }
        return back()->withSuccess("Ayarlar başarıyla kaydedildi!");
    }

    public function socialMedia()
    {
        $socialMedia = SocialMedia::find(1);
        return view("back.site-management.social-media-management", compact("socialMedia"));
    }

    public function socialMediaSave(Request $request)
    {
        SocialMedia::find(1)->update($request->post());
        return back()->withSuccess("Ayarlar başarıyla kaydedildi!");
    }

    public function aboutApp()
    {
        $aboutApp = AboutApp::find(1);
        return view("back.page-management.about-app", compact("aboutApp"));
    }

    public function aboutAppSave(Request $request)
    {
        $control = AboutApp::find(1);
        if ($request->hasFile("images")) {
            foreach ($request->file("images") as $image) {
                $fileName = uniqid() . "." . $image->extension();
                $image->move(public_path("/upload/aboutapp"), $fileName);
                $file[] = $fileName;
                $request->merge([
                    "images" => json_encode($file)
                ]);
            }
        }
        if ($request->hasFile("video_image")) {
            @unlink(public_path($control->video_image));
            $fileNameWithUpload = FileUpload::disk("/upload/aboutapp")->file($request->video_image)->upload();
            $request->merge([
                "video_image" => $fileNameWithUpload
            ]);
        }
        try {
            $content = $request->content;
            $dom = new \DomDocument();
            $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
            $imageFile = $dom->getElementsByTagName('img');
            $bs64 = 'base64';
            foreach ($imageFile as $key => $img) {
                $data = $img->getAttribute('src');
                if (strpos($data, $bs64) == true) {
                    list($type, $data) = explode(';', $data);
                    list(, $data) = explode(',', $data);
                    $data = base64_decode($data);
                    $image_name = "/upload/aboutapp/" . time() . "." . $key . ".png";
                    $path = public_path() . $image_name;

                    file_put_contents($path, $data);

                    $img->removeAttribute('src');
                    $img->setAttribute('src', $image_name);
                } else {
                    $image_name = $data;
                    $img->setAttribute('src', $image_name);
                }
            }

            $content = $dom->saveHTML();
            $request->merge([
                "content" => $content
            ]);
            AboutApp::find(1)->update($request->post());
        } catch (Throwable $e) {
            return back()->withSuccess("Ayarlar başarıyla kaydedildi!");
        }
        return back()->withSuccess("Ayarlar başarıyla kaydedildi!");
    }

    public function contactManagement()
    {
        $contactManagement = ContactManagement::find(1);
        return view("back.site-management.contact-management", compact("contactManagement"));
    }

    public function contactManagementSave(Request $request)
    {
        ContactManagement::find(1)->update($request->post());
        return back()->withSuccess("Ayarlar başarıyla kaydedildi!");
    }

    public function updateUserRole(Request $request)
    {
        UserRole::where("user_id", $request->user_id)->first()->update([
            "site_management" => $request->site_management == null ? "0" : "1",
            "user_management" => $request->user_management == null ? "0" : "1",
            "page_management" => $request->page_management == null ? "0" : "1",
            "slider_management" => $request->slider_management == null ? "0" : "1",
            "cemetery_management" => $request->cemetery_management == null ? "0" : "1",
            "dead_management" => $request->dead_management == null ? "0" : "1",
            "prayer_management" => $request->prayer_management == null ? "0" : "1",
            "notification_management" => $request->notification_management == null ? "0" : "1",
            "organisation_management" => $request->organisation_management == null ? "0" : "1",
            "funeral_management" => $request->funeral_management == null ? "0" : "1",
            "product_management" => $request->product_management == null ? "0" : "1",
        ]);
        User::find($request->user_id)->update([
            "province_district_customization" => $request->status,
        ]);
        return back()->withSuccess("Ayarlar başarıyla kaydedildi");
    }
}

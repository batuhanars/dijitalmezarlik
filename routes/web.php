<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AppFeaturesController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CemeteryController;
use App\Http\Controllers\CemeteryServiceController;
use App\Http\Controllers\CommentAnswerController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DeceasedController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\EditorImageUploadController;
use App\Http\Controllers\FuneralNoticeController;
use App\Http\Controllers\HelpController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NeighborhoodController;
use App\Http\Controllers\OrganisationController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\PrayerController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\SelectboxCemeteryController;
use App\Http\Controllers\SliderController;
use App\Http\Controllers\SuggestionComplaintController;
use App\Http\Controllers\UserController;
use App\Models\Deceased;
use App\Models\FuneralNotice;
use App\Models\Maintenance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::post("/districts", [DistrictController::class, "index"])->name("districts");
Route::post("/auth-districts", [DistrictController::class, "authDistrict"])->name("auth.districts");
Route::post("/homepage-districts", [DistrictController::class, "homePageDistricts"])->name("homepage-districts");
Route::post("/districts-userpage", [DistrictController::class, "getDistrictsUserPageSelectBox"])->name("districts.user-page");
Route::post("/cemeteries", [SelectboxCemeteryController::class, "getSelectboxCemeteries"])->name("cemeteries");
Route::post("/homepage-cemeteries", [SelectboxCemeteryController::class, "getHomePageSelectboxCemeteries"])->name("homepage-cemeteries");
Route::post("/neighborhoods", [NeighborhoodController::class, "index"])->name("neighborhoods");
Route::post("/homepage-neighborhoods", [NeighborhoodController::class, "homePageNeighborhoods"])->name("homepage-neighborhoods");

Route::get("/giris-yap", [AuthController::class, "login"])->name("login");
Route::post("/giris-yap", [AuthController::class, "loginPost"])->name("loginPost");
Route::get("/uye-ol", [AuthController::class, "register"])->name("register");
Route::post("/uye-ol", [AuthController::class, "registerPost"])->name("registerPost");
Route::get("cikis-yap", [AuthController::class, "logout"])->name("logout");

Route::get("/parolami-unuttum", [PasswordResetController::class, "forgotPassword"])->name("forgot-password");
Route::post("/parolami-unuttum", [PasswordResetController::class, "sendEmail"])->name("send-email");
Route::get("/parola-yenile/{token}/{email}", [PasswordResetController::class, "resetPassword"])->name("reset-password");
Route::put("/parola-yenile/{token}/{email}", [PasswordResetController::class, "resetPasswordPost"])->name("reset-password.post");

Route::post("/image-upload", [EditorImageUploadController::class, "upload"])->name("editor-image-upload");

Route::post("/oneri-ve-sikayet/ekle", [SuggestionComplaintController::class, "store"])->name("suggestions-complaints.store");
Route::post("/mesajlar/ekle", [MessageController::class, "store"])->name("messages.store");
Route::post("cevap/ekle", [CommentAnswerController::class, "store"])->name("comment_answer.store");

Route::middleware(["IsLogin", "IsUserApproved"])->prefix("panel")->group(function () {
    Route::get("/", [AdminController::class, "index"])->name("panel");
    Route::get("/ayarlar", [AdminController::class, "settings"])->name("settings");
    Route::post("/ayarlar", [AdminController::class, "saveSettings"])->name("save.settings");
    Route::get("/bakim-modu", [AdminController::class, "maintenance"])->name("maintenance");
    Route::post("/bakim-modu", [AdminController::class, "saveMaintenance"])->name("save.maintenance");

    Route::get("/cenaze-ilanları", [FuneralNoticeController::class, "index"])->name("funeral-notices.index");
    Route::get("/cenaze-ilanları/{id}/guncelle", [FuneralNoticeController::class, "edit"])->name("funeral-notice.edit");
    Route::put("/cenaze-ilanları/{id}/guncelle", [FuneralNoticeController::class, "update"])->name("funeral-notice.update");
    Route::patch("/cenaze-ilanları/{id}", [FuneralNoticeController::class, "funeralUpdateStatus"])->name("funeral-notice.updateStatus");
    Route::get("/cenaze-ilanı-sil/{id}", [FuneralNoticeController::class, "destroy"])->name("funeral-notice.destroy");

    Route::get("/cerez-politikası", [AdminController::class, "cookiePolicy"])->name("cookie-policy");
    Route::post("/cerez-politikası", [AdminController::class, "cookiePolicySave"])->name("cookie-policy.save");

    Route::get("/sosyal-medya-yonetimi", [AdminController::class, "socialMedia"])->name("social-media");
    Route::post("/sosyal-medya-yonetimi", [AdminController::class, "socialMediaSave"])->name("social-media.save");

    Route::get("/uygulama-hakkinda", [AdminController::class, "aboutApp"])->name("about-app");
    Route::post("/uygulama-hakkinda", [AdminController::class, "aboutAppSave"])->name("about-app.save");

    Route::get("/uygulama-ozellikleri", [AppFeaturesController::class, "index"])->name("app-features.index");
    Route::post("/uygulama-ozellikleri/ekle", [AppFeaturesController::class, "store"])->name("app-features.store");
    Route::get("/uygulama-ozellikleri/{slug}/guncelle", [AppFeaturesController::class, "edit"])->name("app-features.edit");
    Route::put("/uygulama-ozellikleri/{id}/guncelle", [AppFeaturesController::class, "update"])->name("app-features.update");
    Route::get("/uygulama-ozellikleri-sil/{id}", [AppFeaturesController::class, "destroy"])->name("app-features.destroy");

    Route::get("/iletisim-yonetimi", [AdminController::class, "contactManagement"])->name("contact-management");
    Route::post("/iletisim-yonetimi", [AdminController::class, "contactManagementSave"])->name("contact-management.save");

    Route::get("/oneri-ve-sikayet", [SuggestionComplaintController::class, "index"])->name("suggestions-complaints.index");
    Route::get("/oneri-ve-sikayet-sil/{id}", [SuggestionComplaintController::class, "destroy"])->name("suggestions-complaints.destroy");

    Route::get('/sliderlar', [SliderController::class, "index"])->name("sliders.index");
    Route::get('/sliderlar/ekle', [SliderController::class, "create"])->name("sliders.create");
    Route::post('/sliderlar/ekle', [SliderController::class, "store"])->name("sliders.store");
    Route::get('/slider-sil/{id}', [SliderController::class, "destroy"])->name("sliders.destroy");

    Route::get("/dualar", [PrayerController::class, "index"])->name("prayers.index");
    Route::get("/dualar/ekle", [PrayerController::class, "create"])->name("prayers.create");
    Route::post("/dualar/ekle", [PrayerController::class, "store"])->name("prayers.store");
    Route::get("/dualar/{slug}/guncelle", [PrayerController::class, "edit"])->name("prayers.edit");
    Route::put("/dualar/{id}/guncelle", [PrayerController::class, "update"])->name("prayers.update");
    Route::get("/dua-sil/{id}", [PrayerController::class, "destroy"])->name("prayers.destroy");

    Route::get("/kullanicilar", [UserController::class, "index"])->name("users.index");
    Route::get("/kullanicilar/ekle", [UserController::class, "create"])->name("users.create");
    Route::post("/kullanicilar/ekle", [UserController::class, "store"])->name("users.store");
    Route::get("/kullanicilar/{id}", [UserController::class, "show"])->name("users.show");
    Route::get("/kullanici-sil/{id}", [UserController::class, "destroy"])->name("users.destroy");
    Route::patch("/kullanici-durum-guncelle/{id}", [UserController::class, "updateStatus"])->name("users.updateStatus");

    Route::post("/kullanicilar/{id}/il-ekle", [UserController::class, "addProvince"])->name("users.provinces.store");
    Route::get("/kullanicilar/{userId}/il-sil/{provinceId}", [UserController::class, "deleteProvince"])->name("users.provinces.destroy");
    Route::post("/kullanicilar/{id}/ilce-ekle", [UserController::class, "addDistrict"])->name("users.districts.store");
    Route::get("/kullanicilar/{userId}/ilce-sil/{districtId}", [UserController::class, "deleteDistrict"])->name("users.districts.destroy");
    Route::post("/kullanicilar/{id}/kurum-ekle", [UserController::class, "addOrganisation"])->name("users.organisations.store");
    Route::get("/kullanicilar/{userId}/kurum-sil/{organisationId}", [UserController::class, "deleteOrganisation"])->name("users.organisations.destroy");

    Route::get("/hesap-guncelle", [AuthController::class, "profile"])->name("profile.edit");
    Route::put("/hesap-guncelle/{id}", [AuthController::class, "profileUpdate"])->name("profile.update");

    Route::get("/kurumlar", [OrganisationController::class, "index"])->name("organisations.index");
    Route::get("/kurumlar/ekle", [OrganisationController::class, "create"])->name("organisations.create");
    Route::post("/kurumlar/ekle", [OrganisationController::class, "store"])->name("organisations.store");
    Route::get("/kurumlar/{slug}/guncelle", [OrganisationController::class, "edit"])->name("organisations.edit");
    Route::put("/kurumlar/{id}/guncelle", [OrganisationController::class, "update"])->name("organisations.update");
    Route::get("/kurum-sil/{id}", [OrganisationController::class, "destroy"])->name("organisations.destroy");

    Route::get("/mezarliklar", [CemeteryController::class, "index"])->name("cemeteries.index");
    Route::get("/mezarliklar/ekle", [CemeteryController::class, "create"])->name("cemeteries.create");
    Route::post("/mezarliklar/ekle", [CemeteryController::class, "store"])->name("cemeteries.store");
    Route::get("/mezarliklar/{slug}/guncelle", [CemeteryController::class, "edit"])->name("cemeteries.edit");
    Route::put("/mezarliklar/{id}/guncelle", [CemeteryController::class, "update"])->name("cemeteries.update");
    Route::get("/mezarlik-sil/{id}", [CemeteryController::class, "destroy"])->name("cemeteries.destroy");

    Route::get("/vefat-edenler", [DeceasedController::class, "index"])->name("deceased.index");
    Route::get("/vefat-edenler/ekle", [DeceasedController::class, "create"])->name("deceased.create");
    Route::post("/vefat-edenler/ekle", [DeceasedController::class, "store"])->name("deceased.store");
    Route::get("/vefat-edenler/{id}/guncelle", [DeceasedController::class, "edit"])->name("deceased.edit");
    Route::put("/vefat-edenler/{id}/guncelle", [DeceasedController::class, "update"])->name("deceased.update");
    Route::get("/mevta-sil/{id}", [DeceasedController::class, "destroy"])->name("deceased.destroy");
    Route::put("/mevta-durumu-guncelle/{id}", [DeceasedController::class, "updateStatus"])->name("deceased.updateStatus");
    Route::get("/vefat-edenler/{deadId}/kurum-sil/{organisationId}", [DeceasedController::class, "deleteOrganisation"])->name("deceased.deleteOrganisation");
    Route::post("/vefat-edenler/{deadId}/kurum-ekle", [DeceasedController::class, "addOrganisation"])->name("deceased.addOrganisation");

    Route::get("/mezarlik-hizmetleri", [CemeteryServiceController::class, "index"])->name("cemetery-services.index");
    Route::post("/mezarlik-hizmetleri", [CemeteryServiceController::class, "store"])->name("cemetery-services.store");
    Route::get("/mezarlik-hizmetleri/{slug}/guncelle", [CemeteryServiceController::class, "edit"])->name("cemetery-services.edit");
    Route::put("/mezarlik-hizmetleri/{id}/guncelle", [CemeteryServiceController::class, "update"])->name("cemetery-services.update");
    Route::get("/hizmet-sil/{id}", [CemeteryServiceController::class, "destroy"])->name("cemetery-services.destroy");

    Route::get("/yardim", [HelpController::class, "index"])->name("help.index");
    Route::post("/yardim", [HelpController::class, "store"])->name("help.store");
    Route::get("/yardim/{slug}/guncelle", [HelpController::class, "edit"])->name("help.edit");
    Route::put("/yardim/{id}/guncelle", [HelpController::class, "update"])->name("help.update");
    Route::get("/yardim-sil/{id}", [HelpController::class, "destroy"])->name("help.destroy");

    Route::get("/defin-islemleri", [AdminController::class, "burialProcedures"])->name("burial-procedures");
    Route::post("/defin-islemleri", [AdminController::class, "saveBurialProcedures"])->name("save.burial-procedures");

    Route::get("/mezarlik-adabi", [AdminController::class, "cemeteryEtiquette"])->name("cemetery-etiquette");
    Route::post("/mezarlik-adabi", [AdminController::class, "saveCemeteryEtiquette"])->name("save.cemetery-etiquette");

    Route::get("/mesajlar", [MessageController::class, "index"])->name("messages.index");
    Route::get("/mesaj-sil/{id}", [MessageController::class, "destroy"])->name("messages.destroy");

    Route::get("/yorumlar", [CommentController::class, "index"])->name("comment.index");
    Route::put("/yorum/{id}/guncelle", [CommentController::class, "update"])->name("comment.update");
    Route::get("/yorum-sil/{id}", [CommentController::class, "destroy"])->name("comment.destroy");

    Route::get("yorum/{id}/cevaplar", [CommentAnswerController::class, "index"])->name("comment_answer.index");
    Route::put("/cevap/{id}/guncelle", [CommentAnswerController::class, "update"])->name("comment_answer.update");
    Route::get("/cevap-sil/{id}", [CommentAnswerController::class, "destroy"])->name("comment_answer.destroy");

    Route::put("/rol-kaydet", [AdminController::class, "updateUserRole"])->name("roles.update");

    Route::get("/urunler", [ProductController::class, "index"])->name("products.index");
    Route::get("/urunler/ekle", [ProductController::class, "create"])->name("products.create");
    Route::post("/urunler/ekle", [ProductController::class, "store"])->name("products.store");
    Route::get("/urunler/{slug}/guncelle", [ProductController::class, "edit"])->name("products.edit");
    Route::put("/urunler/{id}/guncelle", [ProductController::class, "update"])->name("products.update");
    Route::get("/urunler/{id}/sil", [ProductController::class, "destroy"])->name("products.destroy");

    Route::get("/urunler/{slug}/galeri", [ProductImageController::class, "index"])->name("products.images.index");
    Route::post("/urunler/{slug}/galeri/ekle", [ProductImageController::class, "store"])->name("products.images.store");
    Route::get("/urunler/galeri/{id}/sil", [ProductImageController::class, "destroy"])->name("products.images.destroy");
    Route::get("/panel/urunler/galeri/{id}/showroom", [ProductImageController::class, "updateShowRoom"]);
});

Route::get("/bakim-modu", function () {
    $maintenance = Maintenance::find(1);
    return view("maintenance", compact("maintenance"));
})->name("maintenance-page")->middleware("MaintenanceModeFinish");

Route::middleware(["CountVisitor", "MaintenanceModeStart"])->group(function () {
    Route::get("/", [HomeController::class, "index"])->name("home");
    Route::get("/dualar", [HomeController::class, "getPrayers"])->name("home.prayers");
    Route::get("/dualar/{slug}/detay", [PrayerController::class, "show"])->name("home.prayers.show");
    Route::get("/mezarliklar", [HomeController::class, "getCemeteries"])->name("home.cemeteries.index");
    Route::get("/mezarliklar/{slug}/detay", [CemeteryController::class, "show"])->name("home.cemeteries.show");
    Route::get("/vefat-edenler", [HomeController::class, "getDeceased"])->name("home.deceased");
    Route::post("/vefat-edenler", [HomeController::class, "deceasedStore"])->name("home.deceased.store");
    Route::get("/vefat-edenler/{id}/detay", [DeceasedController::class, "show"])->name("deceased.show");
    Route::get("/iletisim", [HomeController::class, "contact"])->name("home.contact");
    Route::get("/mezarlik-hizmetleri", [HomeController::class, "cemeteryService"])->name("home.cemetery-service");
    Route::get("/mezarlik-hizmetleri/{slug}/detay", [HomeController::class, "cemeteryServiceDetail"])->name("home.cemetery-service.show");
    Route::get("/mezarlik-adabi", [HomeController::class, "cemeteryEtiquette"])->name("home.cemetery-etiquette");
    Route::get("/defin-islemleri", [HomeController::class, "burialProcedures"])->name("home.burial-procedures");
    Route::get("/uygulama-hakkinda", [HomeController::class, "aboutApp"])->name("home.about-app");
    Route::get("/cerez-politikası", [HomeController::class, "cookiePolicy"])->name("home.cookie-policy");
    Route::get("/yardim", [HomeController::class, "help"])->name("home.help");
    Route::get("/cenaze-ilanlari", [HomeController::class, "getFuneralNotices"])->name("home.funeral-notices");
    Route::post("/cenaze-ilanlari", [FuneralNoticeController::class, "store"])->name("home.funeral-notices.store");
    Route::post("/yorum-yaz", [CommentController::class, "store"])->name("comment.store");
    Route::get("/urunler", [HomeController::class, "products"])->name("home.products");
    Route::get("/urunler/{slug}", [ProductController::class, "show"])->name("home.products.show");

    Route::post("/view-count", [HomeController::class, "funeralViewCount"])->name("viewCount");
});

// Route::get("/test", function () {
//     // $notices = DB::table("funeral_notices")->get();
//     // foreach ($notices as $notice) {
//     //     if (isset(explode(" ", $notice->first_name)[1])) {
//     //         FuneralNotice::find($notice->id)->update([
//     //             "first_name" => Str::ucfirst(Str::lower(explode(" ", $notice->first_name)[0])) . " " . Str::ucfirst(Str::lower(explode(" ", $notice->first_name)[1])),
//     //             "last_name" => Str::upper($notice->last_name)
//     //         ]);
//     //         echo Str::ucfirst(Str::lower(explode(" ", $notice->first_name)[0])) . " " . Str::ucfirst(Str::lower(explode(" ", $notice->first_name)[1])) . " " . Str::ucfirst(Str::lower($notice->last_name));
//     //     } else {
//     //         FuneralNotice::find($notice->id)->update([
//     //             "first_name" => Str::ucfirst(Str::lower(explode(" ", $notice->first_name)[0])),
//     //             "last_name" => Str::upper($notice->last_name)
//     //         ]);
//     //         echo Str::ucfirst(Str::lower(explode(" ", $notice->first_name)[0])) . " " . Str::upper($notice->last_name);
//     //     }
//     // }
//     // $deceased = DB::table("deceased")->get();
//     // foreach ($deceased as $dead) {
//     //     if (isset(explode(" ", $dead->full_name)[2])) {
//     //         Deceased::find($dead->id)->update([
//     //             "full_name" => Str::ucfirst(Str::lower(explode(" ", $dead->full_name)[0])) . " " . Str::ucfirst(Str::lower(explode(" ", $dead->full_name)[1])) . " " . Str::upper(explode(" ", $dead->full_name)[2]),
//     //         ]);
//     //         echo Str::ucfirst(Str::lower(explode(" ", $dead->full_name)[0])) . " " . Str::ucfirst(Str::lower(explode(" ", $dead->full_name)[1])) . " " .  Str::upper(explode(" ", $dead->full_name)[2]);
//     //     } else {
//     //         Deceased::find($dead->id)->update([
//     //             "full_name" => Str::ucfirst(Str::lower(explode(" ", $dead->full_name)[0])) . " " . Str::upper(explode(" ", $dead->full_name)[1]),
//     //         ]);
//     //         echo Str::ucfirst(Str::lower(explode(" ", $dead->full_name)[0])) . " " . Str::upper(explode(" ", $dead->full_name)[1]);
//     //     }
//     // }
// });

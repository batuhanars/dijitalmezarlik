<?php

namespace App\Providers;

use App\Models\AboutApp;
use App\Models\ContactManagement;
use App\Models\Maintenance;
use App\Models\Setting;
use App\Models\SocialMedia;
use Carbon\Carbon;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // view()->share("setting", Setting::find(1));
        // view()->share("aboutApp", AboutApp::find(1));
        // view()->share("socialMedia", SocialMedia::find(1));
        // view()->share("contact", ContactManagement::find(1));

        // if (Maintenance::where("opening_date", "<=", Carbon::now()->format("Y-m-d H:i"))->find(1)) {
        //     Maintenance::find(1)->update([
        //         "status" => "passive",
        //     ]);
        // }
    }
}

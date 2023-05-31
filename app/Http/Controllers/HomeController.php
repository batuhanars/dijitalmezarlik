<?php


namespace App\Http\Controllers;

use App\FileUpload\FileUpload;
use App\Http\Requests\DeceasedRequest;
use App\Http\Requests\FuneralNoticeRequest;
use App\Http\Requests\HomeDeceasedRequest;
use App\Models\AboutApp;
use App\Models\AppFeature;
use App\Models\BurialProcedure;
use App\Models\Cemetery;
use App\Models\CemeteryEtiquette;
use App\Models\CemeteryService;
use App\Models\ContactManagement;
use App\Models\CookiePolicy;
use App\Models\Deceased;
use App\Models\District;
use App\Models\FuneralNotice;
use App\Models\Help;
use App\Models\Neighborhood;
use App\Models\Organisation;
use App\Models\OrganisationDeceased;
use App\Models\Prayer;
use App\Models\Product;
use App\Models\Province;
use App\Models\Slider;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class HomeController extends Controller
{
    public function __construct()
    {
        view()->share("selectboxProvinces", Province::all());
        view()->share("funeralCemeteries", Cemetery::all());
        view()->share("selectboxCemeteries", Cemetery::all());
        view()->share("selectboxOrganisations", Organisation::all());
        view()->share("jobs", DB::table("jobs")->get());
        view()->share("countries", DB::table("countries")->get());
    }
    public function index()
    {
        $cemeteries = Cemetery::with("province", "district")->orderBy("created_at", "DESC")->take(8)->get();

        $provinces = Province::with("dead")->get();
        $appFeatures = AppFeature::take(3)->get();
        $whoDiedToday = Deceased::with("province", "district")
            ->where("day_of_death", "=", Carbon::now()->format("d"))
            ->where("month_of_death", "=", Carbon::now()->format("m"))
            ->where("year_of_death", "=", Carbon::now()->format("Y"))->take(8)->get();
        $sliders = Slider::orderBy("created_at", "DESC")->get();
        $funeralAddedToday = FuneralNotice::with("province", "district", "neighborhood")->whereDate("date_of_death", "=", Carbon::now()->format("Y-m-d"))->take(6)->get();

        $totalDeceased = Deceased::count();
        $totalCemetery = Cemetery::count();
        $totalTomb = Cemetery::where("type", "tomb")->count();
        $totalMartyrdom = Cemetery::where("type", "martyrdom")->count();
        $totalMonument = Cemetery::where("type", "monument")->count();

        $deceasedInfo = new Deceased;

        return view(
            "front.index",
            compact(
                "cemeteries",
                "provinces",
                "appFeatures",
                "whoDiedToday",
                "sliders",
                "funeralAddedToday",
                "totalDeceased",
                "totalCemetery",
                "totalTomb",
                "totalMartyrdom",
                "totalMonument",
                "deceasedInfo"
            )
        );
    }

    public function getPrayers()
    {
        $prayers = new Prayer;
        if (request()->get("dua")) {
            $prayers = $prayers->where("title", "LIKE", "%" . request()->get("dua") . "%");
        }
        $prayers = $prayers->orderBy("created_at", "DESC")->paginate(24)->withQueryString();
        return view("front.prayers", compact("prayers"));
    }

    public function getCemeteries()
    {
        $cemeteries = Cemetery::with("deceased", "province", "district");
        if (request()->get("cemetery")) {
            $cemeteries = $cemeteries->where("title", "LIKE", "%" . request()->get("cemetery") . "%");
        }
        $cemeteries = $cemeteries->orderBy("created_at", "DESC")->paginate(24)->withQueryString();
        return view("front.cemeteries", compact("cemeteries"));
    }

    public function getDeceased()
    {
        $deceased = Deceased::with("cemetery", "province", "district", "neighborhood");
        $districts = null;
        $neighborhoods = null;
        $selectboxCemeteries = null;

        if (request()->get("ad_soyad")) {
            $deceased = $deceased->where("full_name", "LIKE", "%" . request()->get("ad_soyad") . "%");
        }
        if (request()->get("il")) {
            $deceased = $deceased->where("province_id", request()->get("il"));
            $districts = District::query()->where('province_id', request()->get("il"))->get();
        }
        if (request()->get("ilce")) {
            $deceased = $deceased->where("district_id", request()->get("ilce"));
            $neighborhoods = Neighborhood::query()->where('province_id', request()->get("il"))->where('district_id', request()->get("ilce"))->get();
        }
        if (request()->get("mahalle")) {
            $deceased = $deceased->where("neighborhood_id", request()->get("mahalle"));
            $selectboxCemeteries = Cemetery::query()->where('neighborhood_id', request()->get("mahalle"))->get();
        }
        if (request()->get("mezarlik")) {
            $deceased = $deceased->where("cemetery_id", request()->get("mezarlik"));
        }
        if (request()->get("kurum")) {
            $deceased = $deceased->where("organisation_id", request()->get("kurum"));
        }
        if (request()->get("baba_adi")) {
            $deceased = $deceased->where("father_name", "LIKE", "%" . request()->get("baba_adi") . "%");
        }
        if (request()->get("anne_adi")) {
            $deceased = $deceased->where("mother_name", "LIKE", "%" . request()->get("anne_adi") . "%");
        }
        if (request()->get("dogum_tarihi")) {
            $deceased = $deceased->where("day_of_birth", Carbon::create(request()->get('dogum_tarihi'), 'Europe/Istanbul')->format('j') . "")
                ->where("month_of_birth", Carbon::create(request()->get('dogum_tarihi'), 'Europe/Istanbul')->translatedFormat('F') . "")
                ->where("year_of_birth", Carbon::create(request()->get('dogum_tarihi'), 'Europe/Istanbul')->format('Y') . "");
        }
        if (request()->get("olum_tarihi")) {
            $deceased = $deceased->where("day_of_death", Carbon::create(request()->get('olum_tarihi'), 'Europe/Istanbul')->format('j'))
                ->where("month_of_death", Carbon::create(request()->get('olum_tarihi'), 'Europe/Istanbul')->translatedFormat('F'))
                ->where("year_of_death", Carbon::create(request()->get('olum_tarihi'), 'Europe/Istanbul')->format('Y'));
        }
        $deceased = $deceased->where("status", "1")->orderBy("created_at", "DESC")->paginate(12)->withQueryString();
        return view("front.deceased", compact("deceased", "districts", "neighborhoods", "selectboxCemeteries"));
    }

    public function deceasedStore(HomeDeceasedRequest $request)
    {
        if ($request->hasFile("image")) {
            $fileNameWithUpload = FileUpload::disk("/upload/deceased")->file($request->image)->upload();
            $request->merge([
                "image" => $fileNameWithUpload
            ]);
        }
        $content = $request->content;
        $dom = new \DomDocument();
        $dom->loadHtml(mb_convert_encoding($content, 'HTML-ENTITIES', 'UTF-8'), LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD);
        $imageFile = $dom->getElementsByTagName('img');

        foreach ($imageFile as $key => $img) {
            $data = $img->getAttribute('src');

            list($type, $data) = explode(';', $data);
            list(, $data)      = explode(',', $data);
            $data = base64_decode($data);
            $image_name = "/upload/deceased/" . time() . $key . ".png";
            $path = public_path() . $image_name;

            file_put_contents($path, $data);

            $img->removeAttribute('src');
            $img->setAttribute('src', $image_name);
        }

        $content = $dom->saveHTML();

        $request->merge([
            "content" => $content
        ]);

        if (isset(explode(" ", $request->first_name)[1])) {
            $request->merge([
                "full_name" => Str::ucfirst(Str::lower(explode(" ", $request->first_name)[0])) . " " . Str::ucfirst(Str::lower(explode(" ", $request->first_name)[1])) . " " . Str::upper($request->last_name)
            ]);
        } else {
            $request->merge([
                "full_name" => Str::ucfirst(Str::lower($request->first_name)) . " " . Str::upper($request->last_name)
            ]);
        }

        $dead = Deceased::create($request->post());

        foreach ($request->organisation_id as $organisation) {
            OrganisationDeceased::create([
                "organisation_id" => $organisation,
                "deceased_id" => $dead->id,
            ]);
        }

        return back()->withSuccess("Mevta başarıyla eklendi! Onay sürecinden geçtikten sonra anasayfaya düşecektir.");
    }

    public function contact()
    {
        return view("front.contact");
    }

    public function cemeteryService()
    {
        $cemeteryServices = new CemeteryService;
        if (request()->get("hizmet")) {
            $cemeteryServices = $cemeteryServices->where("title", "LIKE", "%" . request("hizmet") . "%");
        }
        $cemeteryServices = $cemeteryServices->orderBy("created_at", "DESC")->paginate(12)->withQueryString();
        return view("front.cemetery-service", compact("cemeteryServices"));
    }

    public function cemeteryServiceDetail($slug)
    {
        $cemeteryService = CemeteryService::where("slug", $slug)->first();
        return view("front.cemetery-service-detail", compact("cemeteryService"));
    }

    public function cemeteryEtiquette()
    {
        $cemeteryEtiquette = CemeteryEtiquette::find(1);
        return view("front.cemetery-etiquette", compact("cemeteryEtiquette"));
    }

    public function burialProcedures()
    {
        $burialProcedures = BurialProcedure::find(1);
        return view("front.burial-procedures", compact("burialProcedures"));
    }

    public function aboutApp()
    {
        return view("front.about-app");
    }

    public function cookiePolicy()
    {
        $cookiePolicy = CookiePolicy::find(1);
        return view("front.cookie-policy", compact("cookiePolicy"));
    }

    public function help()
    {
        $helpQuestions = Help::all();
        return view("front.help", compact("helpQuestions"));
    }

    public function getFuneralNotices()
    {
        $funerals = FuneralNotice::with("province", "district", "neighborhood");
        if (request()->get("olum_tarihi")) {
            $funerals = $funerals->where("date_of_death", request()->get("olum_tarihi"));
        }
        $funerals = $funerals->orderBy("date_of_death", "DESC")->paginate(12);
        return view("front.funeral-notices", compact("funerals"));
    }

    public function funeralViewCount(Request $request)
    {
        $funeralView = FuneralNotice::find($request->funeral_id);
        $funeralView->views += 1;
        $funeralView->save();
    }

    public function products()
    {
        $products = Product::where("status", 1)->orderBy("created_at", "DESC");
        if (request()->get("urun")) {
            $products = $products->where("title", "LIKE", "%" . request()->get("urun") . "%");
        }
        $products = $products->paginate(24)->withQueryString();
        return view("front.products", compact("products"));
    }
}

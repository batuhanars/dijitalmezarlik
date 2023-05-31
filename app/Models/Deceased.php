<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Deceased extends Model
{
    use HasFactory;

    protected $table = "deceased";

    protected $fillable = [
        "image",
        "country_id",
        "province_id",
        "district_id",
        "cemetery_id",
        "province_name",
        "district_name",
        "cemetery_name",
        "neighborhood_id",
        "neighborhood_name",
        "creator_id",
        "full_name",
        "gender",
        "maiden_name",
        "father_name",
        "mother_name",
        "is_married",
        "spouse_name",
        "job",
        "content",
        "year_of_birth",
        "month_of_birth",
        "day_of_birth",
        "year_of_death",
        "month_of_death",
        "day_of_death",
        "place_of_birth",
        "status"
    ];

    // public function setFullNameAttribute($value)
    // {
    //     if (isset(explode(" ", $value)[2])) {
    //         $this->attributes['full_name'] = Str::ucfirst(Str::lower(explode(" ", $value)[0])) . " " . Str::ucfirst(Str::lower(explode(" ", $value)[1])) . " " . Str::ucfirst(Str::lower(explode(" ", $value)[2]));
    //     } else {
    //         $this->attributes['full_name'] = Str::ucfirst(Str::lower(explode(" ", $value)[0])) . " " . Str::ucfirst(Str::lower(explode(" ", $value)[1]));
    //     }
    // }

    public function getTranslatedMonth($value)
    {
        if ($value == "01") {
            return "Ocak";
        }
        if ($value == "02") {
            return "Şubat";
        }
        if ($value == "03") {
            return "Mart";
        }
        if ($value == "04") {
            return "Nisan";
        }
        if ($value == "05") {
            return "Meyıs";
        }
        if ($value == "06") {
            return "Haziran";
        }
        if ($value == "07") {
            return "Temmuz";
        }
        if ($value == "08") {
            return "Ağustos";
        }
        if ($value == "09") {
            return "Eylül";
        }
        if ($value == "10") {
            return "Ekim";
        }
        if ($value == "11") {
            return "Kasım";
        }
        if ($value == "12") {
            return "Aralık";
        }
    }

    public function creator()
    {
        return $this->belongsTo("App\Models\User");
    }

    public function comments()
    {
        return $this->hasMany("App\Models\Comment", "dead_id");
    }

    public function country()
    {
        return $this->belongsTo("App\Models\Country");
    }

    public function province()
    {
        return $this->belongsTo("App\Models\Province");
    }

    public function district()
    {
        return $this->belongsTo("App\Models\District");
    }

    public function cemetery()
    {
        return $this->belongsTo("App\Models\Cemetery");
    }

    public function organisations()
    {
        return $this->belongsToMany(Organisation::class, "organisation_deceased");
    }

    public function neighborhood()
    {
        return $this->hasOne("App\Models\Neighborhood", 'id', 'neighborhood_id');
    }

    // Bugün Vefat Edenler
    public function scopewhoDiedToday($query)
    {
        return $query->whereDay("day_of_death", "=", Carbon::now()->format("d"))->count();
    }
    // Dün Vefat Edenler
    public function scopethoseWhoDiedYesterday($query)
    {
        return $query->whereDay("day_of_death", "=", Carbon::yesterday()->format("d"))->count();
    }
    // Bu Ay Vefat Edenler
    public function scopewhoDiedThisMonth($query)
    {
        return $query->where("month_of_death", Carbon::now()->format("m"))->count();
    }
    // Bu Yıl Vefat Edenler
    public function scopewhoDiedThisYear($query)
    {
        return $query->where("year_of_death", date("Y"))->count();
    }
    //---------- Aylık Vefat İstatistiği -----------\\
    public function scopethoseWhoDiedInJanuary($query)
    {
        return $query->where("month_of_death", "=", "01")->count();
    }

    public function scopethoseWhoDiedInFebruary($query)
    {
        return $query->where("month_of_death", "=", "02")->count();
    }

    public function scopethoseWhoDiedInMarch($query)
    {
        return $query->where("month_of_death", "=", "03")->count();
    }

    public function scopethoseWhoDiedInApril($query)
    {
        return $query->where("month_of_death", "=", "04")->count();
    }

    public function scopethoseWhoDiedInMay($query)
    {
        return $query->where("month_of_death", "=", "05")->count();
    }

    public function scopethoseWhoDiedInJune($query)
    {
        return $query->where("month_of_death", "=", "06")->count();
    }

    public function scopethoseWhoDiedInJuly($query)
    {
        return $query->where("month_of_death", "=", "07")->count();
    }

    public function scopethoseWhoDiedInAugust($query)
    {
        return $query->where("month_of_death", "=", "08")->count();
    }

    public function scopethoseWhoDiedInSeptember($query)
    {
        return $query->where("month_of_death", "=", "09")->count();
    }

    public function scopethoseWhoDiedInOctober($query)
    {
        return $query->where("month_of_death", "=", "10")->count();
    }

    public function scopethoseWhoDiedInNovember($query)
    {
        return $query->where("month_of_death", "=", "11")->count();
    }

    public function scopethoseWhoDiedInDecember($query)
    {
        return $query->where("month_of_death", "=", "12")->count();
    }
    //-------- Aylık Vefat İstatistiği Son ---------\\
    //-------- Yıllık Vefat İstatistiği ---------\\
    public function scopewhoDiedInTwoThousandTen($query)
    {
        return $query->where("year_of_death", "=", "2011")->count();
    }

    public function scopewhoDiedInTwoThousandEleven($query)
    {
        return $query->where("year_of_death", "=", "2012")->count();
    }

    public function scopewhoDiedInTwoThousandTwelve($query)
    {
        return $query->where("year_of_death", "=", "2013")->count();
    }

    public function scopewhoDiedInTwoThousandThirteen($query)
    {
        return $query->where("year_of_death", "=", "2014")->count();
    }

    public function scopewhoDiedInTwoThousandFourteen($query)
    {
        return $query->where("year_of_death", "=", "2015")->count();
    }

    public function scopewhoDiedInTwoThousandFifteen($query)
    {
        return $query->where("year_of_death", "=", "2016")->count();
    }

    public function scopewhoDiedInTwoThousandSixteen($query)
    {
        return $query->where("year_of_death", "=", "2017")->count();
    }

    public function scopewhoDiedInTwoThousandSeventeen($query)
    {
        return $query->where("year_of_death", "=", "2018")->count();
    }

    public function scopewhoDiedInTwoThousandEighteen($query)
    {
        return $query->where("year_of_death", "=", "2019")->count();
    }

    public function scopewhoDiedInTwoThousandNineteen($query)
    {
        return $query->where("year_of_death", "=", "2020")->count();
    }

    public function scopewhoDiedInTwoThousandTwenty($query)
    {
        return $query->where("year_of_death", "=", "2021")->count();
    }

    public function scopewhoDiedInTwoThousandTwentyOne($query)
    {
        return $query->where("year_of_death", "=", "2022")->count();
    }
    //-------- Yıllık Vefat İstatistiği Son ---------\\
}

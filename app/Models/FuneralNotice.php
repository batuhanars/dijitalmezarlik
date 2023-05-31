<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FuneralNotice extends Model
{
    use HasFactory;

    protected $fillable = [
        "country_id",
        "province_id",
        "district_id",
        "neighborhood_id",
        "province_name",
        "district_name",
        "neighborhood_name",
        "owner",
        "cemetery",
        "first_name",
        "last_name",
        "gender",
        "maiden_name",
        "father_name",
        "mosque",
        "funeral_time",
        "funeral_hour",
        "funeral_address",
        "date_of_death",
        "status"
    ];

    protected $dates = [
        "date_of_death"
    ];

    public function setOwnerAttribute($value)
    {
        if (isset(explode(" ", $value)[2])) {
            $this->attributes['owner'] = Str::ucfirst(Str::lower(explode(" ", $value)[0])) . " " . Str::ucfirst(Str::lower(explode(" ", $value)[1])) . " " . Str::ucfirst(Str::lower(explode(" ", $value)[2]));
        } else {
            if (isset(explode(" ", $value)[1])) {
                $this->attributes['owner'] = Str::ucfirst(Str::lower(explode(" ", $value)[0])) . " " . Str::ucfirst(Str::lower(explode(" ", $value)[1]));
            } else {
                $this->attributes['owner'] = Str::ucfirst(Str::lower(explode(" ", $value)[0]));
            }
        }
    }

    public function setFirstNameAttribute($value)
    {
        if (isset(explode(" ", $value)[1])) {
            $this->attributes['first_name'] = Str::ucfirst(Str::lower(explode(" ", $value)[0])) . " " . Str::ucfirst(Str::lower(explode(" ", $value)[1]));
        } else {
            $this->attributes['first_name'] = Str::ucfirst(Str::lower(explode(" ", $value)[0]));
        }
    }

    public function setLastNameAttribute($value)
    {
        $this->attributes['last_name'] = Str::upper($value);
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

    public function neighborhood()
    {
        return $this->belongsTo("App\Models\Neighborhood");
    }
}

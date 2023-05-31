<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        "image",
        'full_name',
        "province_district_customization",
        'email',
        'address',
        "phone",
        "token",
        'password',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    public function role()
    {
        return $this->hasOne("App\Models\UserRole");
    }

    public function provinces()
    {
        return $this->belongsToMany("App\Models\Province", "user_provinces");
    }

    public function districts()
    {
        return $this->belongsToMany("App\Models\District", "user_districts");
    }

    public function organisations()
    {
        return $this->belongsToMany("App\Models\Organisation", "user_organisations");
    }

    public function setPasswordAttribute($value)
    {
        if ($value != null) {
            $this->attributes['password'] = Hash::make($value);
        }
    }
}

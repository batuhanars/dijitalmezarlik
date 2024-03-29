<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserProvince extends Model
{
    use HasFactory;

    protected $fillable = ["user_id", "province_id"];

    public $timestamps = false;
}

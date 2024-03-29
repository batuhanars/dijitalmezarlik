<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Maintenance extends Model
{
    use HasFactory;

    protected $table = "maintenance";
    protected $fillable = ["title", "status", "description", "opening_date"];
    protected $dates = ["opening_date"];
    public $timestamps = false;
}

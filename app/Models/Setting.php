<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;

    protected $fillable = [
        "dark_logo",
        "white_logo",
        "favicon",
        "pages_image",
        "title",
        "keywords",
        "description"
    ];

    public $timestamps = false;
}

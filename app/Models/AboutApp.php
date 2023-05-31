<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AboutApp extends Model
{
    use HasFactory;

    protected $table = "about_app";
    protected $fillable = ["images", "video_image", "video", "title", "content"];
    public $timestamps = false;
}

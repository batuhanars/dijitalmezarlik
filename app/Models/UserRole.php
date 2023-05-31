<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    use HasFactory;

    protected $fillable = [
        "user_id",
        "site_management",
        "user_management",
        "page_management",
        "slider_management",
        "cemetery_management",
        "dead_management",
        "prayer_management",
        "notification_management",
        "organisation_management",
        "funeral_management",
        "product_management",
    ];

    public $timestamps = false;
}

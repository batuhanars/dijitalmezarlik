<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CemeteryEtiquette extends Model
{
    use HasFactory;

    protected $table = "cemetery_etiquette";

    protected $fillable = ["title", "content"];
}

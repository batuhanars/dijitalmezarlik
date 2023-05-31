<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuggestionComplaint extends Model
{
    use HasFactory;

    protected $table = "suggestions_complaints";
    protected $fillable = ["name", "email", "title", "topic"];
}

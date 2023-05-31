<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrganisationDeceased extends Model
{
    use HasFactory;

    protected $table = "organisation_deceased";
    protected $fillable = [
        "organisation_id",
        "deceased_id",
    ];

    public function organisation()
    {
        return $this->belongsTo(Organisation::class);
    }

    public function deceased()
    {
        return $this->belongsTo(Deceased::class);
    }
}

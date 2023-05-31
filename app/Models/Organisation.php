<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Organisation extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ["name", "slug", "email", "tax_number", "address", "phone"];

    public function province()
    {
        return $this->belongsTo("App\Models\Province");
    }

    public function district()
    {
        return $this->belongsTo("App\Models\District");
    }

    public function deceased()
    {
        return $this->belongsToMany(Deceased::class, "organisation_deceased");
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name',
                'onUpdate' => true,
            ]
        ];
    }
}

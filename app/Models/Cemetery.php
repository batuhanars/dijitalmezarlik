<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Cemetery extends Model
{
    use HasFactory, Sluggable;

    protected $fillable = ["province_id", "district_id", "neighborhood_id", "type", "image", "title", "slug", "phone", "address", "address_map", "content", "opening_time", "closing_time"];

    public function province()
    {
        return $this->belongsTo("App\Models\Province");
    }

    public function district()
    {
        return $this->belongsTo("App\Models\District");
    }

    public function neighborhood()
    {
        return $this->hasOne("App\Models\Neighborhood", 'id', 'neighborhood_id');
    }

    public function deceased()
    {
        return $this->hasMany("App\Models\Deceased");
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true,
            ]
        ];
    }

    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucfirst($value);
    }
}

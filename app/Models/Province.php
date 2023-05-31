<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function dead()
    {
        return $this->hasMany("App\Models\Deceased");
    }

    public function districts()
    {
        return $this->hasMany("App\Models\District");
    }

    public function neighborhoods()
    {
        return $this->hasMany("App\Models\Neighborhood");
    }
}

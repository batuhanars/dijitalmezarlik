<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visitor extends Model
{
    use HasFactory;

    protected $fillable = ["ip"];
    public $timestamps = false;

    public function scopevisitorsToday($query)
    {
        return $query->whereDay("date", "=", Carbon::now()->format("d"))->count();
    }

    public function scopevisitorsYesterday($query)
    {
        return $query->whereDay("date", "=", Carbon::yesterday()->format("d"))->count();
    }

    public function scopevisitorsThisMonth($query)
    {
        return $query->whereMonth("date", "=", Carbon::now()->format("m"))->count();
    }

    public function scopevisitorsInJanuary($query)
    {
        return $query->whereMonth("date", "=", "1")->count();
    }

    public function scopevisitorsInFebruary($query)
    {
        return $query->whereMonth("date", "=", "2")->count();
    }

    public function scopevisitorsInMarch($query)
    {
        return $query->whereMonth("date", "=", "3")->count();
    }

    public function scopevisitorsInApril($query)
    {
        return $query->whereMonth("date", "=", "4")->count();
    }

    public function scopevisitorsInMay($query)
    {
        return $query->whereMonth("date", "=", "5")->count();
    }

    public function scopevisitorsInJune($query)
    {
        return $query->whereMonth("date", "=", "6")->count();
    }

    public function scopevisitorsInJuly($query)
    {
        return $query->whereMonth("date", "=", "7")->count();
    }
    public function scopevisitorsInAugust($query)
    {
        return $query->whereMonth("date", "=", "8")->count();
    }

    public function scopevisitorsInSeptember($query)
    {
        return $query->whereMonth("date", "=", "9")->count();
    }

    public function scopevisitorsInOctober($query)
    {
        return $query->whereMonth("date", "=", "10")->count();
    }

    public function scopevisitorsInNovember($query)
    {
        return $query->whereMonth("date", "=", "11")->count();
    }

    public function scopevisitorsInDecember($query)
    {
        return $query->whereMonth("date", "=", "12")->count();
    }
}

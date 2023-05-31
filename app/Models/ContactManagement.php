<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactManagement extends Model
{
    use HasFactory;

    protected $table = "contact_management";
    protected $fillable = ["title", "phone", "email", "address", "address_map"];
    public $timestamps = false;
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    protected $fillable = ["dead_id", "comment_full_name", "comment_email", "comment_title", "comment_message", "status"];

    public function answers()
    {
        return $this->hasMany("App\Models\CommentAnswer")->orderBy("created_at", "DESC");
    }

    public function dead()
    {
        return $this->belongsTo("App\Models\Deceased", "dead_id");
    }
}

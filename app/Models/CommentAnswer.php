<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommentAnswer extends Model
{
    use HasFactory;

    protected $fillable = ["comment_id", "answer_full_name", "answer_email", "answer_title", "answer_message", "status"];

    public function author()
    {
        return $this->belongsTo("App\Models\User");
    }
}

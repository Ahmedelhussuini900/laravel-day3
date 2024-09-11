<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;


use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    // Assuming you have the fillable properties defined
    protected $fillable = ['content', 'user_id'];

   

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
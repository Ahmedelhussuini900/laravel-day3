<?php
namespace App\Models;

use App\Models\Comment;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Correct import
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Carbon\Carbon;


class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['title', 'posted_by', 'image', 'created_at', 'updated_at'];

    public function user()
    {
        return $this->belongsTo(User::class, 'posted_by');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function getFormattedCreatedAtAttribute()
{
    return Carbon::parse($this->created_at)->format('l, F j, Y \a\t g:i A');
}


}

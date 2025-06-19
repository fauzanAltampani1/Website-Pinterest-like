<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'image', 'status','title'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function likes()
    {
        return $this->hasMany(Like::class);
    }
    
    public function likeCount()
    {
        return $this->likes()->count();
    }
    
    public function isLikedByUser($userId)
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }
    
    public function isLikedByGuest($ip)
    {
        return $this->likes()->where('ip_address', $ip)->exists();
    }
    


}


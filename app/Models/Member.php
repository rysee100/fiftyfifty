<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;
use App\Models\Post;

class Member extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'member_name'
    ];
    
    public function users()
    {
        return $this->belongsTo(User::class);
    
    }
    
    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}

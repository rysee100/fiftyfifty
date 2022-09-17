<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;
use App\Models\Member;

class Post extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'user_id',
        'member_id',
        'post_name',
        'price',
        'comment',
        'date'
    ];
    
    public function users()
    {
        return $this->belongsTo(User::class);
    
    }
    
    public function members()
    {
        return $this->belongsTo(Member::class);
    
    }
    
}

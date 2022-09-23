<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;
use App\Models\Member;
use Carbon\Carbon;

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
    
    protected function postDate(): Attribute
    {
        return new Attribute(
            get: fn() => Carbon::parse($this->date)->format('Y年m月d日')
            );
    }
    
    protected function monthList(): Attribute
    {
        return new Attribute(
            get: fn() => Carbon::parse($this->date)->format('Y年m月')
            );
    }
    
    public function users()
    {
        return $this->belongsTo(User::class);
    
    }
    
    public function members()
    {
        return $this->belongsTo(Member::class);
    
    }
    
}

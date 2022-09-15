<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Carbon\Carbon;
use App\Models\User;

class Member extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'name'
    ];
    
    public function users()
    {
        return $this->belongsTo(User::class);
    
    }
}

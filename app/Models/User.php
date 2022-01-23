<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Model
{
    protected $fillable = [
        'name',
        'last_name',
        'email',
    ];

    protected $hidden = [
        'pivot'
    ];

    protected $casts = [
        'created_at'  => 'datetime:Y-m-d H:i',
        'updated_at' => 'datetime:Y-m-d H:i',
    ];

    public function settings(){
        return $this->belongsToMany(Setting::class);
    }

    public function tests(){
        return $this->belongsToMany(Test::class);
    }

    public function courses(){
        return $this->belongsToMany(Course::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    protected $table = 'users';
    use HasApiTokens;

    protected $fillable = [
        'name',
        'email',
        'password',
        'token'
    ];

    
}

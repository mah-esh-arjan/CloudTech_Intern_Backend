<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;

class Admin extends Authenticatable 
{
    use HasApiTokens;

    protected $table = "admins";
    protected $primaryKey = "id";

    public function setPasswordAttribute($value) {
        $this->attributes['password'] = Hash::make($value);
    }

    protected $fillable = [
        'email',
        'password'

    ];
}

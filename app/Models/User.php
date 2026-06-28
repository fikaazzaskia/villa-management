<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'users';
    protected $primaryKey = 'username';
    public $incrementing = false;
    public $timestamps = false;
    protected $fillable = ['username', 'password', 'extend', 'status', 'role'];
}
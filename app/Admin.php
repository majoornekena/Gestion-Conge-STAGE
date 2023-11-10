<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Admin extends Authenticatable
{
    protected $fillable = [
        'users',
        'mdp',
        'api_token',
    ];

    protected $primaryKey = 'idadmin';
    protected $table = 'admins';

    public $timestamps = false;
}

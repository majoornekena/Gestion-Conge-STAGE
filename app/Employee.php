<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Employee extends Authenticatable
{
    protected $fillable = [
        'nom',
        'prenom',
        'mail',
        'mdp',
        'imgprofile',
        'sexe',
        'etatsup',
        'api_token',
    ];

    protected $primaryKey = 'idemploye';
    protected $table = 'employes';

    public $timestamps = false;
}

<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Typeconge extends Authenticatable
{
    protected $fillable = [
        'typeconge',
        'description',
        'dureemax',
        'etatsup',
    ];

    protected $primaryKey = 'idtypeconge';
    protected $table = 'typeconges';

    public $timestamps = false;
}

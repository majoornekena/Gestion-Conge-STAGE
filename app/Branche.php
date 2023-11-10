<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Branche extends Authenticatable
{
    protected $fillable = [
        'branche',
        'description',
        'etatsup',
    ];

    protected $primaryKey = 'idbranche';
    protected $table = 'branches';

    public $timestamps = false;
}

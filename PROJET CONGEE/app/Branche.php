<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Branche extends Authenticatable
{
    protected $fillable = [
        'branche',
        'description',
    ];

    protected $primaryKey = 'idbranche';
    protected $table = 'branches';

    public $timestamps = false;
}

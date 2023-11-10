<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class acte extends Model
{
    protected $fillable = [
        'acte',
        'budget_annuel',
        'code',
        'etatsup'
    ];

    public $timestamps = false;
    protected $primaryKey = "idacte";
    public $incrementing = false;
}

<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class actepatient extends Model
{
    protected $fillable = [
        'idfacture',
        'idacte',
        'quantite',
        'tarif',
        'etatsup',
    ];

    public $timestamps = false;
    protected $primaryKey = "idactepatient";
    public $incrementing = false;
}
?>

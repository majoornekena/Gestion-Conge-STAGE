<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class patient extends Model
{
    protected $fillable = [
        'nom',
        'datenaissance',
        'genre',
        'etatsup',
        'remboursement'

    ];

    public $timestamps = false;
    protected $primaryKey = "idpatient";
    public $incrementing = false;
}
?>
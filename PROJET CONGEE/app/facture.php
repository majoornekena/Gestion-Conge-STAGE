<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class facture extends Model
{
    protected $fillable = [
        'idpatient',
        'datefacture',
        'etatsup',
        'etatremboursement'

    ];

    public $timestamps = false;
    protected $primaryKey = "idfacture";
    public $incrementing = false;
}
?>

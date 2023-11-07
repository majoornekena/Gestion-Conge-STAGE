<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class depense extends Model
{
 
    protected $fillable = [
        'idtypedepense',
        'datedepense',
        'montant',
        'quantite',
        'etatsup',
    ];
    protected $primaryKey = 'iddepense';
    public $timestamps = false;
    public $incrementing = false;


}

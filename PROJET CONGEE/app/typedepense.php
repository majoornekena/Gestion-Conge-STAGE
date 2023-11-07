<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class typedepense extends Model
{
    protected $fillable = [
        'typedepense',
        'etatsup',
        'budget_annuel',
        'code'
    ];

    public $timestamps = false;
    protected $primaryKey = "idtypedepense";
    public $incrementing = true;
}
?>

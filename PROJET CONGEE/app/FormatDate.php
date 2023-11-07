<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable ; //pour authentifier ma classe
use Illuminate\Auth\Authenticatable as Functable ;    //pour mettre les 6 fonctions abstraites
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class FormatDate extends Model
{

    public static function format($date){
        $carbonDate = Carbon::createFromFormat('Y-m-d', $date);
        $date_formatee_fr = $carbonDate->isoFormat('D MMMM YYYY');
        
        return $date_formatee_fr;
    }
    

}

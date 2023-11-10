<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable ; //pour authentifier ma classe
use Illuminate\Auth\Authenticatable as Functable ;    //pour mettre les 6 fonctions abstraites
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class FormatMois extends Model
{
    public static function formatMois($mois)
    {
        $mois_formate_fr = '';
        
        switch ($mois) {
            case 1:
                $mois_formate_fr = 'Janvier';
                break;
            case 2:
                $mois_formate_fr = 'Février';
                break;
            case 3:
                $mois_formate_fr = 'Mars';
                break;
            case 4:
                $mois_formate_fr = 'Avril';
                break;
            case 5:
                $mois_formate_fr = 'Mai';
                break;
            case 6:
                $mois_formate_fr = 'Juin';
                break;
            case 7:
                $mois_formate_fr = 'Juillet';
                break;
            case 8:
                $mois_formate_fr = 'Août';
                break;
            case 9:
                $mois_formate_fr = 'Septembre';
                break;
            case 10:
                $mois_formate_fr = 'Octobre';
                break;
            case 11:
                $mois_formate_fr = 'Novembre';
                break;
            case 12:
                $mois_formate_fr = 'Décembre';
                break;
            default:
                $mois_formate_fr = '';
        }
        
        return $mois_formate_fr;
    }
}

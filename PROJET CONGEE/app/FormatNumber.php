<?php

namespace App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Auth\Authenticatable ; //pour authentifier ma classe
use Illuminate\Auth\Authenticatable as Functable ;    //pour mettre les 6 fonctions abstraites
use Illuminate\Support\Facades\DB;
use \Carbon\Carbon;

class FormatNumber extends Model
{

    public static function formatter($nombre){
        $nombre=strval($nombre);
        $nombre=str_split($nombre);
        $count=count($nombre);
        // echo $count;
        // echo contains_comma($nombre);

        $result="";
        $c=0;
        for ($i=$count-1; $i>=0; $i--) {
            if($i>=self::contains_comma($nombre)&& self:: contains_comma($nombre)!=0){
                if ($i-self::contains_comma($nombre)<=2) {
                    $result=$result.$nombre[$i];
                }
                continue;
            }
            if($c==3){
                $c=0;
                $result=$result." ";
            }
            $result=$result.$nombre[$i];
            $c++;

        }
        $result=str_split($result);
        $result=array_reverse($result);
        // var_dump($result);
        return implode("",$result);
    }



    public static function contains_comma($nombre){
        $count=count($nombre);
        for ($i=$count-1; $i >= 0; $i--) {
            if ($nombre[$i]==".") {
                return $i;
            }
        }
        return 0;
    }

    public static function to_double($nombre){
        $nombre=str_split($nombre);
        $count=count($nombre);
        $result="";
        for ($i=0; $i<$count; $i++) {
            if ($nombre[$i]==" ") {
                continue;
            }
            $result=$result.$nombre[$i];
        }
        return floatval($result);
    }
}

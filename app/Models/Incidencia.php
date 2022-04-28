<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Incidencia extends Model
{
    use HasFactory;

    //scope para filtrar, creamos un filtro general
    /*public function scopeFiltro($query, $filtro, $valorBuscado){
        if(($filtro) && ($valorBuscado) ){
            return $query->where($filtro,"like","%$valorBuscado%");

        }
    } */
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suscriptor_M;

class Suscriptor_C extends Controller
{
    
    public function index($ID_Suscriptor){          
        
        //CONSULTA los datos de un suscriptor especifico
        $Suscriptor = Suscriptor_M::
            all()//trae todos los registro de la tabla 
            ->where('ID_Suscriptor', '=', $ID_Suscriptor)
            ->first();
            return $Suscriptor; 
    } 

    public function suscriptores(){         
        //CONSULTA los datos de todos los suscriptores
        $Suscriptores = Suscriptor_M::
            all();//trae todos los registro de la tabla 
            return $Suscriptores; 
    } 
    
    public function suscriptoresArtistas(){   
        //CONSULTA los datos de todos los suscriptores que tienen portafolio de artista
        $Suscriptores = Suscriptor_M::
            select('ID_SUscriptor','nombreSuscriptor','apellidoSuscriptor','estadoSuscriptor','nombre_imagenPortafolio','paisSuscriptor') 
            ->where('nombre_imagenPortafolio', '!=', '')
            ->get();
            return $Suscriptores; 
    } 
}

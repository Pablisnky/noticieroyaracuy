<?php

namespace App\Http\Controllers;

use Efemeride_M;
use Illuminate\Http\Request;
use App\Models\Efemerides_M;

class Efemeride_C extends Controller
{
    
    public function __invoke(){ 
        
        date_default_timezone_set("America/Caracas");
        $Hoy = date("Y-m-d"); 
        
        //consulta la efemeride de hoy
        $Efemeride = Efemerides_M::
            select('titulo','contenido','fecha','nombre_ImagenEfemeride')
            ->where('fecha','=', $Hoy)
            ->join('imagenesefemerides', 'efemeride.ID_Efemeride','=','imagenesefemerides.ID_Efemeride') 
            ->orderBy('efemeride.ID_Efemeride', 'desc')
            ->get();
            // echo gettype($Efemeride);
            // return $Efemeride;

        return view('efemeride_V', [
            'efemerideHoy' => $Efemeride
            ]
        );
    }
}

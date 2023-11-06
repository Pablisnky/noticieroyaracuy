<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda_M;
use Carbon\Carbon;

class EventosController extends Controller
{
    // Muestra todos los eventos
    public function index(){        
        
        $date = Carbon::now();
        $Hoy = $date->format('Y-m-d');

        //consulta los eventos en agenda de hoy
        $Eventos = Agenda_M::
            select('ID_Agenda','nombre_imagenAgenda','caducidad')
            ->where('caducidad','>=',$Hoy)               
            ->orderBy('ID_Agenda', 'desc')
            ->get();
            // echo gettype($Eventos) . '<br>';
            // return $Eventos; 
            // dd($Eventos); 
            // echo '<pre>';
            // print_r($Eventos);
            // echo '</pre>';
            // exit;
        
        return view('eventos/eventos_V', [
            'eventos' => $Eventos
        ]); 		 
    }

    public function redes_sociales($ID_Agenda){
       
        //consulta los eventos en agenda de hoy
        $Eventos = Agenda_M::
            select('ID_Agenda','nombre_imagenAgenda')
            ->where('ID_Agenda','=', $ID_Agenda)
            ->first();
            // echo gettype($Eventos);
            // return $Eventos;

        return view('eventos/evento_RedesSociales_V', [
            'eventos' => $Eventos
        ]); 
    }
}

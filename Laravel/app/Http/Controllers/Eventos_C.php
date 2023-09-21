<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Agenda_M;
use Carbon\Carbon;

class Eventos_C extends Controller
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
        
        return view('eventos_V', [
                'eventos' => $Eventos
            ]
        ); 		 
    }

    public function redes_sociales($ID_Agenda){
        //consulta los eventos en agenda de hoy
        // $Agenda = $this->ConsultaAgenda_M->consultarArchivoAgendaEspecifico($ID_Agenda);

        // $Datos = [
        //     'agenda' => $Agenda, // ID_Agenda, nombre_imagenAgenda
        // ];
        
        // echo "<pre>";
        // print_r($Datos);
        // echo "</pre>";          
        // exit();

        // $this->vista("header/header_agenda", $Datos); 
        // $this->vista("view/agenda_RedesSociales_V", $Datos); 
    }
}

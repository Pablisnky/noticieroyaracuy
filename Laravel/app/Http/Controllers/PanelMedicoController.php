<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PanelMedicoController extends Controller
{
    public function perfil_medico($ID_Medico){

        // CONSULTA toda la información de perfil del medico
        $Comerciante = DB::connection('mysql_2')
            ->select("SELECT * FROM comerciantes WHERE ID_Comerciante = '$ID_Medico';");
            // return gettype($Comerciante);
            // return $Comerciante;

    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolController extends Controller
{

    // EN tra en este metodo solo sino el suscriptor aun no ha definido su rol dentro de la plataforma
    public function __invoke($Correo){
        return view('modal/modal_cambioRol_V');
    }
}

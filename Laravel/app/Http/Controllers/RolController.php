<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RolController extends Controller
{

    public function __invoke($Correo){
        return view('modal/modal_cambioRol_V');
    }
}

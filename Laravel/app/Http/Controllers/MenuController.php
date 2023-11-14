<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function __invoke(){

        return view('nuestroADN_V');
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anuncios_M extends Model
{
    use HasFactory;

    protected $table = 'anuncios';
    protected $primaryKey  = 'ID_Anuncio ';
    // public $timestamps = false; //Cuando una tabla no tiene este campo se debe colocar "false"
}

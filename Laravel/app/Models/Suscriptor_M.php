<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suscriptor_M extends Model
{
    use HasFactory;

    // public $TimesTamp = false;
    protected $table = 'suscriptores';
    protected $primaryKey  = 'ID_Suscriptor'; 
    protected $fillable = ['nombreSuscriptor','apellidoSuscriptor','estadoSuscriptor','pseudonimoSuscripto','nombre_imagenPortafolio','paisSuscriptor','telefonoSuscriptor'];
}

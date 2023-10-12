<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comerciante_M extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'comerciantes';
    protected $primaryKey  = 'ID_Comerciante'; 
    // protected $fillable = ['nombreSuscriptor','apellidoSuscriptor','estadoSuscriptor','pseudonimoSuscripto','nombre_imagenPortafolio','paisSuscriptor','telefonoSuscriptor'];
}

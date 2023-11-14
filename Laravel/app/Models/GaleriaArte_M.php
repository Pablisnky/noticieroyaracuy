<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GaleriaArte_M extends Model
{
    use HasFactory;
    
    protected $table = 'obra';
    protected $primaryKey  = 'ID_Obra';
    // public $timestamps = false; //Cuando una tabla no tiene este campo se debe colocar "false"
}

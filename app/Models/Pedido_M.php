<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido_M extends Model
{
    use HasFactory;
    
    public $timestamps = false; //Cuando una tabla no tiene este campo se debe colocar "false"
    protected $table = 'pedido';
    protected $primaryKey = 'ID_Pedido';
}

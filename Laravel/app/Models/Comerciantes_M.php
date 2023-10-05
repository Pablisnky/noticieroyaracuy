<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comerciantes_M extends Model
{
    use HasFactory;

    protected $table = 'comerciantes';
    protected $primaryKey  = 'ID_Comerciante'; 
    // public $TimesTamp = false;
}

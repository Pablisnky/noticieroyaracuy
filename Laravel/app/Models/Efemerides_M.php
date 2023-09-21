<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Efemerides_M extends Model
{
    use HasFactory;

    protected $table = 'efemeride';
    protected $primaryKey  = 'ID_Efemeride';
    // public $TimesTamp = false; //Cuando una tabla no tiene este campo se debe colocar "false"
}

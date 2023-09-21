<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda_M extends Model
{
    use HasFactory;
    
    protected $table = 'agenda';
    protected $primaryKey  = 'ID_Agenda ';
    // public $TimesTamp = false; //Cuando una tabla no tiene este campo se debe colocar "false"
}

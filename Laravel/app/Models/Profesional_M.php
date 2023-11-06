<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profesional_M extends Model
{
    use HasFactory;
    
    protected $table = 'directorioprofesionales';
    protected $primaryKey  = 'ID_Profesional';
    public $TimesTamp = false;
}

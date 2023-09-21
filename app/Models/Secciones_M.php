<?php

namespace App\Models;

use Illuminate\Database\DBAL\TimestampType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Secciones_M extends Model
{
    use HasFactory;

    protected $table = 'secciones';
    protected $primaryKey  = 'ID_Seccion';
    public $TimesTamp = false;
}

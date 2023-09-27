<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuscriptorPasword_M extends Model
{
    use HasFactory;

    public $timestamps  = false;
    protected $table = 'suscriptorespasword';
    protected $primaryKey  = 'ID_Suscriptor';
}
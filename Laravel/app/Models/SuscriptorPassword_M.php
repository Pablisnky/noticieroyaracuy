<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuscriptorPassword_M extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'suscriptorespassword';
    protected $primaryKey  = 'ID_Suscriptor';
}
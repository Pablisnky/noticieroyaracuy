<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuscriptorPassword_M extends Model
{
    use HasFactory;

    public $timestamps = true;
    protected $table = 'suscriptorespassword';
    protected $primaryKey  = 'ID_Suscriptor';
}
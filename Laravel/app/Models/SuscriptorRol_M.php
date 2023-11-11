<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SuscriptorRol_M extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'suscriptor_roles';
    protected $primaryKey  = 'ID_SR';
}

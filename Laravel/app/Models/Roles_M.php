<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles_M extends Model
{
    use HasFactory;

    protected $table = 'roles';
    protected $primaryKey  = 'ID_Rol';
    public $timestamps = false;
}

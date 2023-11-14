<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class YaracuyEnVideos_M extends Model
{
    use HasFactory;

    protected $table = 'yaracuyenvideos';
    protected $primaryKey  = 'ID_YaracuyEnVideo';
    // public $timestamps = false;
}

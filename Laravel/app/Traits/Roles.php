<?php 
namespace App\Traits;

use App\Models\Roles_M;

trait Roles
{
   
    // public function rol($ID_Comerciante){        
    //     //Se consultan los roles existentes
    //     $Roles = Roles_M::
    //         select('rol')               
    //         ->where('ID_Comerciante', '=', $ID_Comerciante)
    //         ->first();
    //         return $Roles;
    // }
   
   public function roles(){        
       //Se consultan los roles existentes
       $Roles = Roles_M::
           select('ID_Rol','rol')               
           ->orderBy('rol', 'desc')
           ->get();
           return $Roles;
    }
}
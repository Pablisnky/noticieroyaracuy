<?php 
namespace App\Traits;

trait ServidorUse
{
   
    public function conexionServidor(){
        
        // $Servidor = 'Remoto';
        $Servidor = 'Local';

        return $Servidor;
    }
}
<?php 
namespace App\Traits;

trait Divisas
{
   
    public function ValorDolar(){
        //se actualiza manualmente el precio del dolar segun tasa del BCV
        $Dolar = 34.42; 

        return $Dolar;
    }
}
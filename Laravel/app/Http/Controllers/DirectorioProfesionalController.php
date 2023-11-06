<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Profesional_M; 
use App\Models\ProfesionalImagenes_M;

class DirectorioProfesionalController extends Controller
{
    public function index(){
        
        //Se CONSULTA profesionalen una misma categria
        // $ComercianteCategorias = DB::connection('mysql_2')
        //     ->select("SELECT ID_Comerciante, pseudonimoComerciante, categoriaComerciante, nombreImgCatalogo
        //         FROM comerciantes
        //         WHERE categoriaComerciante = '$NombreCategoria' AND activarComerciante = 1;");   
            // return gettype($ComercianteCategorias);
            // return($ComercianteCategorias);
            
        // //Se CONSULTA la cantidad de profesionales que estan afiliadas en cada categoria
        $CantidadProfesionales = Profesional_M::
            select('profesion')
            ->selectRaw('COUNT("profesion") AS cantidad')
            ->join('directorioprofesiones', 'directorioprofesionales.ID_Profesion','=','directorioprofesiones.ID_Profesion') 
            ->groupBy("profesion")
            ->get();
            // return gettype($CantidadProfesionales);
            // return $CantidadProfesionales;
            
        return view('directorioProfesional.directorioProfesional_V', [            
            'cantidadProfesionales' =>  $CantidadProfesionales
        ]);  
    }

    // muestra todos los profesiones de una categoria especifica, en un flayer con minituras, solo si esta activa
    public function directorioCategoria(){
        
        //Se CONSULTA profesionales en una misma categria
        $ProfesionalesCategorias = Profesional_M::
            select('directorioprofesionales.ID_Profesional','profesion', 'nombre_Poofesional', 'apellido_Poofesional', 'telefono__Poofesional','correo_Poofesional','direccion_Poofesional','descripcion_Poofesional','nombre_ImagenProfesional')
            ->join('directorioprofesiones', 'directorioprofesionales.ID_Profesion','=','directorioprofesiones.ID_Profesion') 
            ->join('imagenesdirectorio', 'directorioprofesionales.ID_Profesional','=','imagenesdirectorio.ID_Profesional')
            ->where('imagenPrincipaProfesional','=', 1)
            ->orderBy("apellido_Poofesional", 'desc')
            ->get();
            // return gettype($ProfesionalesCategorias);
            // return($ProfesionalesCategorias);

        //Se CONSULTA las imagenes secundarias de los profesionales una misma categria
        $ProfesionalesImagenes = ProfesionalImagenes_M::
            select('ID_Profesional','nombre_ImagenProfesional')
            // ->where('imagenPrincipaProfesional','=', 0)
            ->get();
            // return gettype($ProfesionalesImagenes);
            // return($ProfesionalesImagenes);

        return view('directorioProfesional.catalogoDirectorio_V', [
            'profesionales' => $ProfesionalesCategorias,
            'profesionalesImagenes' => $ProfesionalesImagenes
        ]); 
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\GaleriaArte_M;
use App\Models\Artistas_M;

class GaleriaArteController extends Controller
{
    // Muestra todos los artistas de la galeriia de arte
    public function index(){   
        
        //Se CONSULTA los artistas en BD
        $Artistas = Artistas_M::
            select('ID_Artista', 'nombreArtista', 'apellidoArtista','imagenArtista','paisArtista','estadoArtista')
            ->get();
            // return $Artistas; 

        return view('galeriaArte.galeriaArte_V', [
            'artistas' => $Artistas
            ]
        ); 
    }

    public function artistas($ID_Artista){
        //Se CONSULTA un artista especifico
        $Artista = Artistas_M::
            select('ID_Artista','nombreArtista','apellidoArtista','paisArtista','estadoArtista','imagenArtista')
            ->where('ID_Artista','=', $ID_Artista)
            ->first();
            // return gettype($Artista);
            // return $Artista;

        //Se CONSULTA las obras de un artista especifico
        $ObraArtista = GaleriaArte_M::
            select('ID_Obra','ID_Artista','nombreObra','imagenObra')
            ->where('ID_Artista','=', $ID_Artista)
            ->get();
            // echo gettype($ObraArtista);
            // return $ObraArtista;
     
        return view('galeriaArte.artistas_V', [
            'artista' => $Artista, 
            'obraArtista' => $ObraArtista 
            ]
        ); 
                
        // $this->vista("header/header_Artista", $Datos);
        // $this->vista("view/artistas_V", $Datos);
    }        

    public function detalleObra($ID_Obra){
        
        //CONSULTA los detalles de la obra seleccionada
        $Detalle_Obra = GaleriaArte_M::
            select('artistas.ID_Artista','ID_Obra','nombreObra','anioObra','disponible','coleccionObra', 'descripcionObra','imagenObra','tecnicaObra','medidaObra','nombreArtista','apellidoArtista', 'precioDolarObra')
            ->join('artistas', 'obra.ID_Artista','=','artistas.ID_Artista') 
            ->where('ID_Obra','=', $ID_Obra)
            ->first();
            // echo gettype($Detalle_Obra) . '<br>';
            // return $Detalle_Obra;
        
        return view('galeriaArte.detalleObra_V', [
            'detalleObra' => $Detalle_Obra 
            ]
        ); 
    }
    
    // recorre obra a obra en un slider segun el artista seleccionado
    public function diapositivaObra($ID_Obra, $ID_Artista, $Recorrido){

        if($Recorrido == 'Retroceder'){
            // Se consulta el nombre de la imagen anterior que se va amostrar en detalle
            $DiapositivaObra = GaleriaArte_M::
                select('ID_Obra','nombreObra','anioObra','coleccionObra','descripcionObra','medidaObra','tecnicaObra','imagenObra','disponible','precioDolarObra')
                ->where('ID_Obra','<', $ID_Obra)
                ->where('ID_Artista','=', $ID_Artista)                
                ->orderBy('ID_Obra', 'desc')->limit(1)
                ->first();
                // echo gettype($DiapositivaObra) . '<br>';
                // return $DiapositivaObra;
        }
        else if($Recorrido == 'Avanzar'){
            // Se consulta el nombre de la imagen posterior que se va amostrar en detalle
            $DiapositivaObra = GaleriaArte_M::
                select('ID_Obra','nombreObra','anioObra','coleccionObra','descripcionObra','medidaObra','tecnicaObra','imagenObra','disponible','precioDolarObra')
                ->where('ID_Obra','>', $ID_Obra)
                ->where('ID_Artista','=', $ID_Artista)                
                ->orderBy('ID_Obra')->limit(1)
                ->first();
                // echo gettype($DiapositivaObra) . '<br>';
                // return $DiapositivaObra;
        }
        
        //Se CONSULTA un artista especifico
        $Artistas = Artistas_M::
            select('ID_Artista','nombreArtista','apellidoArtista','paisArtista','estadoArtista','imagenArtista')
            ->where('ID_Artista','=', $ID_Artista)
            ->first();
            // return gettype($Artista);
            // return $Artista;
            
        //Se visualizan las imagenes del artista como diapositivas
        if($DiapositivaObra != null){
            return view('ajax.A_detalleObra_V', [
                'diapositivaObra' => $DiapositivaObra, 
                'artista' => $Artistas
                ]
            ); 		
        }
        else{ //Cuando el slider llega a un extremo

            //Se consulta cual es el ultimo ID_Obra de la tabla "obra" de un artista especifico
            $UltimoID_Obra = GaleriaArte_M::
                select('ID_Obra','imagenObra','nombreObra','anioObra','coleccionObra','descripcionObra','medidaObra','tecnicaObra','disponible','precioDolarObra','artistas.ID_Artista','nombreArtista','apellidoArtista')
                ->join('artistas', 'obra.ID_Artista','=','artistas.ID_Artista') 
                ->where('artistas.ID_Artista','=', $ID_Artista)                
                ->orderBy('ID_Obra', 'desc')->limit(1)
                ->first();
                // echo gettype($UltimoID_Obra) . '<br>';
                // return $UltimoID_Obra;

            //Se consulta cual es el primer ID_Obra de la tabla "obra" de un artista especifico
            $PrimerID_Obra = GaleriaArte_M::
                select('ID_Obra','imagenObra','nombreObra','anioObra','coleccionObra','descripcionObra','medidaObra','tecnicaObra','disponible','precioDolarObra','artistas.ID_Artista','nombreArtista','apellidoArtista')
                ->join('artistas', 'obra.ID_Artista','=','artistas.ID_Artista') 
                ->where('artistas.ID_Artista','=', $ID_Artista)                
                ->orderBy('ID_Obra')->limit(1)
                ->first();
                // echo gettype($PrimerID_Obra) . '<br>';
                // return $PrimerID_Obra;

            // Se consulta el nombre de la imagen que se va amostrar en detalle
            $DiapositivaObra = GaleriaArte_M::
                select('ID_Obra','imagenObra','nombreObra','anioObra','coleccionObra','descripcionObra','medidaObra','tecnicaObra','disponible','precioDolarObra','artistas.ID_Artista','nombreArtista','apellidoArtista')
                ->join('artistas', 'obra.ID_Artista','=','artistas.ID_Artista') 
                ->where('ID_Obra','=', $ID_Obra)   
                ->first();
                // echo gettype($DiapositivaObra) . '<br>';
                // return $DiapositivaObra;

            //Si llega al extremo de lado derecho
            if($UltimoID_Obra->ID_Obra == $DiapositivaObra->ID_Obra){
                //Se reconstruye el array $Datos para cambiar el ID_Obra que se debe enviar
                $DiapositivaObra->ID_Obra = $PrimerID_Obra->ID_Obra;

                return view('ajax.A_detalleObra_V', [
                    'diapositivaObra' => $PrimerID_Obra,
                    'primerID_Obra' => $PrimerID_Obra, 	
                    'artista' => $Artistas,
                    ]
                ); 	
            }
            //Si llega al extremo de lado izquierdo
            else if($PrimerID_Obra->ID_Obra == $DiapositivaObra->ID_Obra){

                return view('ajax.A_detalleObra_V', [
                    'diapositivaObra' => $UltimoID_Obra,
                    'primerID_Obra' => $UltimoID_Obra, 	
                    'artista' => $Artistas,
                    ]
                ); 	
            }
        }
    }       
}

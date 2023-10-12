<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\YaracuyEnVideos_M;

class YaracuyVideoController extends Controller
{
            
    public function index(){              
        //consulta los videos cargados en la seccion YaracuyEnVideo
        $VideosYaracuy = YaracuyEnVideos_M::
            select('ID_YaracuyEnVideo','nombreVideo','decripcionVideo')       
            ->orderBy('ID_YaracuyEnVideo', 'desc')
            ->first();
            // return $VideosYaracuy;
        
        return view('yaracuyEnVideos_V', [
            'yaracuyVideo' => $VideosYaracuy 
        ]);  
    }

    public function recorridoVideos($ID_Video, $Recorrido){

        if($Recorrido == 'Retroceder'){
            // Se consulta el nombre de la imagen anterior que se va amostrar en detalle
            $VideoYaracuy = YaracuyEnVideos_M::
                select('ID_YaracuyEnVideo','nombreVideo','decripcionVideo')  
                ->where('ID_YaracuyEnVideo','<', $ID_Video)     
                ->orderBy('ID_YaracuyEnVideo', 'desc')
                ->first();
                // return $VideoYaracuy;
        }
        else if($Recorrido == 'Avanzar'){
            // Se consulta el nombre de la imagen posterior que se va amostrar en detalle
            $VideoYaracuy = YaracuyEnVideos_M::
                select('ID_YaracuyEnVideo','nombreVideo','decripcionVideo')  
                ->where('ID_YaracuyEnVideo','>', $ID_Video)     
                ->orderBy('ID_YaracuyEnVideo')
                ->first();
                // return $VideoYaracuy;
        }
        
        //Si la imagen llegua al extremo izquierdo o derecho, en este caso arrojará un array vacio
        if($VideoYaracuy != null){
            return view('ajax/A_yaracuyEnVideo_V', [
                'yaracuyVideo' => $VideoYaracuy 
            ]); 
        }
        else { //Cuando el slider llega a un extremo

            //Se consulta cual es el ultimo Video de la tabla yaracuyenvideos 
            $UltimoVideo = YaracuyEnVideos_M::
                select('ID_YaracuyEnVideo','nombreVideo','decripcionVideo')    
                ->orderBy('ID_YaracuyEnVideo', 'desc')
                ->first();
                // return $UltimoVideo;

            //Se consulta cual es el primer Video de la tabla yaracuyenvideos
            $PrimerVideo = YaracuyEnVideos_M::
                select('ID_YaracuyEnVideo','nombreVideo','decripcionVideo')    
                ->orderBy('ID_YaracuyEnVideo')
                ->first();
                // return $PrimerVideo;

            // Si llega al extremo de lado derecho
            if($UltimoVideo->ID_YaracuyEnVideo == $ID_Video){             
        
                return view('ajax/A_yaracuyEnVideo_V', [
                    'yaracuyVideo' =>  $PrimerVideo, 
                ]); 
            }
            //Si llega al extremo de lado izquierdo
            else if($PrimerVideo->ID_YaracuyEnVideo == $ID_Video){           
        
                return view('ajax/A_yaracuyEnVideo_V', [
                    'yaracuyVideo' =>  $UltimoVideo, 
                ]); 
            }
        }
    }

    public function redesSociales($ID_Video){
        //consulta un video especifico de la seccion YaracuyEnVideo
        $VideosYaracuy = YaracuyEnVideos_M::
            select('ID_YaracuyEnVideo','nombreVideo','decripcionVideo')   
            ->where('ID_YaracuyEnVideo','>', $ID_Video)     
            ->orderBy('ID_YaracuyEnVideo')
            ->first();
            // return $VideosYaracuy;
        
        return view('yaracuyEnVideos_V', [
            'yaracuyVideo' => $VideosYaracuy 
        ]);  
    }
}

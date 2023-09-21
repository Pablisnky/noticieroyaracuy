<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Noticias_M;
use App\Models\Imagenes_M;
use App\Models\Videos_M; 
use App\Models\Comentarios_M; 
use App\Models\Noticias_Anuncios_M; 
use App\Models\YaracuyEnViedo_M; 
use Carbon\Carbon;
// use Illuminate\Support\Facades\DB;

class Inicio_C extends Controller{  

    public function __invoke(){

        date_default_timezone_set("America/Caracas");
        $Hoy = date("Y-m-d"); 
        $Ayer = date("Y-m-d", strtotime($Hoy."- 1 days"));
        // echo gettype($Ayer) . '<br>'; 
        // echo gettype($Hoy) . '<br>'; 
        // exit;

        // DB::connection()->enableQueryLog();
        // $Noticias = Inicio_M::all();//trae todos los registro de la tabla noticias 
        // $Noticias = DB::getQueryLog();
        // DB::connection('foo')->
        
        //CONSULTA las noticias de portada de ayer y las de hoy
        $Noticias = Noticias_M::
                select('noticias.ID_Noticia','titulo','subtitulo','nombre_imagenNoticia','municipio','fecha','fuente','seccion')
                ->join('imagenes', 'noticias.ID_Noticia','=','imagenes.ID_Noticia') 
                ->join('noticias_secciones', 'noticias.ID_Noticia','=','noticias_secciones.ID_Noticia')
                ->join('secciones', 'noticias_secciones.ID_Seccion','=','secciones.ID_Seccion') 
                ->whereBetween("fecha", [$Ayer, $Hoy])   
                ->where('ImagenPrincipal', '=', '1')
                ->orderBy("ID_Noticia", "desc")
                ->get();      
                // return $Noticias;

        // CONSULTA la cantidad de imagenes asociados a cada noticia de portada
        $Imagenes = Imagenes_M::
                select('noticias.ID_Noticia')
                ->selectRaw('COUNT("ID_Noticia") AS Cantidad_Imagenes')
                ->join('noticias', 'imagenes.ID_Noticia','=','noticias.ID_Noticia') 
                ->whereBetween("fecha", [$Ayer, $Hoy])  
                ->groupBy("ID_Noticia")
                ->get();
                // return $Imagenes;
                                    
        // CONSULTA si existe algun video asociadas a cada noticia del dia
        $CantidadVideos = Videos_M::
                select('noticias.ID_Noticia')
                ->selectRaw('COUNT("ID_Noticia") AS Cantidad_Videos')
                ->join('noticias', 'videos.ID_Noticia','=','noticias.ID_Noticia') 
                ->whereBetween("fecha", [$Ayer, $Hoy])  
                ->groupBy("ID_Noticia")
                ->get();
                // return $CantidadVideos;

        // CONSULTA si no existe algun video asociadas a cada noticia del dia
        $NoticiasSinVideo = Noticias_M::
                select('noticias.ID_Noticia')
                ->leftJoin('videos', 'noticias.ID_Noticia','=','videos.ID_Noticia') 
                ->whereNull('nombreVideo')
                ->orderBy('noticias.ID_Noticia', 'desc')
                ->get();
                // return $NoticiasSinVideo;
        
        // CONSULTA la cantidad de comentarios en cada noticia de portada
        $CantidadComentario = Comentarios_M::
                select('ID_Noticia')
                ->selectRaw('COUNT("ID_Noticia") AS Cantidad_Comentarios')
                ->groupBy("ID_Noticia")
                ->get();
                // return $CantidadComentario;
          
        // CONSULTA las noticias que no tienen comentarios                 
        $NoticiasSinComentarios = Noticias_M::
                select('noticias.ID_Noticia')
                ->leftJoin('comentarios', 'noticias.ID_Noticia','=','comentarios.ID_Noticia') 
                ->whereNull('comentario')
                ->orderBy('noticias.ID_Noticia', 'desc')
                ->get();
                // return $NoticiasSinComentarios;

        // CONSULTA si existe algun anuncio asociado a cada noticia del dia           
        $Anuncios = Noticias_Anuncios_M::
                select('anuncios.ID_Anuncio', 'ID_Noticia')
                ->join('anuncios', 'noticias_anuncios.ID_Anuncio','=','anuncios.ID_Anuncio') 
                ->where('nombre_imagenPublicidad','!=','imagen.png')
                ->get();
                // return $Anuncios;
                            
        // CONSULTA los videos de la serie YaracuyEnVideo       
        $YaracuyEnVideo = YaracuyEnViedo_M::
                select('ID_YaracuyEnVideo', 'nombreVideo')
                ->get();
                // return $YaracuyEnVideo;

        return view('inicio_V', [
            'noticias' => $Noticias, 
            'imagenes' => $Imagenes, 
            'cantidadVideos' => $CantidadVideos, 
            'noticiasSinVideo' => $NoticiasSinVideo, 
            'cantidadComentario' => $CantidadComentario, 
            'noticiasSinComentarios' => $NoticiasSinComentarios, 
            'anuncios' => $Anuncios, 
            'yaracuyEnVideo' => $YaracuyEnVideo
            ]
        );
    }
}
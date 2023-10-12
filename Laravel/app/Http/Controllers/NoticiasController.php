<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Noticias_M;
use App\Models\Imagenes_M; 
use App\Models\Videos_M; 
use App\Models\Comentarios_M;
use App\Models\Noticias_Anuncios_M; 
use App\Models\Secciones_M;
use Carbon\Carbon;

class NoticiasController extends Controller{

    // muestra todas las noticias generales
    public function index(){ 

        //Se CONSULTA las seccion       
        $Secciones = Secciones_M::
            select('ID_Seccion', 'seccion')
            ->get();
            // return $Secciones;
           
        $NoticiasSeccion = [];
        $CantidadSeccion = [];

        foreach($Secciones as $Row) :            
            //Se consultan las ultimas 15 noticias de cada seccion
            $NoticiasGenerales = Noticias_M::
                select('noticias.ID_Noticia','titulo','subtitulo','municipio','secciones.ID_Seccion','seccion', 'portada','nombre_imagenNoticia','fecha','fuente')
                ->join('imagenes', 'noticias.ID_Noticia','=','imagenes.ID_Noticia') 
                ->join('noticias_secciones', 'noticias.ID_Noticia','=','noticias_secciones.ID_Noticia') 
                ->join('secciones', 'noticias_secciones.ID_Seccion','=','secciones.ID_Seccion') 
                ->where('secciones.ID_Seccion','=', $Row['ID_Seccion'])
                ->where('ImagenPrincipal','=', 1)                
                ->orderBy('fecha', 'desc')->limit(15)
                ->get();

            // Muestra la cantidad de noticias por cada sección
            $CantidadNoticiasSeccion = Noticias_M::
                select('noticias_secciones.ID_Seccion')
                ->selectRaw('COUNT("noticias.ID_Noticia") AS cantidad')
                ->join('noticias_secciones', 'noticias.ID_Noticia','=','noticias_secciones.ID_Noticia') 
                ->where('noticias_secciones.ID_Seccion','=', $Row['ID_Seccion'])
                ->groupBy("noticias_secciones.ID_Seccion")
                ->get();
                // return $CantidadNoticiasSeccion;

            array_push($NoticiasSeccion, $NoticiasGenerales);
            array_push($CantidadSeccion, $CantidadNoticiasSeccion);
        endforeach;
        
        //CONSULTA la cantidad de imagenes asociadas a cada noticia publiciada
        $CantidadImagenes = Imagenes_M::
            select('ID_Noticia')
            ->selectRaw('COUNT("ID_Noticia") AS cantidadImagenes')
            ->groupBy("ID_Noticia")
            ->get();  
            // return $CantidadImagenes;
                
        // CONSULTA el video asociado a cada noticia publiciada
        $Videos = Videos_M::
            select('ID_Noticia')
            ->get();  
            // return $Videos;
                
        // CONSULTA la cantidad de comentarios en cada noticia del dia
        $CantidadComentario = Comentarios_M::
            select('ID_Noticia')
            ->selectRaw('COUNT("ID_Comentario") AS cantidadComentario')
            ->groupBy("ID_Noticia")
            ->get();  
            // return $Videos;
                
        // CONSULTA si existe algun anuncio publicitario asociado a cada noticia publicada
        $Anuncios = Noticias_Anuncios_M::
            select('anuncios.ID_Anuncio', 'ID_Noticia')
            ->join('anuncios', 'noticias_anuncios.ID_Anuncio','=','anuncios.ID_Anuncio') 
            ->get();  
            // return $Anuncios;
        
        return view('noticias.noticias_V', [
            'secciones' => $Secciones, 
            'noticiasSeccion' => $NoticiasSeccion,
            'cantidadSeccion' => $CantidadSeccion, 
            'cantidadImagenes' => $CantidadImagenes, 
            'videos' => $Videos, 
            'anuncios' => $Anuncios, 
            'cantidadCmentarios' => $CantidadComentario 
        ]); 
    }

    public function NoticiasGenerales(){ 
        return view('noticias.noticiasGenerales_V');
    }
    
    // muestra la noticia completamente
    public function detalleNoticia($ID_Noticia){   
        
        $date = Carbon::now();
        $Hoy = $date->format('Y-m-d');
                
        // CONSULTA los datos de la noticia seleccionada
        $Noticia = Noticias_M::
            find($ID_Noticia);
            // return $Noticia;
        
        // CONSULTA las imagenes de la noticia seleccionada
        $ImagenesNoticia = Imagenes_M::
            select('ID_Noticia', 'ID_Imagen', 'nombre_imagenNoticia', 'ImagenPrincipal')
            ->where('ID_Noticia','=', $ID_Noticia)
            ->orderBy('ImagenPrincipal', 'desc')
            ->get();
            // return $ImagenesNoticia;
        
        // CONSULTA la cantidad de comentarios que tiene la noticia seleccionada
        $ComentariosCantidad = Comentarios_M::
            select('ID_Noticia')
            ->selectRaw('COUNT("ID_Comentario") AS Cantidad_Comentarios')
            ->where('ID_Noticia','=', $ID_Noticia)
            ->groupBy("ID_Noticia")
            ->first(); 
            // return $ComentariosCantidad;
        
        // CONSULTA los suscriptres que han realizado comentarios y el comentario
        $Comentarios = Comentarios_M::
            select('ID_Comentario', 'comentarios.ID_Suscriptor', 'comentario', 'fecha AS fechaComentario', 'hora AS horaComentario', 'nombreSuscriptor','apellidoSuscriptor')
            ->join('suscriptores', 'comentarios.ID_Suscriptor','=','suscriptores.ID_Suscriptor')
            ->where('ID_Noticia','=', $ID_Noticia)
            ->orderBy("fecha", 'desc')
            ->get();
            // return $Comentarios;

        // CONSULTA si existe algun anuncio asociado a la noticia seleccionada y si tiene catalogo
        $Publicidad = Noticias_Anuncios_M::
            select('anuncios.ID_Anuncio', 'ID_Noticia', 'nombre_imagenPublicidad')
            ->join('anuncios', 'noticias_anuncios.ID_Anuncio','=','anuncios.ID_Anuncio') 
            ->where('ID_Noticia','=', $ID_Noticia)
            ->where('nombre_imagenPublicidad','!=','imagen.png')
            ->where('fechaCulmina','>=',$Hoy)
            ->first();
            // return $Publicidad; 
        
        // SESIONES creadas en LoginController.php
        $ID_Suscriptor = !empty($_SESSION['ID_Suscriptor']) ? $_SESSION['ID_Suscriptor'] : 'No existe';
        $Nombre = !empty($_SESSION["nombreSuscriptor"]) ? $_SESSION["nombreSuscriptor"] : 'No existe';
        $Apellido = !empty($_SESSION["apellidoSuscriptor"]) ? $_SESSION["apellidoSuscriptor"] : 'No existe';

        return view('noticias.detalleNoticia_V', [
            'noticia' => $Noticia, 
            'imagenesNoticia' => $ImagenesNoticia, 
            'comentariosCantidad' => $ComentariosCantidad, 
            'comentarios' => $Comentarios, 
            'publicidad' => $Publicidad, 
            'id_suscriptor' => $ID_Suscriptor, 
            'nombre' => $Nombre, 
            'apellido' => $Apellido
        ]);
        // Cuando el nombre de la variable coincide con la clave del array se puede utilizar la siguiente sintaxis:
        //  return view('noticias.detalleNoticia_V', compact(ID_Noticia))
    }
    
    // muestra la imagen seleccionada en la miniatura de una noticia
    public function muestraImagenSeleccionada($ID_Imagen){
        //Se CONSULTA la imagen que se solicito en detalle
        $DetalleImagen = Imagenes_M::
            select('nombre_imagenNoticia')
            ->where('ID_Imagen','=', $ID_Imagen)
            ->first();
            // return $DetalleImagen;
       
        return view('ajax.A_imagenSeleccionada_V', [
            'imagenSeleccionada' => $DetalleImagen,
        ]);
    }
    
    // public function recibeComentario($ID_Noticia, $Comentario){	
    //     echo 'Controlador = NoticiasController' . '<br>';
    //     echo 'Metodo = recibeComentario' . '<br>';
    //     echo 'Variable ID_Noticia = ' . $ID_Noticia . '<br>';
    //     echo 'Variable Comentario = ' . $Comentario . '<br>';
    // }
        
    // Verifica que el usuario haya hecho login para poder comentar una noticia
    public function Verificar_Login($ID_Noticia, $Bandera, $ID_Comentario){

        // echo $ID_Noticia . '<br>';
        // echo $Bandera . '<br>';
        // echo $ID_Comentario . '<br>';
        // exit;
        
        // Sesion creada en LoginController, sino existe se muestra el formulario para logearse
        if(!isset($_SESSION['ID_Suscriptor']) AND $Bandera == 'comentar'){ 
            return redirect()->action([LoginController::class, 'index'], ['id_noticia' => $ID_Noticia, 'bandera' => 'comentar', 'id_comentario' => $ID_Comentario]);             
            // terminamos inmediatamente la ejecución del script, evitando que se envíe más salida al cliente.
            die(); 
        }        
        else if(!isset($_SESSION['ID_Suscriptor']) AND $Bandera == 'responder'){
            return redirect()->route('Login', ['id_noticia' => $ID_Noticia, 'bandera' => 'responder', 'id_comentario' => $ID_Comentario]);
            // terminamos inmediatamente la ejecución del script, evitando que se envíe más salida al cliente.
            die(); 
        }

        // QUE SUCEDE CUANDO EL USUARIO SI ESTA LOGEADO
    }
    
    //muestra todas las noticias segun la sección, se hace mediante de paginación de 25 noticias por pagina
    public function archivo($ID_Seccion, $pagina = 1){          
        # Cuántos productos mostrar por página 
        $NoticiasPorPagina = 25;

        // Por defecto se muestra la página 1; pero si está presente en la URL, tomamos esa
        if(isset($_GET["pagina"])) {
            $pagina = $_GET["pagina"];
        }

        # El límite es el número de productos por página
        $Limit = $NoticiasPorPagina;
        // echo 'Noticias a mostrar ' . $Limit . '<br>';

        # El offset es saltar X productos que viene dado por multiplicar la página - 1 * los productos por página
        $Desde = ($pagina - 1) * $NoticiasPorPagina;
        // echo 'Desde la Nro ' . $Desde . '<br>';
        
        // Muestra la cantidad de noticias por cada sección y poder saber cuántas páginas se van a mostrar
        $CantidadNoticiasSeccion = Noticias_M::
            select('noticias_secciones.ID_Seccion')
            ->selectRaw('COUNT("noticias.ID_Noticia") AS cantidad')
            ->join('noticias_secciones', 'noticias.ID_Noticia','=','noticias_secciones.ID_Noticia') 
            ->where('noticias_secciones.ID_Seccion','=', $ID_Seccion)
            ->groupBy("noticias_secciones.ID_Seccion")
            ->get();
            // return $CantidadNoticiasSeccion;        

        //Para obtener las páginas se divide el conteo entre los productos por página, y se redondea hacia arriba
        $paginas = ceil($CantidadNoticiasSeccion[0]['cantidad'] / $NoticiasPorPagina);

        //Se consultan las noticias que se mostraran segun la pagina seleccionada en paginación
        $TodasNoticiasSeccion = DB::connection('mysql')
            ->select(
                "SELECT noticias.ID_Noticia, titulo, subtitulo, secciones.ID_Seccion, seccion, portada, nombre_imagenNoticia, DATE_FORMAT(fecha, '%d-%m-%Y') AS fechaPublicacion, fuente
                FROM noticias 
                INNER JOIN imagenes ON noticias.ID_Noticia=imagenes.ID_Noticia
                INNER JOIN noticias_secciones ON noticias.ID_Noticia=noticias_secciones.ID_Noticia                
                INNER JOIN secciones ON noticias_secciones.ID_Seccion=secciones.ID_Seccion
                WHERE secciones.ID_Seccion = $ID_Seccion AND ImagenPrincipal = 1
                ORDER BY fecha
                DESC 
                LIMIT $Desde, $Limit"
            );
            // return $TodasNoticiasSeccion;
                        
        return view('noticias/archivo_V', [
            'todasNoticiasSeccion' => $TodasNoticiasSeccion, 
            'pagina' => $pagina,
            'paginas' => $paginas,
            'cantidadNoticiasSeccion' => $CantidadNoticiasSeccion
        ]);  
    }

    // //Se consulta el comentario al que se va a dar una respuesta
    // public function responderComentario($ID_Comentario){
    // }
    
    // // ELimina comentario
    // public function eliminar_comentario($ID_Comentario){
    // }
    
    public function filtrarMunicipio($Seccion, $Municipio){

        // Muestra las noticias por municipios y seccion
        $NoticiasMunicipios = Noticias_M::
            select('noticias.ID_Noticia','titulo','subtitulo','municipio','secciones.ID_Seccion','seccion', 'portada','nombre_imagenNoticia','fecha','fuente')
            ->join('imagenes', 'noticias.ID_Noticia','=','imagenes.ID_Noticia') 
            ->join('noticias_secciones', 'noticias.ID_Noticia','=','noticias_secciones.ID_Noticia') 
            ->join('secciones', 'noticias_secciones.ID_Seccion','=','secciones.ID_Seccion') 
            ->where('municipio','=', $Municipio)
            ->where('seccion','=', $Seccion)     
            ->where('ImagenPrincipal','=', 1)             
            ->orderBy('fecha', 'desc')->limit(15)
            ->get();
            // return gettype($NoticiasMunicipios);
            // return $NoticiasMunicipios;

        //CONSULTA la cantidad de imagenes asociadas a cada noticia publiciada
        $Imagenes = Imagenes_M::
            select('ID_Noticia')    
            ->selectRaw('COUNT("ID_Noticia") AS cantidadImagenes')      
            ->groupBy('ID_Noticia')
            ->get();
            // return $Imagenes;
        
        //CONSULTA el video asociado a cada noticia publiciada
        // $Videos = $this->ConsultaNoticia_M->consultarVideoNoticiaGenerales();

        //CONSULTA la cantidad de comentarios en cada noticia del dia
        // $CantidadComentario = $this->ConsultaNoticia_M->consultarCantidadComentarioNoticiaGenerales();

        //CONSULTA si existe algun anuncio asociado a cada noticia publicada
        // $Anuncios = $this->ConsultaNoticia_M->consultarAnuncioNoticiaGenerales();
        
        // Muestra la cantidad de noticias 
        $CantidadNoticiasSeccionMunicipio = Noticias_M::
            select('noticias_secciones.ID_Seccion')
            ->selectRaw('COUNT("noticias") AS cantidad')
            ->join('noticias_secciones', 'noticias.ID_Noticia','=','noticias_secciones.ID_Noticia') 
            ->join('secciones', 'noticias_secciones.ID_Seccion','=','secciones.ID_Seccion') 
            ->where('secciones.Seccion','=', $Seccion)
            ->where('municipio','=', $Municipio)       
            ->groupBy('noticias_secciones.ID_Seccion')
            ->get();
            // return $CantidadNoticiasSeccionMunicipio
                        
        return view('ajax/A_NoticiasMunicipio_V', [
            'noticiasSeccion' => $NoticiasMunicipios,
            'cantidadSeccion' => $CantidadNoticiasSeccionMunicipio,
            'imagenes' => $Imagenes,
            // 'videos' => $Videos,
            // 'anuncios' => $Anuncios,
            // 'cantidadCmentarios' => $CantidadComentario,
            'municipio' =>  $Municipio,
            'seccion' => $Seccion
        ]);         
    }
    
    public function quitarFIltroMunicipio($Seccion){

        // Muestra las noticias por seccion
        $NoticiasSeccion = Noticias_M::
            select('noticias.ID_Noticia','titulo','subtitulo','municipio','secciones.ID_Seccion','seccion', 'portada','nombre_imagenNoticia','fecha','fuente')
            ->join('imagenes', 'noticias.ID_Noticia','=','imagenes.ID_Noticia') 
            ->join('noticias_secciones', 'noticias.ID_Noticia','=','noticias_secciones.ID_Noticia') 
            ->join('secciones', 'noticias_secciones.ID_Seccion','=','secciones.ID_Seccion') 
            ->where('seccion','=', $Seccion)     
            ->where('ImagenPrincipal','=', 1)             
            ->orderBy('fecha', 'desc')->limit(15)
            ->get();
            // return $NoticiasSeccion;
        
        //CONSULTA la cantidad de imagenes asociadas a cada noticia publiciada
        $Imagenes = Imagenes_M::
            select('ID_Noticia')
            ->selectRaw('COUNT("ID_Noticia") AS cantidadImagenes')
            ->groupBy("ID_Noticia")
            ->get();  
            // return $Imagenes;
        
        //CONSULTA el video asociado a cada noticia publiciada
        // $Videos = $this->ConsultaNoticia_M->consultarVideoNoticiaGenerales();

        //CONSULTA la cantidad de comentarios en cada noticia del dia
        // $CantidadComentario = $this->ConsultaNoticia_M->consultarCantidadComentarioNoticiaGenerales();

        //CONSULTA si existe algun anuncio asociado a cada noticia publicada
        // $Anuncios = $this->ConsultaNoticia_M->consultarAnuncioNoticiaGenerales();
        
        // Muestra la cantidad de noticias en la seccion consultada
        $CantidadNoticiasSeccionMunicipio = Noticias_M::
            select('noticias_secciones.ID_Seccion')    
            ->selectRaw('COUNT("noticias.ID_Noticia") AS cantidad') 
            ->join('noticias_secciones', 'noticias.ID_Noticia','=','noticias_secciones.ID_Noticia') 
            ->join('secciones', 'noticias_secciones.ID_Seccion','=','secciones.ID_Seccion') 
            ->where('secciones.Seccion', '=', $Seccion)     
            ->groupBy('noticias_secciones.ID_Seccion')
            ->get();
            // return $CantidadNoticiasSeccionMunicipio;
        
        return view('ajax/A_NoticiasMunicipio_V', [
            'noticiasSeccion' => $NoticiasSeccion,
            'cantidadSeccion' => $CantidadNoticiasSeccionMunicipio,
            'imagenes' => $Imagenes,
            // 'videos' => $Videos,
            // 'anuncios' => $Anuncios,
            // 'cantidadCmentarios' => $CantidadComentario 
        ]);                 
    }
}

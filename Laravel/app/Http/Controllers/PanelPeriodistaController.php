<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Noticias_M;
use App\Models\Secciones_M;  
use App\Models\Efemerides_M;  
use App\Models\Imagenes_M;
use App\Models\ImagenesEfemerides_M;
use App\Models\Anuncios_M;
use App\Models\Periodistas_M;   
use App\Models\Fuentes_M;   
use App\Models\Agenda_M;
use App\Models\Noticias_Anuncios_M;
use App\Models\Noticias_Secciones_M;
use App\Models\Videos_M;

use App\Traits\ServidorUse;
use App\Traits\Comprimir_Imagen;

class PanelPeriodistaController extends Controller
{    
    use ServidorUse; //Traits
    use Comprimir_Imagen; //Traits

    private $Hoy;
    private $Comprimir;
    private $Servidor;
    
    public function __construct(){        
        
        date_default_timezone_set("America/Caracas");
        $this->Hoy = date("Y-m-d"); 
        // echo $this->Hoy . '<br>';
        
        $this->Servidor = $this->conexionServidor(); // metodo en Traits ServidorUse
    }
    
    // muestra las noticias de portadas en el panel de periodistas
    public function index(){
        if(empty(session('id_periodista'))){ 
            return redirect()->action([InicioController::class]);   
            die();
        }
        else{     

            //CONSULTA las noticias de portada
            $NoticiasPortadas = Noticias_M::
                select('ID_Noticia','titulo','municipio','fecha')
                ->where('fecha','=', $this->Hoy)
                ->where('ID_Periodista','=', session('id_periodista'))
                ->orderBy('ID_Noticia', 'desc')
                ->get();
                // echo gettype($NoticiasPortadas);
                // return $NoticiasPortadas;
                            
            //CONSULTA las secciones de las noticias de portada
            $SeccionesNoticiasPortadas = Secciones_M::
                select('noticias.ID_Noticia', 'seccion', 'fecha')
                ->join('noticias_secciones', 'secciones.ID_Seccion','=','noticias_secciones.ID_Seccion')
                ->join('noticias', 'noticias_secciones.ID_Noticia','=','noticias.ID_Noticia')
                ->where('fecha','=', $this->Hoy)
                ->get();
                // return $SeccionesNoticiasPortadas;
                    
            //CONSULTA las imagenes de noticias de portada
            $ImagenesNoticiasPortadas = Imagenes_M::
                select('noticias.ID_Noticia', 'nombre_imagenNoticia')
                ->join('noticias', 'imagenes.ID_Noticia','=','noticias.ID_Noticia')
                ->where('ImagenPrincipal','=', 1)
                ->where('fecha','=', $this->Hoy)
                ->get();
                // return $ImagenesNoticiasPortadas;

            //CONSULTA si hay asociado un anuncio pulicitario
            $Publicidad = Anuncios_M::
                select('noticias.ID_Noticia', 'razonSocial')
                ->join('noticias_anuncios', 'anuncios.ID_Anuncio','=','noticias_anuncios.ID_Anuncio')
                ->join('noticias', 'noticias_anuncios.ID_Noticia','=','noticias.ID_Noticia')
                ->where('fecha','=', $this->Hoy)
                ->get();
                // return $Publicidad;
                        
            return view('panel/periodistas/periodistaPortada_V', [
                'noticia' => $NoticiasPortadas, 
                'seccionesNoticiasPortadas' => $SeccionesNoticiasPortadas,
                'imagenesNoticiasPortadas' => $ImagenesNoticiasPortadas, 
                'publicidad' => $Publicidad
            ]);
        }
    }
    
    // muestra las noticias generales en el panel de periodistas, se hace mediante de paginación de 2session('id_periodista') noticias por pagina
    public function not_Generales($pagina = 1){ 

        # Cuántos productos mostrar por página 
        $NoticiasPorPagina = 30;

        // Por defecto se muestra la página 1; pero si está presente en la URL, tomamos la que muestra
        if(isset($_GET["pagina"])) {
            $pagina = $_GET["pagina"];
        }

        # El límite es el número de productos por página
        $Limit = $NoticiasPorPagina;
        // echo 'Noticias a mostrar ' . $Limit . '<br>';

        # El offset es saltar X productos que viene dado por multiplicar la página - 1 * los productos por página
        $Desde = ($pagina - 1) * $NoticiasPorPagina;
        // echo 'Desde la Nro ' . $Desde . '<br>';

        // Muestra la cantidad de noticias generales y poder saber cuántas páginas se van a mostrar
        // $CantidadNoticiasGenerales = $this->Panel_M->consultarCantidadNoticiasGenerales($_SESSION["ID_Periodista"]);

        //Para obtener las páginas se divide el conteo entre los productos por página, y se redondea hacia arriba
        // $paginas = ceil($CantidadNoticiasGenerales[0]['cantidad'] / $NoticiasPorPagina);

        //CONSULTA las noticias generales
        $NoticiasGenerales = Noticias_M::
                select('noticias.ID_Noticia', 'titulo', 'subtitulo', 'municipio', 'fecha')
                ->join('noticias_secciones', 'noticias.ID_Noticia','=','noticias_secciones.ID_Noticia')
                ->join('secciones', 'noticias_secciones.ID_Seccion','=','secciones.ID_Seccion')
                ->where('fecha','<', $this->Hoy)
                ->where('ID_Periodista','=', session('id_periodista'))
                ->orderBy('noticias.ID_Noticia', 'desc')->limit(30)
                ->get();
                // return $NoticiasGenerales;

        //CONSULTA las imagenes de noticias generales
        $ImagenesNoticiasGenerales = Imagenes_M::
                select('noticias.ID_Noticia', 'nombre_imagenNoticia')
                ->join('noticias', 'imagenes.ID_Noticia','=','noticias.ID_Noticia')
                ->where('ImagenPrincipal','=', 1)
                ->where('fecha','<', $this->Hoy)
                ->get();
                // return $imagenesNoticiasGenerales;

        //CONSULTA las secciones de noticias de generales
        $SeccionessNoticiasGenerales = Secciones_M::
                select('noticias.ID_Noticia', 'seccion')
                ->join('noticias_secciones', 'secciones.ID_Seccion','=','noticias_secciones.ID_Seccion')
                ->join('noticias', 'noticias_secciones.ID_Noticia','=','noticias.ID_Noticia')
                ->where('fecha','<', $this->Hoy)
                ->get();
                // return $SeccionessNoticiasGenerales;
                    
        //CONSULTA si hay asociado anuncios publicitario en las noticias de generales
        $Publicidad = Noticias_Anuncios_M::
                select('noticias.ID_Noticia', 'razonSocial')
                ->join('anuncios', 'noticias_anuncios.ID_Anuncio','=','anuncios.ID_Anuncio')
                ->join('noticias', 'noticias_anuncios.ID_Noticia','=','noticias.ID_Noticia')
                ->where('fecha','<', $this->Hoy)
                ->get();
                // return $Publicidad;
        
        //suma la cantidad de visitas a una noticia
        // $Visitas = $this->Panel_M->consultaVisitasNoticia();
                
        return view('panel/periodistas/NoticiasGenerales_V', [
            'noticia' => $NoticiasGenerales, 
            'imagenesNoticiasGenerales' => $ImagenesNoticiasGenerales,
            'seccionessNoticiasGenerales' => $SeccionessNoticiasGenerales, 
            'publicidad' => $Publicidad
        ]);
    }
    
    //Muestra panel eventos en agenda
    public function agenda(){ 
        
        // COSULTA los eventos que el periodista a montado en su cuenta
        $Agenda = Agenda_M::
                select('ID_Agenda', 'nombre_imagenAgenda','caducidad')
                ->where('disponibilidad','=', 'activado')
                ->where('ID_Periodista','=', session('id_periodista'))
                ->orderBy('ID_Agenda', 'desc')
                ->get();            
                // return $Agenda;
       
        return view('panel/periodistas/panel_agenda_V', [
            'agenda' => $Agenda
        ]);
    }
    
    //Muestra en la vista panel todos los anuncios de publicidad, incluyendo los caducados
    public function publicidad(){ 
        
        //CONSULTA los anuncios de publicidad
        $Anuncio = Anuncios_M::
                select('ID_Anuncio','nombre_imagenPublicidad','razonSocial','fechaInicio','fechaCulmina')
                ->where('ID_Periodista','=', session('id_periodista'))
                ->orderBy('ID_Anuncio', 'desc')
                ->get();            
                // return $Anuncio;
       
        return view('panel/periodistas/panel_publicidad_V', [
            'anuncio' => $Anuncio
        ]);
    }
    
    //Muestra las secciones en una ventana modal
    public function secciones(){
        // CONSULTA las secciones del periodico
        $Secciones = Secciones_M::
                select('ID_Seccion','seccion')
                ->get();            
                // return $Secciones;

        return view('modal/modal_seccionesDisponibles', [
            'secciones' => $Secciones
        ]);
    }
		
    //Muestra panel de todas las efemerides
    public function efemerides(){ 
        // if(isset($_SESSION['ID_Periodista'])){
            //CONSULTA las efemerides en el panel periddistas
            $Efemerides = Efemerides_M::
                select('efemeride.ID_Efemeride','titulo','contenido','fecha','nombre_ImagenEfemeride')
                ->join('imagenesefemerides', 'efemeride.ID_Efemeride','=','imagenesefemerides.ID_Efemeride') 
                ->orderBy('ID_Efemeride', 'desc')->limit(30)
                ->get();
                // return $Efemerides;
        
            // El metodo vista() se encuentra en el archivo app/clases/Controlador.php
            // $this->vista('header/header_SoloEstilos');
            
            return view('panel/periodistas/panel_efemeride_V', [
                'efemerides' => $Efemerides 
        ]); 
        // }
        // else{
        //     header("Location:" . RUTA_URL . "/CerrarSesion_C");
        // }
    }

    // Carga la vista de perfil del periodista
    public function perfil_periodista($ID_Periodista){
        // CONSULTA toda la información de perfil del periodista
        $Periodista = Periodistas_M::
            all()
            ->where('ID_Periodista','=', $ID_Periodista)
            ->first();
            // return gettype($Periodista);
            // return $Periodista;

        return view('panel/periodistas/periodista_perfil_V', [
            'periodista' => $Periodista
        ]);
    }
    		
    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************

    // muestra formulario para agregar una noticia
    public function agregar_noticia(){
        //CONSULTA la fuente por defecto del periodista
        $FuenteDefault = Periodistas_M::
                select('fuenteDefault')
                ->where('ID_Periodista','=', session('id_periodista'))
                ->first();
                // return $FuenteDefault;
        
        // CONSULTA las fuentes que tiene registradas el periodista
        $Fuentes = Fuentes_M::
                select('ID_Fuente','fuente')
                ->where('ID_Periodista','=', session('id_periodista'))
                ->orderBy('fuente', 'desc')
                ->get();
                // return $Fuentes;
        
        //Se crea esta sesion para impedir que se recargue la información enviada por el formulario mandandolo varias veces a la base de datos           
        session(['AgregarNoticia' =>  1976]);
                
        return view('panel/periodistas/agregarNoticia_V', [
            'fuenteDefault' => $FuenteDefault, 
            'fuentes' => $Fuentes
        ]);
    }

    // muestra formulario para agregar una efemeride
    public function agregar_efemeride(){
        // if($_SESSION["ID_Periodista"]){
               
            return view('panel/periodistas/agregarEfemerides_V');
        // }
        // else{
        //     header("Location:" . RUTA_URL . "/CerrarSesion_C");
        // }
    }

    // muestra formulario para agregar un evento en agenda
    public function agregar_agenda(){
        // if($_SESSION["ID_Periodista"]){

            return view('panel/periodistas/agregarAgenda_V');
        // }
        // else{
            // header("Location:" . RUTA_URL . "/CerrarSesion_C");
        // }
    }

    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************

    // recibe el formulario que agrega noticia
    public function recibeAgregarNoticia(Request $Request){
        if(session('AgregarNoticia') == 1976){
            session()->forget('actualizarNoticia'); //se borra la sesión. 
            // if(!empty($_FILES['imagenPrincipal']["name"])){

            $Titulo = $Request->get('titulo');
            $Sub_Titulo = $Request->get('subtitulo'); 
            $Contenido = $Request->get('contenido'); 
            $Seccion = $Request->get('seccion');
            $Municipio = empty($Request->get('municipio')) ? 'Ambito estadal' : $Request->get('municipio');	
            $Fecha = $Request->get('fecha');	
            $Fuente = $Request->get('fuente');			
            $ID_Anuncio = $Request->get('id_anuncio');	

            // echo "Titulo : " . $Titulo . '<br>';
            // echo "SubTitulo : " . $Sub_Titulo . '<br>';
            // echo "Contenido : " . $Contenido . '<br>';
            // echo "Seccion: " . $Seccion . '<br>';
            // echo "Municipio : " . $Municipio . '<br>';
            // echo "Fecha : " . $Fecha . '<br>';
            // echo "Fuente : " . $Fuente . '<br>';
            // echo "ID_Anuncio = " . $ID_Anuncio . '<br>';
            // exit;
                                        
            // Se cambia el formato a la fecha para introducirla a la BD
            $Fecha = \Carbon\Carbon::parse(strtotime($Fecha))->format('Y-m-d');	

            //Se INSERTA la noticia en tabla noticias de la BD y se retorna el ID de la inserción
            Noticias_M::insert(
                ['ID_Periodista' => session('id_periodista'), 
                'titulo' => $Titulo,
                'subtitulo' => $Sub_Titulo,
                'contenido' => $Contenido,
                'fecha' => $Fecha,
                'fuente' => $Fuente,
                'portada' => 1,
                'municipio' => $Municipio
                ]
            );
            $ID_Noticia = Noticias_M::latest('ID_Noticia')->first()->ID_Noticia;
            // return $ID_Noticia;
            
            //Se verifica si la fuente de la noticia ya existe en la BD, sino existe se inserta
            // $VerificaFuente = Fuentes_M::
            //     select('ID_Fuente','fuente')
            //     ->where('ID_Periodista','=', session('id_periodista'))
            //     ->orderBy('fuente', 'desc')
            //     ->get();
            //     // return $VerificaFuente;

            // $AgregaFuente = [];
            // $palabra_a_buscar = $Fuente;
            // foreach($VerificaFuente as $key => $value)	:
            //     // $value es un objeto y debe convertirse en array
            //     $value = get_object_vars($value);
            //     $Indice = array_search($palabra_a_buscar, $value);
            //     if($Indice){//si la fuente existe entra al IF
            //         //No se inserta en la BD	
            //         array_push($AgregaFuente, $palabra_a_buscar);

            //         // echo '<pre>';
            //         // print_r($AgregaFuente);
            //         // echo '</pre>';
            //     }
            // endforeach;

            // if($AgregaFuente == Array()){//Si $AgregaFuente esta vacio, la fuente no existe y se inserta en BD
            //     //Se INSERTA la nueva fuente 
            //     return 'entro';
            //     // $this->Panel_M->InsertarFuente($_SESSION['ID_Periodista'], $Fuente);					
            // }

            //Se verifica si la fuente de la noticia ya existe en la BD, sino existe se inserta
            $VerificaFuente = Fuentes_M::
                select('ID_Fuente','fuente')
                ->where('ID_Periodista','=', session('id_periodista'))
                ->where('fuente','=', $Fuente)
                ->orderBy('fuente', 'desc')
                ->first();     
                // return $VerificaFuente;
                    
            if($VerificaFuente == null){// Si $VerificaFuente esta vacio, la fuente no existe y se inserta en BD
                //Se INSERTA la nueva fuente 
                Fuentes_M::insert(
                    ['ID_Periodista' => session('id_periodista'),
                    'fuente' => $Fuente
                    ]
                );
            }

            // Se inserta los ID en la tabla de dependencias transitivas "noticias_secciones" 
            if(strpos($Seccion, ',') == false){//Si hay una sola seccion

                // Se consulta el ID_Seccion segun la seccion recibida
                $ID_Seccion = Secciones_M::
                    select('ID_Seccion')
                    ->where('seccion','=', $Seccion)
                    ->first();
                    // echo gettype($ID_Seccion);
                    // return $ID_Seccion;

                // se INSERTA los ID en tabla de dependencia trancitiva
                Noticias_Secciones_M::insert(
                        ['ID_Noticia' => $ID_Noticia, 
                        'ID_Seccion' => $ID_Seccion->ID_Seccion
                        ]
                    );
            }
            // else{//$Seccion contiene una cadena con las secciones seleccionadas, separados por coma,
            //     //se convierte $Seccion en array
            //     $Seccion = explode(',', $Seccion);
            //     // echo '<pre>';
            //     // print_r($Seccion);
            //     // echo '</pre>';
            //     // exit;
                
            //     $Elementos = count($Seccion);
            //     $SeccionesVarias = "";
            //     //Se convierte el array en una cadena con sus elementos entre comillas
            //     for($i = 0; $i < $Elementos; $i++){
            //         $SeccionesVarias .= " '" . $Seccion[$i] . "', ";
            //     }
                
            //     // echo $SeccionesVarias . '<br>';

            //     // Se quita el ultimo espacio y coma del string generado con lo cual
            //     // el string queda 'id1','id2','id3'
            //     $SeccionesVarias = substr($SeccionesVarias,0,-2);
            //     // echo $SeccionesVarias . '<br>';

            //     //Se consulta el ID_Seccion segun la seccion recibida
            //     // $ID_Secciones = $this->Panel_M->ConsultarVarios_ID_Seccion($SeccionesVarias);
                
            //     // echo '<pre>';
            //     // print_r($ID_Secciones);
            //     // echo '</pre>';
            //     // exit;

            //     $Cantidad = count($ID_Secciones);

            //     $Varios = [];
            //     foreach($ID_Secciones as $Row)	:
            //         // array_push($Varios, $Row['ID_Seccion']);
            //     endforeach;

            //     // echo '<pre>';
            //     // print_r($Varios);
            //     // echo '</pre>';
            //     // exit;
                
            //     //Se INSERTA los ID_Noticia y ID_Seccion en la tabla de dependencias transitiva
            //     for($i = 0; $i < $Cantidad; $i++){
            //         // $DT_noticia_seccion = $this->Panel_M->Insertar_DT_noticia_seccion($ID_Noticia, $Varios[$i]);
            //     }
            // }
            
            // INSERTAR IMAGEN PRINCIPAL NOTICIA
            //Si existe imagenPrincipal y tiene un tamaño correcto se procede a recibirla y guardar en BD
            if($_FILES['imagenPrincipal']["name"] != ""){
                $Nombre_imagenPrincipal = $_FILES['imagenPrincipal']['name'];
                $Tipo_imagenPrincipal = $_FILES['imagenPrincipal']['type'];
                $Tamanio_imagenPrincipal = $_FILES['imagenPrincipal']['size'];
                $Temporal_imagenPrincipal = $_FILES['imagenPrincipal']['tmp_name'];
                // echo "Nombre_imagen : " . $Nombre_imagenPrincipal . '<br>';
                // echo "Tipo_imagen : " .  $Tipo_imagenPrincipal . '<br>';
                // echo "Tamanio_imagen : " .  $Tamanio_imagenPrincipal . '<br>';
                // echo "Temporal_imagen : " .  $Temporal_imagenPrincipal . '<br>';
                // exit;

                //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
                $Nombre_imagenPrincipal = preg_replace('([^A-Za-z0-9.])', '', $Nombre_imagenPrincipal);

                // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
                $Nombre_imagenPrincipal = mt_rand() . '_' . $Nombre_imagenPrincipal;

                //Se INSERTA la imagen principal de la noticia en BD
                Imagenes_M::insert(
                    ['ID_Noticia' => $ID_Noticia, 
                    'nombre_imagenNoticia' => $Nombre_imagenPrincipal,
                    'tamanio_imagenNoticia' => $Tamanio_imagenPrincipal,
                    'tipo_imagenNoticia' => $Tipo_imagenPrincipal,
                    'ImagenPrincipal' => 1
                    ]
                );
              
                // INSSERTA IMAGEN PRINCIPAL DE NOTICIA EN SERVIDOR
                // se comprime y se inserta el archivo en el directorio de servidor 
                $BanderaImg = 'ImagenNoticia';
                // metodo en Traits Comprimir_imagen
                $this->imagen_comprimir($BanderaImg, $this->Servidor, $Nombre_imagenPrincipal, $Tipo_imagenPrincipal, $Tamanio_imagenPrincipal, $Temporal_imagenPrincipal);	
            }

            //INSERTAR IMAGENES SECUNDARIAS NOTICIA
            if($_FILES['imagenesSecUndariaNoticia']['name'][0] != ''){
                $Cantidad = count($_FILES['imagenesSecUndariaNoticia']['name']);
                for($i = 0; $i < $Cantidad; $i++){
                    //nombre original del fichero en la máquina cliente.
                    $Nombre_imagenSecundaria = $_FILES['imagenesSecUndariaNoticia']['name'][$i];
                    $tamanio_imagenSecundaria = $_FILES['imagenesSecUndariaNoticia']['size'][$i];
                    $tipo_imagenSecundaria = $_FILES['imagenesSecUndariaNoticia']['type'][$i];
                    $Ruta_Temporal_imagenSecundaria = $_FILES['imagenesSecUndariaNoticia']['tmp_name'][$i];
                    // echo "Nombre_imagen : " . $Nombre_imagenSecundaria . '<br>';
                    // echo "Tipo_imagen : " .  $Ruta_Temporal_imagenSecundaria . '<br>';
                    // echo "Tamanio_imagen : " .  $tipo_imagenSecundaria . '<br>';
                    // echo "Tamanio_imagen : " .  $tamanio_imagenSecundaria . '<br>';
                    // echo '<br>';
                    // exit;
                    
                    //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
                    $Nombre_imagenSecundaria = preg_replace('([^A-Za-z0-9.])', '', $Nombre_imagenSecundaria);

                    // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
                    $Nombre_imagenSecundaria = mt_rand() . '_' . $Nombre_imagenSecundaria;

                    //Se INSERTAN las fotografias secundarias de la noticia en BD
                    Imagenes_M::insert(
                        ['ID_Noticia' => $ID_Noticia, 
                        'nombre_imagenNoticia' => $Nombre_imagenSecundaria,
                        'tamanio_imagenNoticia' => $tamanio_imagenSecundaria,
                        'tipo_imagenNoticia' => $tipo_imagenSecundaria,
                        'ImagenPrincipal' => 0
                        ]
                    );

                    // INSSERTA IMAGENES SECUNDARIAS DE NOTICIA EN SERVIDOR
                    // se comprime y se inserta el archivo en el directorio de servidor 
                    $BanderaImgSec = 'ImagenNoticia';
                    // metodo en Traits Comprimir_imagen
                    $this->imagen_comprimir($BanderaImgSec, $this->Servidor, $Nombre_imagenSecundaria, $tipo_imagenSecundaria, $tamanio_imagenSecundaria, $Ruta_Temporal_imagenSecundaria);	                   
                } 
            }

            // INSERTAR IMAGEN ANUNCIO PUBLICITARIO
            //EL anuncio ya se inserto en la platorma en la seccion "Anuncios" del panel_administrador, aqui solo se inserta la relacion del ID_Noticia con el ID_Anuncio
            if($ID_Anuncio != ""){

                //Se inserta la dependencia transiiva entre el anuncio y la noticia
                // $this->Panel_M->Insertar_DT_noticia_anuncio($ID_Noticia, $ID_Anuncio);
            }

            // INSERTAR VIDEO
            // if($_FILES['video']['name'][0] != ''){
            //     $Nombre_video = $_FILES['video']['name'];
            //     $Tipo_video = $_FILES['video']['type'];
            //     $Tamanio_video = $_FILES['video']['size'];
            //     // echo "Nombre_video : " . $Nombre_video . '<br>';
            //     // echo "Tipo_video : " .  $Tipo_video . '<br>';
            //     // echo "Tamanio_video : " .  $Tamanio_video . '<br>';
            //     // exit;

            //     //Se INSERTA el video de la noticia
            //     // $this->Panel_M->InsertarVideoNoticia($ID_Noticia, $Nombre_video, $Tamanio_video, $Tipo_video);
                
            //     if($this->Servidor == 'Remoto'){
            //         //Usar en remoto
            //         $Directorio = $_SERVER['DOCUMENT_ROOT'] . '/public/video/';
            //     }
            //     else{
            //         // usar en local
            //         $Directorio = $_SERVER['DOCUMENT_ROOT'] . '/proyectos/NoticieroYaracuy/public/video/';
            //     }

            //     //Se mueve el archivo desde el directorio temporal a la ruta indicada anteriormente utilizando la función move_uploaded_files
            //     move_uploaded_file($_FILES['video']['tmp_name'], $Directorio . $Nombre_video);
            // }			
            // else{
            //     echo "Es necesario una imagen para la noticia";
            //     exit;
            // }
            
            return redirect()->action([PanelPeriodistaController::class,'index']); 
            die();
        }
        else{
            return redirect()->action([PanelPeriodistaController::class,'index']); 
            die();
        }
    }
    
    // recibe formulario que agrega efemeride
    public function recibeEfemerideAgregada(Request $Request){
        // if(isset($_FILES['imagenEfemeride']["name"])){

            function filtrado($datos){
                $datos = trim($datos); // Elimina espacios antes y después de los datos
                $datos = stripslashes($datos); // Elimina backslashes \
                $datos = htmlspecialchars($datos); // Traduce caracteres especiales en entidades HTML
                return $datos;
            }
            
            $Titulo = filtrado($Request->get('titulo'));
            $Contenido = $Request->get('contenido'); 
            $Fecha = $Request->get('fecha');		

            // echo "Titulo : " . $Titulo . '<br>';
            // echo "Contenido : " . $Contenido . '<br>';
            // echo "Fecha : " . $Fecha . '<br>';
            // exit;
		
            $Nombre_imagenEfemeride = $_FILES['imagenEfemeride']['name'];
            $Tipo_imagenEfemeride = $_FILES['imagenEfemeride']['type'];
            $Tamanio_imagenEfemeride = $_FILES['imagenEfemeride']['size'];
            $Temporal_imagenEfemeride = $_FILES['imagenEfemeride']['tmp_name'];

            // echo "Nombre_imagen : " . $Nombre_imagenEfemeride . '<br>';
            // echo "Tipo_imagen : " .  $Tipo_imagenEfemeride . '<br>';
            // echo "Tamanio_imagen : " .  $Tamanio_imagenEfemeride . '<br>';
            // exit;
            
            //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
            $Nombre_imagenEfemeride = preg_replace('([^A-Za-z0-9.])', '', $Nombre_imagenEfemeride);

            // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
            $Nombre_imagenEfemeride = mt_rand() . '_' . $Nombre_imagenEfemeride;
            
            // Se cambia el formato a la fecha para introducirla a la BD
            $Fecha = \Carbon\Carbon::parse(strtotime($Fecha))->format('Y-m-d');	

            //Se INSERTA la efemeride y se retorna el ID de la inserción
            Efemerides_M::insert(
                ['titulo' => $Titulo,
                'contenido' => $Contenido,
                'fecha' => $Fecha
                ]
            );
            $ID_Efemeride = Efemerides_M::latest('ID_Efemeride')->first()->ID_Efemeride;
            // return $ID_Efemeride;
            
            //Se INSERTA la imagen principal de la efemeride
            $VerificaInsert = ImagenesEfemerides_M::insert(
                ['ID_Efemeride' => $ID_Efemeride,
                'nombre_ImagenEfemeride' => $Nombre_imagenEfemeride,
                'tipo_ImagenEfemeride' => $Tipo_imagenEfemeride,
                'tamanio_ImagenEfemeride' => $Tamanio_imagenEfemeride,
                'imagenPrincipalEfemeride' => 1
                ]
            );
            // return $VerificaInsert;

            // INSSERTA IMAGEN PRINCIPAL DE EFEMERIDE EN SERVIDOR
            // se comprime y se inserta el archivo en el directorio de servidor 
            $BanderaImg = 'ImagenEfemeride';
            // metodo en Traits Comprimir_imagen
            $this->imagen_comprimir($BanderaImg, $this->Servidor, $Nombre_imagenEfemeride, $Tipo_imagenEfemeride, $Tamanio_imagenEfemeride, $Temporal_imagenEfemeride);	
        // }				

        return redirect()->action([PanelPeriodistaController::class,'efemerides']); 
        die();
    }
    
    // recibe formulario que agrega evento en agenda
    public function recibeAgendaAgregada(Request $Request){
        // if(isset($_FILES['imagenAgenda']["name"])){	

            $Caducidad = $Request->get('caducidad');
            		
            $Nombre_imagenAgenda = $_FILES['imagenAgenda']['name'];
            $Tipo_imagenAgenda = $_FILES['imagenAgenda']['type'];
            $Tamanio_imagenAgenda = $_FILES['imagenAgenda']['size'];
            $Temporal_imagenAgenda = $_FILES['imagenAgenda']['tmp_name'];

            // echo "Caducidad : " . $Caducidad . '<br>';
            // echo "Nombre_imagen : " . $Nombre_imagenAgenda . '<br>';
            // echo "Tipo_imagen : " .  $Tipo_imagenAgenda . '<br>';
            // echo "Tamanio_imagen : " .  $Tamanio_imagenAgenda . '<br>';
            // echo "Temporal_imagen : " .  $Temporal_imagenAgenda . '<br>';
            // exit;
            
            //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
            $Nombre_imagenAgenda = preg_replace('([^A-Za-z0-9.])', '', $Nombre_imagenAgenda);

            // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
            $Nombre_imagenAgenda = mt_rand() . '_' . $Nombre_imagenAgenda;
            
            // Se cambia el formato a la fecha para introducirla a la BD
            $FechaCaducidad = \Carbon\Carbon::parse(strtotime($Caducidad))->format('Y-m-d');

            //Se INSERTA en BD la informacion del evento agendado
            Agenda_M::insert(
                ['ID_Periodista' => session('id_periodista'),       
                'caducidad' => $FechaCaducidad,
                'nombre_imagenAgenda' => $Nombre_imagenAgenda,
                'typo_imagenAgenda' => $Tipo_imagenAgenda,
                'tamanio_imagenAgenda' => $Tamanio_imagenAgenda,
                'disponibilidad' => 'activado'
                ]
            );	
            
            // INSSERTA IMAGEN PRINCIPAL DE AGENDA EN SERVIDOR
            // se comprime y se inserta el archivo en el directorio de servidor 
            $BanderaImg = 'imagenAgenda';
            // metodo en Traits Comprimir_imagen
            $this->imagen_comprimir($BanderaImg, $this->Servidor, $Nombre_imagenAgenda, $Tipo_imagenAgenda, $Tamanio_imagenAgenda, $Temporal_imagenAgenda);	
        // }				

        return redirect()->action([PanelPeriodistaController::class,'agenda']); 
        die();
    }

    // recibe el formulario de perfil para actualizarlo
    public function recibePerfilPeriodista(Request $Request){
        //Se reciben el campo del formulario, se verifica que son enviados por POST y que no estan vacios
        // if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nombreSuscriptor']) && !empty($_POST['apellidoSuscriptor']) && !empty($_POST['correoSuscriptor']) && !empty($_POST['municipio']) && !empty($_POST['parroquia']) && !empty($_POST['telefono']) && !empty($_POST['pseudonimo']) && (!empty($_POST['transferencia']) || !empty($_POST['pago_movil']) || !empty($_POST['paypal']) || !empty($_POST['zelle']) || !empty($_POST['bolivar']) || !empty($_POST['dolar']) || !empty($_POST['acordado']))){
            $RecibeDatosPeriodista = [
                'nombrePeriodista' => $Request->get("nombrePeriodista"),
                'apellidoPeriodista' => $Request->get('apellidoPeriodista'),
                'correoPeriodista' => $Request->get('correoPeriodista'),
                'telefonoPeriodista' => $Request->get("telefonoPeriodista"),
                'cnp' => $Request->get("cnp")
            ];
            // return $RecibeDatosPeriodista;

            //Se actualizan datos del periodista
            $Actualizar = Periodistas_M
                ::find(session('id_periodista'));
                $Actualizar->nombrePeriodista = $RecibeDatosPeriodista['nombrePeriodista'];
                $Actualizar->apellidoPeriodista = $RecibeDatosPeriodista['apellidoPeriodista'];
                $Actualizar->correoPeriodista = $RecibeDatosPeriodista['correoPeriodista'];
                $Actualizar->telefonoPeriodista = $RecibeDatosPeriodista['telefonoPeriodista'];
                $Actualizar->CNP = $RecibeDatosPeriodista['cnp'];
                $Actualizar->save();

                //CONSULTA que el perfil este completo
                $NoticiasPortadas = Periodistas_M::
                    all()
                    ->where('ID_Periodista','=', session('id_periodista') )
                    ->first();
                    // echo gettype($NoticiasPortadas);
                    // return $NoticiasPortadas;

            if($NoticiasPortadas->telefonoPeriodista != null AND $NoticiasPortadas->CNP != null){
                // sesion creada en LoginController // se destruye porque el perfil esta completo
                session()->forget('perfilCompleto');
            }
            else{
                //Se vuelve a crear la sesion
                session(['perfilCompleto' => 'total']);
            }

        return redirect()->route("Perfil_periodista", ['id_periodista' => session('id_periodista')]);
        die();
    }

    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************

    // Muestra formulario con la noticia a actualizar
    public function actualizar_noticia($ID_Noticia, $Bandera){

        // echo $ID_Noticia . '<br>';
        // echo $Bandera . '<br>';
        // exit;

        //CONSULTA la noticia a actualizar
        $NoticiaActualizar = Noticias_M::
            select('noticias.ID_Noticia','secciones.ID_Seccion','titulo','subtitulo','contenido','seccion','municipio','nombre_imagenNoticia','ID_Imagen','fuente','fecha')
            ->join('imagenes', 'noticias.ID_Noticia','=','imagenes.ID_Noticia')
            ->join('noticias_secciones', 'noticias.ID_Noticia','=','noticias_secciones.ID_Noticia')
            ->join('secciones', 'noticias_secciones.ID_Seccion','=','secciones.ID_Seccion')
            ->where('noticias.ID_Noticia','=', $ID_Noticia)
            ->where('ImagenPrincipal','=', 1)
            ->first();            
            // return $NoticiaActualizar;

        //CONSULTA las imagenes de la noticia a actualizar
        $ImagenesNoticiaActualizar = Imagenes_M::
            select('ID_Noticia','nombre_imagenNoticia','ID_Imagen')
            ->where('ID_Noticia','=', $ID_Noticia)
            ->where('ImagenPrincipal','=', 0)
            ->get();            
            // return $ImagenesNoticiaActualizar;

        // CONSULTA la fuente de la noticia
        $Fuentes = Fuentes_M::
            select('ID_Fuente','fuente')
            ->where('ID_Periodista','=', session('id_periodista'))
            ->orderBy('fuente', 'desc')
            ->get();            
            // return $Fuentes;
        
        // CONSULTA el anuncio publicitario de la noticia
        $Anuncio = Noticias_Anuncios_M::
                select('anuncios.ID_Anuncio','nombre_imagenPublicidad')
                ->join('anuncios', 'noticias_anuncios.ID_Anuncio','=','anuncios.ID_Anuncio')
                ->where('ID_Noticia','=', $ID_Noticia)
                ->first();            
                // return $Anuncio;
      
        // CONSULTA el video de la noticia
        $Video = Videos_M::
                select('ID_Noticia','ID_Video','nombreVideo')
                ->where('ID_Noticia','=', $ID_Noticia)
                ->first();            
                // return $Video;
        
        //Se crea esta sesion para impedir que se recargue la información enviada por el formulario mandandolo varias veces a la base de datos           
        session(['actualizarNoticia' =>  1906]);
                
        return view('panel/periodistas/actualizarNoticia_V', [
            'noticiaActualizar' => $NoticiaActualizar, 
            'imagenesNoticiaActualizar' => $ImagenesNoticiaActualizar, 
            'fuentes' => $Fuentes, 
            'anuncio' => $Anuncio, 
            'video' => $Video,
            'bandera' => $Bandera
        ]);
    }
    
    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************

    // recibe formulario que actualiza una noticia
    public function recibeNoti_actualizada(Request $Request){
        // if(session('actualizarNoticia') == 1906){
        //     session()->forget('actualizarNoticia'); //se borra la sesión. 
                    
            $ID_Noticia = $Request->get('ID_Noticia');	
            $Fecha = $Request->get('fecha');	
            $Fuente = $Request->get('fuente');		
            $Bandera = $Request->get('bandera');

            // echo "ID_Noticia: " . $ID_Noticia . '<br>';
            // echo "Fecha : " . $Fecha . '<br>';
            // echo "Fuente : " . $Fuente . '<br>';
            // echo "Bandera : " . $Bandera . '<br>';
            // exit;
            
            // Se cambia el formato a la fecha para introducirla a la BD
            $Fecha = \Carbon\Carbon::parse(strtotime($Fecha))->format('Y-m-d');	
                
            //Se ACTUALIZA la noticia de portada seleccionada
            $ActualizarNoticia = Noticias_M
                ::find($ID_Noticia);
                $ActualizarNoticia->fecha = $Fecha;
                $ActualizarNoticia->titulo = $Request->input('titulo');
                $ActualizarNoticia->subtitulo = $Request->input('subtitulo');
                $ActualizarNoticia->contenido = $Request->input('contenido');
                $ActualizarNoticia->municipio = $Request->input('municipio');
                $ActualizarNoticia->fuente = $Request->input('fuente');
                $ActualizarNoticia->save();
           
            //Se verifica si la fuente de la noticia ya existe en la BD, sino existe se inserta
            $VerificaFuente = Fuentes_M::
                select('ID_Fuente','fuente')
                ->where('ID_Periodista','=', session('id_periodista'))
                ->where('fuente','=', $Fuente)
                ->orderBy('fuente', 'desc')
                ->first();     
                // return $VerificaFuente;
                    
            if($VerificaFuente == null){// Si $VerificaFuente esta vacio, la fuente no existe y se inserta en BD
                //Se INSERTA la nueva fuente 
                Fuentes_M::insert(
                    ['ID_Periodista' => session('id_periodista'),
                    'fuente' => $Fuente
                    ]
                );
            }
        
            // Se ACTUALIZA los ID_Seccion en la tabla de dependencias transitivas
            // if(ctype_alpha($Seccion)){//Si Seccion es solo letras, hay una sola seccion
                
                //Se consulta el ID_Seccion segun la seccion recibida
                // $ID_Seccion = $this->Panel_M->Consultar_ID_Seccion($Seccion);
                
                // echo $ID_Seccion['ID_Seccion'];

                // echo '<pre>';
                // print_r($ID_Seccion);
                // echo '</pre>';
                // exit();

                //Se BORRAN los ID_Seccion de una noticia especifica para volver a insertarlos con valores nuevos
                // $this->Panel_M->eliminar_DT_noticia_seccion($ID_Noticia);

                ///se INSERTA los ID en tabla de dependencia trancitiva
                // $Insertar_DT_noticia_seccion = $this->Panel_M->Insertar_DT_noticia_seccion($ID_Noticia, $ID_Seccion['ID_Seccion']);
            // }
            // else{//$Seccion contiene una cadena con las secciones seleccionadas, separados por coma,
            //     // echo $Seccion . '<br>';
            //     //se convierte $Seccion en array
            //     $Seccion = explode(',', $Seccion);
            //     // echo '<pre>';
            //     // print_r($Seccion);
            //     // echo '</pre>';
                
            //     $Elementos = count($Seccion);
            //     $SeccionesVarias = "";
            //     //Se convierte el array en una cadena con sus elementos entre comillas
            //     for($i = 0; $i < $Elementos; $i++){
            //         $SeccionesVarias .= " '" . $Seccion[$i] . "', ";
            //     }
                
            //     // echo $SeccionesVarias . '<br>';

            //     // Se quita el ultimo espacio y coma del string generado con lo cual
            //     // el string queda 'id1','id2','id3'
            //     $SeccionesVarias = substr($SeccionesVarias,0,-2);
            //     // echo $SeccionesVarias . '<br>';

            //     //Se consulta el ID_Seccion segun la seccion recibida
            //     $ID_Secciones = $this->Panel_M->ConsultarVarios_ID_Seccion($SeccionesVarias);
                    
            //     // echo '<pre>';
            //     // print_r($ID_Secciones);
            //     // echo '</pre>';
            //     // exit;

            //     $Cantidad = count($ID_Secciones);

            //     $Varios = [];
            //     foreach($ID_Secciones as $Row)	:
            //         array_push($Varios, $Row['ID_Seccion']);
            //     endforeach;

            //     // echo '<pre>';
            //     // print_r($Varios);
            //     // echo '</pre>';
            //     // exit;
                
            //     //Se BORRAN los ID_Seccion de una noticia especifica para volver a insertarlos con valores nuevos
            //     $this->Panel_M->eliminar_DT_noticia_seccion($ID_Noticia);

            //     //Se INSERTA los ID_Noticia y ID_Seccion en la tabla de dependencias transitiva
            //     for($i = 0; $i < $Cantidad; $i++){
            //         $this->Panel_M->Insertar_DT_noticia_seccion($ID_Noticia, $Varios[$i]);
            //     }
            // }

            // ACTUALIZA IMAGEN PRINCIPAL NOTICIA, Si se cambio se procede a actualizarla
            if($_FILES['imagenPrincipal']["name"] != ""){			
                $ID_imagen = $_POST['id_fotoPrincipal'];	
                $Nombre_imagenPrincipal = $_FILES['imagenPrincipal']['name'];
                $Tipo_imagenPrincipal = $_FILES['imagenPrincipal']['type'];
                $Tamanio_imagenPrincipal = $_FILES['imagenPrincipal']['size'];
                $Temporal_imagenPrincipal = $_FILES['imagenPrincipal']['tmp_name'];

                // echo "ID_Imagen: " .$ID_imagen. '<br>';
                // echo "Nombre_imagen: " . $Nombre_imagenPrincipal . '<br>';
                // echo "Tipo_imagen: " .  $Tipo_imagenPrincipal . '<br>';
                // echo "Tamanio_imagen: " .  $Tamanio_imagenPrincipal . '<br>';
                // exit;
                
                //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
                $Nombre_imagenPrincipal = preg_replace('([^A-Za-z0-9.])', '', $Nombre_imagenPrincipal);

                // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
                $Nombre_imagenPrincipal = mt_rand() . '_' . $Nombre_imagenPrincipal;
                                
                // ACTTUALIZA IMAGEN PRINCIPAL DE NOTICIA EN SERVIDOR
                // se comprime y se inserta el archivo en el directorio de servidor                 
                $BanderaImg = 'ImagenNoticia';
                // metodo en Traits Comprimir_imagen
                $this->imagen_comprimir($BanderaImg, $this->Servidor, $Nombre_imagenPrincipal, $Tipo_imagenPrincipal,$Tamanio_imagenPrincipal, $Temporal_imagenPrincipal);	
                
                //Se ACTUALIZA la imagen principal de la noticia en BD
                $ActualizarImagenNoticia = Imagenes_M:: 
                    find($ID_imagen);	
                    $ActualizarImagenNoticia->nombre_imagenNoticia = $Nombre_imagenPrincipal;
                    $ActualizarImagenNoticia->tamanio_imagenNoticia = $Tamanio_imagenPrincipal;
                    $ActualizarImagenNoticia->tipo_imagenNoticia = $Tipo_imagenPrincipal;
                    $ActualizarImagenNoticia->save();
            }

            // ACTUALIZA IMAGENES SECUNDARIAS DE NOTICIA
            if($_FILES['imagenesSecundarias']['name'][0] != ''){
                $Cantidad = count($_FILES['imagenesSecundarias']['name']);
                for($i = 0; $i < $Cantidad; $i++){
                    //nombre original del fichero en la máquina cliente.
                    $Nombre_imagenSecundaria = $_FILES['imagenesSecundarias']['name'][$i];
                    $tamanio_imagenSecundaria = $_FILES['imagenesSecundarias']['size'][$i];
                    $tipo_imagenSecundaria = $_FILES['imagenesSecundarias']['type'][$i];
                    $Ruta_Temporal_imagenSecundaria = $_FILES['imagenesSecundarias']['tmp_name'][$i];
                    // echo "Nombre_imagen : " . $Nombre_imagenSecundaria . '<br>';
                    // echo "Tipo_imagen : " .  $Ruta_Temporal_imagenSecundaria . '<br>';
                    // echo "Tamanio_imagen : " .  $tipo_imagenSecundaria . '<br>';
                    // echo "Tamanio_imagen : " .  $tamanio_imagenSecundaria . '<br>';
                    // exit;
                
                    //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
                    $Nombre_imagenSecundaria = preg_replace('([^A-Za-z0-9.])', '', $Nombre_imagenSecundaria);

                    // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
                    $Nombre_imagenSecundaria = mt_rand() . '_' . $Nombre_imagenSecundaria;
                    
                    // SE ACTTUALIZAN IMAGENES SECUNDARIAS DE NOTICIA EN SERVIDOR
                    // se comprime y se inserta el archivo en el directorio de servidor                 
                    $BanderaImgSec = 'ImagenNoticia';
                    // metodo en Traits Comprimir_imagen
                    $this->imagen_comprimir($BanderaImgSec, $this->Servidor, $Nombre_imagenSecundaria, $tipo_imagenSecundaria,$tamanio_imagenSecundaria, $Ruta_Temporal_imagenSecundaria);	

                    //Se INSERTAR nuevas imagenes secundarias de la noticia
                    Imagenes_M::insert(
                        ['ID_Noticia' => $ID_Noticia, 
                        'nombre_imagenNoticia' => $Nombre_imagenSecundaria,
                        'tamanio_imagenNoticia' => $tamanio_imagenSecundaria,
                        'tipo_imagenNoticia' => $tipo_imagenSecundaria,
                        'ImagenPrincipal' => 0
                        ]
                    );
                }
            }

            // // ANUNCIO PUBLICITARIO
            // //Si se cambio el anuncio publicitario se procede a actualizarlo
            // if($_POST['actualizar'] == 'SiActualizar'){

            //     $ID_Anuncio = $_POST['id_anuncio'];
                
                
            //     if($this->Servidor == 'Remoto'){
            //         //Usar en remoto
            //         $Directorio_1 = $_SERVER['DOCUMENT_ROOT'] . '/public/images/publicidad/';
            //     }
            //     else{
            //         // usar en local
            //         $Directorio_1 = $_SERVER['DOCUMENT_ROOT'] . '/proyectos/NoticieroYaracuy/public/images/publicidad/';
            //     }

            //     // echo "ACTUALIZAR". '<br>';
            //     // echo $ID_Noticia . '<br>';
            //     // echo $ID_Anuncio;
            //     // exit;
                
            //     //Se verifica si ya existe un anuncio para la noticia especificad, sino, se inserta un anuncio y si existe se actualiza
            //     $VerificaAnuncio = $this->Panel_M->consultar_DT_noticia_anuncio($ID_Noticia);
                
            //     // echo '<pre>';
            //     // print_r($VerificaAnuncio);
            //     // echo '</pre>';
            //     // exit;

            //     if($VerificaAnuncio == Array()){ //Se inserta el anuncio
            //         //Se INSERTAR el anuncio
            //         $this->Panel_M->insertar_DT_AnuncioSeleccionado($ID_Noticia, $ID_Anuncio);
            //     }
            //     else{ //Se actualiza el anuncio
            //         //Se ACTUALIZA el anuncio que corresponde a la noticia en la tabla de depencia transitiva "noticias_anuncios"
            //         $this->Panel_M->actualizar_DT_noticia_anuncio($ID_Noticia, $ID_Anuncio);
            //     }
            // }

            // // VIDEO
            // //Si se cambio el video se procede a actualizarlo
            // if($_FILES['video']["name"] != ""){			
            //     $ID_Video = !empty($_POST['id_video']) ? $_POST['id_video'] : 'No existe';	 
            //     $Nombre_video = $_FILES['video']['name'];
            //     $Tipo_video = $_FILES['video']['type'];
            //     $Tamanio_video = $_FILES['video']['size'];
            //     // echo 'ID_Video= ' . $ID_Video . '<br>';
            //     // echo 'Nombre_video= ' .  $Nombre_video . '<br>';
            //     // echo 'Tipo_video= ' .  $Tipo_video . '<br>';
            //     // echo 'Tamanio_video= ' .  $Tamanio_video . '<br>';
            //     // echo 'ID_Noticia= ' .  $ID_Noticia . '<br>';
            //     // exit;
                
            //     if($ID_Video == 'No existe'){//No existe video para actualizar, entonces se inserta
            //         //Se INSERTA el video de la noticia
            //         $this->Panel_M->InsertarVideoNoticia($ID_Noticia, $Nombre_video, $Tamanio_video, $Tipo_video);
            //     }
            //     else{//Se actualiza el video existente
            //         //Se ACTUALIZA el video de la noticia
            //         $this->Panel_M->ActualizarVideo($ID_Noticia, $Nombre_video, $Tamanio_video, $Tipo_video);
            //     }

                
            //     if($this->Servidor == 'Remoto'){
            //         //Usar en remoto
            //         $Directorio_1 = $_SERVER['DOCUMENT_ROOT'] . '/public/video/';
            //     }
            //     else{
            //         // usar en local
            //         $Directorio_1 = $_SERVER['DOCUMENT_ROOT'] . '/proyectos/NoticieroYaracuy/public/video/';
            //     }

            //     //Se mueve la imagen desde el directorio temporal a la ruta indicada anteriormente utilizando la función move_uploaded_files
            //     move_uploaded_file($_FILES['video']['tmp_name'], $Directorio_1.$Nombre_video);
            // }

            if($Bandera == 'Portada'){                
                return redirect()->action([PanelPeriodistaController::class,'index']);   
                die();
            }
            else{
                return redirect()->action([PanelPeriodistaController::class,'not_Generales']);
                die();
            }
        // }
        // else{
        //     echo 'La sesion no existe';
        //     // return redirect()->action([InicioController::class]); 
        //     die();
        // }
    }

    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************
    // *************************************************************************************************
    
    // ELimina noticia 
    public function eliminar_noticia($ID_Noticia){
       
        // falta eliminar de la tabla de dependencia transitiva "noticias_secciones"
        // falta eliminar del servidor el video

        // Se consultan los nombres de las imagenes de la noticia para eliminarlas del directorio
        $NombreImagenes = Imagenes_M::
            select('nombre_imagenNoticia')
            ->where('ID_Noticia','=', $ID_Noticia) 
            ->get();
            // return $NombreImagenes;
       
       // Se eliminan las imagenes del directorio del servidor
        foreach($NombreImagenes as $Key)	:
            $Ruta = file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/noticias/' . $Key->nombre_imagenNoticia);

            if($Ruta){
                unlink($_SERVER['DOCUMENT_ROOT'] . '/images/noticias/' . $Key->nombre_imagenNoticia); 
            }
        endforeach;
         
        // Se eliminan las imagenes de la BD
        $EliminaImagenes = Imagenes_M::       
            where('ID_Noticia','=', $ID_Noticia)
            ->delete();
            // return $EliminaImagenes;      

        // Elimina noticia de BD
        $EliminaNoticia = Noticias_M::       
            where('ID_Noticia','=', $ID_Noticia)
            ->delete();
            // return $EliminaNoticia; 	
        
        // // Elimina video de BD
        // $this->Panel_M->eliminarVideoNoticia($ID_Noticia);

        return redirect()->action([PanelPeriodistaController::class,'index']);
        die();
    }  
    
    // ELimina efemeride 
    public function eliminar_efemeride($ID_Efemeride){
       
        // Se consultan el nombre de la imagenen de la efemeride para eliminarla del directorio
        $NombreImagenEfemeride = ImagenesEfemerides_M::
            select('nombre_ImagenEfemeride')
            ->where('ID_Efemeride','=', $ID_Efemeride) 
            ->first();
            // return $NombreImagenEfemeride;
       
       // Se elimina la imagen del directorio del servidor                
        $Ruta = file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/efemerides/' .$NombreImagenEfemeride->nombre_imagenNoticia);

        if($Ruta){
            unlink($_SERVER['DOCUMENT_ROOT'] . '/images/efemerides/' . $NombreImagenEfemeride->nombre_ImagenEfemeride); 
        }
            
        // Se elimina la imagen de la BD
        $EliminaImagen = ImagenesEfemerides_M::       
            where('ID_Efemeride','=', $ID_Efemeride)
            ->delete(); 
            return $EliminaImagen;      

        // Elimina efemeride de BD
        $EliminaEfemeride = Efemerides_M::       
            where('ID_Efemeride','=', $ID_Efemeride)
            ->delete(); 
            return $EliminaEfemeride; 	
        
        return redirect()->action([PanelPeriodistaController::class,'efemerides']);
        die();
    } 
    
    // ELimina agenda 
    public function eliminar_agenda($ID_Agenda){
       
        // Se consultan el nombre de la imagenen de la agenda para eliminarla del directorio
        $NombreImagenAgenda = Agenda_M::
            select('nombre_imagenAgenda')
            ->where('ID_Agenda','=', $ID_Agenda) 
            ->first();
            // return $NombreImagenAgenda;
       
       // Se elimina la imagen del directorio del servidor                
        $Ruta = file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/agenda/' . $NombreImagenAgenda->nombre_imagenAgenda);

        if($Ruta){
            unlink($_SERVER['DOCUMENT_ROOT'] . '/images/agenda/' . $NombreImagenAgenda->nombre_imagenAgenda); 
        }
            
        // Se elimina el evento agendado de la BD
        $EliminaAgenda = Agenda_M::       
            where('ID_Agenda','=', $ID_Agenda)
            ->delete(); 
            return $EliminaAgenda;      
        
        return redirect()->action([PanelPeriodistaController::class,'agenda']);
        die();
    } 

    //Eliminar imagen secundaria de noticia
    public function eliminar_imagenSecundariaNoticia($ID_Imagen){
        
        // Se consultan el nombre de la imagen de la noticia para eliminarl del directorio
        $nombre_imagenNoticia = Imagenes_M::
            select('nombre_imagenNoticia')
            ->where('ID_Imagen','=', $ID_Imagen) 
            ->first();
            // return $nombre_imagenNoticia;
            
        $Ruta = file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/noticias/' . $nombre_imagenNoticia->nombre_imagenNoticia);

        if($Ruta){
            unlink($_SERVER['DOCUMENT_ROOT'] . '/images/noticias/' . $nombre_imagenNoticia->nombre_imagenNoticia); 
        }

        // Se elimina la imagen de la BD
        $EliminaImagen = Imagenes_M::       
            where('ID_Imagen','=', $ID_Imagen)
            ->delete(); 
            //return $EliminaImagen; 
    }

    public function instagram($ID_Noticia){

        // CONSULTA los datos de la noticia seleccionada
        $Noticia = Noticias_M::
            select('titulo','fecha','municipio','seccion','fuente')
            ->join('noticias_secciones', 'noticias_secciones.ID_Noticia','=','noticias.ID_Noticia')
            ->join('secciones', 'noticias_secciones.ID_Seccion','=','secciones.ID_Seccion')
            ->where('noticias.ID_Noticia','=', $ID_Noticia)
            ->first();
            // return $Noticia;
            
        // CONSULTA las imagenes de la noticia seleccionada
        $ImagenesNoticia = Imagenes_M::
            select('nombre_imagenNoticia')
            ->where('ID_Noticia','=', $ID_Noticia)
            ->where('ImagenPrincipal','=', 1)
            ->first();
            // return $ImagenesNoticia;

        return view('panel/periodistas/periodistaInstagram_V', [
            'noticia' => $Noticia, 
            'imagenNoticia' => $ImagenesNoticia
        ]);
    }
}

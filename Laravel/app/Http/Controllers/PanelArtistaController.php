<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Obras_M;
use App\Models\Suscriptor_M;

class PanelArtistaController extends Controller
{
    private $Panel_Artista_M;
    private $PrecioDolar;
    private $Comprimir;
    
    // Muestra el portafolio de obras de un artista
    public function index($ID_Suscriptor){      

        //consulta la cantidad de obras publicadas por un artista
        $CantidadObras = Obras_M::
            selectRaw('COUNT("ID_Obra") AS cantidadObras')  
            ->where('ID_Suscriptor', '=', $ID_Suscriptor)
            ->first();      
            // return $CantidadObras;

        //consulta la imagen del portafolio de un artista
        $ImagenPortafolio = Suscriptor_M::
            select('nombreSuscriptor','apellidoSuscriptor','nombre_imagenPortafolio')
            ->where('ID_Suscriptor', '=', $ID_Suscriptor)
            ->first();      
            // return $ImagenPortafolio;

        // Consulta detalles de obras publicadas por un artista
        $Obras = Obras_M::
            select('ID_Obra','nombreObra','imagenObra','precioDolarObra','precioBsObra','tecnicaObra','coleccionObra')
            ->where('ID_Suscriptor', '=', $ID_Suscriptor)
            ->get();      
            // return $Obras;
       
        //Si no hay obras cargadas y no hay foto de portafolio, se muestra el modal de sin obras
        if($CantidadObras['cantidadObras'] == 0 && $ImagenPortafolio['nombre_imagenPortafolio'] == ''){
                   
            return view('modal/modal_sinImagenPortafolio_V', [
                'ID_Suscriptor' => $ID_Suscriptor,
                'datosArtista' => $ImagenPortafolio,
                'obras' => $Obras 
            ]);
            exit;
        }
        else if($CantidadObras['cantidadObras'] == 0){//Si no hay obras cargadas pero ya existe una foto de perfil

            // header('location:' . RUTA_URL . '/PanelArtistaController/CargarObras/' . $ID_Suscriptor); 
            die();
        }
        else{            
            return view('panel/artistas/artista_obras_V', [
                'ID_Suscriptor' => $ID_Suscriptor,
                'datosArtista' => $ImagenPortafolio,
                'obras' => $Obras 
            ]); 
            exit;
        }
    }

    // entrega la cantidad de obras de un suscriptor
    public function cantidadObras($ID_Suscriptor){

        //consulta la cantidad de obras publicadas por un artista
        $CantidadObras = $this->Panel_Artista_M->consultarObras($ID_Suscriptor);

        return $CantidadObras;
    }

    // muestra la vista donde se carga una obra
    public function CargarObras($ID_Artista){
        echo 'ID_Artista= ' . $ID_Artista . '<br>';
        exit;

        //Solicita el precio del dolar al controlador 
        require(RUTA_APP . '/controladores/Divisas_C.php');
        $this->PrecioDolar = new Divisas_C();
        
        //se consultan la informacion del suscriptor
        $Suscriptor = $this->Panel_Artista_M->suscrptor($ID_Artista);

        $Datos = [
            'dolarHoy' => $this->PrecioDolar->Dolar,
            'suscriptor' => $Suscriptor
        ];
            
        // echo "<pre>";
        // print_r($Datos);
        // echo "</pre>";
        // exit();

        $_SESSION['CargarObras'] = 1922; 
        //Se crea esta sesion para impedir que se recargue la información enviada por el formulario mandandolo varias veces a la base de datos
        
        $this->vista('header/header_suscriptor');
        $this->vista('suscriptores/suscrip_agregarObra_V', $Datos);
    }

    // muestra la ventana modal donde se completa el registro como artista
    public function recibe_ImagenPortafolio(){

         //IMAGEN PORTAFOLIO
        // Si se selecionó alguna nueva imagen
        if(!empty($_FILES['imagenPortafolio']["name"]) != ''){
            $ID_Suscriptor = $_POST['id_suscriptor'];
            $NombreArtista = $_POST['nombreArtista'];
            $ApellidoArtista = $_POST['apellidoArtista'];
            $Telefono = $_POST['telefono'];
            $nombre_Portafolio = $_FILES['imagenPortafolio']['name'];
            $tipo_Portafolio = $_FILES['imagenPortafolio']['type'];
            $tamanio_Portafolio = $_FILES['imagenPortafolio']['size'];
            $Temporal_Portafolio = $_FILES['imagenPortafolio']['tmp_name'];

            // echo "Nombre de la imagen = " . $nombre_Portafolio . "<br>";
            // echo "Tipo de archivo = " . $tipo_Portafolio .  "<br>";
            // echo "Tamaño = " . $tamanio_Portafolio . "<br>";
            // //se muestra el directorio temporal donde se guarda el archivo
            // echo 'Temporal = ' . $_FILES['imagenPortafolio']['tmp_name'] .  "<br>";
            // echo 'ID_Suscriptor = ' . $ID_Suscriptor .  "<br>";
            // echo 'Nombre Artista = ' . $NombreArtista .  "<br>";
            // echo 'Apellido Artista = ' . $ApellidoArtista .  "<br>";
            // exit;

             //Se crea el directorio donde iran las obras de la galeria
            // Usar en remoto
            $CarpetaObras = $_SERVER['DOCUMENT_ROOT'] . '/public/images/galeria/' . $ID_Suscriptor . '_' . $NombreArtista . '_' . $ApellidoArtista;

            // Usar en local
            // $CarpetaObras = $_SERVER['DOCUMENT_ROOT'] . '/proyectos/NoticieroYaracuy/public/images/galeria/' . $ID_Suscriptor . '_' . $NombreArtista . '_' . $ApellidoArtista;
            
            if(!file_exists($CarpetaObras)){
                mkdir($CarpetaObras, 0777, true);
            }    
            
             //Se crea el directorio donde iran la imagen de portafolio del artista
            // Usar en remoto
            $CarpetaPortafolio = $_SERVER['DOCUMENT_ROOT'] . '/public/images/galeria/' . $ID_Suscriptor . '_' . $NombreArtista . '_' . $ApellidoArtista . '/perfil';

            // Usar en local
            // $CarpetaPortafolio = $_SERVER['DOCUMENT_ROOT'] . '/proyectos/NoticieroYaracuy/public/images/galeria/' . $ID_Suscriptor . '_' . $NombreArtista . '_' . $ApellidoArtista . '/perfil';
            
            if(!file_exists($CarpetaPortafolio)){
                mkdir($CarpetaPortafolio, 0777, true);
            }         
                
            //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
            $nombre_Portafolio = preg_replace('([^A-Za-z0-9.])', '', $nombre_Portafolio);

            // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
            $nombre_Portafolio = mt_rand() . '_' . $nombre_Portafolio;

            // ACTUALIZA IMAGEN PRINCIPAL DE NOTICIA EN SERVIDOR                
            require(RUTA_APP . '/helpers/Comprimir_Imagen.php');
            $Comprimir = new Comprimir_Imagen();

            // se comprime y se inserta el archivo en el directorio de servidor 
            $Bandera = 'imagenPortafolio';
            $Comprimir->index($Bandera, $nombre_Portafolio, $tipo_Portafolio, $tamanio_Portafolio, $Temporal_Portafolio, $ID_Suscriptor, $NombreArtista, $ApellidoArtista);

            //Se ACTUALIZA la fotografia de portafolio y el telefono del artista
            $this->Panel_Artista_M->actualizarImagenPortafolio($ID_Suscriptor, $nombre_Portafolio, $tipo_Portafolio, $tamanio_Portafolio, $Telefono);
            
            $this->CargarObras($_POST["id_suscriptor"]);
        }
        else{
            echo "Es necesario una imagen para la noticia";
            exit;
        }
    }
    
    // Carga la vista de perfil del suscriptor
    public function perfil_artista($ID_Artista){       
        echo $ID_Artista;
        exit;
        // CONSULTA toda la información de perfil del suscriptor
        $this->Suscriptor = $this->ConsultaSuscriptor_M->consultarSuscriptor($ID_Suscriptor);
        
        // CONSULTA las secciones que tiene el catalogo de un suscriptor 
        $Secciones = $this->Instancia_Panel_C->SeccionesSuscriptor($ID_Suscriptor);

        $Datos = [       
            'suscriptor' => $this->Suscriptor,         
            'secciones' => $Secciones,                        
            'ID_Suscriptor' => $this->Suscriptor[0]['ID_Suscriptor'],
            'nombre' => $this->Suscriptor[0]['nombreSuscriptor'],
            'apellido' => $this->Suscriptor[0]['apellidoSuscriptor'],
            'Pseudonimmo' => $this->Suscriptor[0]['pseudonimoSuscripto'],
            'telefono' => $this->Suscriptor[0]['telefonoSuscriptor'],
        ];
        
        // echo '<pre>';
        // print_r($Datos);
        // echo '</pre>';
        // exit;   
        
        $this->vista("header/header_suscriptor");
        $this->vista("panel/suscriptores/suscrip_perfil_V", $Datos);
    } 

    // recibe el formulario para cargar una obra
    public function recibeObraPublicar(){
        if($_SESSION['CargarObras'] == 1922){// Anteriormente en el metodo "CargarObras" se generó la variable $_SESSION["CargarObras"] con un valor de 1922; con esto se evita que no se pueda recarga esta página.
            unset($_SESSION['CargarObras']);//se borra la sesión. 

            //Se reciben todos los campos del formulario, desde cuenta_publicar_V.php se verifica que son enviados por POST y que no estan vacios
            //SECCION DATOS DEL PRODUCTO
            if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nombreObra']) && !empty($_POST['precioBs']) && (!empty($_POST['precioDolar']) || $_POST['precioDolar'] == 0)){
                $RecibeObra = [
                    //Recibe datos del producto que se va a cargar al sistema
                    'id_suscriptor' => $_POST['id_suscriptor'],
                    'nombreObra' => $_POST['nombreObra'],
                    'descripcionObra' => $_POST['descripcionObra'],
                    // 'Descripcion' => preg_replace('[\n|\r|\n\r|\]','',$_POST, "descripcion", ), //evita los saltos de lineas realizados por el usuario al separar parrafos
                    'precioBsObra' => $_POST["precioBs"],
                    'precioDolarObra' => $_POST["precioDolar"],
                    'dimensionesObra' => $_POST['dimensiones'],
                    'tecnicaObra' => $_POST['tecnica'],
                    'coleccionObra' => $_POST['coleccion'],
                    'anioObra' => $_POST['anio'],
                    'ID_Suscriptor' => $_POST["id_suscriptor"] 
                ];
                // echo '<pre>';
                // print_r($RecibeObra);   
                // echo '</pre>';
                // exit;
            }
            else{
                echo 'Llene todos los campos del formulario ';
                echo "<a href='javascript: history.go(-1)'>Regresar</a>";
                // exit();
            }

            //********************************************************
            //Las siguientes consultas se deben realizar por medio de Transacciones BD

    
            //IMAGEN OBRA
            //********************************************************
            //Si se selecionó alguna imagen entra
            if($_FILES['imagenObra']["name"] != ''){
                $nombre_imagenObra = $_FILES['imagenObra']['name'];
                $tipo_imagenObra = $_FILES['imagenObra']['type'];
                $tamanio_imagenObra = $_FILES['imagenObra']['size'];
                $Temporal_imagenObra = $_FILES['imagenObra']['tmp_name'];
                $ID_Suscriptor = $_POST['id_suscriptor'];
                $NombreArtista = $_POST['nombreArtista'];
                $ApellidoArtista = $_POST['apellidoArtista'];

                // echo 'Nombre de la imagen = ' . $nombre_imagenObra . '<br>';
                // echo 'Tipo de archivo = ' .$tipo_imagenObra .  '<br>';
                // echo 'Tamaño = ' . $tamanio_imagenObra . '<br>';
                // echo 'Archivo temporal = ' . $Temporal_imagenObra . '<br>';
                // exit();
                
                //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
                $nombre_imagenObra = preg_replace('([^A-Za-z0-9.])', '', $nombre_imagenObra);

                // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
                $nombre_imagenObra = mt_rand() . '_' . $nombre_imagenObra;

                    //indicamos los formatos que permitimos subir a nuestro servidor
                    if(($tipo_imagenObra == 'image/jpeg')
                        || ($tipo_imagenObra == 'image/jpg') || ($tipo_imagenObra == 'image/png')){
                        
                        //Se INSERTA la imagen dela obra en la BD
                        // $this->Panel_Artista_M->insertaImagenPrincipalProducto($ID_Obra, $nombre_imagenObra, $tipo_imagenObra, $tamanio_imagenObra);
                        
                        // INSSERTA IMAGEN DE OBRA EN SERVIDOR
                        // se comprime y se inserta el archivo en el directorio de servidor 
                        $Bandera = 'imagenObra';
                        require(RUTA_APP . '/helpers/Comprimir_Imagen.php');
                        $this->Comprimir = new Comprimir_Imagen();

                        $this->Comprimir->index($Bandera, $nombre_imagenObra, $tipo_imagenObra, $tamanio_imagenObra, $Temporal_imagenObra, $ID_Suscriptor, $NombreArtista, $ApellidoArtista);
                                                    
                        //Se INSERTA en BD la obra
                        $this->Panel_Artista_M->insertarObra($RecibeObra, $nombre_imagenObra,$tamanio_imagenObra, $tipo_imagenObra);

                        $this->index($RecibeObra["ID_Suscriptor"]);
                    }
                    else{
                        //si no cumple con el formato
                        echo 'Solo puede cargar imagenes con formato jpg, jpeg o png';
                        echo '<a href="javascript: history.go(-1)">Regresar</a>';
                        exit();
                    }
            }
            else{//si no se selecciono ninguna imagen principal
                echo 'Es necesario mostrar una imagen de la obra ';
                echo "<a href='javascript: history.go(-1)'>Regresar</a>";
                exit();
            }
        }
        else{                 
            header('location:' . RUTA_URL . '/CerrarSesion_C');
            die();
        } 
    }

    // muestra formulario para actualizar una obra especifico
    public function actualizarObra($ID_Obra){

        //CONSULTA los datos de una obra especifica
        $Especificaciones = $this->Panel_Artista_M->consultarDescripcionObra($ID_Obra);
        
        //CONSULTA los datos de una obra especifica
        $DatosSuscriptor = $this->Panel_Artista_M->suscrptor($_SESSION['ID_Suscriptor']);
                                            
        //Solicita el precio del dolar al controlador 
        require(RUTA_APP . '/controladores/Divisas_C.php');
        $this->PrecioDolar = new Divisas_C();
        // VERIFICAR QUE SE TRAE LOS DATOS DE ACCESO A LA BD
        // echo '<pre>';
        // print_r($this->PrecioDolar);
        // echo '</pre>';

        // Se consulta el precio del dolar
        $PrecioDolarHoy = $this->PrecioDolar->Dolar;

        $Datos = [
            'ID_Suscriptor' => $_SESSION['ID_Suscriptor'],
            'especificaciones' => $Especificaciones, 
            'dolarHoy' => $PrecioDolarHoy,
            'suscriptor' => $DatosSuscriptor
        ];

        // echo '<pre>';
        // print_r($Datos);
        // echo '</pre>';
        // exit();

        //SE crea la sesion, esta sera solicitada cuando se envia el formulario para evitar recargas y duplicidad de datos
        $_SESSION["EditarObra"] = 1027;

        $this->vista('header/header_suscriptor'); 
        $this->vista('suscriptores/suscrip_editar_obra_V', $Datos);
    }

    //recibe el formulario que actualiza una obra
    public function recibeActualizaObra(){
        if($_SESSION["EditarObra"] == 1027){// Anteriormente en el metodo "actualizarObra" se generó la variable $_SESSION["EditarObra"] con un valor de 1027; con esto se evita que no se pueda recarga esta página.
            unset($_SESSION['EditarObra']);//se borra la sesión. 

            //Se reciben todos los campos del formulario, desde cuenta_publicar_V.php se verifica que son enviados por POST y que no estan vacios
            //SECCION DATOS DEL PRODUCTO
            if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nombreObra']) && !empty($_POST['precioBs']) && (!empty($_POST['precioDolar']) || $_POST['precioDolar'] == 0)){
                $RecibeObra = [
                    //Recibe datos del producto que se va a cargar al sistema
                    'id_suscriptor' => $_POST['id_suscriptor'],
                    'nombreObra' => $_POST['nombreObra'],
                    'descripcionObra' => $_POST['descripcionObra'],
                    // 'Descripcion' => preg_replace('[\n|\r|\n\r|\]','',$_POST, "descripcion", ), //evita los saltos de lineas realizados por el usuario al separar parrafos
                    'precioBsObra' => $_POST["precioBs"],
                    'precioDolarObra' => $_POST["precioDolar"],
                    'dimensionesObra' => $_POST['dimensiones'],
                    'tecnicaObra' => $_POST['tecnica'],
                    'coleccionObra' => $_POST['coleccion'],
                    'anioObra' => $_POST['anio'],
                    'ID_Suscriptor' => $_POST["id_suscriptor"],
                    'ID_Obra' => $_POST["id_obra"]  
                ];
                // echo '<pre>';
                // print_r($RecibeObra);   
                // echo '</pre>';
                // exit;
            }
            else{
                echo 'Llene todos los campos del formulario ';
                echo "<a href='javascript: history.go(-1)'>Regresar</a>";
                // exit();
            }

            //Se INSERTAN datos en BD la obra
            $this->Panel_Artista_M->actualizarDatosObra($RecibeObra);
    
            //IMAGEN OBRA
            //********************************************************
            //Si se selecionó alguna imagen nueva para la obra
            if($_FILES['imagenObra']["name"] != ''){
                $nombre_imagenObra = $_FILES['imagenObra']['name'];
                $tipo_imagenObra = $_FILES['imagenObra']['type'];
                $tamanio_imagenObra = $_FILES['imagenObra']['size'];
                $Temporal_imagenObra = $_FILES['imagenObra']['tmp_name'];
                $ID_Suscriptor = $_POST['id_suscriptor'];
                $NombreArtista = $_POST['nombreArtista'];
                $ApellidoArtista = $_POST['apellidoArtista'];

                // echo 'Nombre de la imagen = ' . $nombre_imagenObra . '<br>';
                // echo 'Tipo de archivo = ' .$tipo_imagenObra .  '<br>';
                // echo 'Tamaño = ' . $tamanio_imagenObra . '<br>';
                // echo 'Temporal_imagenObra = ' . $Temporal_imagenObra . '<br>';
                // echo 'ID_Suscriptor = ' . $ID_Suscriptor . '<br>';
                // echo 'Nombre Artista = ' . $NombreArtista . '<br>';
                // echo 'Apellido Artista = ' . $ApellidoArtista . '<br>';
                // exit();
                
                //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
                $nombre_imagenObra = preg_replace('([^A-Za-z0-9.])', '', $nombre_imagenObra);

                // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
                $nombre_imagenObra = mt_rand() . '_' . $nombre_imagenObra;

                //indicamos los formatos que permitimos subir a nuestro servidor
                if(($tipo_imagenObra == 'image/jpeg')
                    || ($tipo_imagenObra == 'image/jpg') || ($tipo_imagenObra == 'image/png')){
                                            
                    // INSSERTA IMAGEN DE OBRA EN SERVIDOR
                    // se comprime y se inserta el archivo en el directorio de servidor 
                    $Bandera = 'imagenObra';
                    require(RUTA_APP . '/helpers/Comprimir_Imagen.php');
                    $this->Comprimir = new Comprimir_Imagen();

                    $this->Comprimir->index($Bandera, $nombre_imagenObra, $tipo_imagenObra, $tamanio_imagenObra, $Temporal_imagenObra, $ID_Suscriptor, $NombreArtista, $ApellidoArtista);
                                                
                    //Se INSERTA en BD la obra
                    $this->Panel_Artista_M->actualizarImagenObra($RecibeObra, $nombre_imagenObra,$tamanio_imagenObra, $tipo_imagenObra);
                }
                else{
                    //si no cumple con el formato
                    echo 'Solo puede cargar imagenes con formato jpg, jpeg o png';
                    echo '<a href="javascript: history.go(-1)">Regresar</a>';
                    exit();
                }
            }
                          
            //IMAGEN PORTAFOLIO
            //********************************************************
            //Si se selecionó alguna imagen nueva para la obra
            // if($_FILES['imagenObra']["name"] != ''){
            //     $nombre_imagenObra = $_FILES['imagenObra']['name'];
            //     $tipo_imagenObra = $_FILES['imagenObra']['type'];
            //     $tamanio_imagenObra = $_FILES['imagenObra']['size'];
            //     $Temporal_imagenObra = $_FILES['imagenObra']['tmp_name'];
            //     $ID_Suscriptor = $_POST['id_suscriptor'];
            //     $NombreArtista = $_POST['nombreArtista'];
            //     $ApellidoArtista = $_POST['apellidoArtista'];

            //     // echo 'Nombre de la imagen = ' . $nombre_imagenObra . '<br>';
            //     // echo 'Tipo de archivo = ' .$tipo_imagenObra .  '<br>';
            //     // echo 'Tamaño = ' . $tamanio_imagenObra . '<br>';
            //     //se muestra el directorio temporal donde se guarda el archivo
            //     // echo $_FILES['imagen']['tmp_name'];
            //     // exit();
                
            //     //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
            //     $nombre_imagenObra = preg_replace('([^A-Za-z0-9.])', '', $nombre_imagenObra);

            //     // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
            //     $nombre_imagenObra = mt_rand() . '_' . $nombre_imagenObra;

            //         //indicamos los formatos que permitimos subir a nuestro servidor
            //         if(($tipo_imagenObra == 'image/jpeg')
            //             || ($tipo_imagenObra == 'image/jpg') || ($tipo_imagenObra == 'image/png')){
                        
            //             //Se INSERTA la imagen dela obra en la BD
            //             // $this->Panel_Artista_M->insertaImagenPrincipalProducto($ID_Obra, $nombre_imagenObra, $tipo_imagenObra, $tamanio_imagenObra);
                        
            //             // INSSERTA IMAGEN DE OBRA EN SERVIDOR
            //             // se comprime y se inserta el archivo en el directorio de servidor 
            //             $Bandera = 'imagenObra';
            //             require(RUTA_APP . '/helpers/Comprimir_Imagen.php');
            //             $this->Comprimir = new Comprimir_Imagen();

            //             $this->Comprimir->index($Bandera, $nombre_imagenObra, $tipo_imagenObra, $tamanio_imagenObra, $Temporal_imagenObra, $ID_Suscriptor, $NombreArtista, $ApellidoArtista);
                                                    
            //             //Se INSERTA en BD la obra
            //             $this->Panel_Artista_M->actualizarImagenObra($ID_Obra, $nombre_imagenObra,$tamanio_imagenObra, $tipo_imagenObra);
            //         }
            //         else{
            //             //si no cumple con el formato
            //             echo 'Solo puede cargar imagenes con formato jpg, jpeg o png';
            //             echo '<a href="javascript: history.go(-1)">Regresar</a>';
            //             exit();
            //         }
            // }
            // else{//si no se selecciono ninguna imagen principal
            //     echo 'Es necesario mostrar una imagen de la obra ';
            //     echo "<a href='javascript: history.go(-1)'>Regresar</a>";
            //     exit();
            // }
            
            $this->index($RecibeObra["ID_Suscriptor"]);
        }
        else{                 
            header('location:' . RUTA_URL . '/CerrarSesion');
            die();
        } 
    }
    
    //Elimina una obra especifica
    public function eliminarObra($ID_Obra){

        //Se consulta el nombre y apellido del artista y el nombre de la obra necesarios para la ruta en el seridor
        $Suscriptor = $this->Panel_Artista_M->consultarArtista($ID_Obra);
        
        //Usar en remoto
        unlink($_SERVER['DOCUMENT_ROOT'] . '/public/images/galeria/'. $_SESSION['ID_Suscriptor'] . '_' . ['ID_Suscriptor'] . '_' . $Suscriptor['nombreSuscriptor'] . '_' . $Suscriptor['apellidoSuscriptor'] . '/' . $Suscriptor['imagenObra'] );
            
        //usar en local
        // unlink($_SERVER['DOCUMENT_ROOT'] . '/proyectos/noticieroyaracuy/public/images/galeria/'. $_SESSION['ID_Suscriptor'] . '_' . $Suscriptor['nombreSuscriptor'] . '_' . $Suscriptor['apellidoSuscriptor'] . '/' . $Suscriptor['imagenObra'] );
        
        //Se elimina la obra de la BD
        $this->Panel_Artista_M->ObraEliminar($ID_Obra);

        $this->index($_SESSION['ID_Suscriptor']);
    }
}

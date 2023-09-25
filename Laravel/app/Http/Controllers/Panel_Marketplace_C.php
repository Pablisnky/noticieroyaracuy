<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Panel_Marketplace_C extends Controller
{
    private $ConsultaClasificados_M;
    private $PrecioDolar;
    private $InformacionSuscriptor;
    private $Comprimir;

    public function __construct(){
        // session_start();
    }
         
    //Da la cantidad de anuncios clasificados que tiene un suscriptor especifico
    public function index($ID_Suscriptor){
        // echo $ID_Suscriptor;
        //se consultan los anuncios clasificados de un suscriptor
        // $ClasificadosSuscriptor = $this->ConsultaClasificados_M->consultarAnunciosClasificados($ID_Suscriptor);
        
        // echo "<pre>";
        // print_r($ClasificadosSuscriptor);
        // echo "</pre>";
        // exit();

        // return $ClasificadosSuscriptor;
        return view('suscriptores/suscrip_marketplace_V');
    }
    
    //CONSULTA las secciones que tiene el catalogo de un suscriptor
    public function SeccionesSuscriptor($ID_Suscriptor){
        
        //se consultan los anuncios clasificados de un suscriptor
        $ClasificadosSuscriptor = $this->ConsultaClasificados_M->consultarSeccionesSuscriptor($ID_Suscriptor);
        
        // echo "<pre>";
        // print_r($ClasificadosSuscriptor);
        // echo "</pre>";
        // exit();

        return $ClasificadosSuscriptor;
    }

    //Muestra todos los productos en la vista clasificados del panel de suscriptores
    public function Productos($ID_Suscriptor){
        // echo 'ID_Suscriptor= ' . $ID_Suscriptor . '<br>';
        // exit;

        //CONSULTA todos los productos de un suscriptor  
        $Productos = $this->ConsultaClasificados_M->consultarTodosProductosSuscriptor($ID_Suscriptor);

        $Datos = [
            'productos' => $Productos,
            'suscriptor' => $_SESSION["ID_Suscriptor"],
            'pseudonimmo' => $_SESSION["PseudonimoSuscriptor"]
        ];
        
        // echo "<pre>";
        // print_r($Datos);
        // echo "</pre>";
        // exit();

        //Si no hay productos cargados y no hay datos comerciales, se muestra el modal de sin productos
        if($Datos['productos'] == Array() && $Datos['pseudonimmo'] == ''){
            $Datos = [
               'SinDatosComerciales'  => 'SinDatosComerciales',
               'ID_Suscriptor' => $ID_Suscriptor
            ];

            $this->vista('header/header_suscriptor');
            $this->vista('modal/modal_sinProductos_V', $Datos);
            exit;
        }
        else if($Productos == Array()){//Si no hay productos cargados

            header('location:' . RUTA_URL . '/Panel_Clasificados_C/Publicar/' . $ID_Suscriptor); 
            die();
        }
        else{    
            $this->vista('header/header_suscriptor');
            $this->vista('suscriptores/suscrip_productos_V', $Datos);
        }            
    }
    
    // muestra la vista donde se carga un producto
    public function Publicar($ID_Suscriptor){
        // echo 'ID_Suscriptor= ' . $ID_Suscriptor . '<br>';
        // exit;

        //Solicita el precio del dolar al controlador 
        require(RUTA_APP . '/controladores/Divisas_C.php');
        $this->PrecioDolar = new Divisas_C();
        
        //se consultan las secciones del catalogo del suscriptor
        $Secciones = $this->ConsultaClasificados_M->consultarSeccionesSuscriptor($ID_Suscriptor);

        $Datos = [
            'dolarHoy' => $this->PrecioDolar->Dolar,
            'ID_Suscriptor' => $ID_Suscriptor,
            'secciones' => $Secciones
        ];
            
        // echo "<pre>";
        // print_r($Datos);
        // echo "</pre>";
        // exit();

        $_SESSION['Publicar'] = 1906; 
        //Se crea esta sesion para impedir que se recargue la información enviada por el formulario mandandolo varias veces a la base de datos

        $this->vista('header/header_suscriptor');
        $this->vista('suscriptores/suscrip_publicar_V', $Datos);
    }
    
    //recibe el formulario para cargar un nuevo producto
    public function recibeProductoPublicar(){
        if($_SESSION['Publicar'] == 1906){// Anteriormente en el metodo "Publicar" se generó la esta sesion; con esto se evita que no se pueda recarga esta página.
            unset($_SESSION['Publicar']);//se borra la sesión. 

            //Se reciben todos los campos del formulario, desde cuenta_publicar_V.php se verifica que son enviados por POST y que no estan vacios
            //SECCION DATOS DEL PRODUCTO
            if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['producto']) && !empty($_POST['descripcion']) && !empty($_POST['id_seccion'])  && !empty($_POST['precioBs']) && (!empty($_POST['precioDolar']) || $_POST['precioDolar'] == 0)){ 
                $RecibeProducto = [
                    //Recibe datos del producto que se va a cargar al sistema
                    'condicion' => !empty($_POST['grupo']) ? $_POST['grupo'] : 'NoAsignado',
                    'Producto' => $_POST['producto'],
                    'Descripcion' => $_POST['descripcion'],
                    'id_seccion' => $_POST['id_seccion'],
                    // 'Descripcion' => preg_replace('[\n|\r|\n\r|\]','',$_POST, "descripcion", ), //evita los saltos de lineas realizados por el usuario al separar parrafos
                    'PrecioBs' => $_POST["precioBs"],
                    'PrecioDolar' => $_POST["precioDolar"],
                    'Cantidad' => empty($_POST['cantidad']) ? 0 : $_POST['cantidad'],
                    'ID_Suscriptor' => $_POST["id_suscriptor"] 
                ];
                // echo '<pre>';
                // print_r($RecibeProducto);   
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

            //Se INSERTA en BD el producto  y se retorna el ID recien insertado
            $ID_Producto = $this->ConsultaClasificados_M->insertarProducto($RecibeProducto);

            //Se INSERTA en BD la opcion y precio del productoy se retorna el ID recien insertado
            $ID_Opcion = $this->ConsultaClasificados_M->insertarOpcionesProducto($RecibeProducto);
            
            //Se INSERTA en BD la dependencia transitiva entre producto y opciones
            $this->ConsultaClasificados_M->insertarDT_ProOpc($ID_Producto, $ID_Opcion);
            
            //Se INSERTA en BD la dependencia transitiva entre producto yseccion
            $this->ConsultaClasificados_M->insertarDT_ProSec($ID_Producto, $RecibeProducto);

            //IMAGEN PRINCIPAL PRODUCTO
            //********************************************************
            //Si se selecionó alguna imagen entra
            if($_FILES['imagenProducto']["name"] != ''){
                $nombre_imgProducto = $_FILES['imagenProducto']['name'];
                $tipo_imgProducto = $_FILES['imagenProducto']['type'];
                $tamanio_imgProducto = $_FILES['imagenProducto']['size'];
                $Temporal_imgProducto = $_FILES['imagenProducto']['tmp_name'];

                // echo 'Nombre de la imagen = ' . $nombre_imgProducto . '<br>';
                // echo 'Tipo de archivo = ' .$tipo_imgProducto .  '<br>';
                // echo 'Tamaño = ' . $tamanio_imgProducto . '<br>';
                //se muestra el directorio temporal donde se guarda el archivo
                // echo $_FILES['imagen']['tmp_name'];
                // exit();
                
                //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
                $nombre_imgProducto = preg_replace('([^A-Za-z0-9.])', '', $nombre_imgProducto);

                // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
                $nombre_imgProducto = mt_rand() . '_' . $nombre_imgProducto;

                //Si existe imagenProducto y tiene un tamaño correcto (maximo 2Mb)
                if($nombre_imgProducto == !NULL){
                    //indicamos los formatos que permitimos subir a nuestro servidor
                    if(($tipo_imgProducto == 'image/jpeg')
                        || ($tipo_imgProducto == 'image/jpg') || ($tipo_imgProducto == 'image/png')){
                        
                        //Se crea el directorio donde iran las imagenes de la tienda
                        // Usar en remoto
                        $CarpetaProductos = $_SERVER['DOCUMENT_ROOT'] . '/public/images/clasificados/' . $_SESSION['ID_Suscriptor'] . '/productos';

                        // Usar en local
                        // $CarpetaProductos = $_SERVER['DOCUMENT_ROOT'] . '/proyectos/NoticieroYaracuy/public/images/clasificados/' . $_SESSION['ID_Suscriptor'] . '/productos';
                        
                        if(!file_exists($CarpetaProductos)){
                            mkdir($CarpetaProductos, 0777, true);
                        }       

                        //Se INSERTA la imagen principal en BD
                        $this->ConsultaClasificados_M->insertaImagenPrincipalProducto($ID_Producto, $nombre_imgProducto, $tipo_imgProducto, $tamanio_imgProducto);
                        
                        // INSSERTA IMAGEN PRINCIPAL DE NOTICIA EN SERVIDOR
                        // se comprime y se inserta el archivo en el directorio de servidor 
                        $Bandera = 'imagenProducto';
                        require(RUTA_APP . '/helpers/Comprimir_Imagen.php');
                        $this->Comprimir = new Comprimir_Imagen();

                        $this->Comprimir->index($Bandera, $nombre_imgProducto, $tipo_imgProducto, $tamanio_imgProducto, $Temporal_imgProducto);
                        
                        $this->Productos($RecibeProducto["ID_Suscriptor"]);
                    }
                    else{
                        //si no cumple con el formato
                        echo 'Solo puede cargar imagenes con formato jpg, jpeg o png';
                        echo '<a href="javascript: history.go(-1)">Regresar</a>';
                        exit();
                    }
                }
                else{//si se pasa del tamaño permitido
                    echo 'La imagen principal es demasiado grande ';
                    echo '<a href="javascript: history.go(-1)">Regresar</a>';
                    exit();
                }
            }
            else{//si no se selecciono ninguna imagen principal
                echo 'Es necesario mostrar una imagen del producto ';
                echo "<a href='javascript: history.go(-1)'>Regresar</a>";
                exit();
            }
            
            //INSERTAR IMAGENES SECUNDARIAS PRODUCTO
            if($_FILES['imagenSecundariiaProducto']['name'][0] != ''){
                $Cantidad = count($_FILES['imagenSecundariiaProducto']['name']);
                for($i = 0; $i < $Cantidad; $i++){
                    //nombre original del fichero en la máquina cliente.
                    $Nombre_imagenSecundaria = $_FILES['imagenSecundariiaProducto']['name'][$i];
                    $Ruta_Temporal_imagenSecundaria = $_FILES['imagenSecundariiaProducto']['tmp_name'][$i];
                    $tipo_imagenSecundaria = $_FILES['imagenSecundariiaProducto']['type'][$i];
                    $tamanio_imagenSecundaria = $_FILES['imagenSecundariiaProducto']['size'][$i];
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

                    // INSSERTA IMAGEN SECUNDARIA DE PRODUCTO EN SERVIDOR
                    // se comprime y se inserta el archivo en el directorio de servidor 
                    $Bandera = 'imagenSecundariiaProducto';
                    $this->Comprimir->index($Bandera, $Nombre_imagenSecundaria, $tipo_imagenSecundaria,$tamanio_imagenSecundaria, $Ruta_Temporal_imagenSecundaria);	
                    
                    //Se INSERTAN las fotografias secundarias del producto en BD
                    $this->ConsultaClasificados_M->insertaImagenSecundariaProducto($ID_Producto, $Nombre_imagenSecundaria, $tipo_imagenSecundaria, $tamanio_imagenSecundaria);
                }
            }
        }
        else{ 
            $this->Productos($_POST["id_suscriptor"]);
        } 
    }
    
    //recibe formulario que actualiza la información de un producto
    public function recibeAtualizarProducto(){
        //Se reciben todos los campos del formulario, se verifica que son enviados por POST y que no estan vacios
        if($_SERVER['REQUEST_METHOD'] == 'POST'&& !empty($_POST['producto']) && !empty($_POST['descripcion']) && !empty($_POST['precioBolivar']) && (!empty($_POST['precioDolar']) || $_POST['precioDolar'] == 0)){

            //Recibe datos del producto a actualizar
            $RecibeProducto = [
                'condicion' => !empty($_POST['grupo']) ? $_POST['grupo'] : 'NoAsignado',
                'ID_Producto' => $_POST['id_producto'],
                'ID_Opcion' => $_POST['id_opcion'],
                'Producto' => $_POST['producto'],
                'Descripcion' => $_POST['descripcion'],
                // 'Descripcion' => preg_replace('[\n|\r|\n\r|\]','',$_POST, "descripcion", ), //evita los saltos de lineas realizados por el usuario al separar parrafos
                'PrecioBs' => $_POST["precioBolivar"],
                'PrecioDolar' => $_POST["precioDolar"],
                'Cantidad' => empty($_POST['uni_existencia']) ? 0 : $_POST['uni_existencia'],
                'ID_Suscriptor' => $_POST["id_suscriptor"],
                'ID_Seccion' => $_POST["id_seccion"] 
            ];
            // echo '<pre>';
            // print_r($RecibeProducto);
            // echo '</pre>';
            // exit;
        }
        else{
            echo 'Llene todos los campos obligatorios' . '<br>';
            echo '<a href="javascript: history.go(-1)">Regresar</a>';
            exit();
        }

        require(RUTA_APP . '/helpers/Comprimir_Imagen.php');
        $this->Comprimir = new Comprimir_Imagen();

        //IMAGEN PRINCIPAL
        // ********************************************************
        // Si se selecionó alguna nueva imagen
        if(!empty($_FILES['imagenPrinci_Editar']["name"]) != ''){
            $nombre_imgProductoActualizar = $_FILES['imagenPrinci_Editar']['name'];
            $tipo_imgProductoActualizar = $_FILES['imagenPrinci_Editar']['type'];
            $tamanio_imgProductoActualizar = $_FILES['imagenPrinci_Editar']['size'];
            $Temporal_imgProductoActualizar = $_FILES['imagenPrinci_Editar']['tmp_name'];

            // echo "Nombre de la imagen = " . $nombre_imgProducto . "<br>";
            // echo "Tipo de archivo = " . $tipo .  "<br>";
            // echo "Tamaño = " . $tamanio . "<br>";
            // //se muestra el directorio temporal donde se guarda el archivo
            // echo $_FILES['imagen']['tmp_name'];
            // exit;
                
            //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
            $nombre_imgProductoActualizar = preg_replace('([^A-Za-z0-9.])', '', $nombre_imgProductoActualizar);

            // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
            $nombre_imgProductoActualizar = mt_rand() . '_' . $nombre_imgProductoActualizar;

            // ACTUALIZA IMAGEN PRINCIPAL DE NOTICIA EN SERVIDOR
            // se comprime y se inserta el archivo en el directorio de servidor 
            $Bandera = 'imagenProducto';
            $this->Comprimir->index($Bandera, $nombre_imgProductoActualizar, $tipo_imgProductoActualizar, $tamanio_imgProductoActualizar, $Temporal_imgProductoActualizar);

            //Se ACTUALIZA la fotografia principal del producto
            $this->ConsultaClasificados_M->actualizarImagenPrincipalProducto($RecibeProducto['ID_Producto'], $nombre_imgProductoActualizar, $tipo_imgProductoActualizar, $tamanio_imgProductoActualizar);
        }
        
        //ACTUALIZAR IMAGENES SECUNDARIAS PRODUCTO
        if($_FILES['imagenSecundariiaProdActualizar']['name'][0] != ''){
            $Cantidad = count($_FILES['imagenSecundariiaProdActualizar']['name']);
            for($i = 0; $i < $Cantidad; $i++){
                //nombre original del fichero en la máquina cliente.
                $Nombre_imagenSecundaria = $_FILES['imagenSecundariiaProdActualizar']['name'][$i];
                $Ruta_Temporal_imagenSecundaria = $_FILES['imagenSecundariiaProdActualizar']['tmp_name'][$i];
                $tipo_imagenSecundaria = $_FILES['imagenSecundariiaProdActualizar']['type'][$i];
                $tamanio_imagenSecundaria = $_FILES['imagenSecundariiaProdActualizar']['size'][$i];
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

                // ACTUALIZA IMAGEN SECUNDARIA DE PRODUCTO EN SERVIDOR
                // se comprime y se inserta el archivo en el directorio de servidor 
                $Bandera = 'imagenSecundariiaProdActualizar';
                $this->Comprimir->index($Bandera, $Nombre_imagenSecundaria, $tipo_imagenSecundaria,$tamanio_imagenSecundaria, $Ruta_Temporal_imagenSecundaria);	
                
                //Se INSERTAN las fotografias secundarias del producto en BD
                $this->ConsultaClasificados_M->insertaImagenSecundariaProducto($RecibeProducto['ID_Producto'], $Nombre_imagenSecundaria, $tipo_imagenSecundaria, $tamanio_imagenSecundaria);
            }
        }
    
        // ********************************************************
        //Estas sentencias de actualización deben realizarce por medio de transsacciones

        $this->ConsultaClasificados_M->actualizarOpcion($RecibeProducto);
        $this->ConsultaClasificados_M->actualizarProducto($RecibeProducto);
        
        //ACTUALIZA la dependencia transitiva entre el producto y la seccions a la que pertenece
        $this->ConsultaClasificados_M->actualizarDT_SecPro($RecibeProducto);

        $this->Productos($RecibeProducto['ID_Suscriptor']);
    }
    
    // actualiza el nombre de una seccion
    public function insertarSecciones($ID_Suscriptor, $Seccion){
        // echo $ID_Suscriptor . '<br>';
        // echo '<pre>';
        // print_r($Seccion);
        // echo '</pre>';
        // exit();

        $this->ConsultaClasificados_M->insertaSeccion($ID_Suscriptor, $Seccion);
    }

    // muestra formulario para actualizar un producto especifico
    public function actualizarProducto($ID_Producto){
        
        //CONSULTA las especiicaciones de un producto determinado
        $Especificaciones = $this->ConsultaClasificados_M->consultarDescripcionProducto($ID_Producto);

        //CONSULTAN la imagen principal del producto
        $ImagenPrin = $this->ConsultaClasificados_M->consultarImagenPrincipal($ID_Producto);
        
        //CONSULTAN las imagenes secundarias del producto
        $ImagenSec = $this->ConsultaClasificados_M->consultarImagenSecundaria($ID_Producto);
        
        //CONSULTAN la seccion donde esta un producto
        $Seccion = $this->ConsultaClasificados_M->consultarSeccion($ID_Producto);

        //CONSULTA todas las secciones de un suscriptor
        $Secciones = $this->ConsultaClasificados_M->consultarSeccionesSuscriptor($_SESSION["ID_Suscriptor"]);
                    
        //Solicita el precio del dolar al controlador 
        require(RUTA_APP . '/controladores/Divisas_C.php');
        $this->PrecioDolar = new Divisas_C();
        
        // VERIFICAR QUE SE TRAE LOS DATOS DE ACCESO A LA BD
        // echo '<pre>';
        // print_r($this->PrecioDolar);
        // echo '</pre>';

        // Se consulta el precio del dolar
        $PrecioDolarHoy = $this->PrecioDolar->Dolar;

        //se consultan la informacion del suscriptor
        // $Suscriptor = $this->InformacionSuscriptor->index($_SESSION['ID_Suscriptor']);

        $Datos = [
            'ID_Suscriptor' => $_SESSION['ID_Suscriptor'],
            'especificaciones' => $Especificaciones, //ID_Producto, ID_Opcion, producto, opcion, precioBolivar, precioDolar, cantidad, disponible
            'imagenPrin' => $ImagenPrin, //ID_Imagen, nombre_img
            'imagenSec' => $ImagenSec,
            'dolarHoy' => $PrecioDolarHoy,
            'seccion' => $Seccion,
            'secciones' => $Secciones,      
            // 'nombre' => $Suscriptor['nombreSuscriptor'],
            // 'apellido' => $Suscriptor['apellidoSuscriptor'],
            // 'Pseudonimmo' => $Suscriptor['pseudonimoSuscripto'],
            // 'telefono' => $Suscriptor['telefonoSuscriptor']
        ];

        // echo '<pre>';
        // print_r($Datos);
        // echo '</pre>';
        // exit();

        $this->vista('header/header_suscriptor'); 
        $this->vista('suscriptores/suscrip_editar_prod_V', $Datos);
    }     
    
    // actualiza en nombre de una seccion
    public function actualizarSeccion($DatosAgrupados){
        //$DatosAgrupados contiene una cadena con el ID_Seccion y la sección separados por coma, se convierte en array para separar los elementos
        // echo $DatosAgrupados;
        // exit();

        $DatosAgrupados = explode(',', $DatosAgrupados);

        $Seccion = $DatosAgrupados[0];
        $ID_Seccion = $DatosAgrupados[1];
        
        // echo $ID_Seccion;
        // echo $Seccion;
        // exit;

        $this->ConsultaClasificados_M->actualizarSeccion($ID_Seccion, $Seccion);
    }

    public function eliminarProducto($DatosAgrupados){
        //$DatosAgrupados contiene una cadena con el ID_Opcion, ID_Producto y la sección separados por coma, se convierte en array para separar los elementos
        // echo $DatosAgrupados;
        // exit();

        $DatosAgrupados = explode('-', $DatosAgrupados);

        $ID_Producto = $DatosAgrupados[0];
        $ID_Opcion = $DatosAgrupados[1];

        // *************************************************************************************
        //La siguientes cinco consultas entran en el procedimeinto para ELIMINAR un producto de una tienda, esto debe hacerse mediante transacciones
        // *************************************************************************************
        // *************************************************************************************

        //Se consulta el nombre de las imagenes del producto
        $ImagenesEliminar = $this->ConsultaClasificados_M->consultarImagenesEliminar($ID_Producto);
        // echo $_SESSION['ID_Suscriptor'] . '<br>';
        // echo '<pre>';
        // print_r($ImagenesEliminar);
        // echo '</pre>';
        // exit;
        
        //Se eliminan los archivo del servidor, ubicados en la carpeta public/images/clasificados/productos
        foreach($ImagenesEliminar as $KeyImagenes)  :
            $NombreImagenEliminar = $KeyImagenes['nombre_img'];

            //Usar en remoto
            unlink($_SERVER['DOCUMENT_ROOT'] . '/public/images/clasificados/'. $_SESSION['ID_Suscriptor'] . '/productos/' . $NombreImagenEliminar);
                
            //usar en local
            // unlink($_SERVER['DOCUMENT_ROOT'] . '/proyectos/noticieroyaracuy/public/images/clasificados/'. $_SESSION['ID_Suscriptor'] . '/productos/' . $NombreImagenEliminar);
        endforeach;
        
        $this->ConsultaClasificados_M->eliminarProductoOpcion($ID_Producto);
        $this->ConsultaClasificados_M->eliminarImagenesProducto($ID_Producto);
        $this->ConsultaClasificados_M->eliminarProducto($ID_Producto);
        $this->ConsultaClasificados_M->eliminarOpcion($ID_Opcion);
          
        // *************************************************************************************
        // *************************************************************************************

        $this->Productos($_SESSION['ID_Suscriptor']);
    }
    
    //Eliminar imagen secundaria especifica de un producto
    public function eliminar_imagenSecundariaProducto($ID_Imagen){
        
        //Se consulta el nombre de la imagen del producto
        $NombreImagenEliminar = $this->ConsultaClasificados_M->consultarImageneEspecificaEliminar($ID_Imagen);
        // echo '<pre>';
        // print_r($NombreImagenEliminar);
        // echo '</pre>';
        // exit;		

        //Usar en remoto
        unlink($_SERVER['DOCUMENT_ROOT'] . '/public/images/clasificados/'. $_SESSION['ID_Suscriptor'] . '/productos/' . $NombreImagenEliminar['nombre_img']);
            
        //usar en local
        // unlink($_SERVER['DOCUMENT_ROOT'] . '/proyectos/noticieroyaracuy/public/images/clasificados/'. $_SESSION['ID_Suscriptor'] . '/productos/' . $NombreImagenEliminar['nombre_img']);
        
        $this->ConsultaClasificados_M->eliminarImagenSecundariaNoticia($ID_Imagen);	

        // header("Location:" . RUTA_URL . "/Panel_C/");
        // die();
    }
    
    //Elimina todas las secciones de un catalogo especifico
    public function eliminarSecciones($ID_Suscriptor){

        $this->ConsultaClasificados_M->eliminarTodasSecciones($ID_Suscriptor);
    }
}

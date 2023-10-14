<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comerciante_M;

use App\Traits\Divisas;

use App\Traits\ServidorUse;
use App\Traits\Comprimir_Imagen;

class PanelMarketplaceController extends Controller
{
    use Divisas; //Traits
    use ServidorUse; //Traits
    use Comprimir_Imagen; //Traits

    private $ConsultaClasificados_M;
    private $Dolar;
    private $Comprimir;
    private $Servidor;

    public function __construct(){

        $this->Servidor = $this->conexionServidor(); // metodo en Traits ServidorUse

        // Solicita el precio del dolar al Trait Divisas
        $this->Dolar = $this->ValorDolar();
    }

    //Muestra todos los productos que tiene un comerciante especifico
    public function index($ID_Comerciante){

        //se consultan los anuncios clasificados de un suscriptor
        $ProductosSuscriptor = DB::connection('mysql_2')->table('productos')
            ->select('productos.ID_Producto','producto','opciones.ID_Opcion','opcion','opciones.precioBolivar','opciones.precioDolar','cantidad','nombre_img')
            ->join('productos_opciones', 'productos.ID_Producto','=','productos_opciones.ID_Producto')
            ->join('opciones', 'productos_opciones.ID_Opcion','=','opciones.ID_Opcion')
            ->join('imagenes', 'productos.ID_Producto','=','imagenes.ID_Producto')
            ->where("ID_Comerciante",'=', $ID_Comerciante)
            ->where("fotoPrincipal",'=', 1)
            ->orderBy('productos.ID_Producto', 'desc')
            ->get();
            // return $ProductosSuscriptor;

        return view('panel/comerciantes/comerciante_Inicio_V', [
            'productos' => $ProductosSuscriptor
        ]);
    }

    //Da la cantidad de anuncios clasificados que tiene un suscriptor especifico
    public function clasificadoSuscriptor($ID_Suscriptor){

        //se consultan los anuncios clasificados de un suscriptor
        $ProductosSuscriptor = DB::connection('mysql_2')->table('productos')
            ->selectRaw('COUNT("ID_Producto") AS Cantidad_Productos')
            ->where("ID_Suscriptor",'=', $ID_Suscriptor)
            ->first();
            return $ProductosSuscriptor;
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
    public function agregar($ID_Comerciante){

        //se consultan las secciones del catalogo del suscriptor
        $Secciones = DB::connection('mysql_2')->table('secciones')
            ->select('ID_Seccion', 'seccion')
            ->where('ID_Comerciante','=', $ID_Comerciante)
            ->get();
            // return $Secciones;

        return view('panel/comerciantes/comerciante_agregar_producto_V', [
            'dolarHoy' => $this->Dolar,
            'ID_Comerciante' => $ID_Comerciante,
            'secciones' => $Secciones
        ]);

        // $_SESSION['Publicar'] = 1906;
        //Se crea esta sesion para impedir que se recargue la información enviada por el formulario mandandolo varias veces a la base de datos
    }

    // Carga la vista de perfil del suscriptor
    public function perfil_comerciante($ID_Comerciante){

        // CONSULTA toda la información de perfil del Comerciante
        $Comerciante = Comerciante_M::
            all()
            ->where('ID_Comerciante','=', $ID_Comerciante)
            ->first();
            // return gettype($Comerciante);
            // return $Comerciante;

        // CONSULTA las secciones que tiene el catalogo de un comerciante
        $Secciones = DB::connection('mysql_2')
            ->select("select ID_Seccion, seccion FROM secciones WHERE ID_Comerciante = '$ID_Comerciante';");
            // return gettype($Comerciante);
            // return $Secciones;

        return view('panel/comerciantes/comerciante_perfil_V', [
            'comerciante' => $Comerciante,
            'secciones' => $Secciones
        ]);
    }

    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************

    // muestra formulario para actualizar un producto especifico
    public function actualizarProducto($ID_Producto){

        //CONSULTA las especiicaciones de un producto determinado
        $Especificaciones = DB::connection('mysql_2')->table('productos')
            ->select('productos.ID_Producto', 'opciones.ID_Opcion', 'producto','opcion','precioBolivar','precioDolar','cantidad','nuevo')
            ->join('productos_opciones', 'productos.ID_Producto','=','productos_opciones.ID_Producto')
            ->join('opciones', 'productos_opciones.ID_Opcion','=','opciones.ID_Opcion')
            ->where('productos.ID_Producto','=',$ID_Producto)
            ->first();
            // return $Especificaciones;

        //CONSULTAN la imagen principal del producto
        $ImagenPrin = DB::connection('mysql_2')->table('imagenes')
            ->select('ID_Imagen', 'nombre_img')
            ->where('ID_Producto','=',$ID_Producto)
            ->where('fotoPrincipal','=', 1)
            ->first();
            // return $ImagenPrin;

        //CONSULTAN las imagenes secundarias del producto
        $ImagenSec = DB::connection('mysql_2')->table('imagenes')
            ->select('ID_Imagen', 'nombre_img')
            ->where('ID_Producto','=', $ID_Producto)
            ->where('fotoPrincipal','=', 0)
            ->get();
            // return $ImagenSec;

        // CONSULTAN la seccion donde esta un producto
        $Seccion = DB::connection('mysql_2')->table('secciones')
            ->select('secciones.ID_Seccion','seccion')
            ->join('secciones_productos', 'secciones.ID_Seccion','=','secciones_productos.ID_Seccion')
            ->where('ID_Producto','=', $ID_Producto)
            ->first();
            // return $Seccion;

        // CONSULTA todas las secciones que tienen la tienda de un comerciante
        $Secciones = DB::connection('mysql_2')->table('secciones')
            ->select('ID_Seccion','seccion')
            ->where('ID_Comerciante','=', session('id_comerciante'))
            ->get();
            // return $Secciones;

        return view('panel/comerciantes/comerciante_editar_prod_V', [
            // 'ID_Suscriptor' => session('id_suscriptor'),
            'especificaciones' => $Especificaciones,
            'imagenPrin' => $ImagenPrin,
            'imagenSec' => $ImagenSec,
            'dolarHoy' => $this->Dolar,
            'seccion' => $Seccion,
            'secciones' => $Secciones,
            // 'suscriptor' => $Suscriptor
        ]);
    }

    // actualiza el nombre de una seccion
    public function actualizarSeccion($Seccion, $ID_Seccion ){

        //Se ACTUALIZA la tabla opciones en BD
        DB::connection('mysql_2')->table('secciones')
            ->where('ID_Seccion', $ID_Seccion)
            ->update(['seccion' => $Seccion]);
    }

    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************

    // actualiza el nombre de una seccion
    public function insertarSecciones($ID_Suscriptor, $Seccion){
        // echo $ID_Suscriptor . '<br>';
        // echo '<pre>';
        // print_r($Seccion);
        // echo '</pre>';
        // exit();

        $this->ConsultaClasificados_M->insertaSeccion($ID_Suscriptor, $Seccion);
    }

    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************

    //recibe el formulario para cargar un nuevo producto
    public function recibeProductoAgregar(Request $Request){
        // if($_SESSION['Publicar'] == 1906){// Anteriormente en el metodo "Publicar" se generó la esta sesion; con esto se evita que no se pueda recarga esta página.
            // unset($_SESSION['Publicar']);//se borra la sesión.

            //Se reciben todos los campos del formulario, desde cuenta_publicar_V.php se verifica que son enviados por POST y que no estan vacios
            //SECCION DATOS DEL PRODUCTO
            // if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['producto']) && !empty($_POST['descripcion']) && !empty($_POST['id_seccion'])  && !empty($_POST['precioBs']) && (!empty($_POST['precioDolar']) || $_POST['precioDolar'] == 0)){

                    // 'Descripcion' => preg_replace('[\n|\r|\n\r|\]','',$_POST, "descripcion", ), //evita los saltos de lineas realizados por el usuario al separar parrafos

            //Recibe datos del producto que se va a cargar al sistema
            $RecibeProducto = [
                'Condicion' => !empty($Request->get('grupo')) ? $Request->get('grupo') : 'NoAsignado',
                'Producto' => $Request->get('producto'),
                'Descripcion' => $Request->get('descripcion'),
                'PrecioBs' => $Request->get("precioBs"),
                'PrecioDolar' => $Request->get("precioDolar"),
                'Existencia' => empty($Request->get('existencia')) ? 0 : $Request->get('existencia'),
                'ID_Comerciante' => $Request->get("id_comerciante"),
                'ID_Seccion' => $Request->get("id_seccion")
            ];
            // return $RecibeProducto;
        // }
        // else{
        //     echo 'Llene todos los campos obligatorios' . '<br>';
        //     echo '<a href="javascript: history.go(-1)">Regresar</a>';
        //     exit();
        // }

            //********************************************************
            //Las siguientes consultas se deben realizar por medio de Transacciones BD

            //Se INSERTA en BD el producto y se retorna el ID recien insertado
            DB::connection('mysql_2')
                ->insert('insert into productos (ID_Comerciante, producto, nuevo) values (?,?,?)', [$RecibeProducto['ID_Comerciante'], $RecibeProducto['Producto'], $RecibeProducto['Condicion']]);

            $ID_Producto  = DB::connection('mysql_2')->table('productos')->latest('ID_Producto')->first()->ID_Producto;
            // return $UltimoId;

            //Se INSERTA en BD la opcion y precio del producto y se retorna el ID recien insertado
            DB::connection('mysql_2')
                ->insert('insert into opciones (opcion, precioBolivar, precioDolar, cantidad) values (?,?,?,?)', [$RecibeProducto['Descripcion'], $RecibeProducto['PrecioBs'], $RecibeProducto['PrecioDolar'], $RecibeProducto['Existencia']]);

                $ID_Opcion = DB::connection('mysql_2')->table('opciones')->latest('ID_Opcion')->first()->ID_Opcion;

            //Se INSERTA en BD la dependencia transitiva entre producto y opciones
            DB::connection('mysql_2')
            ->insert('insert into productos_opciones (ID_Producto, ID_Opcion) values (?,?)', [$ID_Producto, $ID_Opcion]);

            //Se INSERTA en BD la dependencia transitiva entre producto y secciones
            DB::connection('mysql_2')
            ->insert('insert into secciones_productos (ID_Producto, ID_Seccion) values (?,?)', [$ID_Producto, $RecibeProducto['ID_Seccion']]);

            //Se INSERTA en BD la dependencia transitiva entre producto yseccion
            // $this->ConsultaClasificados_M->insertarDT_ProSec($ID_Producto, $RecibeProducto);

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
                // // se muestra el directorio temporal donde se guarda el archivo
                // echo $_FILES['imagenProducto']['tmp_name'];
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
                        $CarpetaProductos = $_SERVER['DOCUMENT_ROOT'] . '/images/clasificados/' . session('id_comerciante') . '/productos';

                        // Usar en local
                        // $CarpetaProductos = $_SERVER['DOCUMENT_ROOT'] . 'images/clasificados/' . session('id_comerciante') . '/productos';

                        if(!file_exists($CarpetaProductos)){
                            mkdir($CarpetaProductos, 0777, true);
                        }

                        //Se INSERTA la imagen principal en BD
                        DB::connection('mysql_2')
                            ->insert('insert into imagenes (ID_Producto, nombre_img, tipoArchivo, tamanoArchivo, fotoPrincipal, fecha, hora) values (?,?,?,?,?, CURDATE(), CURTIME())', [$ID_Producto, $nombre_imgProducto, $tipo_imgProducto, $tamanio_imgProducto, 1]);

                        // INSSERTA IMAGEN PRINCIPAL DEL PRODUCTO EN SERVIDOR
                        // se comprime y se inserta el archivo en el directorio de servidor
                        $BanderaImg = 'ImagenProducto';
                        // metodo en Traits Comprimir_imagen
                        $this->imagen_comprimir($BanderaImg, $this->Servidor, $nombre_imgProducto, $tipo_imgProducto, $tamanio_imgProducto, $Temporal_imgProducto);
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
                    $Bandera = 'ImagenProducto';
                    $this->imagen_comprimir($Bandera, $this->Servidor, $Nombre_imagenSecundaria, $tipo_imagenSecundaria, $tamanio_imagenSecundaria, $Ruta_Temporal_imagenSecundaria);

                    //Se INSERTAN las fotografias secundarias del producto en BD
                    DB::connection('mysql_2')
                        ->insert('insert into imagenes (ID_Producto, nombre_img, tipoArchivo, tamanoArchivo, fotoPrincipal, fecha, hora) values (?,?,?,?,?, CURDATE(), CURTIME())', [$ID_Producto, $Nombre_imagenSecundaria, $tipo_imagenSecundaria, $tamanio_imagenSecundaria, 0]);
                }
            }
            // else{
            //     echo "ELSE";
            //     exit;
            // }

            return redirect()->route("PanelProducto", ['id_comerciante' => $RecibeProducto['ID_Comerciante']]);
            die();
        // }
        // else{
        // return redirect()->route("PanelProducto", ['id_comerciante' => $RecibeProducto['ID_Comerciante']]);
        // die();
        // }
    }

    //Invocado en carrito_V.php debe ir en marketplacecontroller
    public function recibePedido(Request $Request){
        //  if($_SESSION['Carrito'] == 1806){Anteriormente en Carrito_C se generó la variable $_SESSION["verfica_2"] con un valor de 1906; con esto se evita que no se pueda recarga esta página.
                // unset($_SESSION['Carrito']);//se borra la sesión verifica.

            // if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nombreUsuario']) && !empty($_POST['apellidoUsuario']) && !empty($_POST['cedulaUsuario']) && !empty($_POST['telefonoUsuario']) && !empty($_POST['direccionUsuario']) && !empty($_POST['pedido'])){

            // DATOS DEL USUARIO
            $RecibeProducto = [
                'ID_Usuario' => !empty($Request->get('ID_Usuario')) ? 0 : $Request->get('ID_Usuario'),
                'Nombre' => $Request->get('nombreUsuario'),
                'Apellido' => $Request->get('apellidoUsuario'),
                'Cedula' => $Request->get("cedulaUsuario"),
                'Telefono' => $Request->get("telefonoUsuario"),
                'Correo' => $Request->get('correoUsuario'),
                'Estado' => $Request->get("estado"),
                'Ciudad' => $Request->get("ciudad"),
                'Direccion' => $Request->get("direccionUsuario"),
                'Suscribir' => $Request->get("suscrito"),
                'MontoTotal' => $Request->get("montoTotal"),
                'MontoTienda' => $Request->get("montoTienda")
            ];
            return $RecibeProducto;

            //Se solicita la hora de la compra
            date_default_timezone_set('America/Caracas');
            $Hora = date('H:i');

            // DATOS DEL PEDIDO
            $RecibeDatosPedido = [
                'ID_Tienda' => $Request->get("id_tienda"),
                'FormaPago' => $Request->get("formaPago"),
                'Despacho' => $Request->get("entrega"),
                'MontoEntrega' => $Request->get("despacho"),
                'CodigoTransferencia' => $Request->get("codigoTransferencia"),
                'Hora' => $Hora
            ];
            return $RecibeDatosPedido;

            // $RecibeDatos = [
            //         'Nombre' => ucwords($_POST['nombre']),
            //         'Apellido' => mb_strtolower($_POST['apellido']),
            //         'Cedula' => is_numeric($_POST['cedula']) ? $_POST['cedula']: false,
            //         'Telefono' => is_numeric($_POST['telefono']) ? $_POST['telefono']: false,
            //         'Direccion' => $_POST['direccion'],
            //         'Pedido' => $_POST['pedido'],
            // ];

            // //Despues de evaluar con is_numeric se da un aviso en caso de fallo
            // if($RecibeDatos['Telefono'] == false){
            //     echo 'El telefono debe ser solo números' . '<br>';
            //     echo "<a href='javascript: history.go(-1)'>Regresar</a>";
            // }
            // //Despues de evaluar con is_numeric se da un aviso en caso de fallo
            // if($RecibeDatos['Cedula'] == false){
            //     echo 'La cedula debe ser solo números' . '<br>';
            //     echo "<a href='javascript: history.go(-1)'>Regresar</a>";
            // }

            //Se genera un número Ale_NroOrden que sera el numero de orden del pedido
            $Ale_NroOrden = mt_rand(1000000,999999999);

            // El pedido como es un string en formato json se recibe sin filtrar o sanear desde vitrina.js PedidoEnCarrito() para que el metodo jsodecode lo pueda reconocer y convertir en un array.
            $RecibeDirecto = $_POST['pedido'];

            $Resultado = json_decode($RecibeDirecto, true);

            // echo '<pre>';
            // print_r($Resultado);
            // echo '</pre>';
            // exit();

            //Se reciben los detalles del pedido
            if(is_array($Resultado) || is_object($Resultado)){
                foreach($Resultado as $Key => $Value)   :
                    $Seccion = 'N_P';
                    $Producto = $Value['Producto'];
                    $Cantidad = $Value['Cantidad'];
                    $Opcion = $Value['Opcion'];
                    $Precio = $Value['Precio'];
                    $Total = $Value['Total'];
                    $ID_Opcion = $Value['ID_Opcion'];

                    //Se INSERTAN los detalles del pedido en la BD
                    $this->ConsultaRecibePedido_M->insertarDetallePedido($RecibeDatosUsuario['ID_Usuario'], $Ale_NroOrden, $Seccion, $Producto, $Cantidad, $Opcion, $Precio, $Total);

                    // Se ACTUALIZA el inventario de los productos pedidos
                    //Se consulta la cantidad de existencia del producto
                    $Existencia = $this->ConsultaRecibePedido_M->consultarExistencia($ID_Opcion);

                    foreach($Existencia as $Key) :
                        $Key['cantidad'];
                    endforeach;

                    //Se resta lo que el usuario pidio y el resultado se introduce en BD
                    $Inventario = $Key['cantidad'] - $Cantidad;

                    $this->ConsultaRecibePedido_M->UpdateInventario($ID_Opcion, $Inventario);
                endforeach;
            }
            else{
                echo 'Error en la entrega de los detalles del pedido';
                echo '<br>';
            }
        // }
        // else{
        //     echo 'Llene todos los campos del formulario de registro' . '<br>';
        //     echo "<a href='javascript: history.go(-1)'>Regresar</a>";
        //     exit();
        // }

        //MONTO POR DELIVERY
        // *****************************************
        //Si hay despacho se calcula el monto del envio (Por ahora es fijo en 3000 Bs)
        if($RecibeDatosPedido['Despacho'] == 'Domicilio_Si'){
            $Delivery = $RecibeDatosPedido['MontoEntrega'];
        }
        else{
            $Delivery = '0';
        }

        // Sino se recibe el codigo de transferencia se da un valor por defecto
        // *****************************************
        if(empty($RecibeDatosPedido['CodigoTransferencia'])){
            // $CodigoTransferencia = $RecibeDatosPedido['formaPago'];
            $CodigoTransferencia = 'No aplica';
        }
        else{
            $CodigoTransferencia = $RecibeDatosPedido['CodigoTransferencia'];
        }

        //Se INSERTAN los datos del comprador en la BD si el usuario acepta
        if($RecibeDatosUsuario['Suscribir'] == 'Suscribir'){
            //Se consulta si el usuario ya existe en la BD
            $UsuarioPedido = $this->ConsultaRecibePedido_M->consultarUsuario($RecibeDatosUsuario['Cedula']);
            if($UsuarioPedido == Array()){
                $Suscrito = 1;
                $this->ConsultaRecibePedido_M->insertarUsuario($RecibeDatosUsuario, $Suscrito);
            }
        }
        else{
            //Se insertan pero no se recuerdan porque e usuario no aceptó guardar datos
            $Suscrito = 0;
            $this->ConsultaRecibePedido_M->insertarUsuario($RecibeDatosUsuario, $Suscrito);
        }

        //Se INSERTAN los datos generales del pedido en la BD
        $this->ConsultaRecibePedido_M->insertarPedido($RecibeDatosUsuario, $CodigoTransferencia, $RecibeDatosPedido, $Ale_NroOrden, $Delivery, $Hora);

        //Se recibe y se inserta el capture de transferencia
        if($_FILES['imagenTransferencia']['name'] == ''){
            // $CodigoTransferencia = $RecibeDatosPedido['formaPago'];
            $archivonombre = 'imagen_2.png';
            $this->ConsultaRecibePedido_M->UpdateCapturePago($Ale_NroOrden, $archivonombre);
        }
        else{
            $archivonombre = $_FILES['imagenTransferencia']['name'];
            $Ruta_Temporal = $_FILES['imagenTransferencia']['tmp_name'];

            //Usar en remoto
            $directorio = $_SERVER['DOCUMENT_ROOT'] . '/public/images/capture/';

            //Subimos el fichero al servidor
            move_uploaded_file($Ruta_Temporal, $directorio.$archivonombre);

            //Se INSERTA el capture del pago por medio de un UPDATE debido a que ya existe un registro con el pedido en curso
            $this->ConsultaRecibePedido_M->UpdateCapturePago($Ale_NroOrden, $archivonombre);
        }

        //RECIBE CAPTURE PAGOMOVIL
        if($_FILES['imagenPagoMovil']['name'] != '' && $RecibeDatosPedido['FormaPago'] == 'PagoMovil'){
            $archivonombre = $_FILES['imagenPagoMovil']['name'];
            $Ruta_Temporal = $_FILES['imagenPagoMovil']['tmp_name'];

            //Usar en remoto
            $directorio = $_SERVER['DOCUMENT_ROOT'] . '/public/images/capture/';

            //Subimos el fichero al servidor
            move_uploaded_file($Ruta_Temporal, $directorio.$archivonombre);

            //Se INSERTA el capture del pago por medio de un UPDATE debido a que ya existe un registro con el pedido en curso
            $this->ConsultaRecibePedido_M->UpdateCapturePago($Ale_NroOrden, $archivonombre);
        }
        // else{
        //     echo 'No se recibio capture de PagoMovil';
        //     exit;
        // }

        //RECIBE CAPTURE PAYPAL
        if($_FILES['imagenPagoPaypal']['name'] != '' && $RecibeDatosPedido['FormaPago'] == 'Paypal'){
            $archivonombre = $_FILES['imagenPagoPaypal']['name'];
            $Ruta_Temporal = $_FILES['imagenPagoPaypal']['tmp_name'];

            //Usar en remoto
            $directorio = $_SERVER['DOCUMENT_ROOT'] . '/public/images/capture/';

            //Subimos el fichero al servidor
            move_uploaded_file($Ruta_Temporal, $directorio.$archivonombre);

            //Se INSERTA el capture del pago por medio de un UPDATE debido a que ya existe un registro con el pedido en curso
            $this->ConsultaRecibePedido_M->UpdateCapturePago($Ale_NroOrden, $archivonombre);
        }
        // else{
        //     echo 'No se recibio capture de pago en Paypal';
        //     exit;
        // }

        // ****************************************
        //DATOS ENVIADOS POR CORREOS
        //Se CONSULTA el pedido recien ingresado a la BD
        $Pedido = $this->ConsultaRecibePedido_M->consultarPedido($Ale_NroOrden);

        //Se CONSULTA el usuario que realizó el pedido
        $Usuario = $this->ConsultaRecibePedido_M->consultarUsuario($RecibeDatosUsuario['Cedula']);

        //Se CONSULTA el correo y el nombre de la tienda
        $Tienda = $this->ConsultaRecibePedido_M->consultarCorreo($RecibeDatosPedido['ID_Tienda']);

        // Se genera el código de despacho que será solicitado por el despachador
        $Ale_CodigoDespacho = mt_rand(0001,9999);

        $DatosCorreo = [
            'informacion_pedido' => $Pedido,
            'informacion_usuario' => $Usuario,
            'informacion_tienda' => $Tienda,
            'Codigo_despacho' => $Ale_CodigoDespacho
        ];

        // echo '<pre>';
        // print_r($DatosCorreo);
        // echo '</pre>';
        // exit;

        $Datos = [
            'Codigo_despacho' => $Ale_CodigoDespacho
        ];

        // CORREOS
        // ****************************************

        //Carga la vista "recibo de compra" dirigida al usuario ubicada en app/clases/controlador.php
        $this->correo('reciboCompra_mail', $DatosCorreo);

        //Carga la vista de correo "orden de compra" dirigida al cliente y al marketplace
        $this->correo('ordenCompra_mail', $DatosCorreo);

        $this->vista('header/header');
        $this->vista('view/RecibePedido_V', $Datos);
    // }
    // else{
    //     // header('location:' . RUTA_URL . '/Inicio_C/NoVerificaLink');
    // }
    }

    //recibe el formulario de perfil para actualizarlo
    public function recibePerfilComerciante(Request $Request){
        //Se reciben el campo del formulario, se verifica que son enviados por POST y que no estan vacios
        // if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nombreSuscriptor']) && !empty($_POST['apellidoSuscriptor']) && !empty($_POST['correoSuscriptor']) && !empty($_POST['municipio']) && !empty($_POST['parroquia']) && !empty($_POST['telefono']) && !empty($_POST['pseudonimo']) && (!empty($_POST['transferencia']) || !empty($_POST['pago_movil']) || !empty($_POST['paypal']) || !empty($_POST['zelle']) || !empty($_POST['bolivar']) || !empty($_POST['dolar']) || !empty($_POST['acordado']))){
            $RecibeDatosComerciante = [
                'nombreComerciante' =>  $Request->get("nombreComerciante"),
                'apellidoComerciante' =>  $Request->get('apellidoComerciante'),
                'correoComerciante' =>  $Request->get('correoComerciante'),
                'pseudonimoComerciante' =>  $Request->get('pseudonimoComerciante'),
                'municipioComerciante' =>  $Request->get("municipioComerciante"),
                'parroquiaComerciante' =>  $Request->get("parroquiaComerciante"),
                'telefonoComerciante' =>  $Request->get("telefonoComerciante"),
                'transferencia' =>  empty($Request->get("transferencia")) ? 0 : 1,
                'pago_movil' =>  empty($Request->get("pago_movil")) ? 0 : 1,
                'paypal' =>  empty($Request->get("paypal")) ? 0 : 1,
                'criptomoneda' =>  empty($Request->get("criptomoneda")) ? 0 : 1,
                'acordado' =>  empty($Request->get("acordado")) ? 0 : 1,
                'categoriaComerciante' => $Request->get("categoriaComerciante")
            ];
            // return $RecibeDatosComerciante;

            //Se actualizan datos del comerciante
            $ActualizarComerciante = Comerciante_M::
                find(session('id_comerciante'));
                $ActualizarComerciante->nombreComerciante = $RecibeDatosComerciante['nombreComerciante'];
                $ActualizarComerciante->apellidoComerciante = $RecibeDatosComerciante['apellidoComerciante'];
                $ActualizarComerciante->correoComerciante = $RecibeDatosComerciante['correoComerciante'];
                $ActualizarComerciante->pseudonimoComerciante = $RecibeDatosComerciante['pseudonimoComerciante'];
                $ActualizarComerciante->municipioComerciante = $RecibeDatosComerciante['municipioComerciante'];
                $ActualizarComerciante->parroquiaComerciante = $RecibeDatosComerciante['parroquiaComerciante'];
                $ActualizarComerciante->telefonoComerciante = $RecibeDatosComerciante['telefonoComerciante'];
                $ActualizarComerciante->transferenciaComerciante = $RecibeDatosComerciante['transferencia'];
                $ActualizarComerciante->pago_movilComerciante = $RecibeDatosComerciante['pago_movil'];
                $ActualizarComerciante->paypalComerciante = $RecibeDatosComerciante['paypal'];
                $ActualizarComerciante->criptomonedaComerciante = $RecibeDatosComerciante['criptomoneda'];
                $ActualizarComerciante->acordadoComerciante = $RecibeDatosComerciante['acordado'];
                $ActualizarComerciante->categoriaComerciante = $RecibeDatosComerciante['categoriaComerciante'];
                $ActualizarComerciante->save();

            //RECIBE SECCIONES
            // ********************************************************
            //Recibe las secciones por nombre (son las nuevas creadas)
            // dd($Request->get('seccion'));
            if($Request->get('seccion') != Array ()){
                foreach($Request->get('seccion') as $Seccion){
                    $SeccionesRecibidas = $Request->get('seccion');
                }

                //El array trae elemenos duplicados, se eliminan los duplicado                
                $SeccionesRecibidas = array_unique($SeccionesRecibidas);
                // echo '<pre>'; 
                // print_r($SeccionesRecibidas);
                // echo '</pre>';

                //Se consultan las secciones existentes en BD de la tienda del comerciante
                $ID_Comerciante = session('id_comerciante');
                $SeccionesExistentes = DB::connection('mysql_2')
                    ->select("select seccion from secciones where ID_Comerciante = '$ID_Comerciante'; ");
                    
                // echo '<pre>'; 
                // print_r($SeccionesExistentes);
                // echo '</pre>';

                $SoloExistentes = [];                
                $Cantidad = count($SeccionesExistentes);
                for($i = 0; $i < $Cantidad; $i++)   : 
                    array_push($SoloExistentes, $SeccionesExistentes[$i]->seccion);
                endfor;
                
                // return gettype($SoloExistentes);
                // echo '<pre>'; 
                // print_r($SoloExistentes);
                // echo '</pre>';

                // Se devuelven todas las entradas que no están presentes en ninguna de los otros arrays.
                $SeccionesInsertar = array_diff($SeccionesRecibidas, $SoloExistentes);
                // return gettype($SeccionesInsertar);
                // return $SeccionesInsertar;
                // return count($SeccionesInsertar);
                
                $SeccionesInsertar = implode(',', $SeccionesInsertar);
                // echo '<pre>'; 
                // print_r($SeccionesInsertar);
                // echo '</pre>';
                // echo gettype($SeccionesInsertar);
                
                $SeccionesInsertar = explode(',', $SeccionesInsertar);
                // echo '<pre>'; 
                // print_r($SeccionesInsertar);
                // echo '</pre>';
                $Elementos = count($SeccionesInsertar);
                // echo $Elementos;
             

                // Se INSERTAN las nuevas secciones al catalogo   
                for($i = 0; $i < $Elementos; $i++)  :                 
                    DB::connection('mysql_2')
                    ->insert("insert into secciones (ID_Comerciante, seccion) values (?,?)", [session('id_comerciante'), $SeccionesInsertar[$i]]);
                endfor;

                // Se crea la sesion con el nombre de la tienda
                // $_SESSION["PseudonimoSuscriptor"] = $_POST['pseudonimo'];
            }
            else{
                echo 'Ingrese al menos una sección';
                echo '<br>';
                echo "<a href='javascript:history.back()'>Regresar</a>";
                exit();
            }

            //RECIBE IMAGEN CATALOGO
            // ********************************************************
            // Si se selecionó alguna nueva imagen
            if($_FILES['imagenCatalogo']["name"] != ''){
                $nombre_imgCatalogo = $_FILES['imagenCatalogo']['name'];
                $tipo_imgCatalogo = $_FILES['imagenCatalogo']['type'];
                $tamanio_imgCatalogo = $_FILES['imagenCatalogo']['size'];
                $Temporal_imgCatalogo = $_FILES['imagenCatalogo']['tmp_name'];

                // echo "Nombre de la imagen = " . $nombre_imgCatalogo . "<br>";
                // echo "Tipo de archivo = " . $tipo_imgCatalogo .  "<br>";
                // echo "Tamaño = " . $tamanio_imgCatalogo . "<br>";
                //se muestra el directorio temporal donde se guarda el archivo
                // echo $Temporal_imgCatalogo;
                // exit;

                //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
                $nombre_imgCatalogo = preg_replace('([^A-Za-z0-9.])', '', $nombre_imgCatalogo);

                // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
                $nombre_imgCatalogo = mt_rand() . '_' . $nombre_imgCatalogo;

                //Se crea el directorio donde ira la imagen del catalogo
                $CarpetaCatalogo = $_SERVER['DOCUMENT_ROOT'] . '/public/images/clasificados/' . session('id_comerciante') . '/';

                if(!file_exists($CarpetaCatalogo)){
                    mkdir($CarpetaCatalogo, 0777, true);
                }

                // ACTUALIZA IMAGEN DE CATALOGO
                // se comprime y se inserta el archivo en el directorio de servidor
                $BanderaImgCat = 'ImagenCatalogo';
                // metodo en Traits Comprimir_imagen
                $this->imagen_comprimir($BanderaImgCat, $this->Servidor, $nombre_imgCatalogo, $tipo_imgCatalogo, $tamanio_imgCatalogo, $Temporal_imgCatalogo);	

                //Se actualiza imagen de catalogo en BD
                $ActualizarImgCatalogo = Comerciante_M::
                    find(session('id_comerciante'));
                    $ActualizarImgCatalogo->nombreImgCatalogo = $nombre_imgCatalogo;
                    $ActualizarImgCatalogo->tipoImgCatalogo = $tipo_imgCatalogo;
                    $ActualizarImgCatalogo->tamanioImgCatalogo = $tamanio_imgCatalogo;
                    $ActualizarImgCatalogo->save();
                    // return $ActualizarImgCatalogo;
            }

        // }
        // else{
        //     echo 'Llene todos los campos obligatorios' . '<br>';
        //     echo '<a href="javascript: history.go(-1)">Regresar</a>';
        //     exit();
        // }

        return redirect()->route("perfil_comerciante", ['id_comerciante' => session('id_comerciante')]);
        die();
    }

    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************

    //recibe formulario que actualiza la información de un producto
    public function recibeAtualizarProducto(Request $Request){
        //Se reciben todos los campos del formulario, se verifica que son enviados por POST y que no estan vacios
        // if($_SERVER['REQUEST_METHOD'] == 'POST'&& !empty($_POST['producto']) && !empty($_POST['descripcion']) && !empty($_POST['precioBolivar']) && (!empty($_POST['precioDolar']) || $_POST['precioDolar'] == 0)){

            //Recibe datos del producto a actualizar
            $RecibeProducto = [
                'condicion' => !empty($Request->get('grupo')) ? $Request->get('grupo') : 'NoAsignado',
                'ID_Producto' => $Request->get('id_producto'),
                'ID_Opcion' => $Request->get('id_opcion'),
                'Producto' => $Request->get('producto'),
                'Descripcion' => $Request->get('descripcion'),
                'PrecioBs' => $Request->get("precioBolivar"),
                'PrecioDolar' => $Request->get("precioDolar"),
                'Existencia' => $Request->get('existencia'),
                'ID_Comerciante' => $Request->get("id_comerciante"),
                'ID_Seccion' => $Request->get("id_seccion")
            ];
            // return $RecibeProducto;
        // }
        // else{
        //     echo 'Llene todos los campos obligatorios' . '<br>';
        //     echo '<a href="javascript: history.go(-1)">Regresar</a>';
        //     exit();
        // }

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

            //Se ACTUALIZA la fotografia principal del producto en BD
            DB::connection('mysql_2')->table('imagenes')
                ->where('ID_Producto', $RecibeProducto['ID_Producto'])
                ->where('fotoPrincipal','=', 1)
                ->update(['nombre_img' => $nombre_imgProductoActualizar,'tipoArchivo' => $tipo_imgProductoActualizar,'tamanoArchivo' => $tamanio_imgProductoActualizar]);

            // ACTUALIZA IMAGEN PRINCIPAL DE NOTICIA EN SERVIDOR
            // se comprime y se inserta el archivo en el directorio de servidor
            $Bandera = 'ImagenProducto';
            // metodo en Traits Comprimir_imagen
            $this->imagen_comprimir($Bandera, $this->Servidor, $nombre_imgProductoActualizar, $tipo_imgProductoActualizar, $tamanio_imgProductoActualizar, $Temporal_imgProductoActualizar);
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
                $Bandera = 'ImagenProducto';
                // metodo en Traits Comprimir_imagen
                $this->imagen_comprimir($Bandera, $this->Servidor, $Nombre_imagenSecundaria, $tipo_imagenSecundaria, $tipo_imagenSecundaria, $Ruta_Temporal_imagenSecundaria);

                //Se INSERTAN las fotografias secundarias del producto en BD
                DB::connection('mysql_2')
                    ->insert('insert into imagenes (ID_Producto, nombre_img, tipoArchivo, tamanoArchivo, fotoPrincipal, fecha, hora) values (?,?,?,?,?, CURDATE(), CURTIME())', [$RecibeProducto['ID_Producto'], $Nombre_imagenSecundaria, $tipo_imagenSecundaria, $tamanio_imagenSecundaria, 0]);
            }
        }

        // ********************************************************
        //Estas sentencias de actualización deben realizarce por medio de transsacciones

        //Se ACTUALIZA la tabla opciones en BD
        DB::connection('mysql_2')->table('opciones')
            ->where('ID_Opcion', $RecibeProducto['ID_Opcion'])
            ->update(['opcion' => $RecibeProducto['Descripcion'], 'precioBolivar' => $RecibeProducto['PrecioBs'], 'precioDolar' => $RecibeProducto['PrecioDolar'], 'cantidad' => $RecibeProducto['Existencia']]);

        //Se ACTUALIZA la tabla productos en BD
        DB::connection('mysql_2')->table('productos')
            ->where('ID_Producto', $RecibeProducto['ID_Producto'])
            ->update(['producto' => $RecibeProducto['Producto']]);  

        // Se ACTUALIZA la dependencia transitiva entre el producto y la seccions a la que pertenece
        DB::connection('mysql_2')->table('secciones_productos')
            ->where('ID_Producto', $RecibeProducto['ID_Producto'])
            ->update(['ID_Seccion' => $RecibeProducto['ID_Seccion']]);  

        return redirect()->route("PanelProducto", ['id_comerciante' => $RecibeProducto['ID_Comerciante']]);
        die();
    }

    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************
    // **************************************************************************************************************

    public function eliminarProducto($ID_Producto, $ID_Opcion){

        // *************************************************************************************
        //La siguientes cinco consultas entran en el procedimeinto para ELIMINAR un producto de una tienda, esto debe hacerse mediante transacciones
        // *************************************************************************************

        //Se consulta el nombre de las imagenes del producto
        $ImagenesEliminar = DB::connection('mysql_2')->table('imagenes')
            ->select('nombre_img')
            ->where('ID_Producto','=', $ID_Producto)
            ->get();
            // return $ImagenesEliminar;

        //Se eliminan las imagenes del directorio del servidor
        foreach($ImagenesEliminar as $Key)	:

            $Ruta = file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/clasificados/' . session('id_comerciante') . '/productos/' . $Key->nombre_img);

            if($Ruta){
                unlink($_SERVER['DOCUMENT_ROOT'] . '/images/clasificados/' . session('id_comerciante') . '/productos/' . $Key->nombre_img);
            }
        endforeach;

        // ELIMINA relacion de dependencia transitiva productos_opciones en BD
        $EliminaOpciones = DB::connection('mysql_2')->table('productos_opciones')
            ->where('ID_Producto','=', $ID_Producto)
            ->delete();
            // return $EliminaOpciones;

        // ELIMINA imagenes de producto en BD
        $EliminaImagenes = DB::connection('mysql_2')->table('imagenes')
            ->where('ID_Producto','=', $ID_Producto)
            ->delete();
            // return $EliminaImagenes;

        // ELIMINA descripcion de producto en BD
        $EliminaProducto = DB::connection('mysql_2')->table('productos')
            ->where('ID_Producto','=', $ID_Producto)
            ->delete();
            // return $EliminaProducto;

        // ELIMINA opciones de producto en BD
        $EliminaOpciones = DB::connection('mysql_2')->table('opciones')
        ->where('ID_Opcion','=', $ID_Opcion)
        ->delete();
        // return $EliminaOpciones;


        // *************************************************************************************
        // *************************************************************************************

        return redirect()->route("PanelProducto", ['id_comerciante' => session('id_comerciante')]);
        die();
    }

    //Eliminar imagen secundaria especifica de un producto
    public function eliminar_imagenSecundariaProducto($ID_Imagen){

        //Se consulta el nombre de la imagen del producto para eliminarl del directorio
        $nombre_imagenProducto = DB::connection('mysql_2')->table('imagenes')
            ->select('nombre_img')
            ->where('ID_Imagen','=', $ID_Imagen)
            ->first();
            // return $nombre_imagenProducto;

        $Ruta = file_exists($_SERVER['DOCUMENT_ROOT'] . '/images/clasificados/'. session('id_comerciante') . '/productos/' . $nombre_imagenProducto->nombre_img);

        if($Ruta){
            unlink($_SERVER['DOCUMENT_ROOT'] . '/images/clasificados/'. session('id_comerciante') . '/productos/' . $nombre_imagenProducto->nombre_img);
        }

        // Se elimina la imagen de la BD
        $EliminaImagen = DB::connection('mysql_2')->table('imagenes')
            ->where('ID_Imagen','=', $ID_Imagen)
            ->delete();
            //return $EliminaImagen;
    }

    //Elimina las secciones de un catalogo especifico
    public function eliminarSeccion($ID_Seccion){
        DB::connection('mysql_2')
        ->delete("delete from secciones where ID_Seccion = '$ID_Seccion';");
    }
}
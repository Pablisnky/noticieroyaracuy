<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\reciboCompra_mail;

use App\Models\Comerciante_M; 

use App\Traits\Divisas; 
use App\Traits\ServidorUse;
use App\Traits\Comprimir_Imagen;

use App\Http\Controllers\SuscriptorController;

class MarketplaceController extends Controller
{
    use Divisas; //Traits
    use ServidorUse; //Traits
    use Comprimir_Imagen; //Traits
    
    private $Dolar;
    private $Comprimir;
    private $Servidor;
    private $Instancia_SuscriptorController;
    
    public function __construct(){

        $this->Instancia_SuscriptorController = new SuscriptorController();
        
        //Solicita el precio del dolar al Trait Divisas
        $this->Dolar = $this->ValorDolar();
        
        $this->Servidor = $this->conexionServidor(); // metodo en Traits ServidorUse
    }
        
    // Muestra la vista con todos los productos publicados, los muestra de manera aleatoria
    public function index(){  
        // Consulta todos los productos publicados  
        $Productos = DB::connection('mysql_2')->table('productos') 
            ->select('productos.ID_Producto','ID_Comerciante','opciones.ID_Opcion','producto','nombre_img','opcion', 'precioBolivar','precioDolar','cantidad','nuevo')
            ->join('imagenes', 'productos.ID_Producto','=','imagenes.ID_Producto') 
            ->join('productos_opciones', 'productos.ID_Producto','=','productos_opciones.ID_Producto')
            ->join('opciones', 'productos_opciones.ID_Opcion','=','opciones.ID_Opcion')  
            ->where('fotoPrincipal', '=', '1')
            ->inRandomOrder()
            ->get(); 
            // return $Productos; 
            
            // Consulta datos de los comerciante  
            $Suscriptores = DB::connection('mysql_2')
                ->select(
                    "SELECT ID_Comerciante, parroquiaComerciante, pseudonimoComerciante 
                    FROM comerciantes ");
            // return gettype($Suscriptores);
            // return $Suscriptores;
        
            return view('marketplace.clasificados_V', [
                'productos' => $Productos, 
                'dolar' => $this->Dolar, 
                'comerciante' => $Suscriptores
                ]
            ); 
    } 
    
    // muestra la vista de un producto y sus detalles
    public function productoAmpliado($ID_Producto, $Bandera){
                   
        //CONSULTA la informacion del producto seleccionado
        $Producto = DB::connection('mysql_2')->table('productos') 
            ->select('productos.ID_Producto','ID_Comerciante','producto','nuevo','opcion','precioBolivar','precioDolar','cantidad')
            ->join('productos_opciones', 'productos.ID_Producto','=','productos_opciones.ID_Producto')
            ->join('opciones', 'productos_opciones.ID_Opcion','=','opciones.ID_Opcion')  
            ->where('productos.ID_Producto', '=', $ID_Producto)
            ->first(); 
            // return $Producto; 
                    
        // CONSULTA la imagenen principal del producto seleccionado
        $Imagen = DB::connection('mysql_2')->table('imagenes') 
            ->select('nombre_img') 
            ->where('ID_Producto', '=', $ID_Producto)
            ->where('fotoPrincipal', '=', 1)
            ->first(); 
            // return $Imagen; 
        
        // CONSULTA todas las imagenenes del producto seleccionado
        $ImagenesSec = DB::connection('mysql_2')->table('imagenes') 
            ->select('ID_Imagen','nombre_img') 
            ->where('ID_Producto', '=', $ID_Producto)
            ->get(); 
            // return $ImagenesSec; 
        
        //CONSULTA solo el ID_Suscriptor para usarlo como filtro en table comerciante
        // $Vendedor = $this->Instancia_SuscriptorController->index($Producto->ID_Comerciante);
        // return gettype($Vendedor);
        // return $Vendedor;         
      
        //Se consulta en la tabla del rol comerciante, en la BD MySQL_2
        $Comerciante = $this->Instancia_SuscriptorController->suscriptorComerciante($Producto->ID_Comerciante);        
        // return $Comerciante;
        
        return view('marketplace.detalleProducto_V', [
            'producto' => $Producto, 
            'imagen' => $Imagen, 
            'imagenesSec' => $ImagenesSec, 
            'comerciante' => $Comerciante,
            'dolar' => $this->Dolar, 
            'bandera' => $Bandera
            ]
        );
    } 

    // muestra la vista de todos los productos de un comerciante
    public function catalogo($ID_Comerciante){
        
        // Consulta todos los productos publicados en clasificados de un suscriptor especifico 
        $Productos = DB::connection('mysql_2')->table('productos') 
            ->select('productos.ID_Producto','ID_Comerciante','ID_Seccion','opciones.ID_Opcion','producto','nombre_img','opcion','precioBolivar','precioDolar','cantidad','nuevo')
            ->join('imagenes', 'productos.ID_Producto','=','imagenes.ID_Producto')  
            ->join('productos_opciones', 'productos.ID_Producto','=','productos_opciones.ID_Producto')
            ->join('opciones', 'productos_opciones.ID_Opcion','=','opciones.ID_Opcion')  
            ->join('secciones_productos', 'productos.ID_Producto','=','secciones_productos.ID_Producto')  
            ->where('ID_Comerciante', '=', $ID_Comerciante)
            ->where('fotoPrincipal', '=', '1')
            ->get(); 
            // return $Productos; 

        // Consulta las secciones de un catalogo especifico   
        $Secciones = DB::connection('mysql_2')->table('secciones') 
            ->select('ID_Seccion','seccion') 
            ->where('ID_Comerciante', '=', $ID_Comerciante)
            ->orderBy('seccion', 'asc')
            ->get(); 
            // return $Secciones; 
            
        //Solicita datos del suscriptor al controlador SuscriptorController   
        $Comerciante = $this->Instancia_SuscriptorController->suscriptorComerciante($ID_Comerciante);
        // return $Comerciante; 
        
        return view('marketplace.catalogos_V', [
            'dolar' => $this->Dolar,
            'id_comerciante' => $ID_Comerciante,
            'productos' => $Productos,
            'comerciante' => $Comerciante,
            'secciones' => $Secciones
            ]
        );
    }  

    // muestra los productos de una seccion especifica
    public function Secciones($ID_Comerciante, $ID_Seccion){
        
        //Consulta las secciones de un catalogo especifico 
        $Secciones = DB::connection('mysql_2')
        ->select(
            "SELECT ID_Seccion, seccion 
            FROM secciones 
            WHERE ID_Comerciante = '$ID_Comerciante'
            ORDER BY seccion
            ASC; ");
        // return gettype($Secciones);
        // return $Secciones;
       
        if(is_numeric($ID_Seccion)){          
            //Consulta los productos  de una seccion especifica
            $Productos = DB::connection('mysql_2')
                ->select(
                "SELECT productos.ID_Producto, productos.ID_Comerciante, opciones.ID_Opcion, ID_Seccion, producto, nombre_img, opcion, precioBolivar, precioDolar, cantidad, nuevo
                FROM productos 
                INNER JOIN imagenes ON productos.ID_Producto=imagenes.ID_Producto
                INNER JOIN productos_opciones ON productos.ID_Producto=productos_opciones.ID_Producto
                INNER JOIN opciones ON productos_opciones.ID_Opcion=opciones.ID_Opcion
                INNER JOIN secciones_productos ON productos.ID_Producto=secciones_productos.ID_Producto
                WHERE productos.ID_Comerciante = $ID_Comerciante AND ID_Seccion = $ID_Seccion AND fotoPrincipal = 1;");
                // return gettype($Productos);
                // return $Productos;
        }
        else{         
            //Consulta los productos de todo el catalogo          
            $Productos = DB::connection('mysql_2')
                ->select(
                "SELECT productos.ID_Producto, productos.ID_Comerciante, opciones.ID_Opcion, ID_Seccion, producto, nombre_img, opcion, precioBolivar, precioDolar, cantidad, nuevo
                FROM productos 
                INNER JOIN imagenes ON productos.ID_Producto=imagenes.ID_Producto
                INNER JOIN productos_opciones ON productos.ID_Producto=productos_opciones.ID_Producto
                INNER JOIN opciones ON productos_opciones.ID_Opcion=opciones.ID_Opcion
                INNER JOIN secciones_productos ON productos.ID_Producto=secciones_productos.ID_Producto
                WHERE productos.ID_Comerciante = $ID_Comerciante AND fotoPrincipal = 1;");
        }
        
        // Se consultan datos del comerciante al controlador SuscriptorController     
        $Comerciante = $this->Instancia_SuscriptorController->suscriptorComerciante($ID_Comerciante);
        // return $Comerciante; 
        
        return view('marketplace.catalogos_V', [
            'dolar' => $this->Dolar,
            'id_comerciante' => $ID_Comerciante,
            'productos' => $Productos,
            'comerciante' => $Comerciante,
            'secciones' => $Secciones
            ]
        );
    } 

    // muestra la VISTA carrito de compras
    public function verCarrito($ID_Comerciante, $Dolar){ 

        // CONSULTA información del vendedor
        // $ContactoTienda = DB::connection('mysql_2')->table('afiliado_com') 
        //     ->select('telefono_AfiCom','ID_Tienda') 
        //     ->join('tiendas', 'afiliado_com.ID_AfiliadoCom','=','tiendas.ID_AfiliadoCom')  
        //     ->where('afiliado_com.ID_AfiliadoCom', '=', $ID_Comerciante)
        //     ->first(); 
            // return $ContactoTienda; 
            
        // El delivery cuesta 1,3 dolares
        $CostoDelivery = 1.30 * $Dolar;
        
        //Se crea esta sesion para impedir que se acceda a la pagina que procesa el formulario o se recargue mandandolo varias veces a la base de datos
        session(['Carrito' =>  1806]);

        return view('marketplace.carrito_V', [
            'id_comerciante' => $ID_Comerciante,
            // 'contactoTienda' => $ContactoTienda, 
            'dolar' => $Dolar, 
            'costoDelivery' => $CostoDelivery
            ]
        );
    }

    // recibe contenido de carrito de compras
    public function recibePedido(Request $Request){
        
        // if(session('Carrito') == 1806){   
            // Anteriormente en Carrito_C se generó la variable $_SESSION["verfica_2"] con un valor de 1906; con esto se evita que no se pueda recarga esta página.
            // session()->forget('Carrito');//se borra la sesión verifica.        
         
             // if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nombreUsuario']) && !empty($_POST['apellidoUsuario']) && !empty($_POST['cedulaUsuario']) && !empty($_POST['telefonoUsuario']) && !empty($_POST['direccionUsuario']) && !empty($_POST['pedido'])){
                function limpiarTelefono($Tel){
                    $Tel = str_replace('.', '', $Tel);
                    $Tel = str_replace('-', '', $Tel);
                    return $Tel;
                }

                $RecibeDatosUsuario = [                    
                    'id_comerciante' => $Request->get('id_comerciante'),
                    'id_usuario' => $Request->get('id_usuario'),
                    'nombreUsuario' => $Request->get('nombreUsuario'),
                    'apellidoUsuario' => $Request->get('apellidoUsuario'),
                    'cedulaUsuario' => str_replace('.', '',($Request->get('cedulaUsuario'))),
                    'telefonoUsuario' => limpiarTelefono($Request->get('telefonoUsuario')),
                    'correoUsuario' => strtolower($Request->get('correoUsuario')),
                    'estado' => $Request->get('estado'),
                    'ciudad' => $Request->get('ciudad'),
                    'direccionUsuario' => $Request->get('direccionUsuario'),  
                    'suscrito' => $Request->get('suscrito'),
                    'montoTotal' => $Request->get('montoTotal'),
                    'montoTienda' => $Request->get('montoTienda'),
                ];        
                // echo '<pre>';
                // print_r($RecibeDatosUsuario); 
                // echo '</pre>';
                // exit();
                
                 //Se solicita la hora de la compra
                 date_default_timezone_set('America/Caracas');
                 $Hora = date('H:i');
                 
                 $RecibeDatosPedido = [
                    // DATOS DEL PEDIDO                     
                    'formaPago' => $Request->get('formaPago'),
                    'entrega' => $Request->get('entrega'),
                    'despacho' => $Request->get('despacho'),
                    'codigoReferencia' => $Request->get('codigoReferencia'),
                    'Hora' => $Hora
                 ];         
                 
                 //Despues de evaluar con is_numeric se da un aviso en caso de fallo
                //  if($RecibeDatos['Telefono'] == false){      
                //      echo 'El telefono debe ser solo números' . '<br>';
                //      echo "<a href='javascript: history.go(-1)'>Regresar</a>";
                //  }
                //  //Despues de evaluar con is_numeric se da un aviso en caso de fallo
                //  if($RecibeDatos['Cedula'] == false){      
                //      echo 'La cedula debe ser solo números' . '<br>';
                //      echo "<a href='javascript: history.go(-1)'>Regresar</a>";
                //  }
                 
                 //Se genera un número Ale_NroOrden que sera el numero de orden del pedido
                 $Ale_NroOrden = mt_rand(1000000,999999999);
                 
                 //El pedido como es un string en formato json se recibe sin filtrar o sanear desde vitrina.js PedidoEnCarrito() para que el metodo jsodecode lo pueda reconocer y convertir en un array.
                 $RecibeDirecto = $Request->get('pedido');

                 $Resultado = json_decode($RecibeDirecto, true); 
                //  print_r($Resultado);
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
                        DB::connection('mysql_2')->table('detallepedido')
                            ->insert([
                                'ID_Usuario' => $RecibeDatosUsuario['id_usuario'],
                                'numeroorden' => $Ale_NroOrden,
                                'seccion' => $Seccion,
                                'producto' => $Producto,
                                'cantidad' => $Cantidad,
                                'opcion' => $Opcion,
                                'precio' => $Precio,
                                'total' => $Total
                                ]                        
                            );
                        
                        //Se consulta la cantidad de existencia del producto
                        $Existencia = DB::connection('mysql_2')->table('opciones') 
                            ->select('ID_Opcion','cantidad')  
                            ->where('ID_Opcion', '=', $ID_Opcion)
                            ->get(); 
                            // return $Existencia;
                   
                        foreach($Existencia as $Key) :
                            $Key->cantidad;

                            // echo 'ID_Opcion= ' . $Key->ID_Opcion . '<br>';
                            // echo 'Cantidad= ' . $Key->cantidad . '<br>';
                        endforeach;

                        //Se resta lo que el usuario pidio y el resultado se introduce en BD
                        $Inventario = $Key->cantidad - $Cantidad;
                        
                        // Se ACTUALIZA el inventario de los productos pedidos
                        // DB::connection('mysql_2')->table('opciones')
                        //     ->where('ID_Opcion', $ID_Opcion)
                        //     ->update(['cantidad' => $Inventario]);
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
             if($RecibeDatosPedido['despacho'] == 'Domicilio_Si'){
                 $Delivery = $RecibeDatosPedido['montoEntrega'];
             }
             else{
                 $Delivery = '0';
             }

            // Sino se recibe el codigo de transferencia se da un valor por defecto
            // *****************************************
            if(empty($RecibeDatosPedido['CodigoReferencia'])){
                // $CodigoReferencia = $RecibeDatosPedido['formaPago'];
                $CodigoReferencia = 'No aplica';
            } 
            else{
                $CodigoReferencia = $RecibeDatosPedido['CodigoReferencia'];
            }
                 
             //Se INSERTAN los datos del comprador en la BD si el usuario acepta
            if($RecibeDatosUsuario['suscrito'] == 'Suscribir'){

                 //Se consulta si el usuario ya existe en la BD
                $UsuarioPedido = DB::connection('mysql_2')->table('usuarios') 
                    ->select('nombre_usu','apellido_usu','cedula_usu','telefono_usu','correo_usu','Ciudad_usu','direccion_usu')  
                    ->where('cedula_usu', '=', $RecibeDatosUsuario['cedulaUsuario'])
                    ->first(); 
                    // echo gettype($UsuarioPedido);
                    // return $UsuarioPedido;

                // SI el usuario no existe en la BD se inserta con opcion de recordar sus datos
                if($UsuarioPedido == null){
                     $Suscrito = 1;
                     DB::connection('mysql_2')->table('usuarios') 
                     ->insert(
                         ['nombre_usu' => $RecibeDatosUsuario['nombreUsuario'], 
                         'apellido_usu' => $RecibeDatosUsuario['apellidoUsuario'],
                         'cedula_usu' => $RecibeDatosUsuario['cedulaUsuario'],
                         'telefono_usu' => $RecibeDatosUsuario['telefonoUsuario'],
                         'correo_usu' => $RecibeDatosUsuario['correoUsuario'],
                         'ciudad_usu' => $RecibeDatosUsuario['ciudad'],
                         'direccion_usu' => $RecibeDatosUsuario['direccionUsuario'],
                         'suscrito' => $Suscrito,
                         'fecha' => date('Y-m-d'),
                         'hora' => date('H:i')
                         ]
                     );
                }
            }
            else{
                // Se INSERTAN pero no se recuerdan porque e usuario no aceptó guardar datos
                $Suscrito = 0;
                // DB::connection('mysql_2')->table('usuarios') 
                // ->insert(
                //     ['nombre_usu' => $RecibeDatosUsuario['nombreUsuario'], 
                //     'apellido_usu' => $RecibeDatosUsuario['apellidoUsuario'],
                //     'cedula_usu' => $RecibeDatosUsuario['cedulaUsuario'],
                //     'telefono_usu' => $RecibeDatosUsuario['telefonoUsuario'],
                //     'correo_usu' => $RecibeDatosUsuario['correoUsuario'],
                //     'estado_usu' => $RecibeDatosUsuario['estado'],
                //     'ciudad_usu' => $RecibeDatosUsuario['ciudad'],
                //     'direccion_usu' => $RecibeDatosUsuario['direccionUsuario'],
                //     'suscrito' => $Suscrito,
                //     'fecha' => date('Y-m-d'),
                //     'hora' => date('H:i')
                //     ]
                // );
            }

            // Se INSERTAN los datos generales del pedido en la BD
            DB::connection('mysql_2')->table('pedido') 
            ->insert(
                ['ID_Comerciante' => $RecibeDatosUsuario['id_comerciante'], 
                'ID_Usuario' => $RecibeDatosUsuario['id_usuario'],
                'numeroorden' => $Ale_NroOrden,
                'montoDelivery' => $Delivery,
                'montoTienda' => $RecibeDatosUsuario['montoTienda'],
                'montoTotal' => $RecibeDatosUsuario['montoTotal'],
                'despacho' => $RecibeDatosPedido['despacho'],
                'formaPago' => $RecibeDatosPedido['formaPago'],
                'codigoPago' => $CodigoReferencia,
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i')
                ]
            );
            
            // Se ACTUALIZA el inventario de los productos pedidos
            // DB::connection('mysql_2')->table('opciones')
            //     ->where('ID_Opcion', $ID_Opcion)
            //     ->update(['cantidad' => $Inventario]);

            //  $this->ConsultaRecibePedido_M->UpdateCapturePago($Ale_NroOrden, $Archivonombre);
                
            //RECIBE CAPTURE DEL PAGO 
            if($_FILES['imagenCapturePago']['name'] != ''){
                $Archivonombre = $_FILES['imagenCapturePago']['name'];
                $Tipo_Archivonombre = $_FILES['imagenCapturePago']['type'];
                $Tamanio_Archivonombre = $_FILES['imagenCapturePago']['size'];
                $Temporal_Archivonombre = $_FILES['imagenCapturePago']['tmp_name'];

                //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
                $Archivonombre = preg_replace('([^A-Za-z0-9.])', '', $Archivonombre);

                // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
                $Archivonombre = mt_rand() . '_' . $Archivonombre;

                //Se INSERTA el capture del pago por medio de un UPDATE debido a que ya existe un registro con el pedido en curso
                DB::connection('mysql_2')->table('pedido')
                    ->where('numeroorden', $Ale_NroOrden)
                    ->update(['capture' => $Archivonombre]);
              
                // INSSERTA IMAGEN DE CAPTURE EN SERVIDOR
                // se comprime y se inserta el archivo en el directorio de servidor 
                $BanderaImg = 'ImagenCapturePago';
                // metodo en Traits Comprimir_imagen
                $this->imagen_comprimir($BanderaImg, $this->Servidor, $Archivonombre, $Tipo_Archivonombre, $Tamanio_Archivonombre, $Temporal_Archivonombre);	
            }      
                //RECIBE CAPTURE PAGOMOVIL
            // else if($_FILES['imagenPagoMovil']['name'] != '' && $RecibeDatosPedido['FormaPago'] == 'PagoMovil'){
            //     $Archivonombre = $_FILES['imagenPagoMovil']['name'];
            //     $Tipo_Archivonombre = $_FILES['imagenPagoMovil']['type'];
            //     $Tamanio_Archivonombre = $_FILES['imagenPagoMovil']['size'];
            //     $Temporal_Archivonombre = $_FILES['imagenPagoMovil']['tmp_name'];

            //     //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
            //     $Archivonombre = preg_replace('([^A-Za-z0-9.])', '', $Archivonombre);

            //     // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
            //     $Archivonombre = mt_rand() . '_' . $Archivonombre;

            //     //Se INSERTA el capture del pago por medio de un UPDATE debido a que ya existe un registro con el pedido en curso
            //     DB::connection('mysql_2')->table('pedido')
            //         ->where('numeroorden', $Ale_NroOrden)
            //         ->update(['capture' => $Archivonombre]);

            //     // INSSERTA IMAGEN DE CAPTURE EN SERVIDOR
            //     // se comprime y se inserta el archivo en el directorio de servidor 
            //     $BanderaImg = 'ImagenCapturePago';
            //     // metodo en Traits Comprimir_imagen
            //     $this->imagen_comprimir($BanderaImg, $this->Servidor, $Archivonombre, $Tipo_Archivonombre, $Tamanio_Archivonombre, $Temporal_Archivonombre);	
            // }
            //     //RECIBE CAPTURE PAYPAL
            // else if($_FILES['imagenPagoPaypal']['name'] != '' && $RecibeDatosPedido['FormaPago'] == 'Paypal'){
            //     $Archivonombre = $_FILES['imagenPagoPaypal']['name'];
            //     $Tipo_Archivonombre = $_FILES['imagenPagoPaypal']['type'];
            //     $Tamanio_Archivonombre = $_FILES['imagenPagoPaypal']['size'];
            //     $Temporal_Archivonombre = $_FILES['imagenPagoPaypal']['tmp_name'];

            //     //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
            //     $Archivonombre = preg_replace('([^A-Za-z0-9.])', '', $Archivonombre);

            //     // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
            //     $Archivonombre = mt_rand() . '_' . $Archivonombre;

            //     //Se INSERTA el capture del pago por medio de un UPDATE debido a que ya existe un registro con el pedido en curso
            //     DB::connection('mysql_2')->table('pedido')
            //         ->where('numeroorden', $Ale_NroOrden)
            //         ->update(['capture' => $Archivonombre]);

            //     // INSSERTA IMAGEN DE CAPTURE EN SERVIDOR
            //     // se comprime y se inserta el archivo en el directorio de servidor 
            //     $BanderaImg = 'ImagenCapturePago';
            //     // metodo en Traits Comprimir_imagen
            //     $this->imagen_comprimir($BanderaImg, $this->Servidor, $Archivonombre, $Tipo_Archivonombre, $Tamanio_Archivonombre, $Temporal_Archivonombre);	
            // }
            //  else{
            //     echo 'No se recibio capture de pago en Paypal';
            //     exit;
            //  }

             // ****************************************
             //DATOS ENVIADOS POR CORREOS
             // ****************************************
             
            //Se CONSULTA el pedido recien ingresado a la BD
            $Pedido = DB::connection('mysql_2')
                ->select(
                "SELECT ID_Pedido, comerciantes.ID_Comerciante, pseudonimoComerciante, seccion, producto, cantidad, opcion, precio, total, detallepedido.numeroorden, DATE_FORMAT(fecha, '%d-%m-%Y') AS fecha, DATE_FORMAT(hora, '%h:%i %p') AS hora, pedido.montoDelivery, pedido.montoTienda, pedido.montoTotal, pedido.despacho, pedido.formaPago, pedido.codigoPago, pedido.capture 
                FROM detallepedido 
                INNER JOIN pedido ON detallepedido.numeroorden=pedido.numeroorden 
                INNER JOIN comerciantes ON pedido.ID_Comerciante=comerciantes.ID_Comerciante
                WHERE detallepedido.numeroorden = $Ale_NroOrden");
                // return $Pedido;
            
            //Se CONSULTA el usuario que realizó el pedido
            $ID_Pedido = $Pedido[0]->ID_Pedido;
            $Usuario = DB::connection('mysql_2')
                ->select(
                "SELECT nombre_usu, apellido_usu, cedula_usu, telefono_usu, estado_usu, ciudad_usu, direccion_usu 
                FROM pedido 
                INNER JOIN usuarios ON pedido.ID_Usuario=usuarios.ID_Usuario 
                WHERE ID_Pedido = $ID_Pedido");
             

             // Se genera el código de despacho que será solicitado por el despachador
             $Ale_CodigoDespacho = mt_rand(0001,9999);

            $DatosCorreo = [
                'informacion_pedido' => $Pedido,
                'informacion_usuario' => $Usuario,
                'Codigo_despacho' => $Ale_CodigoDespacho
            ];

            //  $Datos = [
            //      'Codigo_despacho' => $Ale_CodigoDespacho
            //  ];

             // CORREOS
             // ****************** correo para vendedor y noticieroyaracuy             
             $bccEmails = ["pcabeza7@gmail.com"];

             Mail::to($RecibeDatosUsuario['correoUsuario'])
                ->bcc($bccEmails)
                ->send(new reciboCompra_mail($DatosCorreo));                    
             
            return view('marketplace.RecibePedido_V', [
                'codigo_despacho' => $Ale_CodigoDespacho
                ]
            );
        // }        
        // else{ 
        //      return redirect()->action([InicioController::class]);   
        //      die();
        // }   
    }
     
    // Muestra formulario con los datos de usuario registrado
     public function mostrarUsuario($Cedula){
       
        //Se CONSULTA si el usuario esta suscrito
        $Usuario = DB::connection('mysql_2')->table('usuarios') 
            ->select('ID_Usuario','nombre_usu','apellido_usu','cedula_usu','telefono_usu','correo_usu','estado_usu','ciudad_usu','direccion_usu')  
            ->where('cedula_usu', '=', $Cedula)
            ->first(); 
            // echo gettype($Usuario) . '<br>';
            // return $Usuario;

        if($Usuario == null){
            echo 'Usuario no registrado';
        }
        else{
            //Se separa cada variable pooque llegara a Javascript como una cadena de texto, luego se convertira en un array utilizando las , como caracter separador 
            echo $Usuario->nombre_usu . ',' . $Usuario->apellido_usu . ',' .  $Usuario->cedula_usu . ',' .$Usuario->telefono_usu . ',' . $Usuario->correo_usu . ',' . $Usuario->estado_usu . ',' . $Usuario->ciudad_usu . ',' . $Usuario->direccion_usu . ',' . $Usuario->ID_Usuario;
        }
    }
    
    // muestra la imagen seleccionada en la miniatura de un producto
    public function muestraImagenSeleccionada($ID_Imagen){
        //Se CONSULTA la imagen que se solicito en detalle
        $ImageneMiniatura = DB::connection('mysql_2')->table('imagenes') 
            ->select('nombre_img','ID_Comerciante') 
            ->join('productos', 'imagenes.ID_Producto','=','productos.ID_Producto')
            ->where('ID_Imagen', '=', $ID_Imagen)
            ->first(); 
            // return $ImageneMiniatura; 

        return view('ajax.A_imagenSeleccionada_V', [
            'imagenSeleccionada' => $ImageneMiniatura,
        ]);
    }
    
    // Muestra la vista donde aparecen todas las categorias con la cantidad de tiendas activas
    public function categoria(){
        
        // Consulta los nombres de las categorias existentes en BD
        $Categorias = DB::connection('mysql_2')
            ->select("SELECT ID_Categoria, categoria
                FROM categorias
                ORDER BY categoria
                ASC");
                // return gettype($Categorias);
                // return $Categorias;
            
        // Consulta si las tiendas tienen productos agregados en su inventario
        $TiendasProductos = DB::connection('mysql_2')
            ->select("SELECT ID_Comerciante 
                FROM productos
                GROUP BY ID_Comerciante ");
                // return gettype($TiendasProductos);
                // return $TiendasProductos;

        // Se CONSULTA la cantidad de tiendas que estan afiliadas por categorias
        $CantidadTiendas = DB::connection('mysql_2')
            ->select("SELECT COUNT(ID_Comerciante) AS 'cantidad', categoriaComerciante
                FROM comerciantes
                WHERE desactivarComerciante = 0
                GROUP BY categoriaComerciante
                ORDER BY cantidad
                DESC");
                // return gettype($CantidadTiendas);
                // return $CantidadTiendas;
        
        return view('marketplace/categoria_V',[
                'cantidadTiendas' => $CantidadTiendas,
                'categorias' => $Categorias, 
                'tiendasProductos' => $TiendasProductos,
            ]); 
    }

    // muestra todas las tiendas de una categoria especifica, en un flayer, solo si tiene productos o esta activa
    public function tiendasCategoria($NombreCategoria){
        
        //Se CONSULTA tiendas en una misma categria
        $ComercianteCategorias = DB::connection('mysql_2')
            ->select(
                "SELECT ID_Comerciante, pseudonimoComerciante, categoriaComerciante, nombreImgCatalogo
                FROM comerciantes
                WHERE categoriaComerciante = '$NombreCategoria' AND desactivarComerciante = 0;");   
                // return gettype($ComercianteCategorias);
                // return($ComercianteCategorias);

        if($ComercianteCategorias != null){
            $IDs_Comerciante = [];
    
            //Se obtienen los IDs de los comerciantes que se encuentran en la categoria
            foreach($ComercianteCategorias AS $row) :
                $TodosComerciante = $row->ID_Comerciante;
    
                //Se añade el ID de cada tienda al array $IDs_Comerciante
                array_push($IDs_Comerciante, $TodosComerciante);
            endforeach;
            
            //Se cambia el array $IDs_Tiendas por una cadena para enviarlo como parametro en la consulta a BD
            $IDs_Comerciante = implode(',', $IDs_Comerciante); 
            // echo '<pre>';
            // print_r($IDs_Comerciante);
            // echo '</pre>';
            // exit;

        }
        else{
            $IDs_Comerciante = 0;
        }

        //SELECT que trae nueve productos destacados por cada tienda
        $TiendasProductosDestacados = DB::connection('mysql_2')
            ->select("SELECT comerciantes.ID_Comerciante, nombre_img
                FROM comerciantes 
                INNER JOIN productos ON comerciantes.ID_Comerciante=productos.ID_Comerciante 
                INNER JOIN imagenes ON productos.ID_Producto=imagenes.ID_Producto 
                WHERE comerciantes.ID_Comerciante IN ($IDs_Comerciante) AND productos.destacar = 1 AND imagenes.fotoPrincipal = 1 
                ORDER BY producto");   
                // return gettype($TiendasCategorias);
                // return($TiendasProductosDestacados);
        
        if($ComercianteCategorias != Array()){
            return view('marketplace.CatalogosCategoria_V',[
                'comercianteCategorias' => $ComercianteCategorias,
                'comerciante_productosDestacados' => $TiendasProductosDestacados
            ]);  
        }
        else{
            return redirect()->action([MarketplaceController::class, 'categoria']);
            die();
        }
    }
    
    // Actualiza el precio en Bs de los productos en BD segun el precio del dolar a tasa de BCV
    public function dolarHoy(){

        // Se consultan los precios en dolares.
        $Precios = DB::connection('mysql_2')->table('opciones') 
            ->select('ID_Opcion','precioDolar')  
            ->get(); 
            // echo gettype($Precios) . '<br>';
            // return $Precios;

        //Se declara un array donde se almacenaran los precios actualizados de cada producto
        $NuevoPrecioBolivar = [];
        $Intermedio = [];

        foreach($Precios as $Key):
            $ID_Opcion = $Key->ID_Opcion;
            $PrecioActualBs = ($Key->precioDolar * $this->Dolar);

            $Intermedio = ['ID_Opcion' => $ID_Opcion, 'precioActualizadoBs' => $PrecioActualBs];
            array_push($NuevoPrecioBolivar, $Intermedio);
        endforeach;

        //Se actualizan los precios de los productos existente en BD        
            // SE realiza un foreach porque $NuevoPrecioDolar es un array con el precio de cada producto
            foreach($NuevoPrecioBolivar as $Key):
                DB::connection('mysql_2')->table('opciones')
                ->where('ID_Opcion','=', $Key['ID_Opcion']) 
                ->update(['precioBolivar' => $Key['precioActualizadoBs']]);
            endforeach;

        return redirect()->action([MarketplaceController::class, 'index']);
        die();
    }
}




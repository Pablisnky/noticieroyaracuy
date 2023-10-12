<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Comerciante_M; 

use App\Traits\Divisas; 
use App\Http\Controllers\Suscriptor_C;


class MarketplaceController extends Controller
{
    use Divisas; //Traits
    
    private $Dolar;
    private $Instancia_Suscriptor_C;
    
    public function __construct(){

        $this->Instancia_Suscriptor_C = new Suscriptor_C();
        
        //Solicita el precio del dolar al Trait Divisas
        $this->Dolar = $this->ValorDolar();
    }
        
    // Muestra la vista con todos los productos, los muestra de manera aleatoria
    public function index(){  
        //Consulta todos los productos publicados  
        $Productos = DB::connection('mysql_2')->table('productos') 
            ->select('productos.ID_Producto','ID_Comerciante','opciones.ID_Opcion','producto','nombre_img','opcion', 'precioBolivar','precioDolar','cantidad','nuevo')
            ->join('imagenes', 'productos.ID_Producto','=','imagenes.ID_Producto') 
            ->join('productos_opciones', 'productos.ID_Producto','=','productos_opciones.ID_Producto')
            ->join('opciones', 'productos_opciones.ID_Opcion','=','opciones.ID_Opcion')  
            ->where('fotoPrincipal', '=', '1')
            ->inRandomOrder()
            ->get(); 
            // return $Productos; 
            
            //Solicita datos del suscriptor al controlador Suscriptor_C   
            $Suscriptores = $this->Instancia_Suscriptor_C->suscriptores();
            // return $Suscriptores;
        
            return view('marketplace.clasificados_V', [
                'productos' => $Productos, 
                'dolar' => $this->Dolar, 
                'suscriptor' => $Suscriptores
                ]
            ); 
    } 
    
    // muestra la vista de un producto y sus detalles
    public function productoAmpliado($ID_Producto){
                   
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
        // $Vendedor = $this->Instancia_Suscriptor_C->index($Producto->ID_Comerciante);
        // return gettype($Vendedor);
        // return $Vendedor;         
      
        //Se consulta en la tabla del rol comerciante, esta debe estar en la BD clasificados
        $Comerciante = $this->Instancia_Suscriptor_C->suscriptorComerciante($Producto->ID_Comerciante);        
        // return $Comerciante;
        
        return view('marketplace.detalleProducto_V', [
            'producto' => $Producto, 
            'imagen' => $Imagen, 
            'imagenesSec' => $ImagenesSec, 
            'comerciante' => $Comerciante,
            'dolar' => $this->Dolar, 
            'bandera' => 'Desde_Clasificados'
            ]
        );
    } 

    // muestra la vista de todos los productos de una tienda
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
            ->get(); 
            // return $Secciones; 
            
        //Solicita datos del suscriptor al controlador Suscriptor_C   
        $Comerciante = $this->Instancia_Suscriptor_C->suscriptorComerciante($ID_Comerciante);
        // return $Comerciante; 
        
        return view('marketplace.catalogos_V', [
            'dolar' => $this->Dolar,
            'id_comerciante' => $ID_Comerciante,
            'productos' => $Productos,
            'suscriptor' => $Comerciante,
            'secciones' => $Secciones
            ]
        );
    }  

    // muestra la VISTA carrito de compras
    public function verCarrito($ID_Suscriptor, $Dolar){ 
        
        // CONSULTA información del vendedor
        // $ContactoTienda = DB::connection('mysql_2')->table('afiliado_com') 
        //     ->select('telefono_AfiCom','ID_Tienda') 
        //     ->join('tiendas', 'afiliado_com.ID_AfiliadoCom','=','tiendas.ID_AfiliadoCom')  
        //     ->where('afiliado_com.ID_AfiliadoCom', '=', $ID_Suscriptor)
        //     ->first(); 
            // return $ContactoTienda; 
            
        // El delivery cuesta 1,3 dolares
        $CostoDelivery = 1.30 * $Dolar;
        
        //Se crea esta sesion para impedir que se acceda a la pagina que procesa el formulario o se recargue mandandolo varias veces a la base de datos
        session(['Carrito' =>  1806]);

        return view('marketplace.carrito_V', [
            'id_suscriptor' => $ID_Suscriptor,
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
                    'id_tienda' => $Request->get('id_tienda'),
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
                echo '<pre>';
                print_r($RecibeDatosUsuario);
                echo '</pre>';
                exit();
                
                 //Se solicita la hora de la compra
                 date_default_timezone_set('America/Caracas');
                 $Hora = date('H:i');
                 
                 $RecibeDatosPedido = [
                    // DATOS DEL PEDIDO                     
                    'formaPago' => $Request->get('formaPago'),
                    'entrega' => $Request->get('entrega'),
                    'despacho' => $Request->get('despacho'),
                    'codigoTransferencia' => $Request->get('codigoTransferencia'),
                    'Hora' => $Hora
                 ];           
                //  echo '<pre>';
                //  print_r($RecibeDatosPedido);
                //  echo '</pre>';
                //  exit()
                 
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
                        DB::connection('mysql_2')->table('opciones')
                            ->where('ID_Opcion', $ID_Opcion)
                            ->update(['cantidad' => $Inventario]);
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
            if(empty($RecibeDatosPedido['CodigoTransferencia'])){
                // $CodigoTransferencia = $RecibeDatosPedido['formaPago'];
                $CodigoTransferencia = 'No aplica';
            } 
            else{
                $CodigoTransferencia = $RecibeDatosPedido['CodigoTransferencia'];
            }
                 
             //Se INSERTAN los datos del comprador en la BD si el usuario acepta
            if($RecibeDatosUsuario['suscrito'] == 'Suscribir'){

                 //Se consulta si el usuario ya existe en la BD
                $UsuarioPedido = DB::connection('mysql_2')->table('usuarios') 
                    ->select('nombre_usu','apellido_usu','cedula_usu','telefono_usu','correo_usu','Estado_usu','Ciudad_usu','direccion_usu')  
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
                         'estado_usu' => $RecibeDatosUsuario['estado'],
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
                DB::connection('mysql_2')->table('usuarios') 
                ->insert(
                    ['nombre_usu' => $RecibeDatosUsuario['nombreUsuario'], 
                    'apellido_usu' => $RecibeDatosUsuario['apellidoUsuario'],
                    'cedula_usu' => $RecibeDatosUsuario['cedulaUsuario'],
                    'telefono_usu' => $RecibeDatosUsuario['telefonoUsuario'],
                    'correo_usu' => $RecibeDatosUsuario['correoUsuario'],
                    'estado_usu' => $RecibeDatosUsuario['estado'],
                    'ciudad_usu' => $RecibeDatosUsuario['ciudad'],
                    'direccion_usu' => $RecibeDatosUsuario['direccionUsuario'],
                    'suscrito' => $Suscrito,
                    'fecha' => date('Y-m-d'),
                    'hora' => date('H:i')
                    ]
                );
            }

            // Se INSERTAN los datos generales del pedido en la BD
            DB::connection('mysql_2')->table('pedido') 
            ->insert(
                ['ID_Tienda' => $RecibeDatosUsuario['id_tienda'], 
                'ID_Usuario' => $RecibeDatosUsuario['id_usuario'],
                'numeroorden' => $Ale_NroOrden,
                'montoDelivery' => $Delivery,
                'montoTienda' => $RecibeDatosUsuario['montoTienda'],
                'montoTotal' => $RecibeDatosUsuario['montoTotal'],
                'despacho' => $RecibeDatosPedido['despacho'],
                'formaPago' => $RecibeDatosPedido['formaPago'],
                'codigoPago' => $CodigoTransferencia,
                'fecha' => date('Y-m-d'),
                'hora' => date('H:i')
                ]
            );
             
            //Se recibe y se inserta el capture de transferencia 
            if($_FILES['imagenTransferencia']['name'] != ''){
                $CodigoTransferencia = $RecibeDatosPedido['formaPago'];
                $archivonombre = 'imagen_2.png';
                
                // Se ACTUALIZA el inventario de los productos pedidos
                DB::connection('mysql_2')->table('opciones')
                    ->where('ID_Opcion', $ID_Opcion)
                    ->update(['cantidad' => $Inventario]);











            //  $this->ConsultaRecibePedido_M->UpdateCapturePago($Ale_NroOrden, $archivonombre);
            }
            else{
                $archivonombre = $_FILES['imagenTransferencia']['name'];
                $Ruta_Temporal = $_FILES['imagenTransferencia']['tmp_name'];

                //Usar en remoto
                $directorio = $_SERVER['DOCUMENT_ROOT'] . '/public/images/capture/';

                //Subimos el fichero al servidor
                move_uploaded_file($Ruta_Temporal, $directorio.$archivonombre);

                //Se INSERTA el capture del pago por medio de un UPDATE debido a que ya existe un registro con el pedido en curso
            //  $this->ConsultaRecibePedido_M->UpdateCapturePago($Ale_NroOrden, $archivonombre);
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
            //  $this->ConsultaRecibePedido_M->UpdateCapturePago($Ale_NroOrden, $archivonombre);
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
            //  $this->ConsultaRecibePedido_M->UpdateCapturePago($Ale_NroOrden, $archivonombre);
            }
             // else{
             //     echo 'No se recibio capture de pago en Paypal';
             //     exit;
             // }

             // ****************************************
             //DATOS ENVIADOS POR CORREOS
             //Se CONSULTA el pedido recien ingresado a la BD
            //  $Pedido = $this->ConsultaRecibePedido_M->consultarPedido($Ale_NroOrden);
             
             //Se CONSULTA el usuario que realizó el pedido
            //  $Usuario = $this->ConsultaRecibePedido_M->consultarUsuario($RecibeDatosUsuario['Cedula']);
             
             //Se CONSULTA el correo y el nombre de la tienda
            //  $Tienda = $this->ConsultaRecibePedido_M->consultarCorreo($RecibeDatosPedido['ID_Tienda']);

             // Se genera el código de despacho que será solicitado por el despachador
             $Ale_CodigoDespacho = mt_rand(0001,9999);

            //  $DatosCorreo = [
            //      'informacion_pedido' => $Pedido,
            //      'informacion_usuario' => $Usuario,
            //      'informacion_tienda' => $Tienda,
            //      'Codigo_despacho' => $Ale_CodigoDespacho
            //  ];

             // echo '<pre>';
             // print_r($DatosCorreo);
             // echo '</pre>';
             // exit;

            //  $Datos = [
            //      'Codigo_despacho' => $Ale_CodigoDespacho
            //  ];

             // CORREOS
             // **************************************** 

             //Carga la vista "recibo de compra" dirigida al usuario ubicada en app/clases/controlador.php
            //  $this->correo('reciboCompra_mail', $DatosCorreo); 

             //Carga la vista de correo "orden de compra" dirigida al cliente y al marketplace
            //  $this->correo('ordenCompra_mail', $DatosCorreo); 

            //  $this->vista('header/header');
            //  $this->vista('view/RecibePedido_V', $Datos);
             
            // return view('marketplace.RecibePedido_V', [
            //     'codigo_despacho' => $Ale_CodigoDespacho
            //     ]
            // );
        // }        
        // else{ 
        //      return redirect()->action([Inicio_C::class]);   
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
    
    public function categoria(){
       
        //Se CONSULTAN todos los estados en los cuales existen tiendas disponibles para mostrar a usuarios
        // $EstadosTiendas = $this->ConsultaCategoria_M->consultarEstadosTiendas();

        //Se CONSULTAN todas las  tiendas
        // $CiudadesTiendas = $this->ConsultaCategoria_M->consultarCiudadesTiendas();
        
        // //Se CONSULTA la cantidad de tiendas que estan afiliadas por categorias
        $CantidadTiendas = Comerciante_M::
            select('categoriaComerciante')           
            ->selectRaw('COUNT("ID_Comerciante") AS cantidad')
            ->groupBy("categoriaComerciante")
            ->orderBy('cantidad', 'desc')
            ->get();
            // return gettype($CantidadTiendas);
            // return $CantidadTiendas;
        
        return view('marketplace.categoria_V',[
                'cantidadTiendasCategoria' => $CantidadTiendas
            ]); 
    }

    // muestra las tiendas de una categoria especifica
    public function tiendasCategoria($NombreCategoria){
        
        //Se CONSULTA tiendas en una misma categria
        $TiendasCategorias = Comerciante_M::
            select('ID_Comerciante','pseudonimoComerciante','categoriaComerciante','nombreImgCatalogo')   
            ->where("categoriaComerciante",'=', $NombreCategoria)
            ->get();
            // return gettype($TiendasCategorias);
            // return $TiendasCategorias;
        
        return view('marketplace.CatalogosCategoria_V',[
            'tiendasCategorias' => $TiendasCategorias
        ]);  
    }
}




<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;

use App\Traits\Divisas; 
use App\Http\Controllers\Suscriptor_C;

use App\Traits\ServidorUse;
use App\Traits\Comprimir_Imagen;

class PanelMarketplaceController extends Controller
{
    use Divisas; //Traits 
    use ServidorUse; //Traits
    use Comprimir_Imagen; //Traits

    private $ConsultaClasificados_M;
    private $Instancia_Suscriptor_C;
    private $Dolar;
    private $Comprimir;
    private $Servidor;
        
    public function __construct(){

        $this->Instancia_Suscriptor_C = new Suscriptor_C();
        
        $this->Servidor = $this->conexionServidor(); // metodo en Traits ServidorUse

        // Solicita el precio del dolar al Trait Divisas
        $this->Dolar = $this->ValorDolar();
        // echo $this->Dolar . '<br>';
    }

    //Muestra todos los productos que tiene un suscriptor especifico
    public function index($ID_Suscriptor){
        
        //se consultan los anuncios clasificados de un suscriptor
        $ProductosSuscriptor = DB::connection('mysql_2')->table('productos') 
            ->select('productos.ID_Producto','producto','opciones.ID_Opcion','opcion','opciones.precioBolivar','opciones.precioDolar','cantidad','nombre_img')
            ->join('productos_opciones', 'productos.ID_Producto','=','productos_opciones.ID_Producto')
            ->join('opciones', 'productos_opciones.ID_Opcion','=','opciones.ID_Opcion') 
            ->join('imagenes', 'productos.ID_Producto','=','imagenes.ID_Producto') 
            ->where("ID_Suscriptor",'=', $ID_Suscriptor)  
            ->where("fotoPrincipal",'=', 1) 
            ->orderBy('productos.producto', 'asc')
            ->orderBy('opciones.opcion', 'asc')
            ->get();
            // return $ProductosSuscriptor;

        return view('panel/suscriptores/suscrip_productos_V', [
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
    public function Publicar($ID_Suscriptor){

        //se consultan las secciones del catalogo del suscriptor
        $Secciones = DB::connection('mysql_2')->table('secciones')
            ->select('ID_Seccion', 'seccion')
            ->where('ID_Suscriptor','=', $ID_Suscriptor)
            ->first();
            // return $Secciones; 

        return view('panel/suscriptores/suscrip_publicar_V', [
            'dolarHoy' => $this->Dolar,
            'ID_Suscriptor' => $ID_Suscriptor,
            'secciones' => $Secciones
        ]);            

        // $_SESSION['Publicar'] = 1906; 
        //Se crea esta sesion para impedir que se recargue la información enviada por el formulario mandandolo varias veces a la base de datos
    }
    
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

        // CONSULTA todas las secciones de un suscriptor
        $Secciones = DB::connection('mysql_2')->table('secciones')
            ->select('ID_Seccion','seccion')
            ->where('ID_Suscriptor','=', session('id_suscriptor'))
            ->get();
            // return $Secciones;        
                    
        // se consultan la informacion del suscriptor
        $Suscriptor = $this->Instancia_Suscriptor_C->index(session('id_suscriptor'));
        // return $Suscriptor;
        
        return view('panel.suscriptores.suscrip_editar_prod_V', [
            'ID_Suscriptor' => session('id_suscriptor'),
            'especificaciones' => $Especificaciones,
            'imagenPrin' => $ImagenPrin, 
            'imagenSec' => $ImagenSec,
            'dolarHoy' => $this->Dolar,
            'seccion' => $Seccion,
            'secciones' => $Secciones,      
            'suscriptor' => $Suscriptor
        ]);
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
                // 'Descripcion' => preg_replace('[\n|\r|\n\r|\)','',$_POST, "descripcion", ), //evita los saltos de lineas realizados por el usuario al separar parrafos
                'PrecioBs' => $Request->get("precioBolivar"),
                'PrecioDolar' => $Request->get("precioDolar"),
                'Cantidad' => empty($Request->get('uni_existencia')) ? 0 : $Request->get('uni_existencia'),
                'ID_Suscriptor' => $Request->get("id_suscriptor"),
                'ID_Seccion' => $Request->get("id_seccion") 
            ];
            // return $RecibeProducto;
        // }
        // else{
        //     echo 'Llene todos los campos obligatorios' . '<br>';
        //     echo '<a href="javascript: history.go(-1)">Regresar</a>';
        //     exit();
        // }

        // require(RUTA_APP . '/helpers/Comprimir_Imagen.php');
        // $this->Comprimir = new Comprimir_Imagen();

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
            $Bandera = 'imagenProducto';
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
                $Bandera = 'imagenSecundariiaProdActualizar';
                $this->Comprimir->index($Bandera, $Nombre_imagenSecundaria, $tipo_imagenSecundaria,$tamanio_imagenSecundaria, $Ruta_Temporal_imagenSecundaria);	
                
                //Se INSERTAN las fotografias secundarias del producto en BD
                $this->ConsultaClasificados_M->insertaImagenSecundariaProducto($RecibeProducto['ID_Producto'], $Nombre_imagenSecundaria, $tipo_imagenSecundaria, $tamanio_imagenSecundaria);
            }
        }
    
        // ********************************************************
        //Estas sentencias de actualización deben realizarce por medio de transsacciones

        //Se ACTUALIZA la tabla opciones en BD            
        DB::connection('mysql_2')->table('opciones')
            ->where('ID_Opcion', $RecibeProducto['ID_Opcion']) 
            ->update(['opcion' => $RecibeProducto['Descripcion'], 'precioBolivar' => $RecibeProducto['PrecioBs'], 'precioDolar' => $RecibeProducto['PrecioDolar'], 'cantidad' => $RecibeProducto['Cantidad']]);

        //Se ACTUALIZA la tabla productos en BD   
        DB::connection('mysql_2')->table('productos')
            ->where('ID_Producto', $RecibeProducto['ID_Producto']) 
            ->update(['producto' => $RecibeProducto['Producto']]);
        
        //ACTUALIZA la dependencia transitiva entre el producto y la seccions a la que pertenece
        // $this->ConsultaClasificados_M->actualizarDT_SecPro($RecibeProducto);

        // $this->index($RecibeProducto['ID_Suscriptor']);
        return redirect()->route("SuscriptorMarketplace",['ID_Suscriptor' => $RecibeProducto['ID_Suscriptor']]);
        die();
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
        
        // $this->ConsultaClasificados_M->eliminarProductoOpcion($ID_Producto);
        // $this->ConsultaClasificados_M->eliminarImagenesProducto($ID_Producto);
        // $this->ConsultaClasificados_M->eliminarProducto($ID_Producto);
        // $this->ConsultaClasificados_M->eliminarOpcion($ID_Opcion);
          
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

<?php    

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Models\Noticias_M;
// use App\Models\Imagenes_M; 
// use App\Models\Videos_M; 
// use App\Models\Comentarios_M;
// use App\Models\Noticias_Anuncios_M; 
// use App\Models\Secciones_M;
// use Carbon\Carbon;

class Panel_Denuncias_C extends Controller{
    private $Consulta_PanelDenuncia_M;
    private $Comprimir;
    private $Servidor;
    
    public function __construct(){       
        // session_start();
            
        // $this->Consulta_PanelDenuncia_M = $this->modelo("Panel_Denuncia_M");
        
        // $this->Servidor = conexionServidor();
        
        // require(RUTA_APP . '/helpers/Comprimir_Imagen.php');
        // $this->Comprimir = new Comprimir_Imagen();
    }

    // Muestra el panel de todas las denuncias realiadas por un usuario
    public function index($ID_Suscriptor){   
        // echo $ID_Suscriptor;
        // exit;
        //se consultan las denuncias realizadas por un suscriptor
        // $DenunciasSuscriptor = $this->Consulta_PanelDenuncia_M->consultarDenuncias($ID_Suscriptor);
        
        //se consultan las imagenes de las denuncias realizadas por un suscriptor
        // $DenunciasImagenesSuscriptor = $this->Consulta_PanelDenuncia_M->consultarImagenePrincipalDenuncias($ID_Suscriptor);
        
        // $Datos = [
        //     'denuncias' => $DenunciasSuscriptor, 
        //     'denunciasImagenes' => $DenunciasImagenesSuscriptor 
        // ];

        // echo "<pre>";
        // print_r($Datos);
        // echo "</pre>";
        // exit();
        
        return view('panel/suscriptores/suscrip_denuncias_V', [
                // 'denuncias' => $DenunciasSuscriptor, 
                // 'denunciasImagenes' => $DenunciasImagenesSuscriptor 
            ]);
        // $this->vista("header/header_suscriptor");

    }
    
    //Da la cantidad de denuncias que ha realizado un suscriptor especifico
    public function denunciasSuscriptor($ID_Suscriptor){
        
        //se consultan los anuncios clasificados de un suscriptor
        $DenunciasSuscriptor = $this->Consulta_PanelDenuncia_M->consultarCantidadDenuncias($ID_Suscriptor);
        
        // echo "<pre>";
        // print_r($ClasificadosSuscriptor);
        // echo "</pre>";
        // exit();

        return $DenunciasSuscriptor;
    }
    
    //MUestra el formulario donde se carga una denuncia
    public function denuncias($ID_Suscriptor){

        $Datos = [
            'ID_Suscriptor' => $ID_Suscriptor
        ];
        
        $_SESSION['agregarDenuncia'] = 1976; 
        //Se crea esta sesion para impedir que se recargue la información enviada por el formulario mandandolo varias veces a la base de datos

        $this->vista("header/header_suscriptor");
        $this->vista("suscriptores/suscrip_agregarDenuncia_V", $Datos);
    }
    
    public function verDenuncias(){
        //Se CONSULTA las denuncias realizadas 
        $Denuncias = $this->Consulta_PanelDenuncia_M->consultarDenuncia();
        
        //Se CONSULTA la imagen principal de denuncias realizadas             
        $DenunciasImagenesPricipales = $this->Consulta_PanelDenuncia_M->consultarDenunciaImagenes();
        
        //Se CONSULTA la cantidad de imagenes secundarias en cada denuncia realizada            
        $DenunciasImagenesSecundarias = $this->Consulta_PanelDenuncia_M->consultarDenunciaCantidadImagenes();
        
        // CONSULTA cuantos ias lleva una denuncia
        $diasDenunciaActiva = $this->Consulta_PanelDenuncia_M->diasDenunciaActiva();
        
        // CONSULTA el suscriptor que realizo una denuncia
        $DenunciaSuscriptor = $this->Consulta_PanelDenuncia_M->denunciaSuscriptor();

        //Se CONSULTA los videos de denuncias realizadas 
        // $DenunciasVideo = $this->Consulta_PanelDenuncia_M->consultarDenunciaVideo();
        
        //Se CONSULTA los comentarios de denuncias realizadas 
        // $DenunciasComentarios = $this->Consulta_PanelDenuncia_M->consultarDenunciaCOmentarios();

        $Datos = [
            'descripcion' => $Denuncias, 
            'imagenesDenunciaPrincipal' => $DenunciasImagenesPricipales, 
            'imagenesDenunciaSecundaria' => $DenunciasImagenesSecundarias,
            'diasDenuncia' => $diasDenunciaActiva,
            'denunciaSuscriptor' => $DenunciaSuscriptor
        ];
        
        // echo '<pre>';
        // print_r($Datos);
        // echo '</pre>';
        // exit;
        
        $this->vista("header/header_noticia");
        $this->vista("view/denuncias_V", $Datos);
    }

    public function detalleDenuncia($ID_Denuncia){
        //Se CONSULTA los detalles de una denuncia especifica
        $Denuncia = $this->Consulta_PanelDenuncia_M->consultarDetalleDenuncia($ID_Denuncia);
        
        //Se CONSULTA la imagene principal de una denuncia especifica
        $DenunciaImagenPrncipal = $this->Consulta_PanelDenuncia_M->consultarDenunciaImagenPrincipal($ID_Denuncia);

        //Se CONSULTA las imagenes secundarias de una denuncia especifica
        $DenunciaImagenesSecundarias = $this->Consulta_PanelDenuncia_M->consultarDenunciaImagenesSecundarias($ID_Denuncia);
        
        // CONSULTA cuantos dias lleva una denuncia especifica
        $diasDenunciaActiva = $this->Consulta_PanelDenuncia_M->diasDenunciaActivaEspecifica($ID_Denuncia);

        // CONSULTA el suscriptor que realizo una denuncia
        $DenunciaSuscriptor = $this->Consulta_PanelDenuncia_M->denunciaSuscriptorEspecifica($ID_Denuncia);

        $Datos = [
            'descripcion' => $Denuncia,
            'imagenDenunciaPrincipal' => $DenunciaImagenPrncipal,
            'imagenesDenunciaSecundaria' => $DenunciaImagenesSecundarias,
            'diasDenuncia' => $diasDenunciaActiva, 
            'denunciaSuscriptor' => $DenunciaSuscriptor
        ];
        
        // echo '<pre>';
        // print_r($Datos);
        // echo '</pre>';
        // exit;
        
        $this->vista("header/header_SinMembrete");
        $this->vista("view/detalleDenuncia_V", $Datos);
    }
    
    // muestra formulario para actualizar una denuncia especifica
    public function actualizarDenuncia($ID_Denuncia){
        
        //CONSULTA la informacion de la denuncia determinada
        $InformacionDenuncia = $this->Consulta_PanelDenuncia_M->consultarDescripcionDen($ID_Denuncia);

        //CONSULTAN la imagen principal de la denuncia
        $ImagenPrinDenuncia = $this->Consulta_PanelDenuncia_M->consultarDenunciaImagenPrincipal($ID_Denuncia);
        
        //CONSULTAN las imagenes secundarias de la denuncia
        $ImagenSecDenuncia = $this->Consulta_PanelDenuncia_M->consultarDenunciaImagenesSecundarias($ID_Denuncia);

        $Datos = [
            'ID_Suscriptor' => $_SESSION['ID_Suscriptor'],
            'id_denuncia' => $ID_Denuncia,
            'informacionDenuncia' => $InformacionDenuncia, 
            'imagenPrin' => $ImagenPrinDenuncia, 
            'imagenSec' => $ImagenSecDenuncia,      
        ];

        // echo '<pre>';
        // print_r($Datos);
        // echo '</pre>';
        // exit();
        
        $_SESSION['actualizarDenuncia'] = 1977; 
        //Se crea esta sesion para impedir que se recargue la información enviada por el formulario mandandolo varias veces a la base de datos

        $this->vista('header/header_suscriptor'); 
        $this->vista('suscriptores/suscrip_editar_denuncia_V', $Datos);
    } 
    
    //
    public function recibeDenunciaAgregada(){
        if($_SESSION['agregarDenuncia'] == 1976){// Anteriormente en el metodo "denuncias" se generó la esta sesion; con esto se evita que no se pueda recarga esta página.
            unset($_SESSION['agregarDenuncia']);//se borra la sesión. 

            $Descripcion = $_POST['descripcion'];
            $Ubicacion = $_POST['ubicacion'];
            $Municipio = $_POST['municipio'];	
            $UsuarioSeguimineto = !empty($_POST["usuarioSeguimineto"]) ? $_POST["usuarioSeguimineto"]: 0;

            // echo "Descripcion : " . $Descripcion . '<br>';
            // echo "Ubicacion : " . $Ubicacion . '<br>';
            // echo "Municipio : " . $Municipio . '<br>';
            // echo "UsuarioSeguimineto : " . $UsuarioSeguimineto . '<br>';
            // exit;

            //Se INSERTA la denuncia en BD y se retorna el ID de la inserción 
            //$_SESSION["ID_Suscriptor"] sesion creada en Login_C/ValidarSesion
            $ID_Denuncia = $this->Consulta_PanelDenuncia_M->InsertarDenuncia($_SESSION["ID_Suscriptor"], $Descripcion, $Ubicacion, $Municipio);

            // echo '<pre>';
            // print_r($ID_Denuncia);
            // echo '</pre>';
            // exit;

            // INSERTAR IMAGEN PRINCIPAL DENUNCIA
            //Si existe imagenDenunciaPrincipal y tiene un tamaño correcto se procede a recibirla y guardar en BD
            if($_FILES['imagenDenunciaPrincipal']["name"] != ""){
                $Nombre_imagenDenunciaPrincipal = $_FILES['imagenDenunciaPrincipal']['name'];
                $Tipo_imagenDenunciaPrincipal = $_FILES['imagenDenunciaPrincipal']['type'];
                $Tamanio_imagenDenunciaPrincipal = $_FILES['imagenDenunciaPrincipal']['size'];
                $Temporal_imagenDenunciaPrincipal= $_FILES['imagenDenunciaPrincipal']['tmp_name'];
                // echo "Nombre_imagen : " . $Nombre_imagenDenunciaPrincipal . '<br>';
                // echo "Tipo_imagen : " . $Tipo_imagenDenunciaPrincipal . '<br>';
                // echo "Tamanio_imagen : " . $Tamanio_imagenDenunciaPrincipal . '<br>';
                // echo "Temporal_imagen : " . $Temporal_imagenDenunciaPrincipal . '<br>';
                // exit;

                //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
                $Nombre_imagenDenunciaPrincipal = preg_replace('([^A-Za-z0-9.])', '', $Nombre_imagenDenunciaPrincipal);

                // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
                $Nombre_imagenDenunciaPrincipal = mt_rand() . '_' . $Nombre_imagenDenunciaPrincipal;

                //Se INSERTA la imagen principal de la denuncia en BD
                $this->Consulta_PanelDenuncia_M->InsertarImagenlDenuncia($ID_Denuncia, $Nombre_imagenDenunciaPrincipal, $Tipo_imagenDenunciaPrincipal, $Tamanio_imagenDenunciaPrincipal);
            
                // INSSERTA IMAGEN PRINCIPAL DE NOTICIA EN SERVIDOR
                // se comprime y se inserta el archivo en el directorio de servidor 
                $Bandera = 'ImagenDenuncia';
                $this->Comprimir->index($Bandera, $Nombre_imagenDenunciaPrincipal, $Tipo_imagenDenunciaPrincipal,$Tamanio_imagenDenunciaPrincipal, $Temporal_imagenDenunciaPrincipal);
            }

            //INSERTAR IMAGENES SECUNDARIAS DENUNCIA
            if($_FILES['imagenesDenunciaSecundaria']['name'][0] != ''){
                $Cantidad = count($_FILES['imagenesDenunciaSecundaria']['name']);
                for($i = 0; $i < $Cantidad; $i++){
                    //nombre original del fichero en la máquina cliente.
                    $Nombre_imagenSecundaria = $_FILES['imagenesDenunciaSecundaria']['name'][$i];
                    $Ruta_Temporal_imagenSecundaria = $_FILES['imagenesDenunciaSecundaria']['tmp_name'][$i];
                    $tipo_imagenSecundaria = $_FILES['imagenesDenunciaSecundaria']['type'][$i];
                    $tamanio_imagenSecundaria = $_FILES['imagenesDenunciaSecundaria']['size'][$i];
                    // echo "Nombre_imagen : " . $Nombre_imagenSecundaria . '<br>';
                    // echo "Tipo_imagen : " .  $Ruta_Temporal_imagenSecundaria . '<br>';
                    // echo "Tamanio_imagen : " .  $tipo_imagenSecundaria . '<br>';
                    // echo "Tamanio_imagen : " .  $tamanio_imagenSecundaria . '<br>';
                    // exit;
                    
                    if($this->Servidor == 'Remoto'){
                        //Usar en remoto
                        $directorio_3 = $_SERVER['DOCUMENT_ROOT'] . '/public/images/denuncias/';
                    }
                    else{
                        //usar en local
                        $directorio_3 = $_SERVER['DOCUMENT_ROOT'] . '/proyectos/NoticieroYaracuy/public/images/denuncias/';
                    }

                    //Subimos el fichero al servidor
                    move_uploaded_file($Ruta_Temporal_imagenSecundaria, $directorio_3.$_FILES['imagenesDenunciaSecundaria']['name'][$i]);

                    $ImagenPrincipal = 0;

                    //Se INSERTAN las imagenes secundarias de la noticia
                    $this->Consulta_PanelDenuncia_M->InsertarImagenlDenuncia($ID_Denuncia, $Nombre_imagenSecundaria, $tipo_imagenSecundaria, $tamanio_imagenSecundaria, $ImagenPrincipal);
                }

                //Se consulta el correo a donde llegara la notificación de nueva denuncia
                $CorreoAdmin = $this->Consulta_PanelDenuncia_M->ConsultaCorreoAdministrador();       
                // echo $CorreoAdmin['correoAdmin'];
                // exit();
                
                //Se envia al correo la notificación de nueva denuncia introducida
                $email_subject = 'Nueva denuncia de usuario'; 
                $email_to = $CorreoAdmin['correoAdmin']; 
                $headers = 'From: NoticieroYaracuy<administrador@noticieroyaracuy.com>';
                $email_message = $Descripcion . '; ' . $Ubicacion . '; ' . $Municipio . '; ';
                
                mail($email_to, $email_subject, $email_message, $headers); 
            }

            $this->index($_SESSION['ID_Suscriptor']);
            die();
        }
        else{ 
            $this->index($_SESSION['ID_Suscriptor']);
        } 
    }
    
    //recibe formulario que actualiza una denuncia
    public function recibeAtualizarDenuncia(){
        if($_SESSION['actualizarDenuncia'] == 1977){// Anteriormente en el metodo "actualizarDenuncia" se generó la esta sesion; con esto se evita que no se pueda recarga esta página.
            unset($_SESSION['actualizarDenuncia']);//se borra la sesión. 

            //Se reciben todos los campos del formulario, se verifica que son enviados por POST y que no estan vacios
            if($_SERVER['REQUEST_METHOD'] == 'POST'&& !empty($_POST['descripcion']) && !empty($_POST['ubicacion']) && !empty($_POST['municipio']) && !empty($_POST['solucionado']) || $_POST['fecha']){

                //Recibe datos de la denuncia a actualizar
                $RecibeDenuncia = [
                    'id_denuncia' => $_POST['id_denuncia'],
                    'descripcion' => $_POST['descripcion'],
                    'ubicacion' => $_POST['ubicacion'],
                    'municipio' => $_POST['municipio'],
                    // 'Descripcion' => preg_replace('[\n|\r|\n\r|\]','',$_POST, "descripcion", ), //evita los saltos de lineas realizados por el usuario al separar parrafos
                    'solucionado' => $_POST["solucionado"],
                    'fecha' => $_POST["fecha"],
                ];
                
                // echo '<pre>';
                // print_r($RecibeDenuncia);
                // echo '</pre>';
                // exit;
            }
            else{
                echo 'Llene todos los campos obligatorios' . '<br>';
                echo '<a href="javascript: history.go(-1)">Regresar</a>';
                exit();
            }

            //IMAGEN PRINCIPAL
            // ********************************************************
            // Si se selecionó alguna nueva imagen
            if(!empty($_FILES['imagenPrinci_Denuncia']["name"]) != ''){
                $nombre_imgDenunciaActualizar = $_FILES['imagenPrinci_Denuncia']['name'];
                $tipo_imgDenunciaActualizar = $_FILES['imagenPrinci_Denuncia']['type'];
                $tamanio_imgDenunciaActualizar = $_FILES['imagenPrinci_Denuncia']['size'];
                $Temporal_imgDenunciaActualizar = $_FILES['imagenPrinci_Denuncia']['tmp_name'];

                // echo "Nombre de la imagen = " . $nombre_imgDenunciaActualizar . "<br>";
                // echo "Tipo de archivo = " . $tipo_imgDenunciaActualizar .  "<br>";
                // echo "Tamaño = " . $tamanio_imgDenunciaActualizar . "<br>";
                // echo "Temporal = " .  $Temporal_imgDenunciaActualizar . "<br>";
                // exit;
                    
                //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
                $nombre_imgDenunciaActualizar = preg_replace('([^A-Za-z0-9.])', '', $nombre_imgDenunciaActualizar);

                // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
                $nombre_imgDenunciaActualizar = mt_rand() . '_' . $nombre_imgDenunciaActualizar;

                // ACTUALIZA IMAGEN PRINCIPAL DE NOTICIA EN SERVIDOR
                // se comprime y se inserta el archivo en el directorio de servidor 
                $Bandera = 'ImagenDenuncia';
                $this->Comprimir->index($Bandera, $nombre_imgDenunciaActualizar, $tipo_imgDenunciaActualizar, $tamanio_imgDenunciaActualizar, $Temporal_imgDenunciaActualizar);

                //Se ACTUALIZA la fotografia principal del producto en BD
                $this->Consulta_PanelDenuncia_M->actualizarImagenPrincipalDenuncia($RecibeDenuncia['id_denuncia'], $nombre_imgDenunciaActualizar, $tipo_imgDenunciaActualizar, $tamanio_imgDenunciaActualizar);
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
                    $this->Consulta_PanelDenuncia_M->insertaImagenSecundariaProducto($RecibeDenuncia['ID_Producto'], $Nombre_imagenSecundaria, $tipo_imagenSecundaria, $tamanio_imagenSecundaria);
                }
            }
        
            // Se actualizan los datos de la denuncia en la BD
            $this->Consulta_PanelDenuncia_M->actualizarDenuncia($RecibeDenuncia);

            $this->index($_SESSION['ID_Suscriptor']);
        }
        else{ 
            $this->index($_SESSION['ID_Suscriptor']);
        } 
    }
    
    public function eliminarDenuncia($ID_Denuncia){
        
        // *************************************************************************************
        //La siguientes cinco consultas entran en el procedimeinto para ELIMINAR un producto de una tienda, esto debe hacerse mediante transacciones
        // *************************************************************************************
        // *************************************************************************************

        //Se consulta el nombre de las imagenes de la denuncia
        $ImagenesEliminar = $this->Consulta_PanelDenuncia_M->consultarImagenesDenunciaEliminar($ID_Denuncia);
        // echo $_SESSION['ID_Suscriptor'] . '<br>';
        // echo '<pre>';
        // print_r($ImagenesEliminar);
        // echo '</pre>';
        // exit;
        
        //Se eliminan los archivo del servidor, ubicados en la carpeta public/images/denunciass
        foreach($ImagenesEliminar as $KeyImagenes)  :
            $NombreImagenEliminar = $KeyImagenes['nombre_imgDenuncia'];

            if($this->Servidor == 'Remoto'){
                //Usar en remoto
                unlink($_SERVER['DOCUMENT_ROOT'] . '/public/images/denuncias/' . $NombreImagenEliminar);
            }
            else{
                //usar en local
                unlink($_SERVER['DOCUMENT_ROOT'] . '/proyectos/noticieroyaracuy/public/images/denuncias/' . $NombreImagenEliminar);
            }
        endforeach;
        
        $this->Consulta_PanelDenuncia_M->eliminarDenuncia($ID_Denuncia);
        $this->Consulta_PanelDenuncia_M->eliminarImagenesDenuncia($ID_Denuncia);
            
        // *************************************************************************************
        // *************************************************************************************

        $this->index($_SESSION['ID_Suscriptor']);
    }
}
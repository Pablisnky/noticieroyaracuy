<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suscriptor_M; 
use Illuminate\Support\Facades\DB;

use App\Traits\ServidorUse;
use App\Traits\Comprimir_Imagen;

class SuscriptorController extends Controller
{
    use ServidorUse; //Traits
    use Comprimir_Imagen; //Traits
    
    private $Comprimir;
    private $Servidor;
    
    //CONSULTA los datos de un suscriptor especifico (se debe consultar solo el ID)
    public function index($ID_Suscriptor){          
        
        $Suscriptor = Suscriptor_M::
            all()
            ->where('ID_Suscriptor', '=', $ID_Suscriptor)
            ->first();
            return $Suscriptor; 
    } 

    public function suscriptores(){         
        //CONSULTA los datos de todos los suscriptores
        $Suscriptores = Suscriptor_M::
            all();//trae todos los registro de la tabla 
            return $Suscriptores; 
    } 
    
    public function suscriptoresArtistas(){   
        //CONSULTA los datos de todos los suscriptores que tienen portafolio de artista
        $Suscriptores = Suscriptor_M::
            select('ID_Suscriptor','nombreSuscriptor','apellidoSuscriptor','estadoSuscriptor','nombre_imagenPortafolio','paisSuscriptor') 
            ->where('nombre_imagenPortafolio', '!=', '')
            ->get();
            return $Suscriptores; 
    } 
    
    public function suscriptorComerciante($ID_Comerciante){   
        //CONSULTA los datos de todos los comerciantes            
        $Comerciante = DB::connection('mysql_2')
            ->select("SELECT ID_Comerciante, nombreComerciante, apellidoComerciante, telefonoComerciante, municipioComerciante, parroquiaComerciante, pseudonimoComerciante, nombreImgCatalogo, transferenciaComerciante, pago_movilComerciante, paypalComerciante, criptomonedaComerciante, acordadoComerciante
                FROM comerciantes 
                WHERE ID_Comerciante = $ID_Comerciante");  
            return $Comerciante;  
    } 

    public function accesoSuscriptor($ID_Suscriptor){
        return view('modal/modal_suscripInicio_V', [
                'ID_Suscriptor' => $ID_Suscriptor,
            //     'nombre' => $Nombre,
            //     'apellido' => $Apellido,
            //     'clasificados' => $Comerciante,
            //     'obras' => $Cant_Obras,
            //     'denuncias' => $Cant_Denuncias
        ]);
    }
    
    // Carga la vista de perfil del suscriptor
    public function perfil_suscriptor($ID_Suscriptor){       
        
        // CONSULTA toda la información de perfil del suscriptor
        $Suscriptor = Suscriptor_M::
            select('ID_Suscriptor','nombreSuscriptor','apellidoSuscriptor','correoSuscriptor','municipioSuscriptor','parroquiaSuscriptor','pseudonimoSuscripto','nombre_imagenPortafolio','paisSuscriptor','telefonoSuscriptor') 
            ->where('ID_Suscriptor', '=', $ID_Suscriptor)
            ->first();
            // return $Suscriptor; 
        
        // CONSULTA las secciones que tiene el catalogo de un suscriptor 
        // $Secciones = $this->Instancia_Panel_C->SeccionesSuscriptor($ID_Suscriptor);
        
        return view('panel/suscriptores/suscrip_perfil_V', [
            'suscriptor' => $Suscriptor,         
            // 'secciones' => $Secciones,                        
            // 'ID_Suscriptor' => $this->Suscriptor[0]['ID_Suscriptor'],
            // 'nombre' => $this->Suscriptor[0]['nombreSuscriptor'],
            // 'apellido' => $this->Suscriptor[0]['apellidoSuscriptor'],
            // 'Pseudonimmo' => $this->Suscriptor[0]['pseudonimoSuscripto'],
            // 'telefono' => $this->Suscriptor[0]['telefonoSuscriptor'],
        ]);
    } 
           
    // recibe el perfil de un suscriptor que va a publicar un clasificado
    public function actualizarPerfilSuscriptor(Request $Request){
        //Se reciben el campo del formulario, se verifica que son enviados por POST y que no estan vacios
        // if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nombreSuscriptor']) && !empty($_POST['apellidoSuscriptor']) && !empty($_POST['correoSuscriptor']) && !empty($_POST['municipio']) && !empty($_POST['parroquia']) && !empty($_POST['telefono']) && !empty($_POST['pseudonimo']) && (!empty($_POST['transferencia']) || !empty($_POST['pago_movil']) || !empty($_POST['paypal']) || !empty($_POST['zelle']) || !empty($_POST['bolivar']) || !empty($_POST['dolar']) || !empty($_POST['acordado']))){
            
            $RecibeDatosSuscriptor = [
                // 'ID_Suscriptor' => $_SESSION["ID_Suscriptor"], 
                'nombreSuscriptor' => $Request->get('nombreSuscriptor'),
                'apellidoSuscriptor' =>  $Request->get('apellidoSuscriptor'),
                'correoSuscriptor' =>  $Request->get('correoSuscriptor'),
                'pseudonimo' =>  $Request->get('pseudonimo'),
                'municipio' =>  $Request->get("municipio"),
                'parroquia' =>  $Request->get("parroquia"),
                'telefono' =>  $Request->get("telefono"),
                'transferencia' =>  empty($Request->get("transferencia")) ? 0 : 1,
                'pago_movil' =>  empty($Request->get("pago_movil")) ? 0 : 1,
                'paypal' =>  empty($Request->get("paypal")) ? 0 : 1,
                'zelle' =>  empty($Request->get("zelle")) ? 0 : 1,
                'criptomoneda' =>  empty($Request->get("criptomoneda")) ? 0 : 1,
                'efectivo_Bs' =>  empty($Request->get("bolivar")) ? 0 : 1,
                'efectivo_dol' =>  empty($Request->get("dolar")) ? 0 : 1,
                'acordado' =>  empty($Request->get("acordado")) ? 0 : 1,
                'categoria' => $Request->get("categoria")
            ];
            
            // echo '<pre>';
            // print_r($RecibeDatosSuscriptor);
            // echo '</pre>';
            // exit;
            
            //Se actualizan datos del suscriptor
            // $this->ConsultaSuscriptor_M->actualizarDatosSuscriptor($RecibeDatosSuscriptor);
            
            //RECIBE SECCIONES
            // ********************************************************
            //Recibe las secciones por nombre (son las nuevas creadas)
            // if($_POST['seccion'][0] != ''){
            //     foreach($_POST['seccion'] as $Seccion){
            //         $Seccion = $_POST['seccion'];
            //     }
                    
            //     //El array trae elemenos duplicados, se eliminan los duplicado
            //     $SeccionesRecibidas = array_unique($Seccion);

                // echo 'Secciones recibidas';
                // echo '<pre>';
                // print_r($SeccionesRecibidas);
                // echo '</pre>';

                // $SecccionesExistentes = $this->Instancia_Panel_C->SeccionesSuscriptor($_SESSION["ID_Suscriptor"]);

                // echo 'Secciones existentes';
                // echo '<pre>';
                // print_r($SecccionesExistentes);
                // echo '</pre>';
                // exit;
            
                // $Secciones = array_diff($SeccionesRecibidas, $SecccionesExistentes);
                // echo 'Secciones a insertar';
                // echo '<pre>';
                // print_r($Secciones);
                // echo '</pre>';
                // exit();
                
        //         //Se INSERTAN nuevamnete todas las secciones del catalogo, previamente se borrar las existentes
        //         $this->Instancia_Panel_C->eliminarSecciones($_SESSION["ID_Suscriptor"]);
        //         $this->Instancia_Panel_C->insertarSecciones($_SESSION["ID_Suscriptor"], $SeccionesRecibidas);

        //         // Se crea la sesion con el nombre de la tienda
        //         $_SESSION["PseudonimoSuscriptor"] = $_POST['pseudonimo'];
        //     }
        //     else{
        //         echo 'Ingrese al menos una sección';
        //         echo '<br>';
        //         echo "<a href='javascript:history.back()'>Regresar</a>";
        //         exit();
        //     }
                                
            //RECIBE IMAGEN CATALOGO
            // ********************************************************
            // Si se selecionó alguna nueva imagen
            if($_FILES['imagenCatalogo']["name"] != ''){
                $nombre_imgCatalogo = $_FILES['imagenCatalogo']['name'];
                $tipo_imgCatalogo = $_FILES['imagenCatalogo']['type'];
                $tamanio_imgCatalogo = $_FILES['imagenCatalogo']['size'];
                $Temporal_imgCatalogo = $_FILES['imagenCatalogo']['tmp_name'];

                echo "Nombre de la imagen = " . $nombre_imgCatalogo . "<br>";
                echo "Tipo de archivo = " . $tipo_imgCatalogo .  "<br>";
                echo "Tamaño = " . $tamanio_imgCatalogo . "<br>";
                // se muestra el directorio temporal donde se guarda el archivo
                echo $Temporal_imgCatalogo;
                // exit;
                    
                //Quitar de la cadena del nombre de la imagen todo lo que no sean números, letras o puntos
                $nombre_imgCatalogo = preg_replace('([^A-Za-z0-9.])', '', $nombre_imgCatalogo);

                // Se coloca nuumero randon al principio del nombrde de la imagen para evitar que existan imagenes duplicadas
                $nombre_imgCatalogo = mt_rand() . '_' . $nombre_imgCatalogo;

                //Se crea el directorio donde ira la imagen del catalogo
                echo $this->Servidor;
                exit;
                if($this->Servidor == 'Remoto'){
                    // Usar en remoto
                    $CarpetaCatalogo = $_SERVER['DOCUMENT_ROOT'] . '/public/images/clasificados/' . $_SESSION['ID_Suscriptor'] . '/';
                }
                else{
                    // Usar en local
                    $CarpetaCatalogo = $_SERVER['DOCUMENT_ROOT'] . '/proyectos/NoticieroYaracuy/public/images/clasificados/' . $_SESSION['ID_Suscriptor'] . '/';
                }

                if(!file_exists($CarpetaCatalogo)){
                    mkdir($CarpetaCatalogo, 0777, true);
                }  

                // ACTUALIZA IMAGEN DE CATALOGO
                // se comprime y se inserta el archivo en el directorio de servidor 
                $Bandera = 'imagenCatalogo';
                require(RUTA_APP . '/helpers/Comprimir_Imagen.php');
                $Comprimir = new Comprimir_Imagen();

                $Comprimir->index($Bandera, $nombre_imgCatalogo, $tipo_imgCatalogo, $tamanio_imgCatalogo, $Temporal_imgCatalogo);

                //Se actualiza imagen de catalogo 
                $this->ConsultaSuscriptor_M->actualizarImagenCatalogo($RecibeDatosSuscriptor, $nombre_imgCatalogo, $tipo_imgCatalogo, $tamanio_imgCatalogo);
            }

        //     //Se insertan los datos del suscriptor em BD
        //     // $this->InformacionSuscriptor->actualizarNombreComercial($RecibNombreComercial);
        // }
        // else{
        //     echo 'Llene todos los campos obligatorios' . '<br>';
        //     echo '<a href="javascript: history.go(-1)">Regresar</a>';
        //     exit();
        // }
        
        // $this->perfil_suscriptor($_SESSION["ID_Suscriptor"]);
    }
}

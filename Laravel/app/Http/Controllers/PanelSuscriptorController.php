<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PanelMarketplaceController;
use App\Models\Comerciante_M;
use App\Models\Secciones_M;
use App\Models\Suscriptor_M; 
use App\Models\Periodistas_M;

// use Suscriptor_M;

    class PanelSuscriptorController extends Controller{
        private $ConsultaSuscriptor_M;
        private $Suscriptor;
        private $Instancia_Panel_C;
        private $Instancia_PanelMarketplaceController;
		private $Servidor;

        public function __construct(){
            
            $this->Instancia_PanelMarketplaceController = new PanelMarketplaceController();
            
            //Se CONSULTA al controlador Panel_Clasificado_C las secciones existenete en BD
            // require_once(RUTA_APP . "/controladores/Panel_Clasificados_C.php");
            // $this->Instancia_Panel_C = new Panel_Clasificados_C();
            
            //La función ocultarErrores() se encuantra en la carpeta helpers, es accecible debido a que en iniciador.php se realizó el require respectivo
            // ocultarErrores();

			// $this->Servidor = conexionServidor();
        }
    
        //CONSULTA los datos de un suscriptor especifico
        public function index($ID_Suscriptor){          
            
            $this->Suscriptor = $this->ConsultaSuscriptor_M->consultarSuscriptor($ID_Suscriptor);

            // echo "<pre>";
            // print_r($this->Suscriptor);
            // echo "</pre>";
            // exit();

            return $this->Suscriptor;
        } 
        
        // Carga la vista de seleccion de rol, solo se carga la primera vez que el usuario hace login
        public function crear_Rol($ID_Suscriptor, $Bandera){       
            
            // CONSULTA toda la información de perfil del suscriptor
            $Suscriptor = Suscriptor_M::
                all()
                ->where('ID_Suscriptor','=', $ID_Suscriptor)  
                ->first();
                // return gettype($Suscriptor);
                // return $Suscriptor;
           
            if($Bandera == 'suscriptor'){
                echo $Bandera;
                exit;
            }
            else if($Bandera == 'periodista'){

                // se consultan los datos basicos en la tabla suscriptor
                $Suscriptor = Suscriptor_M::
                    all()
                    ->where('ID_Suscriptor','=', session('id_suscriptor'))
                    ->first();
                    // return $Suscriptor;

                //Se cambbia la sesion suscriptor a sesion periodista
                session(['id_periodista' => $Suscriptor->ID_Suscriptor]);
                session(['nombrePeriodista' => $Suscriptor->nombreSuscriptor]);
                session(['apellidoPeriodista' => $Suscriptor->apellidoSuscriptor]);
                session()->forget('id_suscriptor');

                // Se inserta en la tabla periodista los datos basicos del suscriptor nuevo con el rol de periodista
                Periodistas_M::insert(
                    ['ID_Periodista' => $Suscriptor->ID_Suscriptor, 
                    'nombrePeriodista' => $Suscriptor->nombreSuscriptor,
                    'apellidoPeriodista' => $Suscriptor->apellidoSuscriptor,
                    'correoPeriodista' =>  $Suscriptor->correoSuscriptor
                    ]
                );

                return redirect()->route("Perfil_periodista", ['id_periodista' => session('id_periodista')]);
                die();
            }
            else if($Bandera == 'comerciante'){

                // se consultan los datos basicos en la tabla suscriptor
                $Suscriptor = Suscriptor_M::
                    all()
                    ->where('ID_Suscriptor','=', session('id_suscriptor'))
                    ->first();
                    // return $Suscriptor;

                //Se cambbia la sesion suscriptor a sesion comerciante
                session(['id_comerciante' => $Suscriptor->ID_Suscriptor]);
                session(['nombreComerciante' => $Suscriptor->nombreSuscriptor]);
                session(['apellidoComerciante' => $Suscriptor->apellidoSuscriptor]);
                session()->forget('id_suscriptor');

                // Se inserta en la tabla comerciante los datos basicos del suscriptor nuevo con el rol de comerciante
                DB::connection('mysql_2')
                    ->insert('INSERT INTO comerciantes (ID_Comerciante, nombreComerciante, apellidoComerciante, correoComerciante) VALUES (?,?,?,?)', [$Suscriptor->ID_Suscriptor, $Suscriptor->nombreSuscriptor, $Suscriptor->apellidoSuscriptor, $Suscriptor->correoSuscriptor] );

                return redirect()->route("Perfil_comerciante", ['id_comerciante' => session('id_comerciante')]);
                die();
            }
            else if($Bandera == 'artista'){
                echo $Bandera;
                exit;
            }
            else if($Bandera == 'profesional'){
                echo $Bandera;
                exit;
            }
            else if($Bandera == 'medico'){

                // se consultan los datos basicos en la tabla suscriptor
                $Suscriptor = Suscriptor_M::
                    all()
                    ->where('ID_Suscriptor','=', session('id_suscriptor'))
                    ->first();
                    // return $Suscriptor;

                //Se cambbia la sesion suscriptor a sesion medico
                session(['id_medico' => $Suscriptor->ID_Suscriptor]);
                session(['nombreMedico' => $Suscriptor->nombreSuscriptor]);
                session(['apellidoMedico' => $Suscriptor->apellido_Suscriptor]);
                session()->forget('id_suscriptor');

                // Se inserta en la tabla medico_especialista los datos basicos del suscriptor nuevo con el rol de medico
                DB::connection('mysql_2')
                    ->insert('INSERT INTO medico_especialista (ID_Especialista, nombre_Especialista, apellido_Especialista, correo_Especialista) VALUES (?,?,?,?)', [$Suscriptor->ID_Suscriptor, $Suscriptor->nombreSuscriptor, $Suscriptor->apellidoSuscriptor, $Suscriptor->correoSuscriptor] );

                return redirect()->route("Perfil_medico", ['id_medico' => session('id_medico')]);
                die();
            }
        } 
        
        //carga el dashboard de suscriptores
        public function accesoSuscriptor($ID_Suscriptor){
            // if(!empty($_SESSION['ID_Suscriptor'])){
                //Se consultan datos del suscriptor
                // $Suscriptor = $this->ConsultaSuscriptor_M->consultarSuscriptor($ID_Suscriptor);
                
                //Se CONSULTA al controlador Panel_Clasificado_C la cantidad de productos publicados que tiene el suscriptor.
                $CantidadProductos = $this->Instancia_PanelMarketplaceController->clasificadoSuscriptor($ID_Suscriptor);
                // return $CantidadProductos;

                //Se comunica con al controlador PanelDenunciasController
                // require_once(RUTA_APP . "/controladores/PanelDenunciasController.php");
                // $this->Instancia_PanelDenuncia_C = new PanelDenunciasController();
                
                //Se CONSULTA al controlador PanelDenunciasController la cantidad de denuncias que ha realizado el suscriptor.
                // $Denuncias = $this->Instancia_PanelDenuncia_C->denunciasSuscriptor($ID_Suscriptor);

                //CONSULTA cuantos comentarios ha realizado un suscriptor
                // $Comentarios = $this->ConsultaSuscriptor_M->consultarComentarios($ID_Suscriptor);

                // $Datos = [
                //     'ID_Suscriptor' => $Suscriptor[0]['ID_Suscriptor'],
                //     'nombre' => $Suscriptor[0]['nombreSuscriptor'],
                //     'apellido' => $Suscriptor[0]['apellidoSuscriptor'],
                //     'Pseudonimmo' => $Suscriptor[0]['pseudonimoSuscripto'],
                //     'telefono' => $Suscriptor[0]['telefonoSuscriptor'],
                //     'clasificados' => $CantidadProductos,
                //     'denuncias' => $Denuncias ,
                //     'comentarios' => $Comentarios
                // ];

                // echo "<pre>";
                // print_r($Datos);
                // echo "</pre>";
                // exit;

                return view('modal/modal_suscripInicio_V', [
                    //     'ID_Suscriptor' => $ID_Suscriptor,
                    //     'nombre' => $Nombre,
                    //     'apellido' => $Apellido,
                        'marketplace' => $CantidadProductos,
                    //     'obras' => $Cant_Obras,
                    //     'denuncias' => $Cant_Denuncias
                ]);
            // }
            // else{
            //     header('location:' . RUTA_URL . '/CerrarSesion_C');
            //     die();
            // }
        }

        //CONSULTA los datos de todos los suscriptores
        public function suscriptores(){          

            $Suscriptor = $this->ConsultaSuscriptor_M->consultarTodosSuscriptor();

            // echo "<pre>";
            // print_r($Suscriptor);
            // echo "</pre>";
            // exit();

            return $Suscriptor;
        } 
                
        //recibe el nombre comercial, telefono y formas de pago de un suscriptor que va a publicar un clasificado
        public function actualizaNombreComercial(){
            //Se reciben el campo del formulario, se verifica que son enviados por POST y que no estan vacios
            if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['nombreSuscriptor']) && !empty($_POST['apellidoSuscriptor']) && !empty($_POST['correoSuscriptor']) && !empty($_POST['municipio']) && !empty($_POST['parroquia']) && !empty($_POST['telefono']) && !empty($_POST['pseudonimo']) && (!empty($_POST['transferencia']) || !empty($_POST['pago_movil']) || !empty($_POST['paypal']) || !empty($_POST['zelle']) || !empty($_POST['bolivar']) || !empty($_POST['dolar']) || !empty($_POST['acordado']))){
                $RecibeDatosSuscriptor = [
                    'ID_Suscriptor' => $_SESSION["ID_Suscriptor"], 
                    'nombreSuscriptor' =>  $_POST["nombreSuscriptor"],
                    'apellidoSuscriptor' =>  $_POST['apellidoSuscriptor'],
                    'correoSuscriptor' =>  $_POST['correoSuscriptor'],
                    'pseudonimo' =>  $_POST['pseudonimo'],
                    'municipio' =>  $_POST["municipio"],
                    'parroquia' =>  $_POST["parroquia"],
                    'telefono' =>  $_POST["telefono"],
                    'transferencia' =>  empty($_POST["transferencia"]) ? 0 : 1,
                    'pago_movil' =>  empty($_POST["pago_movil"]) ? 0 : 1,
                    'paypal' =>  empty($_POST["paypal"]) ? 0 : 1,
                    'zelle' =>  empty($_POST["zelle"]) ? 0 : 1,
                    'criptomoneda' =>  empty($_POST["criptomoneda"]) ? 0 : 1,
                    'efectivo_Bs' =>  empty($_POST["bolivar"]) ? 0 : 1,
                    'efectivo_dol' =>  empty($_POST["dolar"]) ? 0 : 1,
                    'acordado' =>  empty($_POST["acordado"]) ? 0 : 1,
                    'categoria' => $_POST["categoria"]
                ];
                
                // echo '<pre>';
                // print_r($RecibeDatosSuscriptor);
                // echo '</pre>';
                // exit;
                
                //Se actualizan datos del suscriptor
                $this->ConsultaSuscriptor_M->actualizarDatosSuscriptor($RecibeDatosSuscriptor);
                
                //RECIBE SECCIONES
                // ********************************************************
                //Recibe las secciones por nombre (son las nuevas creadas)
                if($_POST['seccion'][0] != ''){
                    foreach($_POST['seccion'] as $Seccion){
                        $Seccion = $_POST['seccion'];
                    }
                        
                    //El array trae elemenos duplicados, se eliminan los duplicado
                    $SeccionesRecibidas = array_unique($Seccion);

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
                    
                    //Se INSERTAN nuevamnete todas las secciones del catalogo, previamente se borrar las existentes
                    $this->Instancia_Panel_C->eliminarSecciones($_SESSION["ID_Suscriptor"]);
                    $this->Instancia_Panel_C->insertarSecciones($_SESSION["ID_Suscriptor"], $SeccionesRecibidas);

                    // Se crea la sesion con el nombre de la tienda
                    $_SESSION["PseudonimoSuscriptor"] = $_POST['pseudonimo'];
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

                //Se insertan los datos del suscriptor em BD
                // $this->InformacionSuscriptor->actualizarNombreComercial($RecibNombreComercial);
            }
            else{
                echo 'Llene todos los campos obligatorios' . '<br>';
                echo '<a href="javascript: history.go(-1)">Regresar</a>';
                exit();
            }
            
            // $this->perfil_suscriptor($_SESSION["ID_Suscriptor"]);
        }

        public function consultarFormasPago($ID_Suscriptor){            
            //Se consultan datos del suscriptor
            $MetodoPago = $this->ConsultaSuscriptor_M->consultarMetodoPago($ID_Suscriptor);
            
            // echo "<pre>";
            // print_r($MetodoPago);
            // echo "</pre>";
            // exit();

            return $MetodoPago;
        }
        
        // muestra las tiendas de una categoria especifica
        public function categoria($NombreCategoria){
            
            //Se CONSULTA tiendas en una misma categria
             $TiendasCategorias = $this->ConsultaSuscriptor_M->consultarTiendasCategorias($NombreCategoria);
           
            $Datos = [
                'tiendasCategorias' => $TiendasCategorias, //
            ];

            // echo "<pre>";
            // print_r($Datos);
            // echo "</pre>";          
            // exit();
            
            $this->vista("header/header_noticia"); 
            $this->vista("view/CatalogosCategoria_V", $Datos ); 
        }
    }
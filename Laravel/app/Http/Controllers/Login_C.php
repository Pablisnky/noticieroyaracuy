<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suscriptor_M; 
use App\Models\Periodistas_M; 
use App\Models\PeriodistaPasword_M;
use App\Models\SuscriptorPasword_M; 
use App\Models\CodigoRecuperacion_M;

class Login_C extends Controller
{
    //Muestra el formulario de login, si no existe una sesión abierta
    public function index($ID_Noticia, $Bandera, $ID_Comentario){
        if(!empty($_SESSION['ID_Periodista'])){ 
            // header('Location:'. RUTA_URL . '/Panel_C/portadas');
            die(); 
        }
        else{
            // $ID_Comentario = !empty($ID_Comentario) ? $ID_Comentario: 'SinID_Comentario';

            // echo "ID_Noticia =" .  $ID_Noticia ."<br>";
            // echo "BAndera =" .  $Bandera ."<br>";
            // echo "ID_Comentario =" .  $ID_Comentario ."<br>";
            // exit;

            // unset($_COOKIE ["id_periodista"]);
            // unset($_COOKIE ["clave"]);
            //Se verifica si el usuario esta memorizado en las cookie de su computadora y las compara con la BD, para recuperar sus datos y autorellenar el formulario de inicio de sesion, las cookies de registro de usuario se crearon en validarSesion.php
            
            // echo "Cookie periodista =" . $_COOKIE["id_periodista"] ."<br>";
            // echo "Cookie clave =" .  $_COOKIE["clave"] ."<br>";
            // exit;

            if(isset($_COOKIE["id_periodista"]) AND isset($_COOKIE["clave"])){//Si la variable $_COOKIE esta establecida o creada

                // $Cookie_id_periodista = $_COOKIE["id_periodista"];
                // $Cookie_clave = $_COOKIE["clave"];

                //Se CONSULTA el correo guardado como Cookie con el id_periodista como argumento, se consulta en todos los tipos de usuario que existe
                // $CorreoPeriodista = $this->ConsultaLogin_M->consultarPeriodistaRecordado($Cookie_id_periodista);

                // if(!empty($CorreoRecord_Com)){
                //     $Correo = $CorreoPeriodista[0]['correo_AfiCom'];
                // }

                // $Datos=[
                //     'correoRecord' => $CorreoPeriodista,
                //     'claveRecord' => $Cookie_clave,
                //     // 'bandera' => $Bandera
                // ];
                
                // echo "<pre>";
                // print_r($Datos);
                // echo "</pre>";
                // exit();

                //Se entra al formulario de sesion que esta rellenado con los datos del usuario
                // $this->vista("header/header_noticia");
                // $this->vista("view/login_Vrecord", $Datos);
            }
            else if($Bandera == 'comentar' || $Bandera == 'panelSuscriptor'){//Entra cuando viene de una noticia y desea hacer comentario o cambio de contraseña

                return view('login_V', ['id_noticia' => $ID_Noticia, 'id_comentario' => $ID_Comentario, 'bandera' => $Bandera]);
            }
            else if($Bandera == 'responder'){//Entra cuando viene de una noticia y desea responder un comentario existente
                
                return view('login_V', ['id_noticia' => $ID_Noticia, 'id_comentario' => $ID_Comentario, 'bandera' => $Bandera]);
            }
            else if($Bandera == 'denuncia'){//Bamdera creada en Contraloria_C/VerificaLogin Entra cuando se desea realizar una denuncia

                // $Datos=[
                //     'id_noticia' => 'SinID_Denuncia',
                //     'id_comentario' => 'SinID_Comentario',
                //     'bandera' => $Bandera
                // ];

                // echo "<pre>";
                // print_r($Datos);
                // echo "</pre>";
                // exit();

                //carga la vista login_V en formulario login
                // $this->vista("header/header_noticia");
                // $this->vista("view/login_V", $Datos);
            }
            else{
                return view('login_V', [
                    'id_noticia' => $ID_Noticia, 
                    'id_comentario' => $ID_Comentario, 
                    'bandera' => $Bandera
                ]);
            }
        }
       
    }
    
    // recibe y verifica información de ingreso enviada por el usuario e inicia sesion
    public function ValidarSesion(Request $Request){
        $CorreoEnviado = strtolower($Request->get('correo_Arr'));
        $ClaveEnviada = $Request->get('clave_Arr'); 
        $Bandera = $Request->get('bandera');
        // echo $CorreoEnviado . '<br>';
        // echo $ClaveEnviada . '<br>';
        // echo $Bandera . '<br>';
        // exit;
        
        if(!empty($CorreoEnviado) AND empty(!$ClaveEnviada)){
            
            //Se CONSULTA si el correo existe como suscritor
            $Suscriptor = Suscriptor_M::
                    where('correoSuscriptor','=', $Request->get('correo_Arr'))
                    ->first();
                    // echo gettype($Suscriptor);
                    // return $Suscriptor;
                    
            //Se CONSULTA si el correo existe como periodista
            $Periodista = Periodistas_M::
                where('correoPeriodista','=', $Request->get('correo_Arr'))
                ->first();
                // return $Periodista = $Periodista == null ? null : $Periodista;
                        
            // $Datos = ['suscriptor' => $Suscriptor, 'periodista' => $Periodista];
            // return $ID_Periodista;
            
            // EXISTE COMO SUSCRIPTOR
            if($Suscriptor != null){
                
                $ID_Suscriptor =  $Suscriptor->ID_Suscriptor; 
                $Correo_BD =  $Suscriptor->correoSuscriptor;
                
                //Se CONSULTA la contraseña guardada en BD, para verificar que sea igual a la contraseña de la BD
                $Contrasenia_BD = SuscriptorPasword_M::
                    select('claveCifrada')
                    ->where('ID_Suscriptor','=', $ID_Suscriptor)
                    ->first();                    
                    // return $Contrasenia_BD;
                    
                // LOGEADO Y REDIRECIONAMIENTO
                //se descifra la contraseña con un algoritmo de desencriptado.
                if($CorreoEnviado == $Correo_BD AND $ClaveEnviada == password_verify($ClaveEnviada, $Contrasenia_BD->claveCifrada)){

                    //Se crea la sesion exigida en las páginas de cuentas de usuarios           
                    session(['id_suscriptor' =>  $Suscriptor->ID_Suscriptor]);
                    session(['nombreSuscriptor' => $Suscriptor->nombreSuscriptor]);
                    session(['apellidoSuscriptor' => $Suscriptor->apellidoSuscriptor]);                
                    session(['PseudonimoSuscriptor' =>  $Suscriptor->pseudonimoSuscripto]);

                    // echo session('nombreSuscriptor') . '<br>';
                    // echo session('apellidoSuscriptor') . '<br>';
                    // echo session('PseudonimoSuscriptor') . '<br>';
                    // exit;
                    
                    if($Bandera == 'comentar'){// si va a hacer un comentario en una noticia y esta logeado
                        // header('Location:'. RUTA_URL . '/Noticias_C/detalleNoticia/'.$ID_Noticia.',sinAnuncio,#ContedorComentario');
                        die();
                    }
                //     else if($Bandera == 'SinLogin'){// si va a hacer un comentario y esta logeado
                //         header('Location:'. RUTA_URL . '/Noticias_C/detalleNoticia/'.$ID_Noticia.',sinAnuncio,#ContedorComentario');
                //         die();
                //     }
                //     else if($Bandera == 'responder'){// si va a responder un comentario y esta logeado
                //         header('Location:'. RUTA_URL . '/Noticias_C/detalleNoticia/'.$ID_Noticia.',sinAnuncio,#'.$ID_Comentario);
                //         die();
                //     }
                //     else if($Bandera == 'denuncia'){// si va a realizar una denuncia
                //         header('Location:'. RUTA_URL . '/Contraloria_C/denuncias');
                //         die();
                //     }
                    else if($Bandera == 'sin_bandera'){// entra al panel de suscriptor
                        
                        //Se CONSULTA al controlador Panel_Clasificados_C la cantidad de anuncios clasificados que tiene el suscriptor.
                        // require_once(RUTA_APP . "/controladores/Panel_Clasificados_C.php");
                        // $DatosComerciante = new Panel_Clasificados_C();
                        // $Comerciante = $DatosComerciante->clasificadoSuscriptor($ID_Suscriptor);

                        // //Se CONSULTA al controlador Panel_Artista_C la cantidad de obras que tiene el suscriptor.
                        // require_once(RUTA_APP . "/controladores/Panel_Artista_C.php");
                        // $Obras = new Panel_Artista_C();
                        // $Cant_Obras = $Obras->cantidadObras($ID_Suscriptor);
                        
                        // //Se CONSULTA al controlador Panel_Denuncias_C la cantidad de denunucias que ha realizado el suscriptor.
                        // require_once(RUTA_APP . "/controladores/Panel_Denuncias_C.php");
                        // $Denuncias = new Panel_Denuncias_C();
                        // $Cant_Denuncias = $Denuncias->denunciasSuscriptor($ID_Suscriptor);
                        
                        return view('panel/suscriptores/suscrip_Inicio_V', [
                            //     'ID_Suscriptor' => $ID_Suscriptor,
                            //     'nombre' => $Nombre,
                            //     'apellido' => $Apellido,
                            //     'clasificados' => $Comerciante,
                            //     'obras' => $Cant_Obras,
                            //     'denuncias' => $Cant_Denuncias
                        ]);
                    }
                }
                else{ //en caso de clave o usuario incorrecto
                    return view('modal/modal_falloLogin_V');
                }
            }
                // EXISTE COMO PERIODISTA
            if(!empty($Periodista)){
                
                $ID_Periodista =  $Periodista->ID_Periodista; 
                $Correo_BD =  $Periodista->correoPeriodista;

                //Se CONSULTA la contraseña guardada en BD, para verificar que sea igual a la contraseña de la BD
                $Contrasenia_BD = PeriodistaPasword_M::
                    select('claveCifrada')
                    ->where('ID_Periodista','=', $ID_Periodista)
                    ->first();                    
                    // return $Contrasenia_BD;

                // LOGEADO Y REDIRECIONAMIENTO
                //se descifra la contraseña con un algoritmo de desencriptado.
                if($CorreoEnviado == $Correo_BD AND $ClaveEnviada == password_verify($ClaveEnviada, $Contrasenia_BD->claveCifrada)){

                    //Se crea la sesion exigida en las páginas de cuentas de usuarios
                    session(['nombreSuscriptor' => $Periodista->nombrePeriodista]);
                    session(['apellidoSuscriptor' => $Periodista->apellidoPeriodista]);                
                    session(['id_periodista' =>  $ID_Periodista]);

                    // echo session('nombreSuscriptor') . '<br>';
                    // echo session('apellidoSuscriptor') . '<br>';
                    // echo session('id_periodista') . '<br>';
                    // exit;

                    //Se crean las cookies para recordar al usuario en caso de que $Recordar exista
                    // if($Recordar == 1){
                    //     // Se introduce una cookie en el ordenador del usuario con el identificador del usuario y la cookie aleatoria porque el usuario marca la casilla de recordar
                    //     setcookie('id_periodista', $ID_Periodista, time()+365*24*60*60);
                    //     setcookie('clave', $Clave, time()+365*24*60*60);
                    // }
                        // Se destruyen las cookie para dejar de recordar a usuario
                    // if($No_Recordar == 1){
                    //     setcookie('id_usuario','',time() - 3600,'/');
                    //     setcookie('clave','',time() - 3600,'/');
                    // }

                    return redirect()->action([PanelPeriodista_C::class,'index']);   
                    die();
                }
                else{ //en caso de clave incorrecta
                    return view('modal/modal_falloLogin_V');
                }
            }   
            else{ //en caso de clave o usuario incorrecto
                return view('modal/modal_falloLogin_V');
            }
        }
        else{ //en caso de clave o usuario incorrecto
            return view('modal/modal_falloLogin_V');
        }
    }

    // Muestra formulario para solicitar cambio de clave
    public function solicitudNuevaCLave(){
        return view('modal/modal_recuperarCorreo_V', [
            'bandera' => 'solicitarCambio'
        ]);
    }

    // Envia codigo de recuperacion de contraseña al correo suministrado por el usuario
    public function recuperar_Clave(Request $Request){
        $Correo = strtolower($Request->get('correo'));
        // echo 'Correo= ' . $Correo . '<br>';
        
        //Se genera un numero aleatorio que será el código de recuperación de contraseña
        //alimentamos el generador de aleatorios
        mt_srand (time());

        //generamos un número aleatorio
        $Aleatorio = mt_rand(100000,999999);
        
        $Fecha = date("Y-m-d"); 
        $Hora = date("h:i a");
        // echo $Fecha . '<br>';
        // echo $Hora . '<br>';
        // exit;

        //Se INSERTA el código aleatorio en la tabla "codigo-recuperacion" para asociarlo al correo del usuario
        CodigoRecuperacion_M::insert(
            ['correo' => $Correo, 
            'codigoAleatorio' => $Aleatorio,
            'codigoVerificado' => 0,
            'fechaSolicitud' => $Fecha,
            'horaSolicitud' => $Hora
            ]
        );

        //Se envia correo al usuario informandole el código que debe insertar para verificar
        // $email_subject = 'Recuperación de contraseña';
        // $email_to = $Correo;
        // $headers = 'From: NoticieroYaracuy<administrador@noticieroyaracuy.com>';
        // $email_message = 'Código de recuperación de contraseña: ' . $Aleatorio;

        //     //  echo $email_to . '<br>';
        //     //  echo $email_subject . '<br>';
        //     //  echo $email_message . '<br>';
        //     //  echo $headers . '<br>';
        // mail($email_to, $email_subject, $email_message, $headers);

        return view('modal/modal_recuperarCorreo_V', [
            'correo' => $Correo,
            'bandera' => 'aleatorioinsertado'
        ]);
    }

    //LLamado desde modal_recuperarCorreo_V.php
    public function recibeCodigoRecuperacion(Request $Request){
        $CodigoUsuario = $Request->get('ingresarCodigo');
        $Correo = strtolower($Request->get('correo'));
        // echo 'CodigoUsuario= ' . $CodigoUsuario . '<br>';
        // echo 'Correo= ' . $Correo . '<br>';
        // exit;

        // EL numero aleatorio es de tipo string se debe cambiar a entero
        // echo gettype($CodigoUsuario) . "<br>";
        settype($CodigoUsuario,"integer");
        // echo gettype($CodigoUsuario) . "<br>";

        //Se comprueba el código enviado por el usuario con el código que hay en la BD
        $VerificaCodigo = CodigoRecuperacion_M::
            select('codigoAleatorio','codigoVerificado')  
            ->where('correo', '=', $Correo)
            ->where('codigoAleatorio', '=', $CodigoUsuario)
            ->first();      
            // return $VerificaCodigo;

        if($VerificaCodigo == Array() ){//Si el codigo que envia el usuario es diferente al almacenado en BD

            return view('modal/modal_recuperarCorreo_V', [
                'correo' => $Correo,
                'bandera' => 'nuevoIntento'
            ]);
        }
        else{//Si los códigos coinciden se permite hacer el cambio de contraseña

            //Se ACTUALIZA en la BD que el codigo ha sido usado y verificado
            CodigoRecuperacion_M:: 
            where('correo', '=', $Correo)
            ->update(['codigoVerificado' => 1]);

            return view('modal/modal_recuperarCorreo_V', [
                'correo' => $Correo,
                'bandera' => 'verificado'
            ]);
        }
    }

    public function recibeCambioClave(Request $Request){
        $ClaveNueva = $Request->get('claveNueva');
        $RepiteClaveNueva = $Request->get('repiteClaveNueva');
        $Correo = strtolower($Request->get('correo'));

        // echo "Clave nueva= " . $ClaveNueva . "<br>";
        // echo "Repite clave nueva= " . $RepiteClaveNueva . "<br>";
        // echo "Correo= " . $Correo . "<br>";
        // exit;

        //Se verifica que las claves recibidas sean iguales
        if($ClaveNueva == $RepiteClaveNueva){
            //se cifra la contraseña con un algoritmo de encriptación
            $ClaveCifrada = password_hash($ClaveNueva, PASSWORD_DEFAULT);
            // echo "Clave cifrada= " . $ClaveCifrada . "<br>";
            // exit;

            //Se consulta el ID_Suscriptor correspondiente al correo
            $ID_Suscriptor = Suscriptor_M::
                select('ID_Suscriptor')  
                ->where('correoSuscriptor', '=', $Correo)
                ->first();      
                // return $ID_Suscriptor;

            if($ID_Suscriptor != Array()){
                //Se actualiza en la base de datos la clave del usuario                    
                $Cambio = SuscriptorPasword_M:: 
                    where('ID_Suscriptor', '=', $ID_Suscriptor->ID_Suscriptor)
                    ->update(['claveCifrada' => $ClaveCifrada]);
                    // return $Cambio;

                //Se destruyen las cookies que recuerdan la contraseña antigua, creadas en validarSesion.php
                // echo "Cookie_usuario= " . $_COOKIE["id_usuario"] . "<br>";
                // echo "Cookie_clave= " . $_COOKIE["clave"] . "<br>";

                // setcookie("id_usuario",'',time()-100);
                // setcookie("clave",'',time()-100);

                return view('modal/modal_recuperarCorreo_V', [
                    'bandera' => 'acuseRecibo'
                ]);
            }
            else{
                echo 'No exist el correo';
                echo "<a class='Inicio_16' href='javascript:history.go(-3)'>Regresar</a>";
                exit;
            }
        }
        else{
            echo 'Las contraseñas no coinciden';
            echo '<br>';
            echo "<a href='javascript: history.go(-1)'>Regresar</a>";
        }
    }

    public function cerrar_Sesion(){
        session()->forget('id_periodista');
        session()->forget('id_suscriptor');
        
        return redirect()->action([Inicio_C::class]);   
        die();
    }
}

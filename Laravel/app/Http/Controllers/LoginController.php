<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 
use Illuminate\Support\Facades\DB;
use App\Models\Artistas_M;  
use App\Models\ArtistaPasword_M; 
use App\Models\Comerciante_M; 
use App\Models\Suscriptor_M; 
use App\Models\Periodistas_M; 
use App\Models\SuscriptorPassword_M;
use App\Models\CodigoRecuperacion_M;

use Illuminate\Support\Facades\Cookie;

class LoginController extends Controller
{
    //Muestra el formulario de login en caso de que no exista una sesión abierta
    public function index($ID_Noticia = null, $Bandera = null, $ID_Comentario = null){
        //Se verifica si el usuario esta memorizado en las cookie de su computadora y las compara con la BD, para recuperar sus datos y autorellenar el formulario de inicio de sesion, las cookies de registro de usuario se crearon en validarSesion.php
        
        // echo Cookie::get('id_periodista') . '<br>';
        // echo Cookie::get('clavePeriodista') . '<br>';
        // exit;
        // echo Cookie::get('id_comerciante') . '<br>';
        // echo Cookie::get('clave') . '<br>';
        // exit;
           
        // COOKIE PERIODISTA
        if(!empty(Cookie::get('id_periodista')) AND !empty(Cookie::get('clavePeriodista'))){//Si la variable $_COOKIE esta establecida o creada

            //Se CONSULTA el correo guardado como Cookie con el id_periodista como argumento, se consulta en todos los tipos de usuario que existe
            $CorreoPeriodista = Periodistas_M::
                select('correoPeriodista')
                ->where('id_Periodista','=', Cookie::get('id_periodista'))
                ->first(); 
                // return $CorreoPeriodista;

            return view('login_V', [
                'correo' => $CorreoPeriodista,
                'clave' =>  Cookie::get('clavePeriodista'),
                'id_noticia' => 'sin_id_noticia',
                'id_comentario' => 'sin_id_comentario',
                'bandera' => 'sin_bandera'
            ]);
        }
                // COOKIE COMERCIANTEs
        else if(!empty(Cookie::get('id_comerciante')) AND !empty(Cookie::get('claveComerciante'))){//Si la variable $_COOKIE esta establecida o creada

            //Se CONSULTA el correo guardado como Cookie con el id_comerciante como argumento, se consulta en todos los tipos de usuario que existe
            $CorreoComerciante = Comerciante_M::
                select('correoComerciante')
                ->where('id_comerciante','=', Cookie::get('id_comerciante'))
                ->first(); 
                // return $CorreoPeriodista;

            return view('login_V', [
                'correo' => $CorreoComerciante,
                'clave' =>  Cookie::get('claveComerciante'),
                'id_noticia' => 'sin_id_noticia',
                'id_comentario' => 'sin_id_comentario',
                'bandera' => 'sin_bandera'
            ]);
        }
        // else{
        //     // echo " no existen cookies";
        //     // exit;
        // }

        else if($Bandera == 'comentar' || $Bandera == 'panelSuscriptor'){//Entra cuando viene de una noticia y desea hacer comentario o cambio de contraseña

            echo $Bandera ;
            return view('login_V', ['id_noticia' => $ID_Noticia, 'id_comentario' => $ID_Comentario, 'bandera' => $Bandera]);
        }
        else if($Bandera == 'responder'){//Entra cuando viene de una noticia y desea responder un comentario existente
            
            echo $Bandera ;
            return view('login_V', ['id_noticia' => $ID_Noticia, 'id_comentario' => $ID_Comentario, 'bandera' => $Bandera]);
        }
        else if($Bandera == 'denuncia'){//Bamdera creada en Contraloria_C/VerificaLogin Entra cuando se desea realizar una denuncia

            // echo $Bandera ;
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
        // }       
    }
    
    // recibe y verifica información de ingreso enviada por el usuario e inicia sesion
    public function ValidarSesion(Request $Request){
        $CorreoEnviado = strtolower($Request->get('correo_Arr'));
        $ClaveEnviada = $Request->get('clave_Arr'); 
        $Bandera = $Request->get('bandera'); 
        $Recordar = $Request->get('recordar'); 
        // echo 'CorreoEnviado= ' . $CorreoEnviado . '<br>';
        // echo 'ClaveEnviada= ' .  $ClaveEnviada . '<br>';
        // echo 'Bandera= ' . $Bandera . '<br>';
        // echo 'Recordar= ' . $Recordar . '<br>';
        // exit;
        
        if(!empty($CorreoEnviado) AND !empty($ClaveEnviada)){
            
            //Se CONSULTA si el correo existe como periodista
            $Periodista = Periodistas_M::
                where('correoPeriodista','=', $Request->get('correo_Arr'))
                ->first();
                // return $Periodista;

            //Se CONSULTA si el correo existe como comerciante
            $Comerciante = DB::connection('mysql_2')
                ->select(
                    "SELECT ID_Comerciante, nombreComerciante, apellidoComerciante, correoComerciante 
                    FROM comerciantes 
                    WHERE correoComerciante = '$CorreoEnviado'; ");
                    // return $Comerciante;

            //Se CONSULTA si el correo existe como artista
            $Artista = Artistas_M::
                where('correoArtista','=', $Request->get('correo_Arr'))
                ->first();
                // echo gettype($Artista);
                // return $Artista;

            //Se CONSULTA si el correo existe como suscritor
            $Suscriptor = Suscriptor_M::
                where('correoSuscriptor','=', $Request->get('correo_Arr'))
                ->first();
                // echo gettype($Suscriptor);
                // return $Suscriptor;
                                                        
            // EXISTE COMO PERIODISTA
            if($Periodista != null){
                
                $ID_Periodista = $Periodista->ID_Periodista; 
                $Correo_BD = $Periodista->correoPeriodista;

                //Se CONSULTA la contraseña guardada en BD, para verificar que sea igual a la contraseña enviada por el usuario
                $Contrasenia_BD = SuscriptorPassword_M::
                    select('claveCifrada')
                    ->where('ID_Suscriptor','=', $ID_Periodista)
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
                    if($Recordar == 1){
                        // Se introduce una cookie en el ordenador del usuario con el ID_Usuario  y la cookie aleatoria porque el usuario marca la casilla de recordar
                        Cookie::queue(Cookie::make('id_periodista', $ID_Periodista, time()+365*24*60*60));
                        Cookie::queue(Cookie::make('clavePeriodista', $ClaveEnviada, time()+365*24*60*60));
                    }
                        // Se destruyen las cookie para dejar de recordar a usuario
                    // if($No_Recordar == 1){
                    //     setcookie('id_usuario','',time() - 3600,'/');
                    //     setcookie('clave','',time() - 3600,'/');
                    // }
                    
                    // Se verifica si todos los datos de perfil estan llenos
                    if($Periodista->telefonoPeriodista == null OR $Periodista->CNP == null){
                        // Se crea una sesion que impedira navegar si el perfil esta incomleto
                        session(['perfilCompleto' => 'total']);

                        return redirect()->action([PanelPeriodistaController::class, 'perfil_periodista'],['id_periodista' => session('id_periodista')]);   
                        die();
                    }
                    else{
                        return redirect()->action([PanelPeriodistaController::class,'index']);   
                        die();
                    }
                }
                else{ //en caso de clave incorrecta
                    return view('modal/modal_falloLogin_V');
                }
            }   
           
            // EXISTE COMO COMERCIANTE
            if($Comerciante != null){
                
                $ID_Comerciante =  $Comerciante[0]->ID_Comerciante; 
                $Correo_BD =  $Comerciante[0]->correoComerciante;
                
                //Se CONSULTA la contraseña guardada en BD
                $Contrasenia_BD = SuscriptorPassword_M::  
                    select('claveCifrada')
                    ->where('ID_Suscriptor','=', $ID_Comerciante)
                    ->first();                    
                    // return $Contrasenia_BD;
                    
                // echo $CorreoEnviado . '<br>';
                // echo $Correo_BD . '<br>';
                // echo $Contrasenia_BD->claveCifrada . '<br>';
                // echo password_verify($ClaveEnviada, $Contrasenia_BD->claveCifrada);
                // exit;

                // LOGEADO Y REDIRECIONAMIENTO
                //se descifra la contraseña con un algoritmo de desencriptado.
                if($CorreoEnviado == $Correo_BD AND $ClaveEnviada == password_verify($ClaveEnviada, $Contrasenia_BD->claveCifrada)){

                    //Se crea la sesion exigida en las páginas de cuentas de usuarios           
                    session(['id_comerciante' =>  $Comerciante[0]->ID_Comerciante]);
                    session(['nombreComerciante' => $Comerciante[0]->nombreComerciante]);
                    session(['apellidoComerciante' => $Comerciante[0]->apellidoComerciante]);                
                    session(['correoComerciante' =>  $Comerciante[0]->correoComerciante]);

                    // echo session('nombreComerciante') . '<br>';
                    // echo session('apellidoComerciante') . '<br>';
                    // echo session('correoComerciante') . '<br>';
                    // exit;
                    
                    //Se crean las cookies para recordar al usuario en caso de que $Recordar exista
                    if($Recordar == 1){
                        // Se introduce una cookie en el ordenador del usuario con el ID_Usuario  y la cookie aleatoria porque el usuario marca la casilla de recordar                        
                        Cookie::queue(Cookie::make('id_comerciante', $ID_Comerciante, time()+365*24*60*60));
                        Cookie::queue(Cookie::make('claveComerciante', $ClaveEnviada, time()+365*24*60*60));
                    }
                        // Se destruyen las cookie para dejar de recordar a usuario
                    // if($No_Recordar == 1){
                    //     setcookie('id_usuario','',time() - 3600,'/');
                    //     setcookie('clave','',time() - 3600,'/');
                    // }
                                                                
                    return redirect()->route("PanelProducto", ['id_comerciante' => session('id_comerciante')]);
                    die();
                }
                else{ //en caso de clave o usuario incorrecto
                    return view('modal/modal_falloLogin_V');
                }
            }

            // EXISTE COMO ARTISTA
            if($Artista != null){
                
                $ID_Artista =  $Artista->ID_Artista; 
                $Correo_BD =  $Artista->correoArtista;
                
                //Se CONSULTA la contraseña guardada en BD, para verificar que sea igual a la contraseña de la BD
                $Contrasenia_BD = ArtistaPasword_M::
                    select('claveCifrada')
                    ->where('ID_Artista','=', $ID_Artista)
                    ->first();                    
                    // return $Contrasenia_BD;
                    
                // echo $CorreoEnviado . '<br>';
                // echo $Correo_BD . '<br>';
                // echo password_verify($ClaveEnviada, $Contrasenia_BD->claveCifrada);
                // exit;
                // LOGEADO Y REDIRECIONAMIENTO
                //se descifra la contraseña con un algoritmo de desencriptado.
                if($CorreoEnviado == $Correo_BD AND $ClaveEnviada == password_verify($ClaveEnviada, $Contrasenia_BD->claveCifrada)){

                    //Se crea la sesion exigida en las páginas de cuentas de usuarios           
                    session(['id_artista' =>  $Artista->ID_Artista]);
                    session(['nombreArtista' => $Artista->nombreArtista]);
                    session(['apellidoArtista' => $Artista->apellidoArtista]);                
                    session(['correoArtista' =>  $Artista->correoArtista]);

                    // echo session('id_artista') . '<br>';
                    // echo session('nombreArtista') . '<br>';
                    // echo session('apellidoArtista') . '<br>';
                    // echo session('correoArtista') . '<br>';
                    // exit;
                    
                    //Se crean las cookies para recordar al usuario en caso de que $Recordar exista
                    if($Recordar == 1){
                        // Se introduce una cookie en el ordenador del usuario con el ID_Usuario  y la cookie aleatoria porque el usuario marca la casilla de recordar
                        setcookie('id_artista', $Artista->ID_Artista, time()+365*24*60*60);
                        setcookie('clave', $ClaveEnviada, time()+365*24*60*60);
                    }
                        // Se destruyen las cookie para dejar de recordar a usuario
                    // if($No_Recordar == 1){
                    //     setcookie('id_artista','',time() - 3600,'/');
                    //     setcookie('clave','',time() - 3600,'/');
                    // }
                                                                
                    return redirect()->route("PanelArtista", ['id_artista' => session('id_artista')]);
                    die();
                }
                else{ //en caso de clave o usuario incorrecto
                    return view('modal/modal_falloLogin_V');
                }
            }

            // EXISTE COMO SUSCRIPTOR
            if($Suscriptor != null){
                
                $ID_Suscriptor =  $Suscriptor->ID_Suscriptor; 
                $Correo_BD =  $Suscriptor->correoSuscriptor;
                
                //Se CONSULTA la contraseña guardada en BD, para verificar que sea igual a la contraseña de la BD
                $Contrasenia_BD = SuscriptorPassword_M::
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

                    // echo session('nombreSuscriptor') . '<br>';
                    // echo session('apellidoSuscriptor') . '<br>';
                    // echo session('PseudonimoSuscriptor') . '<br>';
                    // exit;
                    
                    //Se crean las cookies para recordar al usuario en caso de que $Recordar exista
                    if($Recordar == 1){
                        // Se introduce una cookie en el ordenador del usuario con el ID_Usuario  y la cookie aleatoria porque el usuario marca la casilla de recordar
                        setcookie('id_suscriptor', $Suscriptor->ID_Suscriptor, time()+365*24*60*60);
                        setcookie('clave', $ClaveEnviada, time()+365*24*60*60);
                    }
                        // Se destruyen las cookie para dejar de recordar a usuario
                    // if($No_Recordar == 1){
                    //     setcookie('id_usuario','',time() - 3600,'/');
                    //     setcookie('clave','',time() - 3600,'/');
                    // }
                    
                    if($Bandera == 'comentar'){// si va a hacer un comentario en una noticia y esta logeado
                        // header('Location:'. RUTA_URL . '/NoticiasController/detalleNoticia/'.$ID_Noticia.',sinAnuncio,#ContedorComentario');
                        die();
                    }
                //     else if($Bandera == 'SinLogin'){// si va a hacer un comentario y esta logeado
                //         header('Location:'. RUTA_URL . '/NoticiasController/detalleNoticia/'.$ID_Noticia.',sinAnuncio,#ContedorComentario');
                //         die();
                //     }
                //     else if($Bandera == 'ID_Noticia'){// si va a hacer un comentario y esta logeado
                //         header('Location:'. RUTA_URL . '/NoticiasController/detalleNoticia/'.$ID_Noticia.',sinAnuncio,#ContedorComentario');
                //         die();
                //     }
                //     else if($Bandera == 'responder'){// si va a responder un comentario y esta logeado
                //         header('Location:'. RUTA_URL . '/NoticiasController/detalleNoticia/'.$ID_Noticia.',sinAnuncio,#'.$ID_Comentario);
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

                        // //Se CONSULTA al controlador PanelArtistaController la cantidad de obras que tiene el suscriptor.
                        // require_once(RUTA_APP . "/controladores/PanelArtistaController.php");
                        // $Obras = new PanelArtistaController();
                        // $Cant_Obras = $Obras->cantidadObras($ID_Suscriptor);
                        
                        // //Se CONSULTA al controlador Panel_Denuncias_C la cantidad de denunucias que ha realizado el suscriptor.
                        // require_once(RUTA_APP . "/controladores/Panel_Denuncias_C.php");
                        // $Denuncias = new Panel_Denuncias_C();
                        // $Cant_Denuncias = $Denuncias->denunciasSuscriptor($ID_Suscriptor);
                        return view('modal/modal_suscripInicio_V', [
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

            if(!isset($Periodista) || !isset($Comerciante) || !isset($Artista) || !isset($Suscriptor)){ //en caso de clave o usuario incorrecto
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

    // recive correo y envia codigo de recuperacion de contraseña al correo suministrado por el usuario
    public function recuperar_Clave(Request $Request){
        $Correo = strtolower($Request->get('correo'));
        // echo 'Correo= ' . $Correo . '<br>';
        
        //Se genera un numero aleatorio que será el código de recuperación de contraseña
        //alimentamos el generador de aleatorios
        mt_srand (time());

        //generamos un número aleatorio
        $Aleatorio = mt_rand(100000,999999);
        
        // $Fecha = date("Y-m-d"); 
        // $Hora = date("h:i a");
        // echo $Fecha . '<br>';
        // echo $Hora . '<br>';
        // exit;

        //Se INSERTA el código aleatorio en la tabla "codigo-recuperacion" para asociarlo al correo del usuario
        CodigoRecuperacion_M::insert(
            ['correo' => $Correo, 
            'codigoAleatorio' => $Aleatorio,
            'codigoVerificado' => 0
            // 'fechaSolicitud' => $Fecha,
            // 'horaSolicitud' => $Hora
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
                SuscriptorPassword_M:: 
                    where('ID_Suscriptor', '=', $ID_Suscriptor->ID_Suscriptor)
                    ->update(['claveCifrada' => $ClaveCifrada]);

                //Se destruyen las cookies que recuerdan la contraseña antigua, creadas en validarSesion.php
                // Cookie::forget('id_usuario');
                // Cookie::forget('clave');

                // Para verificar si existen cookies
                // Cookie::has('id_usuario');
                // Cookie::has('clave');

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
        session()->forget('id_comerciante');
        
        return redirect()->action([Inicio_C::class]);   
        die();
    }
}

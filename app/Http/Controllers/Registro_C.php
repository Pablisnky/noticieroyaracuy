<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Registro_C extends Controller
{

    //Imuestra el formulario de registro de usuario
    public function suscripcion(){

        return view('registros.registroUsuario_V');
        
        // if($ID_Noticia != 'SinID_Noticia'){

        //     $Datos = [
        //         'id_noticia' => $ID_Noticia
        //     ];

        //     // echo "<pre>";
        //     // print_r($Datos);
        //     // echo "</pre>";
        //     // exit;

        //     $this->vista("header/header_noticia");
        //     $this->vista("view/registro_V", $Datos );
        // }
        // else{
        //     $this->vista("header/header_noticia");
        //     $this->vista("view/registroPeriodista_V");
        // }
    }

    //Recibe los datos de un usurio que a llenado el formulario de suscripcion
    public function recibeRegistroSuscriptor(){
        //Se reciben todos los campos del formulario de suscripcion, se verifica que son enviados por POST y que no estan vacios
        if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["nombre"]) && !empty($_POST["correo"]) && !empty($_POST["clave"]) && !empty($_POST["confirmarClave"])){
            // $RecibeDatos = [
            //     //Recibe datos de la persona responsable
            //     'nombre' => filter_input(INPUT_POST, "nombre", FILTER_SANITIZE_STRING),
            //     'correo' => filter_input(INPUT_POST, "correo", FILTER_SANITIZE_STRING),
            //     'clave' => filter_input(INPUT_POST, "clave", FILTER_SANITIZE_STRING),
            //     'confirmarClave' => filter_input(INPUT_POST, "confirmarClave", FILTER_SANITIZE_STRING)
            // ];
            //Recibe datos de la persona responsable
            $RecibeDatos = [
                'id_noticia' => $_POST['id_noticia'],
                'nombre' => ucwords($_POST['nombre']),
                'apellido' => ucwords($_POST['apellido']),
                'correo' => mb_strtolower($_POST['correo']),
                'municipio' => mb_strtolower($_POST['municipio']),
                'parroquia' => mb_strtolower($_POST['parroquia']),
                'clave' => $_POST['clave'],
                'repiteClave' => $_POST['confirmarClave']
            ];

            // echo "<pre>";
            // print_r($RecibeDatos);
            // echo "</pre>";
            // exit;
        }
        else{
            echo "Debe Llenar todos los campos vacios". "<br>";
            echo "<a href='javascript:history.back()'>Regresar</a>";
            exit();
        }

        // Se inserta el suscriptor nuevo y se recupera su ID_Suscriptor
        $ID_Suscriptor = $this->ConsultaLogin_M->InsertarSuscriptor($RecibeDatos);

        //se cifra la contraseña del afiliado con un algoritmo de encriptación
        $options = ['memory_cost' => 1<<10, 'time_cost' => 4, 'threads' => 2];
        $ClaveCifrada = password_hash($RecibeDatos["clave"], PASSWORD_DEFAULT, $options);

        $this->ConsultaLogin_M->InsertarClave($ID_Suscriptor, $ClaveCifrada);

        //Se consulta el correo a donde llegara la notificación de nueva denuncia
        $CorreoAdmin = $this->ConsultaLogin_M->ConsultaCorreoAdministrador();
        // echo $CorreoAdmin['correoAdmin'];
        // exit();

        //Se envia al correo  la notificación de nuevo cliente registrado
        $email_subject = 'Suscripción de nuevo usuario';
        $email_to = $CorreoAdmin['correoAdmin'];
        $headers = 'From: NoticieroYaracuy<administrador@noticieroyaracuy.com>';
        $email_message = $RecibeDatos['nombre'] . ' ' . $RecibeDatos['apellido'] . ' se ha registrado en la plataforma';

        mail($email_to, $email_subject, $email_message, $headers);

        // echo "<pre>";
        // print_r($Datos);
        // echo "</pre>";
        // exit();

        $this->vista("header/header_noticia");
        $this->vista("modal/modal_bienvenida_V");
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Suscriptor_M; 
use App\Models\SuscriptorPassword_M;

class RegistroController extends Controller
{

    // Recibe los datos de un usurio que a llenado el formulario de suscripcion
    public function recibeRegistroSuscriptor(Request $Request){
        //Se reciben todos los campos del formulario de suscripcion, se verifica que son enviados por POST y que no estan vacios
        // if($_SERVER["REQUEST_METHOD"] == "POST" && !empty($_POST["nombre"]) && !empty($_POST["correo"]) && !empty($_POST["clave"]) && !empty($_POST["confirmarClave"])){

            $RecibeDatos = [
                'Nombre' => $Request->get('nombre'),
                'Apellido' => $Request->get('apellido'),
                'Correo' => mb_strtolower($Request->get('correo')),
                'Clave' => $Request->get('clave'),
                'ConfirmarClave' => $Request->get('confirmarClave')
            ];
            // return $RecibeDatos;

        // }
        // else{
        //     echo "Debe Llenar todos los campos vacios". "<br>";
        //     echo "<a href='javascript:history.back()'>Regresar</a>";
        //     exit();
        // }

        // Se inserta el suscriptor nuevo y se recupera su ID_Suscriptor
        Suscriptor_M::insert(
            ['nombreSuscriptor' => $RecibeDatos['Nombre'],
            'apellidoSuscriptor' => $RecibeDatos['Apellido'],
            'correoSuscriptor' => $RecibeDatos['Correo'],
            ]
        );
        $ID_Suscriptor = Suscriptor_M::latest('ID_Suscriptor')->first()->ID_Suscriptor;
        // return $ID_Suscriptor;

        if($RecibeDatos['Clave'] == $RecibeDatos['ConfirmarClave']){
            // se cifra la contraseña del afiliado con un algoritmo de encriptación
            // $options = ['memory_cost' => 1<<10'], 'time_cost' => 4, 'threads' => 2];
            $ClaveCifrada = password_hash($RecibeDatos["Clave"], PASSWORD_DEFAULT);
            SuscriptorPassword_M::insert(
                ['ID_Suscriptor' => $ID_Suscriptor,
                'claveCifrada' => $ClaveCifrada
                ]
            );
        }
        else{
            echo "Las claves no coinciden". "<br>";
            echo "<a href='javascript:history.back()'>Regresar</a>";
            exit();
        }

        // Se consulta el correo a donde llegara la notificación de nuevo registro
        // $CorreoAdmin = $this->ConsultaLogin_M->ConsultaCorreoAdministrador();
        // // echo $CorreoAdmin['correoAdmin'];
        // // exit();

        // Se envia al correo del suscriptor la notificación de corfinmación de registrado
        // $email_subject = 'Suscripción de nuevo usuario';
        // $email_to = $CorreoAdmin['correoAdmin'];
        // $headers = 'From: NoticieroYaracuy<administrador@noticieroyaracuy.com>';
        // $email_message = $RecibeDatos['nombre'] . ' ' . $RecibeDatos['apellido'] . ' se ha registrado en la plataforma';

        // mail($email_to, $email_subject, $email_message, $headers);
        
        return view('modal/modal_bienvenida_V');
    }

    public function verificar_correo($Correo){

        // se consulta el correo ingresado por el usuario
        $Correo = Suscriptor_M::
            select('ID_Suscriptor')
            ->where('correoSuscriptor','=', $Correo)
            ->first();
            // return $Correo;
            
        if($Correo != null){
            echo '<label class="bandaAlerta">El correo existe como usuario registrado</label>';
        }
    }
}

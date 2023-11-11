<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\nuevaSuscripcion_mail;
use App\Models\Suscriptor_M; 
use App\Models\SuscriptorPassword_M;
use App\Models\SuscriptorRol_M;
use App\Models\Administrador_M;

class RegistroController extends Controller
{

    // Recibe los datos de un usuario que a llenado el formulario de suscripcion
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
        
        // Se inserta en la tabla de Dependencia Transitiva "suscriptor_rol" el rol de suscriptor (ID 1)
        SuscriptorRol_M::insert(
            ['ID_Suscriptor' => $ID_Suscriptor,
            'ID_Rol' => 1
            ]
        );

        if($RecibeDatos['Clave'] == $RecibeDatos['ConfirmarClave']){
            // se cifra la contraseña del afiliado con un algoritmo de encriptación
            // $options = ['memory_cost' => 1<<10'], 'time_cost' => 4, 'threads' => 2];
            $ClaveCifrada = password_hash($RecibeDatos["Clave"], PASSWORD_DEFAULT);

            // Se inserta la contraseña del suscriptor
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

        // CORREOS
        // ****************** correo para suscriptor y noticieroyaracuy 

        // Se consulta el correo a donde llegara la notificación de nuevo registro
        $CorreoAdmin = Administrador_M::
            select('correoAdmin')
            ->where('ID_Administrador','=', 1)
            ->first();
            // echo gettype($NoticiasPortadas);
            // return $CorreoAdmin;

        $DatosCorreo = [
            'nombreSuscriptor' => $RecibeDatos['Nombre'],
            'apellidoSuscriptor' => $RecibeDatos['Apellido']
        ];
        // return $DatosCorreo;

        Mail::to($CorreoAdmin->correoAdmin)
        ->send(new nuevaSuscripcion_mail($DatosCorreo)); 
                                       
        return view('modal.modal_bienvenida_V');
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

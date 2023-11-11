<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Recibo de compra</title>
        <style type="text/css">        
            body{margin: 0; padding: 0; min-width: 100% !important;} 
            h1{color: #8bc34a;}
            p{font-size: 1rem;}
            @media(max-width: 800px){/*medio con dimensiones menores a lo indicado*/
                h1{font-size: 1.6em}
            }
        </style>
    </head>
    <body>
        <?php
            $NombreSuscriptor = $Datos['nombreSuscriptor'];
            $ApellidoSuscriptor  = $Datos['apellidoSuscriptor'];
        ?>
        <h1>{{ $NombreSuscriptor . ' ' . $ApellidoSuscriptor }}</h1>
        <p>Se ha registrado en la plataforma</p>

        <a href="https://www.noticieroyaracuy.com">www.noticieroyaracuy.com</a>    
    </body>
    </html>
<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Pedido para despachar</title>
        <style type="text/css">
            body{margin: 0; padding: 0; min-width: 100% !important;}
            h1{color: #8bc34a;}
            p{font-size: 1rem;}
            img{width: 10rem; height: 10rem; margin-top: 5%}
            tr{height: 15px}
            .hr_1{margin-bottom: 1%;}
            .td_1{text-align: left; width: 180px;}
            .tr_1{height: 30px;}
            @media(max-width: 800px){/*medio con dimensiones menores a lo indicado*/
                img{width: 6rem; height: 6rem; margin-top: 10%}
                h1{font-size: 1.6em}
                .img__capture{width: 8rem; height: 8rem}
            }
        </style>
    </head>
    <body>
        <h1>{{ $Tienda }}, nuevo pedido para despachar</h1>
        <p>Se ha realizado un pago por {{ $DatosCompra->montoTienda }} Bs. Nro confirmación {{ $DatosCompra->codigoPago }}</p>

        <h2>Datos de la compra</h2>      
        <table>
            @foreach($DatosCorreo['informacion_pedido'] as $DatosCompra) 
                @php($Capture =  $DatosCompra['capture'])
                <tr>
                    <td class='td_1'>Nro. Orden</td>
                    <td>{{ $DatosCompra->numeroorden }}</td>
                </tr>
                <tr>
                    <td class='td_1'>FECHA</td>
                    <td>{{ $DatosCompra->fecha }}</td>
                </tr>
                <tr>
                    <td class='td_1'>HORA</td>
                    <td>{{ $DatosCompra->hora }}</td>
                </tr>
                <tr>
                    <td class='td_1'>FORMA DE PAGO</td>
                    <td>{{ $DatosCompra->formaPago }}</td>
                </tr>
                <tr>
                    <td class='td_1'>REFERENCIA BANCARIA</td>
                    <td>{{ $DatosCompra->codigoPago }}</td>
                </tr>
                <tr>
                    <td class='td_1'>MONTO EN TIENDA</td>
                    <td>{{ $DatosCompra->montoTienda }} Bs.</td>
                </tr>
                <td class='td_1'>CAPTURE</td>
                {{-- <td><img class='img__capture' src='https://pedidoremoto.com/public/images/capture/" . $Capture ."'></td> --}}
                @break
            @endforeach
        </table>

        <hr class="hr_1">
        <h2>Datos del pedido</h2>
        <table>
            @foreach($DatosCorreo['informacion_pedido'] as $DatosPedido) 
                <tr>
                    <td>PRODUCTO</td>
                    <td class='td_1'>{{ $DatosPedido->producto }}</td>
                </tr>
                <tr>
                    <td class='td_1'>ESPECIFICACIONES</td>
                    <td>{{ $DatosPedido->opcion }}</td>
                </tr>
                <tr>
                    <td class='td_1'>PRECIO UNITARIO</td>
                    <td>{{ $DatosPedido->precio }} Bs." . "</td>
                </tr>
                <tr>
                    <td class='td_1'>CANTIDAD</td>
                    <td>{{ $DatosPedido->cantidad }}</td>
                </tr>
                <tr>
                    <td class='td_1'>SUB-TOTAL</td>
                    <td>{{ $DatosPedido->total }} Bs." . "</td>
                </tr>
                <tr class='tr_1'>
                </tr>
            @endforeach
        </table>


        <p>Gracias por confiar en nuestro servicio</p>
        <a href="https://www.pedidoremoto.com">www.pedidoremoto.com</a>
        
    </body>
</html>
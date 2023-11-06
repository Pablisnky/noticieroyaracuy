<!DOCTYPE html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Recibo de compra</title>
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
        <?php
            $Hora = $Datos['informacion_pedido'][0]->hora;
            $Fecha = $Datos['informacion_pedido'][0]->fecha;
            $ID_Comerciante = $Datos['informacion_pedido'][0]->ID_Comerciante; 
            $Tienda = $Datos['informacion_pedido'][0]->pseudonimoComerciante;
        ?>
        <h1>{{ $Tienda }}, nuevo pedido para despachar</h1>
        <h2>Aviso de venta</h2>
        <table>
            @foreach($Datos['informacion_pedido'] as $DatosCompra) 
                @php($Capture =  $DatosCompra->capture)
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
                    <td class='td_1'>DESPACHO</td>
                    <td>{{ $DatosCompra->despacho }} Bs.</td>
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
                <tr>
                    <td class='td_1'>TOTAL PAGADO</td>
                    <td>{{ $DatosCompra->montoTotal }}Bs.</td>
                </tr>
                <tr>
                    <td class='td_1'>CAPTURE</td>
                    <td><img class='img__capture' src="{{ asset('/images/clasificados/capture/' . $Capture) }}"></td> 
                </tr>
                
                @break
            @endforeach
        </table>

        <hr class="hr_1">
        <h2>Datos del pedido</h2> 
        <table>
            @foreach($Datos['informacion_pedido'] as $DatosPedido)
                    <tr>
                    <td>PRODUCTO</td> 
                <td class='td_1'>{{ $DatosPedido->producto }}</td>
                </tr>
                <tr>
                    <td class='td_1'>ESPECIFICACIONES</td>
                    <td>{{ $DatosPedido->opcion }}</td>
                </tr>
                    <tr>
                        <td>PRECIO UNITARIO</td> 
                    <td>{{ $DatosPedido->precio }} Bs.</td> 
                </tr>
                <tr>
                    <td class='td_1'>CANTIDAD</td>
                    <td>{{ $DatosPedido->cantidad }}</td>
                </tr>
                    <tr>
                        <td>SUB-TOTAL</td> 
                    <td>{{ $DatosPedido->total }} Bs.</td>
                </tr>
                <tr  class='tr_1'>
                </tr>
            @endforeach
        </table>

        <hr class="hr_1">  
        <h2>Código de despacho</h2> 
        <h2 style="font-weight: normal">{{ $Datos['Codigo_despacho'] }}</h2>     

        <hr class="hr_1">  
        <h2>Datos del comprador</h2>
        <table>
            @foreach($Datos['informacion_usuario'] as $DatosUsuarios)  :
                <tr>
                    <td class='td_1'>NOMBRE</td>
                    <td>{{ $DatosUsuarios->nombre_usu }}</td>
                </tr>
                    <tr>
                        <td>APELLIDO</td>
                    <td>{{ $DatosUsuarios->apellido_usu }}</td>
                </tr>
                    <tr>
                        <td>CEDULA</td> 
                    <td>{{ $DatosUsuarios->cedula_usu }}</td>
                </tr>
                    <tr>
                        <td>TELEFONO</td> 
                    <td>{{ $DatosUsuarios->telefono_usu }}</td>
                </tr>
                    <tr>
                        <td>DIRECCIÓN</td> 
                    <td>{{ $DatosUsuarios->direccion_usu }}</td>
                </tr>
                    <tr>
                        <td>CIUDAD</td>
                    <td>{{ $DatosUsuarios->ciudad_usu }}</td>
                </tr>
                    <tr>
                        <td>ESTADO</td>
                    <td>{{ $DatosUsuarios->estado_usu }}</td>
                </tr>
            @endforeach
        </table> 

        <br>

        {{-- <p>Si existe alguna no conformidad con su despacho, ingrese en <a href="https://www.pedidoremoto.com/NoConformidad_C/noConformidad/'.$ID_Pedido.','.$Fecha.','.$Hora.','.$ID_Tienda.','.$Tienda.'">no conformidades</a>, y reporte su caso, <br> de ser necesario un operador de <strong>PedidoRemoto</strong> lo contactará para ayudarle.</p>  --}}

        <p>Gracias por confiar en nuestro servicio</p>

        <a href="https://www.noticieroyaracuy.com">www.noticieroyaracuy.com</a>    
    </body>
    </html>
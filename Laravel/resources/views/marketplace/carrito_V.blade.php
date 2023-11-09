<!-- Archivo cargado via AJAX en el div id="Mostrar_Orden" del archivo catalogos_V.php -->

<!-- Se coloca el SDN para la libreria JQuery, necesaria para la previsualización del capture--> 
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

<section class="sectionModal--carrito" id="SectionModal--carrito">
    
    <div class="cont_carrito--regresar">
        <!-- ICONO REGRESAR -->
        <img class="icono--regresar Default_pointer" id="Cerrar" src="{{ asset('/iconos/flecha/outline_arrow_back_white_24dp.png') }}" onclick="ocultarPedido()"/>

        <!-- ICONO VACIAR CARRITO DE COMPRAS -->
        <img class="icono--regresar Default_pointer" id="Cerrar" src="{{ asset('/iconos/carritoCompras/outline_remove_shopping_cart_white_24dp.png') }}" onclick="vaciarCarrito()"/>
    </div>

    <!-- ORDEN DE COMPRA -->
    <section> 
        <div class="contenedor_24 contenedor_24--carrito" id="Contenedor_24">
            <header>
                <h1 class="h1_1">Orden de compra</h1>
            </header>

            <article>
                <div class="contPedido borde_bottom">
                    <table class="tabla" id="Tabla">
                        <thead>
                            <tr>
                                <th class="th_1 th_4">CANT.</th>
                                <th class="th_2 th_4">PRODUCTO</th>
                                <th class="th_3 th_4">PRECIO UNITARIO</th>
                                <th class="th_3 th_4">TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <!--tabla es rellenada desde E_Clasificados.js por medio de PedidoEnCarrito()-->
                                <td><input type="text" class="Default_ocultar" id="Input_cantidadCar"/></td>
                                <td><input type="text" class="Default_ocultar" id="Input_productoCar"/></td>
                                <td><input type="text" class="Default_ocultar" id="Input_precioCar"/></td>
                                <td><input type="text" class="Default_ocultar" id="Input_totalCar"/></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </article>

            <article>
                <div class="contGeneral">  

                    {{-- ENTREGA ACORDADDA --}}
                    <div class="contInputRadio--carrito">     
                        <input type="radio" name="entrega" id="Domicilio_No" value="Domicilio_No"  form="DatosUsuario" onclick="Despacho()"/>
                        <label class="contInputRadio__label" for="Domicilio_No">Entrega acordado con vendedor: 0 Bs</label>
                    </div>            
                    
                    {{-- ENTREGA A DOMICILIO --}}
                    <div class="contInputRadio--carrito">
                        <input type="radio" name="entrega" id="Domicilio_Si" value="Domicilio_Si" form="DatosUsuario" checked onclick="Despacho()"/>
                        <label class="contInputRadio__label" for="Domicilio_Si">Entrega a domicilio: {{ number_format($costoDelivery, 2, ",", ".") }} Bs.</label>
                        <input class="Default_ocultar" type="text" id="PrecioEnvio" value="{{ $costoDelivery }}"/>
                    </div>     
                    
                    <!--DIV ALIMENTADO DESDE E_Catalogo.js PedidoEnCarrito() -->
                    <div>
                        <h2 class="h2_2">Monto en tienda: <input type="text" form="DatosUsuario" name="montoTienda" class="input_6" id="MontoTienda" readonly/> Bs.</h2>

                        <h2 class="h2_2 Default_ocultar">Comisión PedidoRemoto: <input type="text" class="input_6" id="Comision" readonly/> Bs.</h2>

                        <h2 class='h2_2'>Monto de envio:<input type='text' form="DatosUsuario" name="despacho" id="Despacho_2" class='input_6' value='{{ number_format($costoDelivery, 2, ",", ".") }}' readonly/> Bs.</h2>

                        <hr class="hr_1--carrito"/>
                        <h2 class="h2_2 h2_3">Monto total: <input type="text" form="DatosUsuario" name="montoTotal" class="input_6 input_7" id="MontoTotal" readonly/> Bs.</h2>
                        <h2 class="h2_2 h2_3"><input type="text" form="DatosUsuario" name="" class="input_6 input_7" id="MontoTotalDolares" readonly/> $</h2>

                        <small class="small_1 small_1A">Cambio oficial a tasa del BCV <strong class="strong_1">( 1 $ = {{ number_format($dolar, 2, ",", ".") }} Bs.)</strong></small>
                    </div>
                </div>
            </article>

            <!-- USUARIO REGISTRADO -->
            <article id="ConfirmarOrden" >
                <header id="Label--confirmar"> 
                    <h1 class="h1_1" >Confirmar orden</h1>
                </header>
                
                <div class="contBoton" style="width: 100%;" id="Contenedor_26">
                    <label class="boton boton--alto boton--carrito" id="No_Registrado" onclick="mostrar_formulario('MuestraEnvioFactura')">Usuario no registrado</label>
                    
                    <label>&nbsp;&nbsp;&nbsp;&nbsp;</label>

                    <label class="boton boton--alto boton--carrito" id="Registrado" onclick="mostrar_cedula()">Usuario <br class="br_2">registrado</label>
                    
                    <div class="Default_ocultar" id="Mostrar_Cedula">
                        <form>
                            <input class="login_cont--input borde--input" type="text" name="cedulaUsuario" id="Cedula_Usuario" placeholder="Nº Cedula (Solo números)" autocomplete="off"/>

                            <label class="boton boton--centro" for="Cedula_Usuario" onclick="soloNumeros(this.form, 'Cedula_Usuario')"/>Enviar</label>
                        </form>
                    </div> 
                </div>  
            </article>
        </div>
    </section>

    <!-- DATOS DE DESPACHO -->
    <section class="ancla" id="Seccion_datos"> 
        <div class="contOculto" id="MuestraEnvioFactura">
            <form action="{{ route('RecibePedido') }}" method="POST" enctype="multipart/form-data" onsubmit="return validarDespacho()" id="DatosUsuario">
                @csrf
                <article>
                    <div class="contenedor_24 contFlex">
                        <header>
                            <h1 class="h1_1">Datos de despacho</h1>
                        </header>
                        <div style="position: relative;">
                            
                            <!-- NOMBRE -->
                            <div class="contenedor_29">
                                <input class="login_cont--input borde--input" type="text" name="nombreUsuario" id="NombreUsuario" autocomplete="off" placeholder="Nombre"/>
                            </div>

                            <!-- APELLIDO -->
                            <div class="contenedor_29">
                                <input class="login_cont--input borde--input" type="text" name="apellidoUsuario" id="ApellidoUsuario" autocomplete="off" placeholder="Apellido"/>
                            </div>

                            <!-- CEDULA -->
                            <div class="contenedor_29">
                                <input class="login_cont--input borde--input" type="text" name="cedulaUsuario" id=
                            "CedulaUsuario" autocomplete="off" placeholder="Cedula / RIF (solo números)"  onkeyup="formatoMiles(this.value, 'CedulaUsuario')"/>
                            </div>

                            <!-- TELEFONO -->
                            <div class="contenedor_29">
                            <input class="login_cont--input borde--input" type="text" name="telefonoUsuario" id="TelefonoUsuario" autocomplete="off" placeholder="Telefono (solo números)" onkeydown="valida_LongitudTelefono(); mascaraTelefono(this.value, 'TelefonoUsuario')" onkeydown="valida_LongitudTelefono()"/>
                            </div>

                            <!-- CORREO -->
                            <div class="contenedor_29">
                                <input class="login_cont--input borde--input" type="correo" name="correoUsuario" id="CorreoUsuario" autocomplete="off" placeholder="correo"/>
                            </div>

                            <!-- DIRECCION -->
                            <div class="contenedor_55 contenedor_154">
                                <div class="contenedor_155">
                                    <select class="select_2 borde_1" name="estado" id="Estado">
                                        <option disabled selected>Seleccione un estado</option>
                                        <option selected="true">Yaracuy</option>
                                    </select>
                                </div>
                                <div class="contenedor_155">
                                    <select class="select_2 borde_1" name="ciudad" id="Ciudad">
                                        <option id="Option_1" disabled selected>Seleccione una ciudad</option>
                                        <option>Cocorote</option>
                                        <option>Independencia</option>
                                        <option>San Felipe</option>
                                    </select>
                                </div>
                            </div>
                            <div class="contenedor_72">
                                <textarea class="textarea_1 borde_1" name="direccionUsuario" id="DireccionUsuario" autocomplete="off" placeholder="Dirección"></textarea>
                            </div>
                            
                            <!-- GUARDAR DATOS DE USUARIO -->
                            <div class="contFlex--suscribir" id="Cont_Suscribir">
                                <div>
                                    <P class="rompe_Flex">Desea que sus datos se guarden para futuras compras</P>
                                </div>
                                <div class="contInputRadio" id="">     
                                    <input type="radio" name="suscrito" id="No_Suscribir" value="No_Suscribir" onclick="formasDePago()"/>
                                    <label class="contInputRadio__label" for="No_Suscribir" >No guardar</label>
                                </div>  
                                <div class="contInputRadio">
                                    <input type="radio" name="suscrito" id="Suscribir" value="Suscribir" onclick="formasDePago()"/>
                                    <label class="contInputRadio__label" for="Suscribir">Guardar</label>
                                </div>  
                            </div>  
                        </div>   
                    </div>
                </article>    

                <!--RADIO BUTOM FORMAS DE PAGO --> 
                <article class="cont_carrito--pagos ancla" id="FormasDePago"> 
                    <div class="contenedor_24 contFlex">
                        <div class="contGeneral contGeneral--left">
                            <h1 class="h1_1">Formas de pago</h1>

                            <!-- SELECCIONAR FORMA DE PAGO -->
                            <div class="contInputRadio">

                                 <!-- SELECCIONAR PAGO EN TRANSFERENCIA -->
                                <div class="contInputRadio--carrito">    
                                    <input type="radio" name="formaPago" id="Transferencia" value="Transferencia" onclick="verPagoTransferencia()"/>
                                    <label class="contInputRadio__label" for="Transferencia">Transferencia bancaria</label>
                                </div>

                                <!-- SELECCIONAR PAGO EN PAGOMOVIL -->                                
                                <div class="contInputRadio--carrito">    
                                    <input type="radio" name="formaPago" id="PagoMovil" value="PagoMovil" onclick="verPagoMovil()"/>
                                    <label class="contInputRadio__label" for="PagoMovil">Pago movil</label> 
                                </div>

                                <!-- SELECCIONAR PAGO EN PAYPAL -->                               
                                <div class="contInputRadio--carrito">    
                                    <input type="radio" name="formaPago" id="Paypal" value="Paypal" onclick="verPagoPaypal()"/>
                                    <label class="contInputRadio__label" for="Paypal">Paypal</label> 
                                </div>

                                <!-- SELECCIONAR PAGO BITCOIN -->                               
                                <div class="contInputRadio--carrito">    
                                    <input type="radio" name="formaPago" id="Bitcoin" value="bitcoin" onclick="verPagoBitcoin()"/>
                                    <label class="contInputRadio__label" for="Bitcoin">Bitcoin</label> 
                                </div>

                                <!-- SELECCIONAR PAGO ACORDADO -->
                                <div class="contInputRadio--carrito">    
                                    <input type="radio" name="formaPago" id="Acordado" value="acordado" onclick="verPagoAcordado()"/>
                                    <label class="contInputRadio__label" for="Acordado">Acordado con tienda</label> 
                                </div>  
                            </div>   

                            <!-- DATOS PAGO TRANSFERENCIA -->
                            <div class="contInforPago" id="Contenedor_60a">
                                <h3 class="h3_2">Datos para transferencia</h3>
                                <table class="tabla_2">
                                    <tbody>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">Banco</td>
                                            <td>Mercantil</td>
                                        </tr>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">Titular</td>
                                            <td>Pablo Cabeza</td>
                                        </tr>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">Nº cuenta</td>
                                            <td>0105 0062 10 1062261763</td>
                                        </tr>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">Cedula/RIF</td>
                                            <td>12.728.036</td>
                                        </tr class="tabla2__tr1">
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">Monto</td>
                                            <td><input class="contInforPago--input" type="text" id="PagarTransferencia" readonly></td>
                                        </tr class="tabla2__tr1">
                                        <tr class="tabla2__tr2"></tr>
                                    </tbody>
                                </table>
                            </div>
                            
                            <!-- DATOS PAGOMOVIL -->
                            <div class="contInforPago" id="Contenedor_60b">
                                <h3 class="h3_2">Datos para PagoMovil</h3>                                
                                <table class="tabla_2">
                                    <tbody>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">Banco</td>
                                            <td>Mercantil</td>
                                        </tr>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">Cedula</td>
                                            <td>12.728.036</td>
                                        </tr>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">Telefono</td>
                                            <td>0424-537.40.44</td>
                                        </tr>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">Monto</td>
                                            <td><input class="contInforPago--input" type="text" id="PagarPagoMovil" readonly></td>
                                        </tr class="tabla2__tr1">
                                        <tr>
                                            <td class="td_6"></td>
                                            <td></td>
                                        </tr>
                                        <tr class="tabla2__tr2"></tr>
                                    </tbody>
                                </table>
                            </div>

                            <!-- DATOS PAYPAL -->
                            <div class="contInforPago" id="Contenedor_60g">
                                <h3 class="h3_2">Datos para Paypal</h3>                                
                                <table class="tabla_2">
                                    <tbody>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">Usuario</td>
                                            <td>pcabeza7@gmail.com</td>
                                        </tr>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">Monto</td>
                                            <td><input class="contInforPago--input" type="text" id="PagarDolaresPaypal" readonly></td>
                                        </tr>
                                    </tbody>
                                </table>      
                            </div>
                            
                            <!-- DATOS BITCOIN -->
                            <div class="contInforPago" id="Contenedor_60g">
                                <h3 class="h3_2">Datos para bitcoin</h3>                                
                                <table class="tabla_2">
                                    <tbody>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">wallet</td>
                                            <td>1231qweqw29342340234923423</td>
                                        </tr>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">red</td>
                                            <td>smart-chain</td>
                                        </tr>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">moneda</td>
                                            <td>BTC</td>
                                        </tr>
                                        <tr class="tabla2__tr1">
                                            <td class="tabla2__td1">Monto</td>
                                            <td><input class="contInforPago--input" type="text" id="PagarDolaresPaypal" readonly></td>
                                        </tr>
                                    </tbody>
                                </table>      
                            </div>
                            
                            <!-- PAGO ACORDADO -->
                            <div class="contInforPago" id="Contenedor_60e">
                                <h3 class="h3_2">Acuerdo con tienda</h3>
                                <p>Contacta al encargado de la tienda.</p>
                            </div>

                            <!-- INFORMAR PAGO -->
                            <div style="display: none" id="Contenedor_60f"> 
                                <div class="contFlex--pagos">
                                    <div>
                                        <h3 class="rompe_Flex h3_2">Informe su pago</h3>
                                    </div>
                                    <div class="contInputRadio">
                                        <input type="radio" name="referenciaPago" id="ReferenciaPago" value="NumeroPagoBancario" onclick="verInputReferencia()"/>
                                        <label class="contInputRadio__label" for="ReferenciaPago">Codigo referencia</label> 
                                    </div>
                                    <div class="contInputRadio">
                                        <input type="radio" name="referenciaPago" id="CapturePago" value="CapturePagoBancario" onclick="verCapturePago()"/>
                                        <label class="contInputRadio__label" for="CapturePago">Capture de pago</label> 
                                    </div>
                                </div>

                                <!-- INPUT CODIGO REFERENCIA -->
                                <div class="contOculto" id="InputReferencia">
                                    <input class="login_cont--input borde--input" type="text" name="codigoReferencia" id="Codigo_RegistroPago" placeholder="Código referencia"/>
                                </div>                           
                                                         
                                <!-- CAPTURE PAGO -->
                                <div class="contOculto" id="InputCapturePago">
                                    <label class="boton boton--largo boton--centro" for="ImagenCapturePago">Insertar capture</label>
                                    <input class="Default_ocultar" type="file" accept=".jpeg, .jpg, .png, .gif, .webp" name="imagenCapturePago" id="ImagenCapturePago"/>
                                    <br>
                                    </div>
                                    <!-- div que muestra la previsualización del capture -->
                                    <div class="contGeneralCentro" id="DivCapturePago"></div>
                                </div> 
                            </div>
                            
                            <!-- BOTON DE ENVIO Y DATOS OCULTOS -->
                            <article>
                                <div class="contBoton">
                                    <input class="Default_ocultar" type="text" name="id_comerciante" value="{{ $id_comerciante }}"/>     
                                    <!-- Cargado via Ajax cuando el usuario es recordado -->
                                    <input class="Default_ocultar" type="text" name="id_usuario" id="ID_Usuario" />
                                    <input class="Default_ocultar" type="text" name="pedido" id="Pedido"/>
    
                                    <input class="Default_ocultar boton boton--alto botonJS" id="InformarPago" type="submit" value="Enviar Pago"/>
                                </div>
                            </article> 
                        </div>
                    </div>
                </article> 
            </form>
        </div>
    </section>
</section>
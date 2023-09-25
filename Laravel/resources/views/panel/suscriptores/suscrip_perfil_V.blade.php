@extends('layouts.partiers.header_suscriptor')

@section('titulo', 'Panel marketplace')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/suscriptores/suscrip_menu_V')
    
    <!-- Se coloca el SDN para la libreria JQuery, necesaria para la previsualización del capture--> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <div class="login_cont" id="Contenedor_42">  
        <form action="{{ route('ActualizaPerfilSuscriptor') }}" method="POST" name="form_Configurar" enctype="multipart/form-data" autocomplete="off"> <!--  onsubmit="return validarPerfil()" -->
            {!! csrf_field() !!}
              
                <!-- SUSCRIPTOR -->
                <fieldset class="fieldset_1">
                    <legend class="legend_1">Datos suscriptor</legend> 

                    <label class="login_cont--label">Nombre</label>
                    <input class="login_cont--input borde--input" type="text" name="nombreSuscriptor" id="" value="{{ $suscriptor->nombreSuscriptor }}" autocomplete="off"/>
                    
                    <label class="login_cont--label">Apellido</label>
                    <input class="login_cont--input borde--input" type="text" name="apellidoSuscriptor" id=""  value="{{ $suscriptor->apellidoSuscriptor }}" autocomplete="off"/>
                                                                
                    <label class="login_cont--label">Correo</label>
                    <input class="login_cont--input borde--input" type="text" name="correoSuscriptor" id="" value="{{ $suscriptor->correoSuscriptor }}" onchange="validarFormatoCorreo(); setTimeout(llamar_verificaCorreo,200)" onclick="ColorearCorreo()" autocomplete="off"/>
                    <div class="contenedor_43" id="Mostrar_verificaCorreo"></div>

                    <label class="login_cont--label">Municipio</label>
                    <select class="login_cont--select borde--input" name="municipio" id="Municipio" onchange="SeleccionarParroquia(this.form)">
                        <option hidden>{{ $suscriptor->municipioSuscriptor }}</option> <!--se da el valor hidden para que no lo muestre al desplegar el select -->
                        <option value="Aristides Bastidas">Aristides Bastidas</option>
                        <option value="Bolivar">Bolivar</option>
                        <option value="Bruzual">Bruzual</option>
                        <option value="Cocorote">Cocorote</option>
                        <option value="Independencia">Independencia</option>
                        <option value="Jose Antonio Paez">Jose Antonio Paez</option>
                        <option value="La Trinidad">La Trinidad</option>
                        <option value="Manuel Monge">Manuel Monge</option>
                        <option value="Nirgua">Nirgua</option>
                        <option value="Peña">Peña</option>
                        <option value="San Felipe">San Felipe</option>
                        <option value="Sucre">Sucre</option>
                        <option value="Urachiche">Urachiche</option>
                        <option value="Veroes">Veroes</option>
                    </select>

                    <label class="login_cont--label">Parroquia</label>
                    <select class="login_cont--select borde--input" name="parroquia" id="Parroquia">
                        <option>{{ $suscriptor->parroquiaSuscriptor }}</option>
                    </select>                
                </fieldset>

                <br><br>
                <!-- DATOS COMERCIALES -->
                <small class="small_1">Usuarios con publicaciones en marketplace</small>
                <fieldset class="fieldset_1 fieldset_2">
                    <legend class="legend_1">Datos comerciales</legend> 

                    <!-- IMAGEN CATALOGO -->
                    <div class="">
                        <label class="login_cont--label">Imagen catalogo o tienda</label>
                    
                            @if($suscriptor->nombreImgCatalogo == '')
                                <label class="Default_pointer" for="imgCatalogo">    
                                    <figure>
                                        <img class="cont_panel--imagen--catalogo" name="imagenNoticia" alt="Fotografia Principal" id="blah" src="{{ asset('/images/imagen.png') }}"/>
                                    </figure>
                                </label>
                                <input class="Default_ocultar" type="file" name="imagenCatalogo" id="imgCatalogo"/>
                            @else
                                <label class="Default_pointer" for="imgCatalogo"> 
                                    <figure>
                                        <img class="cont_panel--imagen--catalogo" name="imagenNoticia" alt="Fotografia del catalogo" id="blah" src="{{ asset('/images/clasificados/' . $suscriptor->ID_Suscriptor . '/' . $suscriptor->nombreImgCatalogo) }}"/>
                                    </figure>
                                </label>
                                <input class="Default_ocultar" type="file" name="imagenCatalogo" id="imgCatalogo"/>
                            @endif
                    </div>               

                    <!-- TELEFONO -->
                    <label class="login_cont--label">Telefono</label>
                    <input class="login_cont--input borde--input" type="text" name="telefono" id=""  value="<?php //echo $Key['telefonoSuscriptor'];?>" autocomplete="off"/>

                    <!-- PSEUDONIMO -->
                    <label class="login_cont--label">Nombre comercial</label>
                    <input class="login_cont--input borde--input" type="text" name="pseudonimo" id="" value="<?php //echo $Key['pseudonimoSuscripto'];?>" autocomplete="off"/>

                    <!-- CATEGORIA -->        
                    <label class="login_cont--label">Categoria</label>
                    <select class="login_cont--select borde--input" name="categoria" id="Categoria">
                        <option hidden><?php //echo $Key['categoria'];?></option> <!--se da el valor hidden para que no lo muestre al desplegar el select -->
                        <option value="ComidaRapida">Comida Rapida</option>
                        <option value="MaterialMedicoQuirurgico">Material médico quirúrgico</option>
                        <option value="Minimarket">Minimarket</option>
                        <option value="Bodega">Bodega</option>
                        <option value="Panaderia">Panadería</option>
                        <option value ="Ferreteria">Ferretería</option>
                        <option value="Arte">Arte</option>
                        <option value="Ropa">Ropa</option>
                        <option value="Zapateria">Zapatería</option>
                        <option value="JoyasRelojeria">Joyas y relojería</option>
                        <option value="Mascotas">Mascotas</option>
                        <option value="RepuestoAutomotriz">Repuesto automotriz</option>
                        <option value="Farmacia">Farmacia</option>
                        <option value="Licoreria">Licorería</option>
                        <option value="Deportes">Deportes</option>
                        <option value="Floristeria">Floristería</option>
                        <option value="Construccion">Construcción</option>
                        <option value="Telefonos">Telefonos</option>
                        <option value="Papeleria">Papelería y Librería</option>
                        <option value="Merceria">Mercería</option>
                        <option value="Frutas">Frutas, verduras y hortalizas</option>
                        <option value="Caramelos">Caramelos</option>
                        <option value="Cosmeticos">Cosmeticos</option>
                        <option value="Juguetes">Juguetes</option>
                    </select>
                </fieldset>

            @foreach($suscriptor as $Key) 
                <!-- SECCIONES -->
                <fieldset class="fieldset_1 fieldset_2">
                    <legend class="legend_1">Secciones</legend>
                    <div class="" id="Contenedor_79">
                        <p class="p_12">Organiza tú catalogo de productos por secciones, añade tantas como consideres necesario.<span class="span_13" id="Span_1"> Ver sugerencias:</span></p>
                        <br>
                        
                        <!-- div a clonar sin eventos y oculto mediante z-index = -1 -->
                        <div class="Default_ocultar" id="Contenedor_80A">
                            <div class="contenedor_80C" id="Contenedor_80C">
                                <input class="login_cont--label borde--input input_12" type="text"/>
                                <div class="contenedor__80div">
                                    <img class="Default_pointer span_10 span_14_js span_10--seccion" src="<?php //echo RUTA_URL . '/public/iconos/cerrar/outline_cancel_black_24dp.png';?>"/>
                                </div>
                            </div>
                        </div>
                        <?php   
                        //Entra en el IF cuando no hay secciones creadas
                        // if($Datos['secciones'] == Array ( )){  ?>
                            <div class="contenedor_80C" id="Contenedor_80">
                                <input class="login_cont--input borde--input input_12 seccionesJS" type="text" name="seccion[]" id="Seccion" placeholder="Indica una sección"/>
                                <div class="contenedor__80div">
                                    <img class="Default_pointer span_10 span_14_js span_10--seccion" src="<?php //echo RUTA_URL . '/public/iconos/cerrar/outline_cancel_black_24dp.png';?>"/>
                                </div>
                            </div>
                            <?php
                        // }   
                        // else{  //Entra en el ELSE cuando hay secciones creadas  
                            // $Contador = 1;
                            // foreach($Datos['secciones'] as $Row) :   ?>                           
                                <div class="contenedor_80C" id="Contenedor_80">
                                    <input class="login_cont--input borde--input input_12 seccionesJS" type="text" name="seccion[]" id="Seccion_<?php //echo $Contador;?>" value="<?php //echo $Row['seccion'];?>" onblur="Llamar_ActualizarSeccion(this.value,'<?php //echo $Row['ID_Seccion'];?>')"/>
                                    <div class="contenedor__80div">
                                        <img class="Default_pointer span_10 span_14_js span_10--seccion" src="<?php //echo RUTA_URL . '/public/iconos/cerrar/outline_cancel_black_24dp.png';?>"/>
                                    </div>
                                </div>
                                <?php
                        //         $Contador++;
                        //     endforeach;   
                        // }   ?>
                    </div>
                    <!--div alimentado via Ajax por medio de la funcion Llamar_EliminarSeccion() solo para verificar respuesta de servidor-->
                    <!-- <did id="ReadOnly"></did> -->
                    <label class="boton" name="enviarSeeciones" id="Label_5">Añadir sección</label>
                </fieldset>

                <!-- FORMAS DE PAGO-->
                <fieldset class="fieldset_1 fieldset_2">
                    <legend class="legend_1">Formas de pago aceptadas</legend>
                    <div class="contenedor_166">   
                        <input type="checkbox" name="transferencia" id="Transferencia" <?php //if($Key['transferencia'] == 1){//echo 'checked';} ?>/>
                        <label class="contInputRadio__label" for="Transferencia">Transferencia</label>           
                    </div>  
                    <div class="contenedor_166">   
                        <input type="checkbox" name="pago_movil" id="Pago_movil" <?php //if($Key['pago_movil'] == 1){//echo 'checked';} ?>/>
                        <label class="contInputRadio__label" for="Pago_movil">Pago movil</label>           
                    </div>  
                    <div class="contenedor_166">   
                        <input type="checkbox" name="paypal" id="Paypal" <?php //if($Key['paypal'] == 1){//echo 'checked';} ?>/>
                        <label class="contInputRadio__label" for="Paypal">Paypal</label>           
                    </div>  
                    <div class="contenedor_166">   
                        <input type="checkbox" name="zelle" id="Zelle" <?php //if($Key['zelle'] == 1){//echo 'checked';} ?>/>
                        <label class="contInputRadio__label" for="Zelle">Zelle</label>           
                    </div>  
                    <div class="contenedor_166">   
                        <input type="checkbox" name="criptomoneda" id="Criptomoneda" <?php //if($Key['criptomoneda'] == 1){//echo 'checked';} ?>/>
                        <label class="contInputRadio__label" for="Criptomoneda">Criptomoneda</label>           
                    </div>  
                    <div class="contenedor_166">   
                        <input type="checkbox" name="bolivar" id="Bolivar" <?php //if($Key['efectivo_Bs'] == 1){//echo 'checked';} ?>/>
                        <label class="contInputRadio__label" for="Bolivar">Pago en destino con efectivo (Bs.)</label>           
                    </div>  
                    <div class="contenedor_166"> 
                        <input type="checkbox" name="dolar" id="Dolar" <?php //if($Key['efectivo_Dol'] == 1){//echo 'checked';} ?>/>
                        <label class="contInputRadio__label" for="Dolar">Pago en destino con efectivo ($)</label>      
                    </div>  
                    <div class="contenedor_166">   
                        <input type="checkbox" name="acordado" id="Acordado" <?php //if($Key['acordado'] == 1){//echo 'checked';} ?>/>
                        <label class="contInputRadio__label" for="Acordado">Pago acordados con el cliente</label>
                    </div>
                </fieldset> 
            @break
            @endforeach

            <!-- BOTON DE ENVIO -->
            <div class="cont_panel--guardar--catalogo"> 
                <input class="boton" type="submit" value="Guardar"/>  
            </div> 
        </form>
        <br><br>
    </div>

    <script src="{{ asset('/js/E_suscrip_perfil.js?v=' . rand()) }}"></script> 
    <script src="{{ asset('/js/A_suscrip_perfil.js?v=' . rand()) }}"></script> 
    <script src="{{ asset('/js/funcionesVarias.js?v=' . rand()) }}"></script>
    <script src="{{ asset('/js/parroquias.js?v=' . rand()) }}"></script> 

    <script> 
        //Da una vista previa de la imagen del catalogo
        function readImage(input, id_Label){
            // console.log("______Desde readImage()______", input + ' | ' + id_Label)
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    id_Label.attr('src', e.target.result); //Renderizamos la imagen
                }
                reader.readAsDataURL(input.files[0]);
            }
        }        
        $("#imgCatalogo").change(function(){
            // Código a ejecutar cuando se detecta un cambio de imagen de tienda
            var id_Label = $('#blah');
            readImage(this, id_Label);
        });
    </script>        

@endsection()  
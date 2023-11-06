@extends('layouts.header_suscriptor')

@section('titulo', 'Panel marketplace')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/comerciantes/comerciante_menu_V')
    
    {{-- Se coloca el SDN para la libreria JQuery, necesaria para la previsualización de la imagen --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <div class="login_cont" id="Contenedor_42">  
        <form action="{{ route('ActualizaPerfilComerciante') }}" method="POST" name="form_Configurar" enctype="multipart/form-data" autocomplete="off" onsubmit="return validarPerfil()">
            @csrf
              
                <fieldset class="fieldset_1" id="marcador_01">
                    <legend class="legend_1">Datos comerciante</legend> 
                    
                    <label class="login_cont--label">Nombre</label>
                    <input class="login_cont--input borde--input" type="text" name="nombreComerciante" id="NombreComerciante" value="{{ $comerciante[0]->nombreComerciante }}" autocomplete="off"/>
                    
                    <label class="login_cont--label">Apellido</label>
                    <input class="login_cont--input borde--input" type="text" name="apellidoComerciante" id="ApellidoComerciante" value="{{ $comerciante[0]->apellidoComerciante }}" autocomplete="off"/>
                                                                
                    <label class="login_cont--label">Correo</label>
                    <input class="login_cont--input borde--input" type="text" name="correoComerciante" id="CorreoComerciante" value="{{ $comerciante[0]->correoComerciante }}" onchange="validarFormatoCorreo(); setTimeout(llamar_verificaCorreo,200)" onclick="ColorearCorreo()" autocomplete="off"/>
                    <div class="contenedor_43" id="Mostrar_verificaCorreo"></div>

                    <label class="login_cont--label">Municipio</label>
                    <select class="login_cont--select borde--input" name="municipioComerciante" id="MunicipioComerciante" onchange="SeleccionarParroquia(this.form)">
                        <option hidden>{{ $comerciante[0]->municipioComerciante }}</option> <!--se da el valor hidden para que no lo muestre al desplegar el select -->
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
                    <select class="login_cont--select borde--input" name="parroquiaComerciante" id="ParroquiaComerciante">
                        <option>{{ $comerciante[0]->parroquiaComerciante }}</option>
                    </select>                
                </fieldset>

                <br><br>
                <!-- DATOS COMERCIALES -->
                <fieldset class="fieldset_1 fieldset_2" id="marcador_02">
                    <legend class="legend_1">Datos comerciales</legend> 

                    <!-- IMAGEN CATALOGO -->
                    <div class="">
                        <label class="login_cont--label">Imagen catalogo o tienda</label>
                        @if($comerciante[0]->nombreImgCatalogo == '')
                            <label class="Default_pointer" for="ImgCatalogo">    
                                <figure>
                                    <img class="cont_panel--imagen--catalogo" name="imagenNoticia" alt="Fotografia Principal" id="blah" src="{{ asset('/images/imagen.png') }}"/>
                                </figure>
                            </label>
                            <input class="Default_ocultar" type="file" accept=".jpeg,.jpg,.png,.gif,.webp"  name="imagenCatalogo" id="ImgCatalogo"/>
                        @else
                            <label class="Default_pointer" for="ImgCatalogo"> 
                                <figure>
                                    <img class="cont_panel--imagen--catalogo" name="imagenNoticia" alt="Fotografia del catalogo" id="blah" src="{{ asset('/images/clasificados/' . $comerciante[0]->ID_Comerciante . '/' . $comerciante[0]->nombreImgCatalogo) }}"/>
                                </figure>
                            </label>
                            <input class="Default_ocultar" type="file" accept=".jpeg,.jpg,.png,.gif,.webp" name="imagenCatalogo" id="ImgCatalogo"/>
                        @endif
                    </div>               

                    <!-- TELEFONO -->
                    <label class="login_cont--label">Telefono</label>
                    <input class="login_cont--input borde--input" type="text" name="telefonoComerciante" id="TelefonoComerciante" value="{{ $comerciante[0]->telefonoComerciante }}" autocomplete="off"/>

                    <!-- PSEUDONIMO -->
                    <label class="login_cont--label">Nombre comercial</label>
                    <input class="login_cont--input borde--input" type="text" name="pseudonimoComerciante" id="PseudonimoComerciante" value="{{ $comerciante[0]->pseudonimoComerciante }}" autocomplete="off"/>

                    <!-- CATEGORIA -->        
                    <label class="login_cont--label">Categoria</label>
                    <select class="login_cont--select borde--input" name="categoriaComerciante" id="Categoria">
                        <option hidden>{{ $comerciante[0]->categoriaComerciante }}</option> <!--se da el valor hidden para que no lo muestre al desplegar el select -->
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
 
                <!-- SECCIONES -->
                <fieldset class="fieldset_1 fieldset_2" id="marcador_03">
                    <legend class="legend_1">Secciones</legend>
                    <div id="Contenedor_79">
                        <p class="p_12">Organiza tú catalogo de productos por secciones, añade tantas como consideres necesario.</p>
                        <br>
                        
                        <!-- div a clonar sin eventos y oculto mediante z-index = -1 -->
                        <div class="Default_ocultar" id="Contenedor_80A">
                            <div class="contenedor_80C" id="Contenedor_80C">
                                <input class="login_cont--input borde--input input_12" type="text"/>
                                <div class="contenedor__80div">
                                    <img class="Default_pointer span_10 span_14_js" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}"/>
                                </div>
                            </div>
                        </div> 
                        {{-- Entra en el IF cuando no hay secciones creadas --}}
                        @if($secciones == null)
                            <p>aqui</p>
                            <div class="contenedor_80C" id="Contenedor_80">
                                <input class="login_cont--input borde--input input_12 seccionesJS" type="text" name="seccion[]" id="Seccion" placeholder="Indica una sección"/>
                                <div class="contenedor__80div">
                                    <img class="Default_pointer span_10 span_14_js" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}"/>
                                </div>
                            </div>
                        @else    {{-- Entra en el ELSE cuando hay secciones creadas --}}
                            @php($Contador = 1)
                            @foreach($secciones as $Row)                          
                                <div class="contenedor_80C" id="Contenedor_80">
                                    <input class="login_cont--input borde--input input_12 seccionesJS" type="text" name="seccion[]" id="Seccion" value="{{ $Row->seccion }}" onblur="Llamar_ActualizarSeccion(this.value,'{{ $Row->ID_Seccion }}')"/>
                                    <div class="contenedor__80div">
                                        <img class="Default_pointer span_10 span_14_js" id="{{ $Row->ID_Seccion }}" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}"/>
                                    </div>
                                </div>
                                @php($Contador++)
                            @endforeach  
                        @endif
                    </div>

                    <!--div alimentado via Ajax por medio de la funcion Llamar_EliminarSeccion() solo para verificar respuesta de servidor-->
                    <!-- <did id="ReadOnly"></did> -->
                    <label class="boton" id="Label_5">Añadir sección</label>
                </fieldset>

            <!-- FORMAS DE PAGO-->
            <fieldset class="fieldset_1 fieldset_2" id="marcador_04">
                <legend class="legend_1">Formas de pago aceptadas</legend>
                <div class="contenedor_166">   
                <input type="checkbox" name="transferencia" id="Transferencia" @if($comerciante[0]->transferenciaComerciante == 1){{'checked' }} @endif/>
                    <label class="contInputRadio__label" for="Transferencia">Transferencia</label>           
                </div>  
                <div class="contenedor_166">   
                <input type="checkbox" name="pago_movil" id="Pago_movil" @if($comerciante[0]->pago_movilComerciante == 1){{ 'checked' }} @endif/>
                    <label class="contInputRadio__label" for="Pago_movil">Pago movil</label>           
                </div>  
                <div class="contenedor_166">   
                    <input type="checkbox" name="paypal" id="Paypal" @if($comerciante[0]->paypalComerciante == 1){{ 'checked' }} @endif/>
                    <label class="contInputRadio__label" for="Paypal">Paypal</label>           
                </div>  
                <div class="contenedor_166">   
                    <input type="checkbox" name="criptomoneda" id="Criptomoneda" @if($comerciante[0]->criptomonedaComerciante == 1){{ 'checked' }} @endif/>
                    <label class="contInputRadio__label" for="Criptomoneda">Criptomoneda</label>           
                </div>  
                <div class="contenedor_166">   
                    <input type="checkbox" name="acordado" id="Acordado" @if($comerciante[0]->acordadoComerciante == 1){{ 'checked' }} @endif/>
                    <label class="contInputRadio__label" for="Acordado">Pago acordados con el cliente</label>
                </div>
            </fieldset> 
            
            <!-- MENU INDICE -->
            <section>   <!--id="Contenedor_83"--> 
                <div class="contenedor_83 borde_1">
                    <a class="contenedor_83--a" href="#marcador_01">Datos comerciante</a>
                    <a class="contenedor_83--a" href="#marcador_02">Datos comerciales</a>
                    <a class="contenedor_83--a" href="#marcador_03">Secciones</a>
                    <a class="contenedor_83--a" href="#marcador_04">Formas de pago</a>

                    <!-- BOTON DE ENVIO -->
                    <div class="contenedor_83--boton">
                        <input class="boton boton--largo" type="submit" value="Guardar"/>
                    </div>          
                    <div class="contenedor_45">
                        <input type="checkbox" id="DesactivarComerciante" name="desactivarComerciante" @if($comerciante[0]->desactivarComerciante == 1) checked = checked" @endif />
                        <label class="label_19" for="DesactivarComerciante">Desactivar catalogo.</label>
                        <div id="Mostrar_tienda"></div>
                    </div> 
                </div>
            </section> 
        </form>
        <br><br>
    </div>

    <script src="{{ asset('/js/E_Comerciante_perfil.js?v=' . rand()) }}"></script> 
    <script src="{{ asset('/js/A_Comerciante_perfil.js?v=' . rand()) }}"></script> 
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
        $("#ImgCatalogo").change(function(){
            // Código a ejecutar cuando se detecta un cambio de imagen de tienda
            var id_Label = $('#blah');
            readImage(this, id_Label);
        });
    </script>        

@endsection()  
@extends('layouts.header_Noticia')

@section('titulo', 'Registro')

@section('contenido')

    <section id="Section_5">
        <div syle="height: 100%;">
            <div style="min-height: 100%;" class="login_cont">
                <form action="{{route('RecibeRegistro')}}" method="POST" id="FormularioCom" name="formRegistroCom" autocomplete="off" onsubmit="return validarRegistro()">
                    <fieldset class="fieldset_1">
                        <legend class="legend_1">Registro de suscripción</legend> 
                        
                        <div class="login_cont--form">
                            <!-- NOMBRE AFILIADO -->                
                            <label class="login_cont--label">Nombre</label>
                            <input class="login_cont--input borde--input" type="text" name="nombre" id="Nombre"/> 

                            <!-- APELLIDO AFILIADO -->                
                            <label class="login_cont--label">Apellido</label>
                            <input class="login_cont--input borde--input" type="text" name="apellido" id="Apellido"/> 

                            <!-- CORREO AFILIADO -->
                            <label class="login_cont--label">Correo electronico</label>
                            <input class="login_cont--input borde--input" type="text" name="correo" id="Correo" onblur="llamar_verificaCorreo(id, 'AfiCom')" onfocus="removerContenidoDiv()"/>
                            <div class="contenedor_43" id="Mostrar_verificaCorreo"></div>
                            
                            <!-- MUNICIPIO AFILIADO -->                
                            <label class="login_cont--label">Municipio</label>
                            <select class="login_cont--select borde--input" name="municipio" id="Municipio"  onchange="SeleccionarParroquia(this.form)">
                                <option></option>
                                <option value="Aristides Bastidas">Aristides Bastidas</option>
                                <option value="Simon Bolivar">Bolivar</option>
                                <option value="Manuel Bruzual">Bruzual</option>
                                <option value="Cocorote">Cocorote</option>
                                <option value="Independencia">Independencia</option>
                                <option value="Jose Antonio Paez">Jose Antonio Paez</option>
                                <option value="La Trinidad">La Trinidad</option>
                                <option value="Manuel Monge">Manuel Monge</option>
                                <option value="Nirgua">Nirgua</option>
                                <option value="José Vicente Peña">Peña</option>
                                <option value="San Felipe">San Felipe</option>
                                <option value="Antonio J. de Sucre">Sucre</option>
                                <option value="Urachiche">Urachiche</option>
                                <option value="Jose Joaquín Veroes">Veroes</option>
                            </select>               
                            
                            <label class="login_cont--label">Parroquia</label>
                            <select class="login_cont--select borde--input" name="parroquia" id="Parroquia">
                                    <option>Seleccione parroquia</option>
                            </select>   

                            <div class="contenedor_43" id="Mostrar_verificarNombreTienda"></div>
                        </div>
                    </fieldset>      

                    <fieldset class="fieldset_1 fieldset_2">
                        <legend class="legend_1">Datos de accceso</legend>  
                        <div class="login_cont--form">
                            
                            <!-- CLAVE -->
                            <label class="login_cont--label">Contraseña</label>
                            <input class="login_cont--input borde--input" type="password" name="clave" id="Clave"  onblur="llamar_verificaClave(this.value, 'AfiCom')"/>
                            <!-- Se recibe respuesta de ajax llamar_verificaClave()-->
                            <div class="contenedor_3" id="Mostrar_verificaClave"></div>

                            <!-- CONFIRMAR CLAVE -->
                            <label class="login_cont--label">Confirmar contraseña</label>
                            <input class="login_cont--input borde--input" type="password" name="confirmarClave" id="ConfirmarClave"/>
                        </div>          
                    </fieldset>        
                    
                    <!-- BOTON DE ENVIO Y DATOS OCULTOS -->
                    <div class="contBoton">  
                        {{-- <input class="Default_ocultar" type="text" name="id_noticia" value="<?php echo $Datos['id_noticia']?>"/>   --}}
                        <input class="boton" id="Boton_registrar" type="submit" value="Suscribirse"/>
                    </div>  
                {{-- </form> --}}
            </div>
        </div>
    </section>

    @include('layouts/footer')
@endsection()
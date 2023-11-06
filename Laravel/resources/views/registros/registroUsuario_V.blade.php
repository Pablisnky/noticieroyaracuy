@extends('layouts.header_Noticia')

@section('titulo', 'Registro de usuarios')

@section('contenido')

    <section id="Section_5">
        <div syle="height: 100%;">
            <div style="min-height: 100%;" class="login_cont">
                <form action="{{ route('RecibeRegistro') }}" method="POST" name="formRegistroCom" autocomplete="off" onsubmit="return validarRegistro()">
                    @csrf
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
                            <input class="login_cont--input borde--input" type="text" name="correo" id="Correo" onblur="llamar_verificaCorreo(this. value)"/>
                            <div id="Mostrar_verificaCorreo">.</div> {{-- El punto es para que el div se muestre aparentemente vacio, luego con ajax carga contenido--}}
                        </div>
                    </fieldset>      

                    <fieldset class="fieldset_1 fieldset_2">
                        <legend class="legend_1">Datos de accceso</legend>  
                        <div class="login_cont--form">
                            
                            <!-- CLAVE -->
                            <label class="login_cont--label">Contraseña</label>
                            <input class="login_cont--input borde--input" type="password" name="clave" id="Clave"/>

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
                </form>
            </div>
        </div>
    </section>

    {{-- @include('layouts/footer') --}}

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/E_Registro.js') }}"></script>
    <script src="{{ asset('/js/A_Registro.js') }}"></script>
    
@endsection()
@extends('layouts.partiers.header_Noticia')

@section('titulo', 'Login')

@section('contenido')
    <?php
        //Se añade la clase cuando se viene desde una noticia a la que se desea hacer un comentario
        if($bandera == 'responder'){ ?>
            <style>
                .detalle_cont--comentario{
                    background-color: var(--FondoDivModal); 
                    position: fixed; 
                    top: 0%;
                    left: 0%;
                    width: 100%;
                    height: 100%;
                }
            </style>
            <?php
        }
        else{   ?>
            <style>
                .detalle_cont--comentario{
                    background-color: white; 
                    position: fixed; 
                    top: 0%;
                    left: 0%;
                    width: 100%;
                    height: 100%;
                }
            </style>
            <?php
        }
    ?>
   
    <section class="detalle_cont--comentario">
        
        <!-- ICONO CERRAR -->
        <img class=" cont_modal--cerrar detalle_cont--cerrar Default_pointer" style="width: 1em;"  src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}" onclick="javascript:window.location.reload()"/>

        <div class="login_cont cont_login">
            <form action="{{ route('IniciarSesion') }}" method="POST">	
                {!! csrf_field() !!}
                <fieldset class="fieldset_1" >
                    <legend class="legend_1">Acceso a suscriptores</legend>
                    <div class="login_cont--form">
                        
                        <!-- CORREO -->
                        <label class="login_cont--label">e-mail</label>
                        <input class="login_cont--input borde--input" type="text" name="correo_Arr" id="Correo" autocomplete="off"/>  

                        <!-- CONTRASEÑA -->
                        <label class="login_cont--label">Contraseña</label>
                        <input class="login_cont--input borde--input" type="password" name="clave_Arr" id="Clave"  autocomplete="off"/>             

                        <!-- RECORDAR DATOS -->
                        <div class="contenedor_45">
                            <input class="" type="checkbox" id="Recordar" name="recordar" value="1"/>
                            <label class="" class="label_20" for="Recordar">Recordar datos en este equipo.</label>
                        </div> 
                        
                        <!-- BOTON DE ENVIO Y DATOS OCULTOS -->
                        <div class="contBoton">
                                <input class="Default_ocultar" type="text" name="bandera" value="{{ $bandera }}"/>
                                <input class="Default_ocultar" type="text" name="id_noticia" value="{{ $id_noticia }}"/>
                                <input class="Default_ocultar" type="text" name="id_comentario" value="{{ $id_comentario }}"/>
                            <input class="boton" id="Boton_Login" type="submit" value="Entrar"/>
                        </div>
                    </div>
                </fieldset> 
            </form>
        
            <!-- RECUPERAR CONTRASEÑA -->
            <div class="login_cont--recuperarClave">	
                <p>¿Olvidaste tu contraseña?</p>
                <label class="Default_link Default_pointer" id="Label_7">Recuperala</label>
                <br><br>

                <p>¿Quieres suscribirte?</p>
                <a href="{{route('registro')}}">Suscribete</a>
                <br><br>

                <p class="Inicio_8" style="line-height: 160%;">¿Eres periodista acreditado CNP en Venezuela?</p>
                <a href="#">Crea contenido</a>
            </div>
        </div>

        <!-- VENTANA MODAL PARA RECUPERAR CONTRASEÑA -->
        <div class="Default_ocultar" id="Contenedor_43"">
            <?php 
                $Datos = '';
                // require(RUTA_APP . "/vistas/modal/modal_recuperarCorreo_V.php"); 
            ?>
        </div>
    </section>

    @include('layouts/partiers/footer')

    <script src="{{ asset('/js/funcionesVarias.js') }}"></script>
@endsection()
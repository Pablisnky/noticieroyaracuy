@extends('layouts.header_SinMembrete')

@section('titulo', 'Fallo login')

@section('contenido')
    <?php 
    // Entra en el if por defecto
    if($bandera == 'solicitarCambio'){ ?>
        <section class="sectionModal">   
            
            {{-- BOTON CERRAR --}}       
            {{-- <a href="<?php //echo RUTA_URL . '/LoginController';?>"><i class="fas fa-times spanCerrar"></i></a> --}}
            
            <!-- ICONO CERRAR -->
            <a class="" href="{{ route('Login', ['id_noticia' => 'sin_id_noticia', 'bandera' => 'sin_bandera', 'id_comentario' => 'sin_id_comentario']) }}"><img class=" cont_modal--cerrar detalle_cont--cerrar Default_pointer" style="width: 1em;" id="CerrarVentana" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}"/></a>
            <br> 

            <div class="sectionModal__div">
                <p class="sectionModal__div__p">Indiquenos el correo afiliado, <br> enviaremos un código de recuperación</p>
                <br>
                <form action="{{ route('RecuperarClave') }}" method="POST" autocomplete="off" onsubmit = "return validarCorreo()">
                    @csrf
                    <input class="login_cont--input borde--input" type="text" name="correo" id="Input_13_JS">

                    <div class="contBoton">
                        <input class="boton" type="submit" id="BotonCambioCOntrasenia" value="Enviar">
                    </div>
                </form>
            </div>   
        </section>      
        <?php
    }
    else if($bandera == 'aleatorioinsertado'){    ?> 
        <section class="sectionModal"> 
            
            {{-- BOTON CERRAR        --}}       
            <a href="<?php //echo RUTA_URL . '/LoginController';?>"><i class="fas fa-times spanCerrar"></i></a>
            <br> 

            <div class="sectionModal__div">
                <p class='sectionModal__div__p'>Se ha enviado un código al correo suministrado.</p> 
                <br>
                <form action="{{ route('RecibeCodigoRecuperacion') }}" method="POST" onsubmit = "return validarCodigoEnviado()">
                    @csrf
                    <input  class="login_cont--input borde--input" type= "text" readonly value="{{ $correo }}" name="correo">
                    <br>
                    <input  class="login_cont--input borde--input" type="text" name="ingresarCodigo" id="IngresarCodigo" placeholder="Ingresar Código"> 
                    <div class="contBoton">
                        <input class="boton" type="submit" id="BotonCodigo" value="enviar">
                    </div>
                </form>  
            </div>         
        </section> 
        <?php
    }
    else if($bandera == 'nuevoIntento'){    ?> 
        <section class="sectionModal">      
            
            {{-- BOTON CERRAR        --}}  
            <a href="<?php //echo RUTA_URL . '/LoginController';?>"><i class="fas fa-times spanCerrar"></i></a>
            <br> 

            <div class="sectionModal__div">
                <p class='sectionModal__div__p'>El código insertado no es valido.</p> 
                <br>
                <form action="<?php //echo RUTA_URL . '/LoginController/recibeCodigoRecuperacion';?>" method="POST">
                    <input  class="login_cont--input borde--input" type= "text" readonly value="<?php //echo $Datos['correo'];?>" name="correo">
                    <input  class="login_cont--input borde--input" type="text" name="ingresarCodigo" placeholder="Ingresar Código Nuevamente"> 
                    <div class="contBoton">
                        <input class="boton" type="submit" value="enviar">
                    </div>
                </form>  
            </div>         
        </section>  <?php
    }
    else if($bandera == 'verificado'){   ?>  
        <section class="sectionModal">  

            {{-- BOTON CERRAR        --}}
            <a href="<?php //echo RUTA_URL . '/LoginController';?>"><i class="fas fa-times spanCerrar"></i></a>
            <br> 

            <div class="sectionModal__div">
                <p class="sectionModal__div__p">Nueva clave de acceso</p>
                <br>
                <form action="{{ route('RecibeCambioClave') }}" method="POST" onsubmit = "return validarCambioClave()">
                    @csrf

                    <!-- NUEVA CLAVE -->
                    <input  class="login_cont--input borde--input" type="" name="claveNueva" placeholder="Nueva clave" id="ClaveNueva">
                    <br><br>

                    <!-- REPETIR CLAVE -->
                    <input  class="login_cont--input borde--input" type="password" name="repiteClaveNueva" placeholder="Repetir clave" id="RepetirClaveNueva">

                    <!-- BOTON DE ENVIO Y DATOS OCULTOS -->
                    <input type="text" value="{{ $correo }}" name="correo" style="display:none"> 
                    <div class="contBoton">
                        <input class="boton"  type="submit" value="Enviar" name="enviar_2" id="botonCambioClave">
                    </div>
                </form>
            </div>         
        </section>  <?php  
    }  
    else if($bandera == 'acuseRecibo'){   ?>
        <section class="sectionModal"> 
            <div class="sectionModal__div"">
                <p class='sectionModal__div__p'>Contraseña cambiada exitosamente</p>
                <br>
                <div class="contBoton">
                    <a class='boton' href='{{ route('Login', ['id_noticia' => 'sin_id_noticia', 'bandera' => 'sin_bandera', 'id_comentario' => 'sin_id_comentario']) }}'>Inicie sesión</a>
                </div>
            </div>         
        </section>  <?php    
    } ?>

    <script>
        function validarCodigoEnviado(){
            console.log("______ Desde validarCodigoEnviado ______")  

            document.getElementById("BotonCodigo").value = "Procesando"
            document.getElementById("BotonCodigo").disabled = "disabled"
            document.getElementById("BotonCodigo").style.backgroundColor = "var(--OficialClaro)"
            document.getElementById("BotonCodigo").style.color = "var(--OficialOscuro)"
            document.getElementById("BotonCodigo").classList.add('borde_1')
            document.getElementById("BotonCodigo").style.cursor = "wait"
            
            let Codigo = document.getElementById('IngresarCodigo').value
            
            //Expresion regular para el codigo, solo admite numeros
            let ER_Codigo = /^[0-9]+$/

            if(Codigo == "" || Codigo.indexOf(" ") == 0 || Codigo.length > 6 || ER_Codigo.test(Codigo) == false){
                alert ("Codigo no valido");
                document.getElementById("IngresarCodigo").value = "";
                document.getElementById("IngresarCodigo").focus();
                document.getElementById("IngresarCodigo").style.backgroundColor = "var(--Fallos)"
                document.getElementById("BotonCodigo").value = "Entrar"
                document.getElementById("BotonCodigo").disabled = false
                document.getElementById("BotonCodigo").style.backgroundColor = "var(--OficialOscuro)"
                document.getElementById("BotonCodigo").style.color = "var(--OficialClaro)"
                document.getElementById("BotonCodigo").classList.remove('borde_1')
                document.getElementById("BotonCodigo").style.cursor = "pointer"
                return false;
            }
            return true;
        }

    //************************************************************************************************

    function validarCambioClave(){
        console.log("______ Desde validarCambioClave ______")  

        document.getElementById("botonCambioClave").value = "Procesando"
        document.getElementById("botonCambioClave").disabled = "disabled"
        document.getElementById("botonCambioClave").style.backgroundColor = "var(--OficialClaro)"
        document.getElementById("botonCambioClave").style.color = "var(--OficialOscuro)"
        document.getElementById("botonCambioClave").classList.add('borde_1')
        document.getElementById("botonCambioClave").style.cursor = "wait"
        
        let Clave = document.getElementById('ClaveNueva').value
        let RepiteClave = document.getElementById('RepetirClaveNueva').value
        
        if(Clave == "" || Clave.indexOf(" ") == 0 || Clave.length > 10){
            alert ("Clave maximo seis caracteres");
            document.getElementById("ClaveNueva").value = "";
            document.getElementById("ClaveNueva").focus();
            document.getElementById("ClaveNueva").style.backgroundColor = "var(--Fallos)"
            document.getElementById("botonCambioClave").value = "Entrar"
            document.getElementById("botonCambioClave").disabled = false
            document.getElementById("botonCambioClave").style.backgroundColor = "var(--OficialOscuro)"
            document.getElementById("botonCambioClave").style.color = "var(--OficialClaro)"
            document.getElementById("botonCambioClave").classList.remove('borde_1')
            document.getElementById("botonCambioClave").style.cursor = "pointer"
            return false;
        }        
        else if(RepiteClave == "" || RepiteClave.indexOf(" ") == 0 || RepiteClave.length > 10){
            alert ("La contraseña no coincide");
            document.getElementById("RepetirClaveNueva").value = "";
            document.getElementById("RepetirClaveNueva").focus();
            document.getElementById("RepetirClaveNueva").style.backgroundColor = "var(--Fallos)"
            document.getElementById("botonCambioClave").value = "Entrar"
            document.getElementById("botonCambioClave").disabled = false
            document.getElementById("botonCambioClave").style.backgroundColor = "var(--OficialOscuro)"
            document.getElementById("botonCambioClave").style.color = "var(--OficialClaro)"
            document.getElementById("botonCambioClave").classList.remove('borde_1')
            document.getElementById("botonCambioClave").style.cursor = "pointer"
            return false;
        }
        else if(Clave != RepiteClave){
            alert ("Las contraseña no coincide");
            document.getElementById("RepetirClaveNueva").value = "";
            document.getElementById("RepetirClaveNueva").focus();
            document.getElementById("RepetirClaveNueva").style.backgroundColor = "var(--Fallos)"
            document.getElementById("botonCambioClave").value = "Entrar"
            document.getElementById("botonCambioClave").disabled = false
            document.getElementById("botonCambioClave").style.backgroundColor = "var(--OficialOscuro)"
            document.getElementById("botonCambioClave").style.color = "var(--OficialClaro)"
            document.getElementById("botonCambioClave").classList.remove('borde_1')
            document.getElementById("botonCambioClave").style.cursor = "pointer"
            return false;
        }
        return true;
    }
    </script>
@endsection

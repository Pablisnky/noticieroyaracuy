@extends('layouts.partiers.header_Noticia')

@section('titulo', 'Login')

@section('contenido')

<section class="detalle_cont--comentario">
	<div class="login_cont cont_login">
        <form action="{{ route('IniciarSesion') }}" method="POST" onsubmit = "return validarLogin()">
            {!! csrf_field() !!}	
            <fieldset class="fieldset_1">
                <legend class="legend_1">Datos de acceso</legend>
                <div class="login_cont--form">
                    <input class="login_cont--input borde--input" type="text" name="correo_Arr" id="Correo_Usu" value="{{ $correoRecord->correoPeriodista }}" autocomplete="off">   

                    <input class="login_cont--input borde--input" type="password" name="clave_Arr" id="Clave" value="{{ $claveRecord }}" autocomplete="off"> 
                    
                    <!-- <div class="contenedor_45">
                        <input type="checkbox" id="Recordar" name="no_recordar" value="1">
                        <label class="label_20" for="Recordar">Dejar de recordar datos en este equipo.</label>
                    </div>   -->
                </div>
                
                <!-- BOTON DE ENVIO Y DATOS OCULTOS -->
                <div class="contBoton">            
                    <!-- este input es solo para que no entre en conclicto con el archivo E_Login.js, debido a que este ultimo tiene un addEventListener  -->
                    <input class="Default_ocultar" type="text" id="Label_7"> 
                    {{-- <input class="Default_ocultar" type="text" name="bandera" value="{{ $bandera }}"/>
                    <input class="Default_ocultar" type="text" name="id_noticia" value="{{ $id_noticia }}"/>
                    <input class="Default_ocultar" type="text" name="id_comentario" value="{{ $id_comentario }}"/> --}}

                    <input class="boton" id="Boton_Login" type="submit"  value="Entrar">
                </div>
            </fieldset>  
        </form>
    </div>   
    </section>

    {{-- @include('layouts/partiers/footer') --}}

    <script type="text/javascript" src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    <script type="text/javascript" src="{{ asset('/js/E_Login.js') }}"></script>

@endsection()
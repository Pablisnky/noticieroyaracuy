@extends('layouts.header_suscriptor')

@section('titulo', 'Panel periodista')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/periodistas/periodistaMenu_V')

    <div class="login_cont" id="Contenedor_42">  
        <form action="{{ route('ActualizaPerfilPeriodista') }}" method="POST" name="form_Configurar" enctype="multipart/form-data" autocomplete="off" onsubmit="return validarPerfil()">
            @csrf
              
            <fieldset class="fieldset_1" id="marcador_01">
                <legend class="legend_1">Datos periodista</legend> 
                
                {{-- NOMBRE --}}
                <label class="login_cont--label">Nombre</label>
                <input class="login_cont--input borde--input" type="text" name="nombrePeriodista" id="NombrePeriodista" value="{{ $periodista->nombrePeriodista }}" autocomplete="off"/>
                
                {{-- APELLIDO --}}
                <label class="login_cont--label">Apellido</label>
                <input class="login_cont--input borde--input" type="text" name="apellidoPeriodista" id="ApellidoPeriodista" value="{{ $periodista->apellidoPeriodista }}" autocomplete="off"/>
                                                            
                {{-- CORREO --}}
                <label class="login_cont--label">Correo</label>
                <input class="login_cont--input borde--input" type="text" name="correoPeriodista" id="CorreoPeriodista" value="{{ $periodista->correoPeriodista }}" onchange="validarFormatoCorreo(); setTimeout(llamar_verificaCorreo,200)" onclick="ColorearCorreo()" autocomplete="off"/>
                <div class="contenedor_43" id="Mostrar_verificaCorreo"></div>

                <!-- TELEFONO -->
                <label class="login_cont--label">Telefono</label>
                <input class="login_cont--input borde--input" type="text" name="telefonoPeriodista" id="TelefonoPeriodista" value="{{ $periodista->telefonoPeriodista }}" autocomplete="off"/>
                
                <!-- CNP -->
                <label class="login_cont--label">CNP</label>
                <input class="login_cont--input borde--input" type="text" name="cnp" id="CNP" value="{{ $periodista->CNP }}" autocomplete="off"/>

            </fieldset>          

            <!-- BOTON DE ENVIO -->
            <div class="contenedor_83--boton">
                <input class="boton boton--largo" style="margin: auto" type="submit" value="Guardar"/>
            </div>  
        </form>
    </div>

    {{-- <script src="{{ asset('/js/E_Periodista_perfil.js?v=' . rand()) }}"></script>  --}}
    {{-- <script src="{{ asset('/js/A_Periodista_perfil.js?v=' . rand()) }}"></script>  --}}
    <script src="{{ asset('/js/funcionesVarias.js?v=' . rand()) }}"></script>
    <script src="{{ asset('/js/parroquias.js?v=' . rand()) }}"></script> 

@endsection()  
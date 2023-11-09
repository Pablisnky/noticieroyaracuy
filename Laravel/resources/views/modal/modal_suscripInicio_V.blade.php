@extends('layouts.header_SinMembrete')

@section('titulo', 'Registro exitoso')

@section('contenido')

    <!-- se debe seleccionar un rol de usuario -->
    <section class="sectionModal">
        <h1 class="cont_modal_suscriptor--h1">Selecciona un rol.</h1>
        <p class="cont_modal_suscriptor--p">Más adelante podras configurar otros roles si lo necesitas</p>

        <div class="cont_modal_suscriptor borde_1"> 

            <!-- SUSCRIPTOR -->
            <a class="cont_modal_suscriptor--a borde_1" href="{{ route('CrearRol', ['id' => session('id_suscriptor'), 'bandera' => 'suscriptor']) }}" rel="noopener noreferrer">Suscriptor</a>
            
            <!-- PERIODISTA -->
            <a class="cont_modal_suscriptor--a borde_1" href="{{ route('CrearRol', ['id' => session('id_suscriptor'), 'bandera' => 'periodista']) }}" rel="noopener noreferrer">Periodista</a>

            <!-- COMERCIANTE -->
            <a class="cont_modal_suscriptor--a borde_1" href="{{ route('CrearRol', ['id' => session('id_suscriptor'), 'bandera' => 'comerciante']) }}">Comerciante</a>
            
            <!-- ARTISTA PLASTICO -->
            {{-- <a class="cont_modal_suscriptor--a borde_1" href="{{ route('CrearRol', ['id' => session('id_suscriptor'), 'bandera' => 'artista']) }}" rel="noopener noreferrer">Artista plastico</a> --}}

            <!-- DIRECTORIO PROFESIONAL -->
            {{-- <a class="cont_modal_suscriptor--a borde_1" href="{{ route('CrearRol', ['id' => session('id_suscriptor'), 'bandera' => 'profesional']) }}" rel="noopener noreferrer">Directorio profesional</a>                 --}}

            <!-- DIRECTORIO MEDICO -->
            {{-- <a class="cont_modal_suscriptor--a borde_1" href="{{ route('CrearRol', ['id' => session('id_suscriptor'), 'bandera' => 'medico']) }}" rel="noopener noreferrer">Directorio médico</a> --}}
        </div>
    </section>

    <script src="{{ asset('js/funcionesVarias.js?v=' . rand()) }}"></script>

@endsection()     
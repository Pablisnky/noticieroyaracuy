@extends('layouts.header_suscriptor')

@section('titulo', 'Dashboard suscriptor')

@section('contenido')
    
    <div class="cont_suscriptor"> 
        <h1>Selecciona un rol dentro de la plataforma.</h1>
        <p>Más adelante podras configurar otros roles si lo necesitas</p>

        <!-- SUSCRIPTOR -->
        <a class="cont_suscriptor--item borde_1" href="{{ route('CrearRol', ['id' => session('id_suscriptor'), 'bandera' => 'suscriptor']) }}" rel="noopener noreferrer">
            <div class="contenedor_27">
                <h1 class="cont_suscriptor--h1">Suscriptor ()por defecto, no deberia aparecer</h1>
                <p>Podras comentar las noticias y responder a comentarios de otros usuarios, subir quejas y reclamos de ausntos pendientes en tu comunidad o la ciudad en general.</p>
            </div>       
        </a>
        
        <!-- PERIODISTA -->
        <a class="cont_suscriptor--item borde_1" href="{{ route('CrearRol', ['id' => session('id_suscriptor'), 'bandera' => 'periodista']) }}" rel="noopener noreferrer">
            <div class="contenedor_27">
                <h1 class="cont_suscriptor--h1">Periodista</h1>
            <p>Si cuentas con credenciales del CNP, podras redactar notcias locales del estado Yaracuy y promocionar hasta tres de tus anunciantes sin cargos por publicidad en la plataforma</p>
            </div>       
        </a> 

        <!-- COMERCIANTE -->
        <a class="cont_suscriptor--item borde_1" href="{{ route('CrearRol', ['id' => session('id_suscriptor'), 'bandera' => 'comerciante']) }}">
            <div class="contenedor_27">
                <h1 class="cont_suscriptor--h1">Comerciante</h1>
                <p>Arma tu tienda virtual y sube tu catalogo de hasta 500 productos.</p>
            </div>
        </a>
        
        <!-- ARTISTA PLASTICO -->
        <a class="cont_suscriptor--item borde_1" href="{{ route('CrearRol', ['id' => session('id_suscriptor'), 'bandera' => 'artista']) }}" rel="noopener noreferrer">
            <div class="contenedor_27">
                <h1 class="cont_suscriptor--h1">Artista plastico</h1>
                <p>Publica tus obras en nuestra galeria de arte.</p>
            </div>
        </a> 

        <!-- DIRECTORIO PROFESIONAL -->
        <a class="cont_suscriptor--item borde_1" href="{{ route('CrearRol', ['id' => session('id_suscriptor'), 'bandera' => 'profesional']) }}" rel="noopener noreferrer">
            <div class="contenedor_27">
                <h1 class="cont_suscriptor--h1">Directorio profesional</h1>
                <p>Crea tu perfil profesional y lo publicamos en nuestro directorio.</p>
            </div>
        </a>

        <!-- DIRECTORIO MEDICO -->
        <a class="cont_suscriptor--item borde_1" href="{{ route('CrearRol', ['id' => session('id_suscriptor'), 'bandera' => 'medico']) }}" rel="noopener noreferrer">
            <div class="contenedor_27">
                <h1 class="cont_suscriptor--h1">Directorio médico</h1>
                <p>Si eres médico con permisos para ejercer legalmente la médicina, publica tu consulta, horarios y ofrecemos el sistema de apartado de citas.</p>
            </div>
        </a>
    </div>

    <script src="{{ asset('js/funcionesVarias.js?v=' . rand()) }}"></script>

@endsection()     
@extends('layouts.header_Noticia')

@section('titulo', 'Efemeride')

@section('contenido')

    <div class="cont_efemeride" id="cont_efemerides">
        <h1 class="h1--principal">Efeméride</h1>
        @foreach($efemerideHoy as $Key)

            <!-- TITULO -->
            <div class="">                   
                <h2 class="h2--efemerides">{{ $Key->titulo }}</h2>
            </div>

            <!-- IMAGEN -->
            <div class="">                        
                <figure>
                    <img class="cont_efemerides--imagen" alt="Fotografia Principal" src="{{ asset('/images/efemerides/' . $Key->nombre_ImagenEfemeride) }}"/> 
                </figure>
            </div>
            
            <!-- CONTENIDO -->
            <div >
                <textarea class="textarea--contenido textarea--borde textarea--font Efemeride--JS" id="Contenido" readonly>{{ $Key->contenido }}</textarea>
            </div>

            <br class="cont_efemeride--br">
        @endforeach
    </div>  

    <!-- BOTONES DEL PANEL FRONTAL -->
    <div class="cont_portada--botones">
        <div>
            <label class="boton boton--corto"><a class="Default_font--white" href="{{ route('Noticias') }}">Mas noticias</a></label> 
        </div>         
    </div>

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/E_Efemeride.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/FullScreem.js?v=' . rand()) }}"></script> 
@endsection()    
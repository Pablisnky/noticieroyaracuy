@extends('layouts.partiers/header_SinMembrete')

@section('titulo', 'Hemeroteca')

@section('contenido')
    <!-- Muestra todas las noticias de una sección -->
    <div class="cont_archivo--membrete">
        <!-- MEMBRETE FIJO -->
        <label class="header__titulo cont_archivo--header">Noticiero Yaracuy</label>
        
        <!-- SECCION -->
        <h1 class="cont_archivo--seccion">Archivo {{ $todasNoticiasSeccion[0]->seccion }}</h1> 
    
        <!-- PAGINACION -->
        <div class="cont_archivo--numeros">
            <ul class="cont_archivo--paginacion">
                <!-- BOTON RETROCEDER -->
                <!-- Si la página actual es mayor a uno, se muestra el botón para ir una página atrás -->
                @if($pagina > 1)
                    <li> 
                        <a href="{{ route('ArchivoPaginacion', ['id_seccion' => $cantidadNoticiasSeccion[0]['ID_Seccion'], 'pagina' => $pagina - 1]) }}"><img class="Default_pointer" style="margin-right:20px" src="{{ asset('/iconos/chevron/outline_arrow_back_ios_new_black_24dp.png') }}"/></a>
                    </li>
                @endif

                <!-- Mostramos enlaces numerados para ir a todas las páginas. -->
                {{-- @for($i = 1; $i <= $paginas; $i++)
                    <li class="cont_archivo--paginacion-numeros">                    
                        <a class="@if ($i == $pagina) {{ 'active' }} @endif" style="color:black" href="{{ route('ArchivoPaginacion', ['id_seccion' => $cantidadNoticiasSeccion[0]['ID_Seccion'], 'pagina' => $i]) }}">{{ $i }}</a>
                    </li>
                @endfor --}}

                <!-- BOTON AANZAR -->
                <!-- Si la página actual es menor al total de páginas, se muestra un botón para ir una página adelante -->
                @if($pagina < $paginas)
                    <li>
                        <a href="{{ route('ArchivoPaginacion', ['id_seccion' => $cantidadNoticiasSeccion[0]['ID_Seccion'], 'pagina' => $pagina + 1]) }}"><img class="Default_pointer" style="margin-right:20px" src="{{ asset('/iconos/chevron/outline_arrow_forward_ios_black_24dp.png') }}"/></a>
                    </li>
                @endif
            </ul> 
        </div>
        <!-- ICONO CERRAR -->
        <img class=" cont_modal--cerrar  Default_pointer" style="width: 1em;" id="CerrarVentana" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}"/>
    </div>

    <!-- NOTICIAS EN ARCHIVO -->
    <div class="cont_archivo"> 
        @foreach($todasNoticiasSeccion as $Row)
            @php($Iterador = 1)
            <div class="cont_archivo--noticia borde_1" id="<?php //echo $Iterador?>">
                <!-- IMAGEN -->
                <a href="{{ route('DetalleNoticia', $Row->ID_Noticia) }}" rel="noopener noreferrer" target="_blank"><img class="cont_noticia-imagen" alt="Fotografia" src="{{ asset('/images/noticias/' . $Row->nombre_imagenNoticia) }}"/></a>

                <div class="cont_noticia--titular">

                    <!-- TITULO -->
                    <p class="cont_archivo--titulo">{{ $Row->titulo }}</p>
                    <!-- <hr class="cont_noticia--hr_1"> -->
                    
                    <!-- FUENTE -->
                    <!-- <br> -->
                    <small class="cont_noticias_informacion--span">{{ $Row->fuente }}</small>     

                    <!-- FECHA -->
                    <br>
                    <small class="cont_noticias_informacion--span">{{ $Row->fechaPublicacion }}</small style="font-size: 0.8em;">
                    <br>                           
                </div>  
            </div>  
            @php($Iterador++)
        @endforeach
    </div>

    <script src="{{ asset('/js/E_Archivo.js?v=' . rand()) }}"></script>
    
@endsection()
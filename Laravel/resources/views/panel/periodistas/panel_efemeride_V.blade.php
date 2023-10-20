@extends('layouts.header_SoloEstilos')

@section('titulo', 'Panel efemerides')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/periodistas/periodistaMenu_V')

    <div class="cont_panel--main">
        <fieldset class="fieldset_1" id="Rowcipales"> 

        <!-- ICONO AGREGAR -->
        <a href="{{ route('AgregarEfemeride') }}" rel="noopener noreferrer"><img class="cont_modal--agregar Default_pointer" src="{{ asset('/iconos/agregar/outline_add_circle_outline_black_24dp.png') }}"/></a> 

        <legend class="legend_1">Efemerides</legend>
            @foreach($efemerides as $Row)
                <div style="display: flex; margin-bottom: 30px" id="{{ $Row['ID_Efemeride'] }}">
                
                    <!-- IMAGEN EFEMERIDE -->
                    <div style=" width: 100%">       
                        <figure>
                            <img class="cont_panel--imagen" name="imagenPrincipal" alt="Fotografia Principal" src="{{ asset('/images/efemerides/' . $Row->nombre_ImagenEfemeride) }}"/> 
                        </figure>
                    </div>
                    <div style="width: 100%; padding-left: 1%">

                        <!-- FECHA -->
                        <label class="cont_panel--label">Fecha</label>
                        <label class="cont_panel--fecha">{{ $Row->fecha }}</label>
                        
                        <!-- TITULO -->
                        <label class="cont_panel--label">Titulo</label>
                        <label class="cont_panel--titulo">{{ $Row->titulo }}</label>
                        
                        <!-- CONTENIDO -->                        
                        <!-- <label class="cont_panel--label">Contenido</label>
                        <textarea class="cont_panel--textarea Default--textarea--scrol" name="contenido" id="Contenido" autosize="none">{{ $Row->contenido }}</textarea>  -->
                        <br>
                        <!-- ACTUALIZAR -->
                        <a class="" href=" <?php //RUTA_URL?>/Panel_C/actualizar_efemeride/{{ $Row['ID_Efemeride'] }}?>" rel="noopener noreferrer">Actualizar</a>
                        
                        <!-- PUBLICIDAD -->
                        {{-- <a href="{{ RUTA_URL?>/Panel_C/eliminar_noticia_principal/{{ $Not_Gen['ID_Efemeride'];?>" rel="noopener noreferrer">Publicidad</a> --}}
                        
                        <!-- ELIMINAR -->                        
                        <label style="margin-left: 50px; color: blue;" class="Default_pointer" onclick="EliminarEfemeride('{{$Row->ID_Efemeride }}','{{ route('EliminarEfemeride', ['id_efemeride' => $Row->ID_Efemeride]) }}')">Eliminar</label>
                    </div>
                </div>
            @endforeach    
        </fieldset>
    </div>
    
    <!-- solo para debuguear cuando se elimina una noticia -->
    {{-- <div id="ReadOnly"></div> --}}
    
    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/E_Efemeride.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/A_Efemeride.js?v='. rand()) }}"></script>

    {{-- @include('layouts/footer') --}}

@endsection()
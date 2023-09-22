@extends('layouts.partiers.header_SoloEstilos')

@section('titulo', 'Panel efemerides')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/periodistas/periodistaMenu_V')

    <div class="cont_panel--main">
        <fieldset class="fieldset_1" id="Rowcipales"> 

        <!-- ICONO AGREGAR <?php //echo RUTA_URL?>/Panel_C/agregar_efemeride-->
        <a href="{{ route('AgregarEfemeride') }}" rel="noopener noreferrer"><img class="cont_modal--agregar Default_pointer" src="{{ asset('/iconos/agregar/outline_add_circle_outline_black_24dp.png') }}"/></a> 

        <legend class="legend_1">Efemerides</legend>
            @foreach($efemerides as $Row)
                <div style="display: flex; margin-bottom: 30px">
                
                    <!-- IMAGEN EFEMERIDE -->
                    <div style=" width: 30%">       
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
                        <a href="<?php //echo RUTA_URL?>/Panel_C/eliminar_efemeride/<?php //echo $Row['ID_Efemeride'];?>,<?php //echo $Row['nombre_ImagenEfemeride'];?>" rel="noopener noreferrer">Eliminar</a>
                    </div>
                </div>
            @endforeach    
        </fieldset>
    </div>
    
    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>

    @include('layouts/partiers/footer')

@endsection()
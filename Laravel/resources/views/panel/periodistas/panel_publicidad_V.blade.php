@extends('layouts.header_PanelPortada')

@section('titulo', 'Panel periodista')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/periodistas/periodistaMenu_V')
    
    <div class="cont_panel--main">
        <fieldset class="fieldset_1" id="Rowcipales"> 

            <!-- ICONO AGREGAR -->
            <a href="#" rel="noopener noreferrer"><img class="cont_modal--agregar Default_pointer" src="{{ asset('/iconos/agregar/outline_add_circle_outline_black_24dp.png') }}"/></a> 
            
            <legend class="legend_1">Publicidad</legend>
            @foreach($anuncio as $Row) 
                <div class="cont_panel--publicidad" id="<?php //echo $Row['ID_Anuncio'];?>"> 
                    
                    <!-- IMAGEN ANUNCIO PUBLICITARIO -->
                    <div class="cont_panel__agenda--imagen">       
                        <figure>
                            <img class="cont_panel--imagen" name="imagenPrincipal" alt="Fotografia Principal" src="{{ asset('/images/publicidad/' . $Row->nombre_imagenPublicidad) }}"/> 
                        </figure>
                    </div>
                    <div class="cont_panel__agenda--contenido">        

                        <!-- CLIENTE -->
                        <label class="cont_panel--label">Cliente:</label>
                        <label>{{ $Row->razonSocial }}</label>
                        <br>
                        
                        <!-- FECHA -->
                        <label class="cont_panel--label">Fecha de caducidad:</label>
                        <label>{{ $Row->fechaCulmina }}</label>

                        <div style="width: 100%;">
                        
                            <!-- ACTUALIZAR -->
                            <a href="" rel="noopener noreferrer">Editar</a>
                            
                            <!-- ELIMINAR -->
                            <label class="Default_pointer" style="color: blue; margin-left: 50px" onclick="EliminarAnuncio()">Eliminar</label>
                        </div>
                    </div> 
                </div>        
            @endforeach     
        </fieldset>
    </div>

    <script src="{{ asset('/javascript/funcionesVarias.js?v='. rand()) }}"></script>
    <script src="{{ asset('/javascript/E_Publicidad.js?v=' . rand()) }}"></script>
    <script src="{{ asset('/javascript/A_Publicidad.js?v=' . rand()) }}"></script>

    {{-- @include('layouts/footer') --}}

@endsection()
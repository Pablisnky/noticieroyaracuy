@extends('layouts.header_PanelAgenda')

@section('titulo', 'Panel agenda')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/periodistas/periodistaMenu_V')
    
    <div class="cont_panel--main">
        <fieldset class="fieldset_1" id="Rowcipales"> 

            <!-- ICONO AGREGAR -->
            <a href="{{ route('AgregarAgenda') }}" rel="noopener noreferrer"><img class="cont_modal--agregar Default_pointer" src="{{ asset('/iconos/agregar/outline_add_circle_outline_black_24dp.png') }}"/></a>       
            
            <legend class="legend_1">Agenda de eventos</legend>
           
            @foreach($agenda as $Row)
                <div class="cont_panel--publicidad" id="{{ $Row['ID_Agenda'] }}"">                
                    <!-- IMAGN  -->
                    <div class="cont_panel__agenda--imagen">       
                        <figure>
                            <img class="cont_panel--imagen" name="imagenPrincipal" alt="Fotografia Principal" src="{{ asset('/images/agenda/' . $Row->nombre_imagenAgenda) }}"/> 
                        </figure>
                    </div>
                    <div>                            
                        <!-- FECHA -->
                        <label style="display: block; width: 150%">Fecha de caducidad</label>
                        <label></label>

                        <div style="width: 100%;">
                            <!-- COMPARTIR FACEBOOK-->             
                            <a href="#" target="_blank">Facebook</a>
                            
                            <!-- ACTUALIZAR -->
                            <a class="" href="#" rel="noopener noreferrer">Actualizar</a>
                            
                            <!-- PUBLICIDAD -->
                            <!-- <a href="<?php //echo RUTA_URL?>/Panel_C/<?php //echo $Row['ID_Agenda'];?>" rel="noopener noreferrer">Publicidad</a> -->
                            
                            <!-- ELIMINAR -->
                            <label style="margin-left: 50px; color: blue;" class="Default_pointer" onclick="EliminarAgenda('{{$Row->ID_Agenda }}','{{ route('EliminarAgenda', ['id_agenda' => $Row->ID_Agenda]) }}')">Eliminar</label>
                        </div>
                    </div> 
                </div>
            @endforeach    
        </fieldset>
    </div>

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/E_PanelAgenda.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/A_PanelAgenda.js?v='. rand()) }}"></script>

    @include('layouts/footer')

@endsection()
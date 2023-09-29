@extends('layouts.partiers.header_PanelPortada')

@section('titulo', 'Panel periodista')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/periodistas/periodistaMenu_V')
    
    <div class="cont_panel--main">     
        {{-- <div class="cont_panel--encabezado Default_quitarMovil">

            <!-- BUSCADOR SECCION -->
            <div class="cont_panel--seccion">
                <label class="login_cont--label">Sección</label>
                <select class="cont_panel--select borde--input" onchange="llamar_noticiaSeccion(this.value)">
                    <option></option>
                    <option value="Cultura">Cultura</option>
                    <option>Politica</option>
                    <option>Sucesos</option>
                    <option>Infraestructura</option>
                    <option>Salud</option>
                    <option>Deporte</option>
                    <option>Comunidad y sociales</option>
                    <option>Educación</option>
                    <option>Religión</option>
                    <option>Ciencia y tecnología</option>
                    <option>Economía</option>
                    <option>Servicios públicos</option>
                    <option>Comuna</option>
                    <option>Turismo</option>
                </select>
            </div> 

            <!-- BUSCADOR MUNICIPIO -->
            <div class="cont_panel--seccion">
                <label class="login_cont--label">Municipio</label>
                <select class="cont_panel--select borde--input" onchange="Llamar_noticiaMunicipio(this.value)">
                    <option></option>
                    <option value="Aristides Bastidas">Aristides Bastidas</option>
                    <option value="Simon Bolivar">Bolivar</option>
                    <option value="Manuel Bruzual">Bruzual</option>
                    <option value="Cocorote">Cocorote</option>
                    <option value="Independencia">Independencia</option>
                    <option value="Jose Antonio Paez">Jose Antonio Paez</option>
                    <option value="La Trinidad">La Trinidad</option>
                    <option value="Manuel Monge">Manuel Monge</option>
                    <option value="Nirgua">Nirgua</option>
                    <option value="José Vicente Peña">Peña</option>
                    <option value="San Felipe">San Felipe</option>
                    <option value="Antonio J. de Sucre">Sucre</option>
                    <option value="Urachiche">Urachiche</option>
                    <option value="Jose Joaquín Veroes">Veroes</option>
                </select>  
            </div>

            <!-- BUSCADOR TITULAR -->
            <div style="flex-grow: 1;">                
                <label class="login_cont--label">Titular</label>
                <input class="login_cont--input borde--input" type="text" name="buscadorTitular" id="BuscadorTitular" />
            </div>

            <!-- REFRESCAR -->
            <div style="margin-bottom:3px">
                <img class="Default_pointer" style="width: 2vw" src="{{ asset('/iconos/refrescar/outline_refresh_black_24dp.png') }}" id="Refrescar"/>
            </div>

            <!-- PAGINACION -->
        </div> --}}

        <div class="cont_PanelnoticiasGenerales" id="Mostrar_NoticiasFiltradas">
            <fieldset class="fieldset_1">
                <legend class="legend_1">Noticias generales</legend>
               
                @foreach($noticiasGenerales as $Not_Gen)
                    <div class="cont_panel--flex" id="{{ $Not_Gen->ID_Noticia }}">
                        <!-- IMAGN NOTICIA -->
                        <div class="cont_panel--flex-left">          
                            <figure>
                                @foreach($imagenesNoticiasGenerales as $Row) 
                                    @if($Not_Gen->ID_Noticia == $Row->ID_Noticia) 
                                        <img class="cont_panel--imagen" name="imagenPrincipal" alt="Fotografia Principal" src="{{ asset('/images/noticias/' .  $Row->nombre_imagenNoticia) }}"/> 
                                    @endif
                                @endforeach
                            </figure>
                        </div>
                        <div style="width: 100%;">

                            <!-- TITULO -->
                            <label class="cont_panel--label">Titulo</label>
                            <label class="cont_panel--titulo">{{ $Not_Gen->titulo }}</label>
                                                    
                            <!-- SECCION -->
                            <label class="cont_panel--label">Seccion</label>
                            <ul class="cont_panel--seccion--ul">
                                @foreach($seccionessNoticiasGenerales as $Key)  
                                    @if($Not_Gen->ID_Noticia == $Key->ID_Noticia)
                                        <li class="cont_panel--seccion--li">{{ $Key->seccion }}</li>
                                    @endif
                                @endforeach
                            </ul>
                            
                            <!-- MUNICIPIO -->
                            <label class="cont_panel--label">Municipio</label>
                            <label class="cont_panel--titulo">{{ $Not_Gen->municipio }}</label>
                                                    
                            <!-- ANUNCIO -->
                            <label class="cont_panel--label">Anuncio publicitario</label>
                                @foreach($publicidad as $Row_3)
                                    @if($Not_Gen->ID_Noticia == $Row_3->ID_Noticia)
                                        <label class="cont_panel--fecha">{{ $Row_3->razonSocial }}</label>
                                    @endif
                                @endforeach

                            <!-- FECHA -->
                            <label class="cont_panel--label">Fecha</label>
                            <label class="cont_panel--fecha">{{ \Carbon\Carbon::parse(strtotime($Not_Gen->fecha))->format('d-m-Y') }}</label>
                            
                            <!-- VISITAS -->
                            <!-- <label class="cont_panel--label">Visitas</label> -->
                                <?php
                                // foreach($Datos['visitas'] as $Row_2)   : 
                                    // if($Not_Gen['ID_Noticia'] == $Row_2['ID_Noticia']){     ?>
                                        <!-- <label class="cont_panel--fecha"><?php //echo $Row_2['visitas'];?></label> -->
                                            <?php
                                    // }
                                // endforeach; ?>

                            <!-- COMPARTIR REDES SOCIALES -->
                            <div>
                                <div class=" detalle_cont--redesSociales--Panel">
                                    <!-- COMPARTIR FACEBOOK -->     
                                    
                                    <!-- COMPARTIR TWITTER -->
                                </div>
                                                            
                                <!-- EDITAR NOTICIA -->   
                                <a style="margin-left: 10%" href="{{ route('ActualizarNoticia', ['id_noticia' => $Not_Gen->ID_Noticia, 'bandera' => 'Not_Generales']) }}" rel="noopener noreferrer">Editar</a>
                                                        
                                <!-- ELIMINAR NOTICIA -->                                
                                <label style="margin-left: 50px; color: blue;" class="Default_pointer" onclick="EliminarNoticia('{{$Not_Gen->ID_Noticia }}','{{ route('EliminarNoticia', $Not_Gen->ID_Noticia) }}')">Eliminar</label>
                            </div>
                        </div>
                    </div>            
                @endforeach  
            </fieldset>            
        </div>
    
        <!--Carga mediante Ajax las noticias con el titular escrito en la busqueda solicitada desde buscador_V.php -->
    <div class="contenedor_58" id="Muestra_Titular"></div>
    
    <!-- solo para debuguear cuando se elimina una noticia -->
    {{-- <div style="margin-top: 10%" id="ReadOnly"></div> --}}

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/E_NoticiasGenerales.js?v=' . rand()) }}"></script>
    <script src="{{ asset('/js/A_NoticiasGenerales.js?v=' . rand()) }}"></script>

    {{-- @include('layouts/partiers/footer') --}}

@endsection()
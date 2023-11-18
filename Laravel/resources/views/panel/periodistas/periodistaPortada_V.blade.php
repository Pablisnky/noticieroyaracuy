@extends('layouts.header_PanelPortada')

@section('titulo', 'Panel periodista')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/periodistas/periodistaMenu_V')
    
    <div class="cont_panel--main">
        <fieldset class="fieldset_1" id="Not_Principales"> 
            <legend class="legend_1">Noticias en portada</legend>            
            @if(!empty($noticia[0]['ID_Noticia']))
                @php($Contador = 1)
                @foreach($noticia as $Not_Prin)
                    <div class="cont_panel--flex" id="{{ $Not_Prin->ID_Noticia }}"> 
                                    
                        <!-- IMAGEN NOTICIA -->
                        <div class="cont_panel--flex-left">      
                            <figure>                                
                                @foreach($imagenesNoticiasPortadas as $Row)  
                                    @if($Not_Prin->ID_Noticia == $Row->ID_Noticia)
                                        <img class="cont_panel--imagen" name="imagenPrincipal" alt="Fotografia Principal" src="{{ asset('/images/noticias/' .  $Row->nombre_imagenNoticia) }}"/> 
                                    @endif
                                @endforeach
                            </figure>
                        </div>
                        <div  class="cont_panel--flex-right">

                            <!-- TITULO -->
                            <label class="cont_panel--label">Titulo</label>
                            <label class="cont_panel--titulo">{{ $Not_Prin->titulo }}</label>
                                                    
                            <!-- SECCION -->
                            <label class="cont_panel--label">Seccion</label>                            
                            <ul class="cont_panel--seccion--ul">
                                @foreach($seccionesNoticiasPortadas as $Key) 
                                    @if($Not_Prin->ID_Noticia == $Key->ID_Noticia)
                                        <li class="cont_panel--seccion--li">{{ $Key->seccion }}</li>
                                    @endif
                                @endforeach
                            </ul>
                            
                            <!-- MUNICIPIO -->
                            <label class="cont_panel--label">Municipio</label>
                            <label class="cont_panel--titulo">{{ $Not_Prin->municipio }}</label>
                                                    
                            <!-- ANUNCIO PUBLICITARIO-->
                            <label class="cont_panel--label">Anuncio publicitario</label>
                                @foreach($publicidad as $Row_3) 
                                    @if($Not_Prin->ID_Noticia == $Row_3->ID_Noticia)
                                        <label class="cont_panel--fecha">{{ $Row_3->razonSocial }}</label>
                                    @endif                                    
                                @endforeach

                            <!-- FECHA -->
                            <label class="cont_panel--label">Fecha</label>
                            <label class="cont_panel--fecha">{{ \Carbon\Carbon::parse(strtotime($Not_Prin->fecha))->format('d-m-Y') }}</label>
                            
                            <!-- COMPARTIR -->
                            <div>
                                <label class="cont_panel--label">Compartir</label>
                                <div class="detalle_cont--redesSociales--Panel">

                                    <!-- COMPARTIR FACEBOOK --> 
                                    <div class="detalle_cont--red--panel" onclick="Llamar_compartirNoticia('{{ route('CompartirNoticia', ['id_noticia' => $Not_Prin->ID_Noticia, 'redSocial' => 'facebook']) }}')">        
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.noticieroyaracuy.com/noticias/detalleNoticia/{{ $Not_Prin->ID_Noticia }}" target="_blank" rel="noopener noreferrer"><img style="height: 1.8em;" alt="facebook" src="{{ asset('/images/facebook.png') }}"/></a> 
                                        @foreach($noticasCompartidas as $Row_4)
                                            @if($Not_Prin->ID_Noticia == $Row_4->ID_Noticia AND $Row_4->facebook == 1)
                                                <input class="Default_ocultar" type="checkbox" value="1" name="facebook" id="Facebook">
                                                <label for="Facebook" ><img style="height: 1em;" src="{{ asset('/iconos/check/outline_done_black_24dp.png') }}"/></label>
                                            @endif
                                        @endforeach
                                    </div>     
                                        
                                    <!-- COMPARTIR TWITTER --> 
                                    <div class="detalle_cont--red--panel" onclick="Llamar_compartirNoticia('{{ route('CompartirNoticia', ['id_noticia' => $Not_Prin->ID_Noticia, 'redSocial' => 'twitter']) }}')">
                                        <a href="https://twitter.com/intent/tweet?url=https://www.noticieroyaracuy.com/noticias/detalleNoticia/{{ $Not_Prin->ID_Noticia }}&text={{  $Not_Prin->titulo }}" target="_blank" rel="noopener noreferrer"><img style="height: 2em;" src="{{ asset('/images/twitter.png') }}"/></a>
                                        @foreach($noticasCompartidas as $Row_4)
                                            @if($Not_Prin->ID_Noticia == $Row_4->ID_Noticia AND $Row_4->Twitter == 1)
                                                <img style="height: 1em;" src="{{ asset('/iconos/check/outline_done_black_24dp.png') }}"/>
                                            @endif
                                        @endforeach
                                    </div>     
                                        
                                    <!-- COMPARTIR INSTAGRAM -->   
                                    <div class="detalle_cont--red--panel">
                                        <a href="{{ route('Instagram', ['id_noticia' => $Not_Prin->ID_Noticia ]) }}"><img style="height: 1.5em; margin-top:3px" alt="Instagram" src="{{ asset('/images/instagram.png') }}"/></a>
                                        @foreach($noticasCompartidas as $Row_4)
                                            @if($Not_Prin->ID_Noticia == $Row_4->ID_Noticia AND $Row_4->instagram == 1)
                                                <img style="height: 1em;" src="{{ asset('/iconos/check/outline_done_black_24dp.png') }}"/>
                                            @endif
                                        @endforeach
                                    </div>  

                                    <!-- COMPARTIR EMAIL --> 
                                    <div class="detalle_cont--red detalle_cont--correo">
                                        <form action="{{ route('AcuseRecibo') }}" method="POST" autocomplete="off" onsubmit="Llamar_compartirNoticia('https://www.noticieroyaracuy.com/panelPeriodista/compartir/' . {{  $Not_Prin->ID_Noticia }} . '/correo')">
                                            @csrf
                                            <img class="Default_pointer" style="width: 2em" alt="Whatsapp" src="{{ asset('/iconos/correo/outline_email_black_24dp.png') }}" onclick="Mostrar_Correo('DireccionCorreo_{{$Contador}}', 'EnviarCorreo_{{$Contador}}')"/>
                                            @foreach($noticasCompartidas as $Row_4)
                                                @if($Not_Prin->ID_Noticia == $Row_4->ID_Noticia AND $Row_4->correo == 1)
                                                    <img style="height: 1em;" src="{{ asset('/iconos/check/outline_done_black_24dp.png') }}"/>
                                                @endif
                                            @endforeach

                                            <input class="login_cont--input borde--input Default_ocultar" type="text" name="destinatario" placeholder="dirección destinatario" id="DireccionCorreo_{{$Contador}}"/>
                                            <input class="Default_ocultar" type="text" name="id_noticia" value="{{ $Not_Prin->ID_Noticia }}"/>
                                            <input class="Default_ocultar" type="text" name="titulo" value="{{ $Not_Prin->titulo }}"/>
                                            <input class="Default_ocultar" type="text" name="fuente" value="{{ $Not_Prin->fuente }}"/>
                                            <input class="Default_ocultar" type="text" name="municipio" value="{{ $Not_Prin->municipio }}"/>
                                            <input class="Default_ocultar" type="text" name="fecha" value="{{ \Carbon\Carbon::parse(strtotime($Not_Prin->fecha))->format('d-m-Y')}}"/>
                                            @foreach($imagenesNoticiasPortadas as $Row)  
                                                @if($Not_Prin->ID_Noticia == $Row->ID_Noticia)
                                                    <input class="Default_ocultar" type="text" name="imagen" value="{{ $Row->nombre_imagenNoticia }}"/>
                                                @endif
                                            @endforeach
                                            
                                        
                                            <input class="boton Default_ocultar" type="submit" value="Enviar correo" id="EnviarCorreo_{{$Contador}}"/> 
                                        </form>
                                    </div>  
                                </div>

                                <!-- EDITAR NOTICIA -->
                                <a style="margin-left: ; color: blue;" href="{{ route('ActualizarNoticia', ['id_noticia' => $Not_Prin->ID_Noticia, 'bandera' => 'Portada']) }}" rel="noopener noreferrer">Editar</a>
                                                            
                                <!-- ELIMINAR NOTICIA -->
                                <label style="margin-left: 50px; color: blue;" class="Default_pointer" onclick="EliminarNoticia('{{$Not_Prin->ID_Noticia }}','{{ route('EliminarNoticia', $Not_Prin->ID_Noticia) }}')">Eliminar</label>
                            </div>
                        </div>
                    </div>
                    @php($Contador ++)
                @endforeach
            @else   
                <p class="cont_panel--NoNoticia bandaAlerta">No se han cargado noticias el dia de hoy</p> 
            @endif
        </fieldset>
    </div>
    
        <!-- solo para debuguear cuando se elimina una noticia -->
        {{-- <div id="ReadOnly"></div> --}}

    <script src="{{ asset('/js/funcionesVarias.js?v=' . rand()) }}"></script>
    <script src="{{ asset('/js/E_NoticiasPortadas.js?v=' . rand()) }}"></script>
    <script src="{{ asset('/js/A_NoticiasPortadas.js?v=' . rand()) }}"></script>
@endsection()
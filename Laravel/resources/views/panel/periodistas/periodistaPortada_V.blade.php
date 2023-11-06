@extends('layouts.header_PanelPortada')

@section('titulo', 'Panel periodista')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/periodistas/periodistaMenu_V')
    
    <div class="cont_panel--main">
        <fieldset class="fieldset_1" id="Not_Principales"> 
            <legend class="legend_1">Noticias en portada</legend>            
            @if(!empty($noticia[0]['ID_Noticia']))
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
                                    <div class="detalle_cont--red">        
                                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.noticieroyaracuy.com/noticias/detalleNoticia/{{ $Not_Prin->ID_Noticia }}" target="_blank" rel="noopener noreferrer"><img style="height: 1.8em;" alt="facebook" src="{{ asset('/images/facebook.png') }}"/></a>
                                    </div>     
                                    
                                    <!-- COMPARTIR TWITTER --> 
                                    <div class="detalle_cont--red">
                                        <a href="https://twitter.com/intent/tweet?url=https://www.noticieroyaracuy.com/noticias/detalleNoticia/{{ $Not_Prin->ID_Noticia }}&text={{  $Not_Prin->titulo }}" target="_blank"><img style="height: 2em;" src="{{ asset('/images/twitter.png') }}"/></a>
                                    </div>     
                                    
                                    <!-- COMPARTIR INSTAGRAM -->   
                                    <div class="detalle_cont--red">
                                        <a href="{{ route('Instagram', ['id_noticia' => $Not_Prin->ID_Noticia ]) }}"><img style="height: 1.5em; margin-top:3px" class="" alt="Instagram" src="{{ asset('/images/instagram.png') }}"/></p>
                                    </div>  

                                    <!-- COMPARTIR WHATSAPP --> 
                                    <div class="whatsapp detalle_cont--red">
                                        <a href="whatsapp://send?text={{ $Not_Prin->titulo }}. {{ route('DetalleNoticia', $Not_Prin->ID_Noticia) }}" data-action="share/whatsapp/share"><img class="detalle_cont--redesSociales-Whatsapp" alt="Whatsapp" src="{{ asset('/images/Whatsapp.png') }}"/></a>
                                    </div>                                              
                                </div>

                                <!-- EDITAR NOTICIA -->
                                <a style="margin-left: ; color: blue;" href="{{ route('ActualizarNoticia', ['id_noticia' => $Not_Prin->ID_Noticia, 'bandera' => 'Portada']) }}" rel="noopener noreferrer">Editar</a>
                                                            
                                <!-- ELIMINAR NOTICIA -->
                                <label style="margin-left: 50px; color: blue;" class="Default_pointer" onclick="EliminarNoticia('{{$Not_Prin->ID_Noticia }}','{{ route('EliminarNoticia', $Not_Prin->ID_Noticia) }}')">Eliminar</label>
                            </div>
                        </div>
                    </div>
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
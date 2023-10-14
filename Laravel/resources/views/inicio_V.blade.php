@extends('layouts.partiers.header_Inicio')

@section('titulo', 'NoticieroYaracuy')

@section('contenido')

    <main class="cont_portada" id="Contenedor_principal">
        @foreach ($noticias as $Row)
            <section class="cont_portada--noticia section " id="">
                <div class="cont_noticia borde_1 borde_3 section__content" data-content id="">
                    
                    <!-- IMAGEN -->
                    <a href="{{ route('DetalleNoticia', $Row->ID_Noticia) }}" rel="noopener noreferrer" target="_blank">  
                        <div style="display: flex;"> 
                            <div style="flex-grow: 1; flex-shrink: 1;">         
                                <figure> 
                                    <img class="imagen--portada efectoBrillo section__img" alt="Fotografia Principal" src="images/noticias/{{ $Row->nombre_imagenNoticia }}"/>
                                </figure>
                            </div>

                            @if($Row['municipio'] != 'Ambito estadal')
                                {{-- TEXTO MUNICIPIO VERTICAL --}}
                                <div  class="cont_portada--municipio">
                                    <p class="cont_portada--municipio--p"><?php echo $Row['municipio'];?> </p>
                                    <p class="cont_portada--abreviatura">Mcpio</p>
                                </div>
                            @else
                                {{-- TEXTO VERTICAL  --}}
                                <div  class="cont_portada--municipio">
                                    <p class="cont_portada--municipio--p"><?php echo $Row['municipio'];?> </p>
                                </div>
                            @endif
                            
                        </div>

                    </a>

                    <div class="cont_portada--tituloResumen">

                        <!-- TITULAR -->
                        <div class="cont_portada--titular""> 
                            <h2 class="titular--texto">{{$Row->titulo}}</h2>
                        </div>
                        
                        <!-- RESUMEN -->
                        <div class="cont_portada--texto">                   
                            <h2 class="cont_portada--resumen Default_puntosSuspensivos">{{$Row->subtitulo}}</h2>  
                        </div>
                    </div>
                    
                    <!-- INFORMACION EN ICONOS -->
                    <div class="cont_portada--informacion">

                        {{-- CANTIDAD DE IMAGENES --}}
                        @foreach ($imagenes as $Key)
                            @if($Row->ID_Noticia == $Key->ID_Noticia)
                                <div style="display: flex; align-items:center; ">
                                    <span style="margin-right: 5px">{{$Key->Cantidad_Imagenes}}</span> 
                                    <img style="width: 1.4em;" src="{{ asset('/iconos/imagenes/outline_photo_camera_black_24dp.png') }}"/>
                                </div>
                            @endif
                        @endforeach   

                        {{-- CANTIDAD DE VIDEO --}}  
                        @foreach ($cantidadVideos as $Key_7)
                            @if($Row->ID_Noticia == $Key_7->ID_Noticia)
                                <div style="display: flex; align-items:center;">
                                    <span style="margin-right: 5px">{{ $Key_7->Cantidad_Videos}}</span> 
                                    <img style="width: 1.8em" src="{{ asset('/iconos/video/outline_videocam_black_24dp.png') }}"/>                            
                                </div>
                            @endif
                        @endforeach 

                        {{-- SIN VIDEO --}}
                        @foreach ($noticiasSinVideo as $Key_2)
                            @if($Row->ID_Noticia == $Key_2->ID_Noticia)
                                <div style="display: flex; align-items:center;">
                                    <span style="margin-right: 5px">0</span> 
                                    <img style="width: 1.8em" src="{{ asset('/iconos/video/outline_videocam_black_24dp.png') }}"/>                            
                                </div>
                            @endif
                        @endforeach 

                        {{-- CANTIDAD COMENTARIOS --}}
                        @foreach ($cantidadComentario as $Key_3)
                            @if($Row->ID_Noticia == $Key_3->ID_Noticia)
                                <div style="display: flex; align-items:center;">
                                    <span style="margin-right: 5px">{{$Key_3->Cantidad_Comentarios}}</span>
                                    <img style="width: 1.8em" src="{{ asset('/iconos/comentario/outline_speaker_notes_black_24dp.png')}}"/> 
                                </div>
                            @endif
                        @endforeach  

                        {{-- SIN COMENTARIOS --}}
                        @foreach ($noticiasSinComentarios as $Key_4)
                            @if($Row->ID_Noticia == $Key_4->ID_Noticia)
                                <div style="display: flex; align-items:center;">
                                    <span style="margin-right: 5px">0</span>
                                    <img style="width: 1.8em" src="{{ asset('/iconos/comentario/outline_speaker_notes_black_24dp.png')}}"/>
                                </div>
                            @endif
                        @endforeach 

                        {{-- SI EXISTE ANUNCIO PUBLICITARIO --}}                                
                        @foreach ($anuncios as $Key_5)
                            @if($Row->ID_Noticia == $Key_5->ID_Noticia)
                                <div style="display: flex; align-items:center;">
                                    <small style="font-weight: bold;">+ Anuncio</small>
                                </div>
                            @endif
                        @endforeach 
                         {{-- <ul>      --}}
                            {{-- <li>
                                @foreach ($yaracuyEnVideo as $Key_6)
                                    <small>{{$Key_6->nombreVideo}}</small>
                                @endforeach
                            </li> --}}
                            {{-- <br> --}}
                        {{-- </ul> --}}
                    </div>

                    <div>
                        <!-- FUENTE -->
                        <small class="cont_portada_informacion--span">{{$Row->fuente}}</small>
                        
                        <br>
                        <!-- FECHA -->    {{-- Se cambia el formato de la fecha --}}
                        <small class="cont_portada_informacion--span">{{ \Carbon\Carbon::parse(strtotime($Row->fecha))->format('d-m-Y') }}</small>
                        
                        <!-- TEXTO SECCION HORIZONTAL -->
                        <p class="cont_portada--seccion borde_3">{{$Row->seccion}} </p>
                    </div> 
                </div>

                <!-- BOTONES DEL PANEL FRONTAL (solo en dispositivos moviles)-->	
                <div class="cont_boton--categoria">
                    <div>
                        <label class="boton boton--corto"><a class="Default_font--white boton_a" href="{{ route('GaleriaArte') }}">Galería</a></label> 
                    </div>        
                    <div>
                        <label class="boton boton--corto"><a class="Default_font--white boton_a"" href="{{ route('Noticias') }}">Mas noticias</a></label> 
                    </div>         
                    <div>
                        <label class="boton boton--corto"><a class="Default_font--white boton_a"" href="{{ route('Marketplace') }}">Marketplace</a></label> 
                    </div>        
                </div>
            </section>
        @endforeach
        
        <div class="cont_portada--masNoticias">
            <a class="boton" href="{{ route('Noticias') }}" rel="noopener noreferrer">Mas noticias</a>
        </div>
    </main>

    @include('layouts/partiers/footer')
    
    <script src="{{ asset('/js/funcionesVarias.js') }}"></script>
    <script src="{{ asset('/js/FullScreem.js?v=' . rand()) }}"></script> 
@endsection()


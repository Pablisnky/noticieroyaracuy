@extends('layouts.partiers/header_OpenGraph')

@section('titulo', 'Noticia')

@section('contenido')
    {{-- SCRIPT PARA LEER EL TEXTO DE LA NOTICIA --}}
    <!-- <script type="text/javascript">
        function speak(text, language) {
            var s = new SpeechSynthesisUtterance(text);
            s.lang = language;	speechSynthesis.speak(s);
        }
    </script> -->

    <div class="detalle_cont--main" id="cont_efemerides"> 
     
        <!-- MEMBRETE FIJO -->
        <div class="detalle_cont--divFijo">
            <a class="detalle_cont--membrete" href="{{route('NoticiasPortada')}}">www.NoticieroYaracuy.com</a> 
            <label class="detalle_cont--fecha" id="Up">San Felipe, {{ $noticia->fecha }} </label>
    
            <!-- ICONO CERRAR -->
            <img class=" cont_modal--cerrar detalle_cont--cerrar Default_pointer" style="width: 1em;" id="CerrarVentana" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}"/>
        </div>

        <div class="detalle_cont"> 
            <div class="detalle_cont--imagen">
                
                <!-- IMAGEN -->
                <figure id="Contenedor_Imagen">
                    <img class="cont_detalle--imagen" alt="Fotografia Principal" src="{{ asset('/images/noticias/' . $imagenesNoticia[0]["nombre_imagenNoticia"]) }}"/>  
                </figure>
            
                <!-- IMAGENES SECUNDARIAS EN MINIATURAS -->
                <div style="display: flex; justify-content: center;">     
                    @foreach($imagenesNoticia as $Row)
                        <div style="margin-top: 1%">
                            <figure>
                                <img class="cont_detalle--imagenMiniatura borde_1" alt="Foto no disponible" src="{{ asset('/images/noticias/' . $Row['nombre_imagenNoticia']) }}" onclick="Llamar_VerMiniatura('<?php //echo $key['ID_Imagen']?>')"/>
                            </figure>
                        </div>
                    @endforeach
                </div> 
            </div>

            <div class="detalle_cont--informacion">
                
                <!-- TITULO -->
                <h1 class="detalle_cont--titulo">{{ $noticia->titulo }}</h1> 

                <!-- RESUMEN -->
                <div class="detalle_cont--resumen">
                    <p>{{$noticia->subtitulo}}</p>

                    <!-- FUENTE -->
                    <span class="detalle_cont--fuente">{{ $noticia->fuente }}</span>
                    <hr class="detalle_cont--hr">
                </div>    
            
                {{-- <p></p> --}}
        
                <!-- COMPARTIR REDES SOCIALES -->
                <div class="detalle_cont--redesSociales">

                    <!-- FACEBOOK -->
                    <div class="detalle_cont--red">
                        <a href="" target="_blank"><img class="detalle_cont--redesSociales-facebook" alt="facebook" src="{{ asset('/images/facebook.png') }}"/></a>
                    </div>

                    <!-- TWITTER -->
                    <div class="detalle_cont--red">
                        <a href="" target="_blank"><img class="detalle_cont--redesSociales-twitter" alt="twitter" src="{{ asset('/images/twitter.png') }}"/></a>
                    </div>          
                    
                    <!-- WHATSAPP -->
                    <div class="whatsapp detalle_cont--red">
                    <?php 
                        // $Titulo = $noticia->titulo;         
                    ?>
                    <a href="whatsapp://send?text={{ $noticia->titulo }}nbsp;{{ route('DetalleNoticia', $noticia->ID_Noticia) }}" data-action="share/whatsapp/share"><img class="detalle_cont--redesSociales-Whatsapp" alt="Whatsapp" src="{{ asset('/images/Whatsapp.png') }}"/></a>
                    </div>            

















                </div> 

                @if(isset($comentariosCantidad["Cantidad_Comentarios"]) )
                    <a class="detalle_cont--marcador" href="#Marcador"> {{ $comentariosCantidad["Cantidad_Comentarios"] }} comentarios a pie de página</a>
                @else
                    <label class="detalle_cont--marcador"> 0 comentarios a pie de página</label>
                @endif
            </div>
        </div>

        <!-- VIDEO -->

        <!-- CONTENIDO -->
        <div>
            <textarea class="textarea--contenido textarea--borde textarea--font" id="Contenido" readonly>{{$noticia->contenido}}</textarea>
        </div>

        <!-- COMENTARIO --> 
        <div class="cont_comentarios" id="ContedorComentario">
            <label class="marcador" id="Marcador">Comentarios</label>            

            <!-- Se escribe el nuevo comentario -->
            <textarea class="textarea--comentario" id="Comentario" nome="comentario" placeholder="Aade un comentario" onfocus="Llamar_VerificarSuscripcion('{{ route('NoticiaLogin', ['ID_Noticia' => $noticia->ID_Noticia, 'bandera' => 'comentar', 'ID_Comentario' => 'SIN_ID_Comentario']) }}')"></textarea>

            @if(isset($_SESSION['ID_Suscriptor']))
                <label class="boton boton--comentar" onclick="Llamar_InsertarComentario('{{ $noticia->ID_Noticia }}')">Comentar</label>
            @endif

            <!-- div carga el nuevo comentario añadido-->
            <div class="cont_comentario--BD" style="margin-top: 2%" id="ComentarioInsertado"></div>
    
            <!-- Se cargan los comentarios existentes en BD -->
            <div>
                @foreach($comentarios as $Row)
                    <div class="cont_comentario--BD" id="{{ $Row->ID_Comentario }}">
                        <p class="detalle_cont--p--comentario" readonly>{{ $Row->comentario }}</p>
                        <div class="comentario--informacion">
                            <label class="comentario--fecha">{{ $Row->nombreSuscriptor }}</label>
                            <label class="comentario--fecha">{{ $Row->apellidoSuscriptor }}</label>&nbsp&nbsp&nbsp
                            <label class="comentario--fecha">{{ \Carbon\Carbon::parse(strtotime($Row->fechaComentario))->format('d-m-Y') }}</label>&nbsp&nbsp&nbsp&nbsp&nbsp<label class="comentario--fecha">{{ \Carbon\Carbon::parse(strtotime($Row->horaComentario))->format('h-m a') }}</label>
                        </div> 

                        <!-- Respuesta a comentario -->
                        <div class="cont_comentario--respuesta Default_ocultar" id="Respuesta_{{ $Row->ID_Comentario }}">
                            <!-- se escribe la respuesta -->
                            <textarea class="textarea--comentario" id="TextoRespuesta_{{ $Row->ID_Comentario }}"></textarea>

                            <!-- se muestra la respuesesta junto al usuario la fecha y la hora -->
                            <p id="insertaRespuesta_{{ $Row->ID_Comentario }}"></p>
                            
                            <!-- BOTON ENVIAR RESPUESTA -->
                            @if(isset($_SESSION['ID_Suscriptor']))
                                <label class="detalle_cont--edicion detalle_cont--label Default_pointer" id="labelEnviar_{{ $Row->ID_Comentario }}" onclick="Llamar_InsertarRespuesta('{{ $Row->ID_Comentario }}','TextoRespuesta_{{ $Row->ID_Comentario }}','labelEnviar_{{ $Row->ID_Comentario }}','insertaRespuesta_{{ $Row->ID_Comentario }}','{{ $Row->ID_Noticia }}')">Enviar</label>

                                <div class="comentario--informacion">
                                    <label class="comentario--fecha">{{ $nombre }}</label>
                                    <label class="comentario--fecha">{{ $apellido }}</label>&nbsp&nbsp&nbsp
                                    {{-- <!-- <label class="comentario--fecha">{{ $ }}</label>&nbsp&nbsp&nbsp<label class="comentario--fecha">{{ $horaComentario }}</label> --> --}}
                                </div> 
                            @endif
                        </div>    

                        <!-- BOTONES DE ELIMINAR - RESPONDER -->
                        @if($Row->ID_Suscriptor == $id_suscriptor)
                            <div> 
                                <label class="detalle_cont--edicion Default_pointer" onclick="EliminarComentario('{{ $Row->ID_Comentario }}')">Eliminar</label>
                            </div>
                        @else 
                        <label class="detalle_cont--edicion Default_pointer" id="botonRespuesta_{{ $Row->ID_Comentario }}" onclick="Llamar_VerificarSuscripcion('{{ route('noticiaLogin', $noticia->ID_Noticia  . ',responder,' . $Row->ID_Comentario) }}')">Responder</label>
                        @endif
                    </div>
                @endforeach  
            </div>   
        </div>
    </div>
    
    <!-- VENTANA EMERGENTE CON PUBLICIDAD --> 
    @if($noticia->ID_Noticia == isset($publicidad->ID_Noticia))
        <div class="publicidad_cont--main" id="VentanaModal--Publicidad">	
            
            <!-- ICONO CERRAR -->
            <img class="cont_modal--cerrar Default_pointer" style="width: 1em;" id="CerrarVentanaModal" src="      {{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}"/>	

            <!-- IMAGEN DE PUBLICIDAD -->
            <div class="publicidad_cont--interno">
                <img class="publicidad_cont--imagen" src="{{ asset('/images/publicidad/' . $publicidad->nombre_imagenPublicidad) }}"/>
            </div>

            <!-- ENLACE A PRODUCTO O CATALOGO -->
            <!-- <a class="publicidad_cont--enlace" href="<?php //echo RUTA_URL?>/Clasificados_C/productoAmpliado/99' " rel="noopener noreferrer" target="_blank">Visitanos</a> -->
        </div>
    @endif
    
    {{-- @include('layouts/partiers/footer') --}}

    <script src="{{ asset('/js/E_DetalleNoticia.js?v=' . rand()) }}"></script>
    <script src="{{ asset('/js/A_DetalleNoticia.js?v=' . rand()) }}"></script>
    <script src="{{ asset('/js/funcionesVarias.js') }}"></script>
@endsection()
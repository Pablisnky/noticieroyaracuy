@extends('layouts.partiers.header_yaracuyEnVideo')

@section('titulo', 'Yaracuy En Video')

@section('contenido')

    <!-- CARGA SDK FONTAWESONE PARA ICONOS DE REDES SOCIALES se uso esta libreria porque los iconos no tienen fondo-->
    <script src="https://kit.fontawesome.com/2d6db4c67d.js" crossorigin="anonymous"></script>

    <div class="con_portada--promocion">
            
        <header class="header" style="background-color: black">      

            <!-- ICONO CERRAR   -->
            <a href="{{ route('NoticiasPortada') }}"><img class="header--menu header--menu--panel cont_yaracuyVideo--cerrar" id="Cerrar--modal" onclick="pausar()" src="{{ asset('/iconos/cerrar/outline_cancel_white_24dp.png') }}"/></a>

            <!-- MEMBRETE FIJO -->
            <div class="cont_yaracuyVideo--membrete">
                <label class="header__titulo">NoticieroYaracuy</label>
                <br class="Default_quitarEscritorio">
                <small class="cont_yaracuyVideo--small">YaracuyEnVideo</small>
            </div>	
        </header>
        
        <div id="Slider_Videos">

            <!-- TITULO  -->
            <p class="cont_yaracuyVideo--titulo">{{ $yaracuyVideo->decripcionVideo }}</p>
                
            <div class="cont_yaracuyVideo--video">

                <!-- FLECHA DE RETROCESO-->
                <div class="cont_yaracuyVideo--chevron chevronLeft Default_pointer" onclick="Llamar_YaracuyVideo('{{ route('RecorridoVideos', ['id_yaracuyEnVideo' =>  $yaracuyVideo->ID_YaracuyEnVideo, 'recorrido'=> 'Retroceder' ]) }}' )">
                    <img src="{{ asset('/iconos/chevron/outline_arrow_back_ios_white_24dp.png') }}"/>
                </div>

                <!-- VIDEO -->
                <div>
                    <video class="con_portada--video" id="VideoPromocion" src="{{ asset('/video/YaracuyEnVideo/' . $yaracuyVideo->nombreVideo) }}" autoplay controls loop></video>
                    
                    <!-- COMPARTIR REDES SOCIALES -->
                    <div class="cont_yaracuyVideo--redesSociales">
                        <!-- FACEBOOK -->
                        <div class="cont_catalogos--iconos">
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php //echo RUTA_URL;?>/YaracuyEnVideo_C/redesSociales/<?php //echo $Datos['yaracuyVideo']['ID_YaracuyEnVideo']?>" target="_blank"><i class="fa-brands fa-facebook-f fa-sm catalogo-RS" style="color: rgba(255, 255, 255, 0.5)"></i></a>
                        </div>        
                        
                        <!-- TWITTER -->
                        <div class="cont_catalogos--iconos">
                            <a href="https://twitter.com/intent/tweet?url=<?php //echo RUTA_URL;?>/YaracuyEnVideo_C/redesSociales/<?php //echo $Datos['yaracuyVideo']['ID_YaracuyEnVideo']?>" target="_blank"><i class="fa-brands fa-twitter catalogo-RS" style="color: rgba(255, 255, 255, 0.5)"></i></a>
                        </div>     
                        
                        <!-- E-MAIL -->
                        <div class="cont_catalogos--iconos">
                            <a href="#" target="_blank"><i class="fa-regular fa-envelope catalogo-RS" style="color: rgba(255, 255, 255, 0.5)"></i></a>
                        </div>      
                        
                        <!-- WHATSAPP -->
                        <div class="whatsapp cont_catalogos--iconos">
                            <a href="whatsapp://send?text={{ $yaracuyVideo->decripcionVideo }}. {{ route('CompartirWhatsApp', ['id_yaracuyEnVideo' => $yaracuyVideo->ID_YaracuyEnVideo]) }}" data-action="share/whatsapp/share"><i class="fa-brands fa-whatsapp catalogo-RS WHhatsApp-catalogo" style="color: rgba(255, 255, 255, 0.5)"></i></a>
                        </div>    
                        <div>
                            <p style="text-align: center; font-size: 0.7em; color: rgba(255, 255, 255, 0.5)">Compartir</p>
                        </div>
                    </div> 
                </div>

                <!-- FLECHA DE AVANCE -->
                <div class="cont_yaracuyVideo--chevron chevronRight Default_pointer" onclick="Llamar_YaracuyVideo('{{ route('RecorridoVideos', ['id_yaracuyEnVideo' => $yaracuyVideo->ID_YaracuyEnVideo, 'recorrido'=> 'Avanzar']) }}')">
                    <img src="{{ asset('/iconos/chevron/outline_arrow_forward_ios_white_24dp.png') }}"/>
                </div>
            </div>  
        </div>  
    </div>  

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/A_YaracuyEnVideo.js?v='. rand()) }}"></script>

@endsection()
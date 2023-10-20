@extends('layouts.header_Noticia')

@section('titulo', 'Galería de arte')

@section('contenido')	
    <style>    
        #ConoDesplegar:hover #MenuSecundario{ 
            margin-top: 30vh; 
            opacity: 1;        
            z-index: 3;
        }
        #ConoDesplegar:hover #IconoExpandir{
            transform: rotate(180deg);/*gira el texto para que se lea de abajo hacia arriba*/
            transition: all 0.4s;
        }
        /* .cambiar{ */
            /* margin-top: -10%!important; */
        /* } */
        .rotar{        
            transform: rotate(0deg)!important;
            transition: all 0.4s;
        }
    </style>

    <div class="cont_Artista--main">
        <div class="cont_galeria--texto" id="ConoDesplegar">
            <div>
                <h1 class="h_1">Galeria de arte</h1>
                <small class="small_3 Default_font--black">& marketplace</small>
            </div>
            <!-- ICONO EXPANDIR MENU -->
            <div class="cont_galeria--icono" > 
                <img class="Default_pointer" style="width: 2em; margin-left: 20%" id="IconoExpandir" src="{{ asset('/iconos/chevron/outline_expand_more_black_24dp.png') }}" onclick="MostrarMenuSec()"/>
            </div>
    
            <!-- MENU SECUNDARIO --> 
            <div class="cont_galeria--menuSecundario borde_1" id="MenuSecundario">  

                <div class="cont_detalle_Producto--suscriptor">
                    <img style="width: 1.5em; margin-right: 5px" src="<?php //echo RUTA_URL . '/public/iconos/pintor/outline_palette_black_24dp.png'?>"/>
                    <a class="cont_detalle_Producto--p Default_font--black" href="{{ route('Login', ['id_noticia' => 'sin_id_noticia', 'bandera' => 'sin_bandera', 'id_comentario' => 'sin_id_comentario']) }}">Exponer obras</a>
                </div>
                        
                <!-- <div class="cont_detalle_Producto--suscriptor">
                    <img style="width: 1.5em; margin-right: 5px" src="<?php //echo RUTA_URL . '/public/iconos/perfil/outline_perm_identity_black_24dp.png'?>"/>
                    <a class="cont_detalle_Producto--p Default_font--black" href="<?php //echo RUTA_URL . '/LoginController/suscripcion/SinID_Noticia'?>">Registrarse como artista</a>
                </div> -->

                <div class="cont_detalle_Producto--suscriptor">
                    <img style="width: 1.5em; margin-right: 5px" src="<?php //echo RUTA_URL . '/public/iconos/listado/outline_fact_check_black_24dp.png'?>"/>
                    <label class="cont_detalle_Producto--p">Terminos y condiciones</label>
                </div>              

                <div class="cont_detalle_Producto--suscriptor">
                    <img style="width: 1.5em; margin-right: 5px" src="<?php //echo RUTA_URL . '/public/iconos/telefono/outline_phone_iphone_black_24dp.png'?>"/>
                    <label class="cont_detalle_Producto--p">Contactanos</label>
                </div>              
            </div>
        </div>

        <!-- ARTISTAS -->
        <div class="cont_Artista--botones">
            @foreach($artistas as $Row)
                <div class="cont_artista--informacion "> 
                    <a href="{{ route('Artista', ['id_artista' => $Row->ID_Artista]) }}">
                        <figure class="efectoZoom"> 
                            <img class="cont_Artista--img borde_1 efectoBrillo efectoZoom--imagen" name="imagenNoticia" alt="Fotografia Artista" src="{{ asset('/images/galeria/' . $Row->ID_Artista . '_' . $Row->nombreArtista . '_' . $Row->apellidoArtista . '/perfil/' . $Row->imagenArtista) }}"/>
                        </figure> 
                    </a>
                    <div>
                        <p class="cont_Artista--leyenda_1 Default_font--black">{{ $Row->nombreArtista . ' ' . $Row->apellidoArtista }}</p>
                        <p class="cont_Artista--leyenda_2">{{ $Row->estadoArtista . ' - ' . $Row->paisArtista }}</p>
                    </div>
                </div>    
            @endforeach
        </div> 
    </div>

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/E_GaleriaArte.js?v='. rand()) }}"></script>
@endsection()
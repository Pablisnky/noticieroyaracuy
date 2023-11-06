@extends('layouts.header_Obra')

@section('titulo', 'Obras')

@section('contenido')

    <!-- CARGA SDK FONTAWESONE PARA ICONOS DE REDES SOCIALES se uso esta libreria porque los iconos no tienen fondo-->
    <script src="https://kit.fontawesome.com/2d6db4c67d.js" crossorigin="anonymous"></script>

    <style>
        @media(max-width: 900px){
            .cara {
                position: absolute;
                backface-visibility: hidden;
            }
            .cara.detras {
                background-color: black;
                transform: rotateY(180deg);  
                backface-visibility: hidden;
            }
        }
        @media(min-width: 901px){
            .cont_ObraDetalle--atras-1{
                margin-left: 7%
            }
        }
    </style>

    <div style="color: white; background-color: black; height: 100vh">

        <!-- COMPARTIR REDES SOCIALES -->
        <div class="cont_obra--redesSociales">
            <!-- FACEBOOK -->
            <div class="cont_catalogos--iconos">
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php //echo RUTA_URL;?>/GaleriaArteController/detalleObra/<?php //echo $Datos['detalleObra']['ID_Obra']?>" target="_blank"><i class="fa-brands fa-facebook-f fa-sm catalogo-RS" style="color: rgba(255, 255, 255, 0.5)"></i></a>
            </div>        
            
            <!-- TWITTER -->
            <div class="cont_catalogos--iconos">
                <a href="https://twitter.com/intent/tweet?url=<?php //echo RUTA_URL;?>/GaleriaArteController/detalleObra/<?php //echo $Datos['detalleObra']['ID_Obra']?>" target="_blank"><i class="fa-brands fa-twitter catalogo-RS" style="color: rgba(255, 255, 255, 0.5)"></i></a>
            </div>     
            
            <!-- E-MAIL -->
            <div class="cont_catalogos--iconos">
                <a href="#" target="_blank"><i class="fa-regular fa-envelope catalogo-RS" style="color: rgba(255, 255, 255, 0.5)"></i></a>
            </div>      
            
            <!-- WHATSAPP -->
            <div class="whatsapp cont_catalogos--iconos">
                <a href="whatsapp://send?text=<?php //echo $Datos['detalleObra']['nombreArtista']?>&nbsp;<?php //echo $Datos['detalleObra']['apellidoArtista']?>&nbsp;<?php //echo $Datos['detalleObra']['nombreObra']?>&nbsp;<?php //echo RUTA_URL?>/GaleriaArteController/detalleObra/<?php //echo $Datos['detalleObra']['ID_Obra']?>" data-action="share/whatsapp/share"><i class="fa-brands fa-whatsapp catalogo-RS WHhatsApp-catalogo" style="color: rgba(255, 255, 255, 0.5)"></i></a>
            </div>    
            <div>
                <p style="text-align: center; font-size: 0.7em; color: rgba(255, 255, 255, 0.5)">Compartir</p>
            </div>
        </div> 

        <div class="cont_ObraDetalle--label">
            
            <!-- ICONO FULLSCREEM -->
            <img class="cont_ObraDetalle--fullscreem" id="Abrir" src="{{ asset('/iconos/fullScreem/outline_open_in_full_white_24dp.png') }}"/>
            
            <!-- ICONO CERARR --> 
            <a href="{{ route('Artista', ['id_artista' => $detalleObra->ID_Artista]) }}"><img class="cont_ObraDetalle--cerrar Default_pointer" id="CerrarVentana" src="{{ asset('/iconos/cerrar/outline_close_white_24dp.png') }}"/></a>
        </div>
        
        <!-- TARJETA QUE GIRA black-->
        <div id="Miimagen">	
            <div class="carta-box">
                <div class="carta" id="Carta">

                    <!-- LADO FRONTAL DE TARJETA -->
                    <div class="cont_ObraDetalle cara" id="Cont_PinturaDetalle">

                        <!-- IMAGEN OBRA -->
                        <div class="cont_ObraDetalle--img" id="Imagen_Detalle">	
                            <img class="imagen_3" id="ImagenDetalle" src="{{ asset('/images/galeria/' . $detalleObra->ID_Artista .'_' . $detalleObra->nombreArtista . '_' . $detalleObra->apellidoArtista . '/' .  $detalleObra->imagenObra) }}"/>
                        </div>

                        <!-- BOTONES INFERIORES -->
                        <div class="cont_ObraDetalle--iconos">             
                            
                            <!-- FLECHA DE RETROCESO -->
                            <img class="Default_pointer cont_ObraDetalle--iconoLeft" onclick="Llamar_detalleObra('{{ route('DiapositivaObra', ['id_obra' => $detalleObra->ID_Obra, 'id_artista' => $detalleObra->ID_Artista, 'posicion' => 'Retroceder']) }}')" src="{{ asset('/iconos/chevron/outline_arrow_back_ios_white_24dp.png') }}"/>

                            <!-- BOTON DE GIRO-->
                            <img class="cont_ObraDetalle--giro Default_pointer Default_quitarEscritorio" src="{{ asset('/iconos/giro/outline_switch_right_black_24dp.png') }}" onclick="AtrasTarjeta('Cont_PinturaDetalle')" />
                            
                            <!-- FLECHA DE AVANCE -->
                            <img class="Default_pointer cont_ObraDetalle--iconoRight" onclick="Llamar_detalleObra('{{ route('DiapositivaObra', ['id_obra' => $detalleObra->ID_Obra, 'id_artista' => $detalleObra->ID_Artista, 'posicion' => 'Avanzar']) }}')" src="{{ asset('/iconos/chevron/outline_arrow_forward_ios_white_24dp.png') }}"/>
                        </div>
                    </div>

                    <!-- LADO POSTERIOR DE TARJETA -->
                    <div class="cont_ObraDetalle--atras cara detras">
                        <div class="cont_ObraDetalle--atras-1">
                            
                            <h1 class="cont_ObraDetalle--h1">{{ $detalleObra->nombreObra }}</h1>
                            <p class="cont_ObraDetalle--p1"><b>Autor: &nbsp;</b> {{ $detalleObra->nombreArtista . ' ' .  $detalleObra->apellidoArtista }}</p>
                            <p class="cont_ObraDetalle--p1"><b>Año: &nbsp;</b> {{ $detalleObra->anioObra }}</p>
                            <p class="cont_ObraDetalle--p1"><b>Dimensiones: &nbsp;</b> {{ $detalleObra->medidaObra }}</p> 
                            <p class="cont_ObraDetalle--p1"><b>Tecnica: &nbsp;</b> {{ $detalleObra->tecnicaObra }}</p> 
                            <p class="cont_ObraDetalle--p1"><b>Serie: &nbsp;</b> {{ $detalleObra->coleccionObra }}</p> 
                            <p class="cont_ObraDetalle--p1"><b>Descripción: &nbsp;</b> {{ $detalleObra->descripcionObra }}</p> 
                            {{-- <p class="cont_ObraDetalle--p1"><b>Precio: &nbsp;</b> {{ $detalleObra->precioDolarObra }}</p> 
                            <p class="cont_ObraDetalle--p1"><b>Factura: &nbsp;</b> Si</p> 
                            <label class="boton boton--marg">Comprar</label>  --}}
                        </div>

                        <!-- BOTON DE GIRO-->
                        <div>
                            <img class="cont_ObraDetalle--giro Default_pointer Default_quitarEscritorio" onclick="FrenteTarjeta('Cont_PinturaDetalle')" src="{{ asset('/iconos/giro/outline_switch_right_black_24dp.png') }}"/>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <script src="{{ asset('/js/E_DetalleObra.js?v=' . rand()) }}"></script> 
    <script src="{{ asset('/js/A_DetallesObra.js?v=' . rand()) }}"></script> 
    <script src="{{ asset('/js/FullScreem.js?v=' . rand()) }}"></script> 

@endsection()
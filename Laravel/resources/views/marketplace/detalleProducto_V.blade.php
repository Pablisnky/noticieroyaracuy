@extends('layouts.header_ProductoAmpliado')

@section('titulo', 'MarketPlace - producto')

@section('contenido')

    <!-- MEMBRETE FIJO -->  
    <header class="detalle_cont--divFijo">      
        <a class="header__titulo--membrete" href="{{ route('NoticiasPortada') }}">www.NoticieroYaracuy.com</a> 
        <br>
        <label class="detalle_cont--fecha">Marketplace</label>

        <!-- ICONO REGRESAR -->    
        <?php
        if($bandera == 'Desde_Clasificados'){   ?>
            <img class="cont_modal--cerrar Default_pointer" style="width: 1em; position:fixed; z-index:10" id="Cerrar" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}" onclick="cerrarVentana()"/>    <?php
        }
        else{   ?>
            <img class="cont_modal--cerrar Default_pointer" style="width: 1em; position:fixed; z-index:10" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}" onclick="cerrarVentana()"/>
            <?php
        }   ?>
    
    </header>
    
    <section>
        <div class="contenedor_122"> 
            <div class="contGridUna">               
                <div id="Imagen_Principal"> 
                    
                    <!-- TEXTO VERTICAL -->
                    <?php
                    if($producto->nuevo == 'Nuevo'){   ?>                        
                        <label class="contOpciones--text">Articulo {{ $producto->nuevo }}</label>
                        <?php
                    }
                    else if($producto->nuevo == 'Usado'){  ?>
                        <label class="contOpciones--text">Articulo {{ $producto->nuevo }}</label>
                        <?php
                    }  ?>

                    <!-- IMAGEN PRINCIPAL imagen_9--> 
                    <img class="cont_detalle--imagen" alt="Imagen no disponible" src="{{ asset('/images/clasificados/' . $producto->ID_Comerciante . '/productos/' . $imagen->nombre_img) }}"/> 
                </div>

                <!-- IMAGENES MINIATURAS -->                           
                <div class="contenedor_125">
                    @foreach($imagenesSec as $Row) 
                        <img class="cont_detalle--imagenMiniatura borde_1" id="Imagen" alt="Fotografia no disponible" src="{{ asset('/images/clasificados/' . $producto->ID_Comerciante . '/productos/' . $Row->nombre_img) }}" onclick="Llamar_VerMiniatura('{{ route('VerMiniaturaProducto', ['id_imagen' => $Row->ID_Imagen]) }}')"/>
                    @endforeach
                </div>

                {{-- PRODUCTO - DESCRIPCION --}}
                <div class="cont_detalle_Producto--precio">
                    <h1 class="h1_1 h1_1--margin font--bold">{{ $producto->producto }}</h1>
                    <h3 class="h1_11 font--center">{{ $producto->opcion }}</h3>
                </div>

                {{-- PRECIO --}}
                <div class="cont_precio">
                    <label class="label_22 borde_1">$ {{ $producto->precioDolar }}
                        <small class="small_2">Bs. {{ $producto->precioBolivar }}</small>
                    </label>
                </div>    
                
                    
                <!-- COMPARTIR REDES SOCIALES -->
                <div class="detalle_cont--redesSociales">

                        {{-- <p>https://www.facebook.com/sharer/sharer.php?u=https://www.noticieroyaracuy.com/noticias/detalleNoticia/<?php //echo $noticia->ID_Noticia ?></p> --}}
                    <!-- FACEBOOK -->
                    <div class="detalle_cont--red">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=https://www.noticieroyaracuy.com/marketplace/productoAmpliado/<?php echo $producto->ID_Producto ?>" target="_blank"><img class="detalle_cont--redesSociales-facebook" alt="facebook" src="{{ asset('/images/facebook.png') }}"/></a>
                    </div>

                    <!-- TWITTER -->
                    <div class="detalle_cont--red">
                        <a href="https://twitter.com/intent/tweet?url=https://www.noticieroyaracuy.com/marketplace/productoAmpliado/{{ $producto->ID_Producto }}&text={{ $producto->producto }}" target="_blank"><img class="detalle_cont--redesSociales-twitter" alt="twitter" src="{{ asset('/images/twitter.png') }}"/></a>
                    </div>          
                    
                    <!-- WHATSAPP -->
                    <div class="whatsapp detalle_cont--red">
                        <a href="whatsapp://send?text={{ $producto->producto }}. {{ route('ProductoAmpliado',['id_producto' => $producto->ID_Producto, 'bandera' => 'DesdeClasificados']) }}" data-action="share/whatsapp/share"><img class="detalle_cont--redesSociales-Whatsapp" alt="Whatsapp" src="{{ asset('/images/Whatsapp.png') }}"/></a>
                    </div>            
                </div> 
            </div>

            <!-- INFORMACION DE CONTACTO DEL COMERCIANTE -->
            <div class="contGridUna">
                <div class="cont_detalle_Producto--informacion">
                    <p><b>Ofertado por:</b> {{ $comerciante[0]->pseudonimoComerciante }}</p>
                    <div class="cont_detalle_Producto--suscriptor">
                        <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/ubicacion/outline_place_black_24dp.png') }}"/>
                        <label>{{ $comerciante[0]->parroquiaComerciante }} - {{ $comerciante[0]->municipioComerciante }}</label>
                    </div>
                    <div class="cont_detalle_Producto--suscriptor">
                        <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_perm_identity_black_24dp.png') }}"/>
                        <label>{{ $comerciante[0]->nombreComerciante . ' ' . $comerciante[0]->apellidoComerciante }}</label>
                    </div>
                    <div class="cont_detalle_Producto--suscriptor">
                        <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/telefono/outline_phone_iphone_black_24dp.png') }}"/>
                        <label>{{ $comerciante[0]->telefonoComerciante }}</label>
                    </div>
                    @if($bandera == 'DesdeClasificados') 
                        <a class="cont_detalle_Producto--p" href="{{ route('Catalogo', ['id_comerciante' => $producto->ID_Comerciante, 'pseudonimoSuscripto' => $comerciante[0]->pseudonimoComerciante ]) }}">Ver catalogo de vendedor</a>
                    @endif
                </div>

                <div class="contenedor_15 borde_1">
        
                    <!-- FORMAS DE ENVIO Y ENTREGA-->
                    <div class="">
                        <h3 class="h3_4">Formas de envio y entrega</h3>  
                        <div class="contenedor_161">
                            <p class="p_19">Acordado con vendedor</p>
                            <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/check/outline_done_black_24dp.png') }}"/>
                        </div>
                    </div>

                    <!-- METODOS DE PAGO -->
                    <div>
                        <h3 class="h3_4">Metodos de pago aceptados</h3>    
                        <?php

                        // TRANSFERENCIA BANCARIAS
                        if($comerciante[0]->transferenciaComerciante == 1){     ?>     
                            <div class="contenedor_161 contenedor_161--fijo">
                                <p class="p_19">Tranferencia bancaria</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/check/outline_done_black_24dp.png') }}"/>
                            </div> 
                            <?php
                        }
                        else{   ?>     
                            <div class="contenedor_161 contenedor_161--fijo">
                                <p class="p_19">Tranferencia bancaria</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/cerrar/outline_close_black_24dp.png') }}"/>
                            </div> 
                            <?php
                        }

                        // PAGO MOVIL
                        if($comerciante[0]->pago_movilComerciante == 1){  ?>
                            <div class="contenedor_161">
                                <p class="p_19">Pago movil</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/check/outline_done_black_24dp.png') }}"/>
                            </div>
                            <?php
                        }
                        else{?>     
                            <div class="contenedor_161">
                                <p class="p_19">Pago movil</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/cerrar/outline_close_black_24dp.png') }}"/>
                            </div> 
                            <?php
                        } 
                                                
                        // PAYPAL 
                        if($comerciante[0]->paypalComerciante == 1){   ?>
                            <div class="contenedor_161">
                                <p class="p_19">Paypal</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/check/outline_done_black_24dp.png') }}"/>
                            </div>  
                            <?php
                        }
                        else{  ?>
                            <div class="contenedor_161">
                                <p class="p_19">Paypal</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/cerrar/outline_close_black_24dp.png') }}"/>
                            </div>  
                            <?php
                        }

                        // CRIPTOMONEDA
                        if($comerciante[0]->criptomonedaComerciante == 1){  ?>
                            <div class="contenedor_161">
                                <p class="p_19">Criptomoneda</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/check/outline_done_black_24dp.png') }}"/>
                            </div>
                                <?php
                        }
                        else{  ?>
                            <div class="contenedor_161">
                                <p class="p_19">Criptomoneda</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/cerrar/outline_close_black_24dp.png') }}"/>
                            </div> 
                            <?php 
                        }    
                                
       
                        // ACORDADO EN TIENDA
                        if($comerciante[0]->acordadoComerciante == 1){   ?>
                            <div class="contenedor_161">
                                <p class="p_19">Acordado con vendedor</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/check/outline_done_black_24dp.png') }}"/>
                            </div>
                                <?php
                        }
                        else{  ?>
                            <div class="contenedor_161">
                                <p class="p_19">Acordado con vendedor</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/cerrar/outline_close_black_24dp.png') }}"/>
                            </div>  
                                <?php
                            } ?>
                    </div>
                </div>
                                
                <!-- COMPARTIR REDES SOCIALES -->
                <div class="detalle_cont--redesSociales">

                    <!-- FACEBOOK -->
                    <div class="detalle_cont--red">
                        {{-- <a href="https://www.facebook.com/sharer/sharer.php?u=<?php //echo RUTA_URL;?>/MarketplaceController/productoAmpliado/<?php //echo $ID_Producto;?>&text=<?php //echo $Producto;?>" target="_blank"><img class="detalle_cont--redesSociales-facebook; icono--face" alt="facebook" src="<?php //echo RUTA_URL?>/public/images/facebook.png"/></a> --}}
                    </div>        

                    <!-- WHATSAPP -->
                    <div class="whatsapp detalle_cont--red">
                        <?php 
                            // $Titulo = $Producto;         
                        ?>
                        {{-- <a href="whatsapp://send?text=<?php //echo $Titulo?>&nbsp;<?php //echo RUTA_URL?>/MarketplaceController/productoAmpliado/<?php //echo $ID_Producto;?>" data-action="share/whatsapp/share"><img class="detalle_cont--redesSociales-Whatsapp icono--what" alt="Whatsapp" src="<?php //echo RUTA_URL?>/public/images/Whatsapp.png"/></a> --}}
                    </div>            
                </div> 
            </div>
        </div>
    </section>

    <!-- CINTILLO  -->
    <p class="contenedor_34--p" id="Contenedor_34--p">Cambio oficial BCV: 1 $ = {{ number_format($dolar, 2, ",", ".") }} Bs.</p>
    
    {{-- @include('layouts/footer') --}}
    
    <script src="{{ asset('/js/A_DetalleProducto.js?v=' . rand()) }}"></script>
        
    <script>
        function cerrarVentana(){     
            window.close()
        }
    </script>

@endsection()
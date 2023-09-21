@extends('layouts.partiers.header_ProductoAmpliado')

@section('titulo', 'MarketPlace - producto')

@section('contenido')
    <!-- ICONO REGRESAR -->    
    <?php
    if($bandera == 'Desde_Clasificados'){   ?>
        <img class="cont_modal--cerrar  Default_pointer" style="width: 1em; position:fixed; z-index:10" id="Cerrar" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}" onclick="cerrarVentana()"/>    <?php
    }
    else{   ?>
        <img class="cont_modal--cerrar  Default_pointer" style="width: 1em; position:fixed; z-index:10" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}" onclick="cerrarVentana()"/>
        <?php
    }   ?>
    
    <section>
        <!-- MEMBRETE FIJO -->  
        <header>      
            <a class="header__titulo--detalleProducto" href="<?php //echo RUTA_URL . '/Inicio_C';?>">www.NoticieroYaracuy.com</a> 
            <label class="header__subtitulo--detalleProducto">Clasificados</label>
        </header>

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

                    <!-- IMAGEN PRINCIPAL--> 
                    <img class="imagen_9" alt="Imagen no disponible" src="{{ asset('/images/clasificados/' . $producto->ID_Suscriptor . '/productos/' . $imagen->nombre_img) }}"/> 
                </div>

                <!-- IMAGENES MINIATURAS -->                           
                <div class="contenedor_125">
                    @foreach($imagenesSec as $Row)  
                        <img class="imagen--miniaturas borde_1 borde_2" id="Imagen" alt="Fotografia no disponible" src="{{ asset('/images/clasificados/' . $producto->ID_Suscriptor . '/productos/' . $Row->nombre_img) }}" onclick="Llamar_VerMiniatura('{{ $Row->ID_Imagen }}')"/>
                    @endforeach
                </div>

                <div class="cont_detalle_Producto--precio">
                    <h1 class="h1_1 h1_1--margin font--bold">{{ $producto->producto }}</h1>
                    <h3 class="h1_11 font--center">{{ $producto->opcion }}</h3>
                </div>

                <div class="cont_precio">
                    <label class="label_22 borde_1">$ <?php echo $producto->precioDolar?>
                        <small class="small_2">Bs. <?php echo $producto->precioBolivar?></small>
                    </label>
                </div>    
            </div>

            <!-- INFORMACION DE CONTACTO DEL VENDEDOR -->
            <div class="contGridUna">
                <div class="cont_detalle_Producto--informacion">
                    <p class="cont_detalle_Producto--p"><b>Ofertado por:</b> <?php echo $vendedor->pseudonimoSuscripto?></p>
                    <div class="cont_detalle_Producto--suscriptor">
                        <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/ubicacion/outline_place_black_24dp.png') }}"/>
                        <label><?php echo $vendedor->parroquiaSuscriptor?> - <?php echo $vendedor->municipioSuscriptor?></label>
                    </div>
                    <div class="cont_detalle_Producto--suscriptor">
                        <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_perm_identity_black_24dp.png') }}"/>
                        <label>{{ $vendedor->nombreSuscriptor . ' ' . $vendedor->apellidoSuscriptor }}</label>
                    </div>
                    <div class="cont_detalle_Producto--suscriptor">
                        <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/telefono/outline_phone_iphone_black_24dp.png') }}"/>
                        <label><?php echo $vendedor->telefonoSuscriptor?></label>
                    </div>
                    @if($bandera == 'Desde_Clasificados') 
                        <a class="cont_detalle_Producto--p" href="{{ route('Catalogo', ['ID_Suscriptor' => $producto->ID_Suscriptor, 'pseudonimoSuscripto' => $vendedor->pseudonimoSuscripto ]) }}">Ver catalogo de vendedor</a>
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
                    <div class="">
                        <h3 class="h3_4">Metodos de pago aceptados</h3>    
                        <?php

                        // TRANSFERENCIA BANCARIAS
                        if($vendedor->transferencia == 1){     ?>     
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
                        if($vendedor->pago_movil == 1){  ?>
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
                        if($vendedor->paypal == 1){   ?>
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
                        
                        // ZELLE 
                        if($vendedor->zelle == 1){   ?>
                            <div class="contenedor_161">
                                <p class="p_19">Zelle</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/check/outline_done_black_24dp.png') }}"/>
                            </div>  
                                <?php
                        }
                        else{  ?>
                            <div class="contenedor_161">
                                <p class="p_19">Zelle</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/cerrar/outline_close_black_24dp.png') }}"/>
                            </div>  
                            <?php
                        }

                        // CRIPTOMONEDA
                        if($vendedor->criptomoneda == 1){  ?>
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
                                
                        // EFECTIVO BOLIVAR
                        if($vendedor->efectivo_Bs == 1){  ?>
                            <div class="contenedor_161">
                                <p class="p_19">En destino (efectivo Bs.)</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/check/outline_done_black_24dp.png') }}"/>
                            </div>
                                <?php
                        }
                        else{  ?>
                            <div class="contenedor_161">
                                <p class="p_19">En destino (efectivo Bs.)</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/cerrar/outline_close_black_24dp.png') }}"/>
                            </div> 
                            <?php 
                        }    

                        // EFECTIVO DOLAR
                        if($vendedor->efectivo_Dol == 1){  ?>
                            <div class="contenedor_161">
                                <p class="p_19">En destino (efectivo $)</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/check/outline_done_black_24dp.png') }}"/>
                            </div>
                            <?php
                        }
                        else{  ?>
                            <div class="contenedor_161">
                                <p class="p_19">En destino (efectivo $)</p>
                                <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/cerrar/outline_close_black_24dp.png') }}"/>
                            </div>  
                                <?php
                        }
                                
                        // ACORDADO EN TIENDA
                        if($vendedor->acordado == 1){   ?>
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
                        {{-- <a href="https://www.facebook.com/sharer/sharer.php?u=<?php //echo RUTA_URL;?>/Clasificados_C/productoAmpliado/<?php //echo $ID_Producto;?>&text=<?php //echo $Producto;?>" target="_blank"><img class="detalle_cont--redesSociales-facebook; icono--face" alt="facebook" src="<?php //echo RUTA_URL?>/public/images/facebook.png"/></a> --}}
                    </div>        

                    <!-- WHATSAPP -->
                    <div class="whatsapp detalle_cont--red">
                        <?php 
                            // $Titulo = $Producto;         
                        ?>
                        {{-- <a href="whatsapp://send?text=<?php //echo $Titulo?>&nbsp;<?php //echo RUTA_URL?>/Clasificados_C/productoAmpliado/<?php //echo $ID_Producto;?>" data-action="share/whatsapp/share"><img class="detalle_cont--redesSociales-Whatsapp icono--what" alt="Whatsapp" src="<?php //echo RUTA_URL?>/public/images/Whatsapp.png"/></a> --}}
                    </div>            
                </div> 
            </div>
        </div>
    </section>

    <!-- CINTILLO  -->
    <p class="contenedor_34--p" id="Contenedor_34--p">Cambio oficial BCV: 1 $ = {{ number_format($dolar, 2, ",", ".") }} Bs.</p>
    
    {{-- @include('layouts/partiers/footer') --}}
    
    <script src="{{ asset('/js/A_descr_Producto.js?v=' . rand()) }}"></script>
        
    <script>
        function cerrarVentana(){     
            window.close()
        }
    </script>

@endsection()
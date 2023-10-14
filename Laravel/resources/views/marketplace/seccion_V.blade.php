@extends('layouts.partiers.header_Catalogo')

@section('titulo', 'MarketPlace secciones')

@section('contenido')	

    <!-- CARGA SDK FONTAWESONE PARA ICONOS DE REDES SOCIALES se uso esta libreria porque los iconos no tienen fondo-->
    <script src="https://kit.fontawesome.com/2d6db4c67d.js" crossorigin="anonymous"></script>

    <body onload="ProductosEnCarrito()">	

    <header>
        <div class="cont_catalogos">  
            <div class="cont_catalogos--membrete--1">     
                <a class="header__titulo--catalogo" href="<?php //echo RUTA_URL . '/Inicio_C';?>">www.NoticieroYaracuy.com</a> 
                <br class="Default_quitarMovil">
                <label class="header__subtitulo--catalogo">Clasificados</label>
            </div> 

            <!-- PSEUDONIMO -->
            <div class="cont_catalogos--membrete--2">
                <img class="cont_catalogos--tienda Default_pointer" src="{{ asset('/iconos/tienda/outline_storefront_black_24dp.png') }}"/>
                <h1 class="h1_1 h1_1--catalogo">{{ $suscriptor->pseudonimoComerciante }}</h1> 
            </div>
                
            <!-- COMPARTIR REDES SOCIALES -->
            <div class="cont_catalogos--membrete--3">
                <!-- FACEBOOK -->
                <div class="cont_catalogos--iconos">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php //echo RUTA_URL;?>/Catalogos_C/index/<?php //echo $Datos['Suscriptor'][0]['ID_Suscriptor'];?>" target="_blank"><i class="fa-brands fa-facebook-f fa-sm catalogo-RS"></i></a>
                </div>        
                
                <!-- TWITTER -->
                <div class="cont_catalogos--iconos">
                    <a href="https://twitter.com/intent/tweet?url=<?php //echo RUTA_URL;?>/Catalogos_C/index/<?php //echo $Datos['Suscriptor'][0]['ID_Suscriptor'];?>" target="_blank"><i class="fa-brands fa-twitter catalogo-RS"></i></a>
                </div>     
                
                <!-- E-MAIL -->
                <div class="cont_catalogos--iconos">
                    <a href="#" target="_blank"><i class="fa-regular fa-envelope catalogo-RS"></i></a>
                </div>      
                
                <!-- WHATSAPP -->
                <div class="whatsapp cont_catalogos--iconos">
                    <a href="whatsapp://send?text=<?php //echo 'Catalogo ' . $Datos['Suscriptor'][0]['pseudonimoSuscripto']?>&nbsp;<?php //echo RUTA_URL?>/Catalogos_C/index/<?php //echo $Datos['Suscriptor'][0]['ID_Suscriptor'];?>" data-action="share/whatsapp/share"><i class="fa-brands fa-whatsapp catalogo-RS WHhatsApp-catalogo"></i></a>
                </div>    
                <div>
                    <p style="text-align: center; font-size: 0.7em">Compartir</p>
                </div>
            </div>
                    
            <!-- SECCIONES ICONO CERRAR-->
            <div class="cont_catalogos--membrete--4">
                <div class=""> 
                    <img class="Default_pointer" style="width: 2em" id="Secciones" src="{{ ASSET('/iconos/chevron/outline_expand_more_black_24dp.png') }}"/>
                </div>  

                <div>
                    <img class="Default_pointer" style="width: 1.8em;" id="Cerrar" src="{{ ASSET('/iconos/cerrar/outline_cancel_black_24dp.png') }}" onclick="cerrarVentana()"/>
                </div> 
            </div> 
    </header>
        <!-- MUESTRA MENU SECCIONES --> 
        <div class="cont_catalogos--secciones" id="Con_Secciones">
            @foreach($secciones as $Key)
                <a href="{{ route('SeccionesTienda', ['id_comerciante' => $suscriptor->ID_Comerciante, 'id_seccion' => $Key->ID_Seccion]) }}" onclick="verSecion({{ $Key->ID_Seccion }}">{{ $Key->seccion }}</a> 
                <br>
            @endforeach
            
            {{-- <?php $Pseudonimo = str_replace(" ", "_", $Datos['Suscriptor'][0]['pseudonimoSuscripto']); ?> --}}
            <a href="{{ route('SeccionesTienda', ['id_comerciante' => $suscriptor->ID_Comerciante, 'id_seccion' => 'Tadas']) }}" onclick="verSecion('Todos')">Todos</a>

            <hr class="hr_3 hr_3a">
            
            <!-- INFORMACION DE CONTACTO DEL VENDEDOR -->
            <div class="cont_detalle_Producto--informacion cont_detalle_Producto---catalogo">
                <div class="cont_detalle_Producto--suscriptor">
                    <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/tienda/outline_storefront_black_24dp.png') }}"/>
                    <label class="cont_detalle_Producto--p">{{ $suscriptor->pseudonimoComerciante }}</label>
                </div>
                <div class="cont_detalle_Producto--suscriptor">
                    <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/ubicacion/outline_place_black_24dp.png') }}"/>
                    <label class="cont_detalle_Producto--p">{{ $suscriptor->municipioComerciante }} - {{ $suscriptor->parroquiaComerciante }}</label> 
                </div>
                <div class="cont_detalle_Producto--suscriptor">
                    <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_perm_identity_black_24dp.png') }}"/>
                    <label class="cont_detalle_Producto--p">{{ $suscriptor->nombreComerciante }} {{ $suscriptor->apellidoComerciante }}</label>
                </div>
                <div class="cont_detalle_Producto--suscriptor">
                    <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/telefono/outline_phone_iphone_black_24dp.png') }}"/>
                    <label class="cont_detalle_Producto--p">{{ $suscriptor->telefonoComerciante }}</label>
                </div>
            </div>
        </div>
        
        <!-- PRODUCTOS -->
        <form>
        <div class="cont_catalogos--productos" id="Contenedor_13Js"> 
            @foreach($productos as $row)
                {{-- 
                $Nuevo = $row['nuevo'] == 1 ? 'Nuevo' : 'Usado';                 
                $Bandera = 'Desde_Catalogo';

                //Se da formato al precio, sin decimales y con separación de miles
                settype($PrecioBolivar, "float");
                settype($PrecioDolar, "float");
                $PrecioBolivar = number_format($PrecioBolivar, 2, ",", "."); 
                $PrecioDolar = number_format($PrecioDolar, 2, ",", ".");   ?>   --}}
                
                <div class="contenedor_95" id="{{ 'Cont_Producto_' . $row->ID_Opcion }}">
                    <div class="contOpciones">
                        {{-- // PRODUCTO NUEVO O USADO --}}
                        @if($row->nuevo == 'Nuevo')                       
                            <label class="contOpciones--textoVertical">Articulo {{ $row->nuevo }}</label>
                        @elseif($row->nuevo == 'Usado')
                            <label class="contOpciones--textoVertical">Articulo {{ $row->nuevo }}</label>
                        @endif

                        <!-- IMAGEN -->
                        <a href="<?php //echo RUTA_URL . '/Catalogos_C/productoAmpliado/' . $ID_Producto;?>" rel="noopener noreferrer" target="_blank"><img class="contOpciones__img" alt="Fotografia del producto" src="{{ asset('/images/clasificados/' .  $row->ID_Comerciante . '/productos/' . $row->nombre_img) }}"/></a> 
                    </div>
                                
                    <div class="cont_producto"> 
                        <div class="cont_catalogos--producto">
                            <!-- PRODUCTO -->
                            <label class="input_8 input_8D hyphen" id="{{ 'EtiquetaProducto_' . $row->ID_Opcion }}">{{ $row->producto }}</label>

                            <!-- OPCION -->
                            <label class="input_8 input_8C hyphen" id="{{ 'EtiquetaOpcion_' . $row->ID_Opcion }}">{{ $row->opcion }}</label>
                        </div>     

                        <div class="cont_Precios">
                            <div style="width:55%">  
                        
                                <!-- PRECIO EN Bs -->
                                <label class="input_8" id="{{ 'EtiquetaPrecio_' . $row->ID_Opcion }}" >Bs. {{ $row->precioBolivar }}</label>

                                <!-- PRECIO EN $-->
                                <label class="input_8" id="{{ 'EtiquetaPrecio_' . $row->ID_Opcion }}" >$ {{ $row->precioDolar }}</label>
                            </div> 
                            
                            <div style="width:40%;">
                                <!-- BOTON AGREGAR -->
                                @if($row->cantidad == 0) <!--SINO HAY PRODUCTOS EN INVENTARIO SE DESABILITA-->
                                    <label class="label_4 label_4--innabilitado">Agregar</label> 
                                @else <!--SI HAY PRODUCTOS EN INVENTARIO SE HABILITA-->
                                    <label for="<?php //echo 'ContadorLabel_' . $ID_Opcion;?>" class="label_4 Label_3js" id="<?php //echo 'Etiqueta_' . $ID_Opcion;?>">Agregar</label> 
                                @endif
                                        
                                <!-- Este input es el que se envia al archivo JS por medio de la función agregarProducto(), en el valor se colocan el caracter _ para usarlo como separardor en JS-->
                                <input class="Default_ocultar" type="radio" name="opcion" id="<?php //echo 'ContadorLabel_' . $ID_Opcion;?>" value="<?php //echo $ID_Opcion . ',' . '_' . $Producto . ',' . '_' . $Opcion . ',' . '_' . $PrecioBolivar . ',' . '_' . $ID_Seccion;?>" onclick="agregarProducto(this.form , '<?php //echo 'Etiqueta_' . $ID_Opcion;?>','<?php //echo 'Cont_Leyenda_' . $ID_Opcion;?>','<?php //echo 'Cantidad_' . $ID_Opcion;?>','<?php //echo 'Producto_' . $ID_Opcion;?>','<?php //echo 'Opcion_' . $ID_Opcion;?>','<?php //echo 'Precio_' . $ID_Opcion;?>','<?php //echo 'Total_' . $ID_Opcion;?>','<?php //echo 'Leyenda_' . $ID_Opcion;?>','<?php //echo 'Cont_Producto_' . $ID_Opcion;?>','<?php //echo 'Item_'. $ID_Opcion;?>','<?php //echo $Existencia;?>','<?php //echo 'ID_BotonMas_'. $ID_Opcion;?>','<?php //echo 'ID_BloquearMas_'. $ID_Opcion;?>')"/>
                                        
                                <!-- BOTON MAS Y MENOS -->                            
                                <div class="contenedor_14" id="<?php //echo 'Cont_Leyenda_' . $ID_Opcion;?>">
                                    <!-- BOTON MAS Y MENOS -->
                                    <label class="menos MenosJS" id="<?php //echo 'ID_BotonMenos_'. $ID_Opcion;?>">-</label>
                                    <input class="input_2" type="text" id="<?php //echo 'Item_'. $ID_Opcion;?>"  value="1"/>
                                    <label class="mas MasJS" id="<?php //echo 'ID_BotonMas_'. $ID_Opcion;?>">+</label>

                                    <i class="fas fa-ban icono_7" id="<?php //echo 'ID_BloquearMas_'. $ID_Opcion;?>" onclick="BotonBloqueado()"></i>
                                    <input class="Default_ocultar BloquearMasJS" type="text" value="<?php //echo $Existencia?>"/>

                                    <!-- cantidad alimentado desde E_Vitrina.js agregarOpcion()-->
                                    <input type="text" class="input_1e Default_ocultar" id="<?php //echo 'Cantidad_' . $ID_Opcion;?>"/>
                                    <!-- seccion -->
                                    <input type="text" class="input_1g Default_ocultar" name="seccion" id="<?php //echo 'Seccion_' . $ID_Opcion;?>"/>
                                    <!-- producto - alimentado desde E_Vitrina.js agregarOpcion() -->
                                    <input type="text" class="input_1a Default_ocultar" name="Desc_Producto" id="<?php //echo 'Producto_' . $ID_Opcion;?>"/>
                                    <!-- opcion alimentado desde E_Vitrina.js agregarOpcion()-->
                                    <input type="text" class="input_1c Default_ocultar" name="" id="<?php //echo 'Opcion_' . $ID_Opcion;?>"/>
                                    <!-- Precio - alimentado desde E_Vitrina.js agregarOpcion() -->
                                    <input type="text" class="input_1d Default_ocultar" id="<?php //echo 'Precio_' . $ID_Opcion;?>"/>
                                    <!-- Total - alimentado desde E_Vitrina.js agregarOpcion()-->
                                    <input type="text" class="input_1f Default_ocultar" id="<?php //echo 'Total_' . $ID_Opcion;?>"/>
                                </div>
                            </div>
                        </div>
                    </div> 
                                    
                    <!-- VENDEDOR -->
                    <div class="contOpciones--vendedor"> 
                        @if($row->ID_Comerciante == $suscriptor->ID_Suscriptor)         
                            <div class="cont_vendedor--span">                        
                                <div class="cont_vendedor--span-2">              
                                    <span class="span--vendedor--ubicacion"></span>
                                    <img class="icono--ubicacion" src="{{ asset('/iconos/ubicacion/outline_place_black_24dp.png') }}"/>{{ $row->parroquiaSuscriptor }} 
                                </div>
                                <span class="span--vendedor">Vendedor: {{ $row->pseudonimoSuscripto }}</span> 
                            </div> 
                        @endif
                    </div>

                    <!-- LEYENDA -->
                    <div class="contenedor_19">
                        <!-- LEYENDA A MOSTRAR alimentado desde E_Vitrina.js agregarOpcion() -->
                        <input class="input_2a" type="text" name="leyenda" id="<?php //echo 'Leyenda_'. $ID_Opcion;?>"/>
                    </div> 
                </div>  
            @endforeach                  
        </div>
        </form>
        
    <!-- BOTON CARRITO DE COMPRAS -->
    <div class="contenedor_61" id="Contenedor_61">
        <div class="contenedor_21" id="Mostrar_Carrito" onclick="llamar_PedidoEnCarrito('<?php //echo $ID_Suscriptor;?>','<?php //echo $Datos['dolarHoy'];?>')">
            <div class="contenedor_31">
                <small class="small_1 small_4" id="Small_4--JS">Ver <br class="br_3"> carrito</small>
                <img class="Default_pointer" style="width: 1.8em;" id="Cerrar" src="<?php //echo RUTA_URL . '/public/iconos/carritoCompras/outline_shopping_cart_white_24dp.png'?>"/>
                <input type="text" class="input_5" id="Input_5" readonly/>
            </div>
        </div>
    </div>

    <div id="Mostrar_Orden"></div>

    {{-- se entregan a JS el ID_Suscriptor y el pseudonimoSuscripto de la tienda para verificar que no existan productos cargado de dos tendas diferentes --}}
    <input class="Default_ocultar" type="text" id="ID_Suscriptor" value='{{ $suscriptor->id_comerciante }}'/>   
    <input class="Default_ocultar" type="text" id="PseudonimoSuscripto" value='{{ $suscriptor->pseudonimoSuscripto }}'/>
        
    <script src="{{ asset('/js/E_Catalogos.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/A_Catalogos.js?v='. rand()) }}"></script>
    
@endsection()
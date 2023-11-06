@extends('layouts.header_Catalogo')

@section('titulo', 'MarketPlace-catalogo')

@section('contenido')	
    <section class="section_9" id="Section_3"> 
        
        <header>
            <div class="cont_catalogos">  

                {{-- MEMBRETE --}}
                <div class="cont_catalogos--membrete--1">     
                    <a class="header__titulo--catalogo" href="{{ route('NoticiasPortada') }}">www.noticieroyaracuy.com</a> 
                    <br class="Default_quitarMovil">
                    <label class="header__subtitulo--catalogo">Catalogo</label>
                </div> 

                <!-- PSEUDONIMO -->
                <div class="cont_catalogos--membrete--2">
                    {{-- <img class="cont_catalogos--tienda Default_pointer" src="{{ asset('/iconos/tienda/outline_storefront_black_24dp.png') }}"/> --}}
                    <h1 class="h1_1 h1_1--catalogo">{{ $comerciante[0]->pseudonimoComerciante }}</h1> 
                </div>
                    
                <!-- COMPARTIR REDES SOCIALES -->
                <div class="cont_catalogos--membrete--3">
                    <!-- FACEBOOK -->
                    <div class="cont_catalogos--iconos">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php //echo RUTA_URL;?>/Catalogos_C/index/<?php //echo $Datos['ID_Suscriptor'];?>" target="_blank"><i class="fa-brands fa-facebook-f fa-sm catalogo-RS"></i></a>
                    </div>        
                    
                    <!-- TWITTER -->
                    <div class="cont_catalogos--iconos">
                        <a href="https://twitter.com/intent/tweet?url=<?php //echo RUTA_URL;?>/Catalogos_C/index/<?php //echo $Datos['ID_Suscriptor'];?>" target="_blank"><i class="fa-brands fa-twitter catalogo-RS"></i></a>
                    </div>     
                    
                    <!-- E-MAIL -->
                    {{-- <div class="cont_catalogos--iconos">
                        <a href="#" target="_blank"><i class="fa-brands fa-envelope catalogo-RS"></i></a>
                    </div>       --}}
                    
                    <!-- WHATSAPP -->
                    <div class="whatsapp cont_catalogos--iconos">
                        <a href="whatsapp://send?text={{ 'Catalogo' . $comerciante[0]->pseudonimoComerciante }}. {{ route('Catalogo', ['id_comerciante' => $comerciante[0]->ID_Comerciante ]) }}" data-action="share/whatsapp/share"><i class="fa-brands fa-whatsapp catalogo-RS WHhatsApp-catalogo"></i></a>
                    </div>    
                    <div>
                        <p style="text-align: center; font-size: 0.7em">Compartir</p>
                    </div>
                </div>
                            
                {{-- ICONO CHEVRON SECCIONES --}}
                <div class="cont_catalogos--membrete--4">
                    <div> 
                        <img class="Default_pointer cont_catalogos--iconChevron" id="Secciones" src="{{ asset('/iconos/chevron/outline_expand_more_black_24dp.png') }}"/>
                    </div>  

                    <div>
                        <!-- SECCIONES ICONO CERRAR-->
                        <img class="Default_pointer cont_catalogos--iconCerrar" id="Cerrar" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}" onclick="cerrarVentana()"/>
                    </div> 
                </div>  
            </div>
        </header>

        <!-- MUESTRA MENU SECCIONES --> 
        <div class="cont_catalogos--secciones" id="Con_Secciones">
            @foreach($secciones as $Key) 
                <a class="cont_catalogos--a" href="{{ route('SeccionesTienda', ['id_comerciante' => $id_comerciante, 'id_seccion' => $Key->ID_Seccion]) }}" onclick="verSecion('{{ $Key->ID_Seccion }}">{{ $Key->seccion }}</a> 
            @endforeach
            
            <?php //$Pseudonimo = str_replace(" ", "_", $comerciante[0]->pseudonimoComerciante); ?>
            <a class="cont_catalogos--a" href="{{ route('SeccionesTienda', ['id_comerciante' => $id_comerciante, 'id_seccion' => 'todas']) }}" onclick="verSecion('Todos')">Todas las secciones</a>
            <hr class="hr_3 hr_3a">
            
            <!-- INFORMACION DE CONTACTO DEL VENDEDOR -->  
            <div class="cont_detalle_Producto--informacion cont_detalle_Producto---catalogo">
                <div class="cont_detalle_Producto--suscriptor">
                    <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/tienda/outline_storefront_black_24dp.png') }}"/>
                    <label class="cont_detalle_Producto--p">{{ $comerciante[0]->pseudonimoComerciante }}</label>
                </div>
                <div class="cont_detalle_Producto--suscriptor">
                    <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/ubicacion/outline_place_black_24dp.png') }}"/>
                    <label class="cont_detalle_Producto--p">{{ $comerciante[0]->municipioComerciante . '-' . $comerciante[0]->parroquiaComerciante }}</label> 
                </div>
                <div class="cont_detalle_Producto--suscriptor">
                    <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_perm_identity_black_24dp.png') }}"/>
                    <label class="cont_detalle_Producto--p">{{ $comerciante[0]->nombreComerciante . ' ' .$comerciante[0]->apellidoComerciante }}</label>
                </div>
                <div class="cont_detalle_Producto--suscriptor">
                    <img class="" style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/telefono/outline_phone_iphone_black_24dp.png') }}"/>
                    <label class="cont_detalle_Producto--p">{{ $comerciante[0]->telefonoComerciante }}</label>
                </div>
            </div>
        </div>

        <!-- PRODUCTOS -->
        <form id="Formulario">
        <div class="cont_catalogos--productos" id="Contenedor_13Js"> 
            
            @foreach($productos as $row)
                {{-- Se da formato al precio, sin decimales y con separación de miles --}}
                @php(settype($row->precioBolivar, "float"))
                @php(settype($row->precioDolar, "float"))
                @php($row->precioBolivar = number_format($row->precioBolivar, 2, ",", "."))
                @php($row->precioDolar = number_format($row->precioDolar, 2, ",", "."))  
                    
                <div class="contenedor_95 " id="{{ 'Cont_Producto_' . $row->ID_Opcion }}">
                                    
                    <div class="contOpciones">

                        {{-- PRODUCTO NUEVO O USADO --}}
                        @if($row->nuevo == 'Nuevo')                        
                            <label class="contOpciones--textoVertical">Articulo {{ $row->nuevo }}</label>
                        @elseif($row->nuevo == 'Usado')
                            <label class="contOpciones--textoVertical">Articulo {{ $row->nuevo }}</label>
                        @endif

                        <!-- IMAGEN -->
                        <a href="{{ route('ProductoAmpliado', ['id_producto' => $row->ID_Producto, 'bandera' => 'DesdeCatalogo']) }}" rel="noopener noreferrer" target="_blank"><img class="contOpciones__img" alt="Fotografia del producto" src="{{ asset('/images/clasificados/' . $id_comerciante . '/productos/' . $row->nombre_img) }}"/></a> 
                    </div>
                                
                    <div class="cont_producto"> 
                        <div class="cont_catalogos--producto"> 

                            <!-- PRODUCTO -->
                            <label class="input_8 input_8D hyphen" id="{{ 'EtiquetaProducto_' . $row->ID_Opcion }}">{{ $row->producto }}</label>

                            <!-- OPCION -->
                            <label class="input_8 input_8C hyphen" id="{{ 'EtiquetaOpcion_' . $row->ID_Opcion }}">{{ $row->opcion }}</label>
                        </div>   

                        <div class="cont_Precios">
                            <div style="width: 55%">  
                        
                                <!-- PRECIO EN Bs -->
                                <label class="input_8" id="{{ 'EtiquetaPrecio_' . $row->ID_Opcion }}" >Bs. {{ $row->precioBolivar }}</label>

                                <!-- PRECIO EN $-->
                                <label class="input_8" id="{{ 'EtiquetaPrecio_' . $row->ID_Opcion }}" >$ {{ $row->precioDolar }}</label>
                            </div> 
                    
                            <!-- BOTON AGREGAR -->
                            <div style="width:40%;">
                                @if($row->cantidad == 0)    <!--SINO HAY PRODUCTOS EN INVENTARIO SE DESABILITA-->
                                    <label class="label_4 label_4--innabilitado">Agotado</label> 
                                @else   <!--SI HAY PRODUCTOS EN INVENTARIO SE HABILITA-->
                                    <label for="{{ 'ContadorLabel_' . $row->ID_Opcion }}" class="label_4 Label_3js" id="{{ 'Etiqueta_' . $row->ID_Opcion }}">Agregar</label> 
                                    <!-- Este input es el que se envia al archivo JS por medio de la función agregarProducto(), en el valor se colocan el caracter _ para usarlo como separardor en JS-->
                                    <input class="Default_ocultar" type="radio" name="opcion" id="{{ 'ContadorLabel_' . $row->ID_Opcion }}" value="{{ $row->ID_Opcion . ',' . '_' . $row->producto . ',' . '_' . $row->opcion . ',' . '_' . $row->precioBolivar . ',' . '_' . $row->ID_Seccion }}" onclick="agregarProducto(this.form , '{{ 'Etiqueta_' . $row->ID_Opcion }}','{{ 'Cont_Leyenda_' . $row->ID_Opcion }}','{{ 'Cantidad_' . $row->ID_Opcion }}','{{ 'Producto_' . $row->ID_Opcion }}','{{ 'Opcion_' . $row->ID_Opcion }}','{{ 'Precio_' . $row->ID_Opcion }}','{{ 'Total_' . $row->ID_Opcion }}','{{ 'Leyenda_' . $row->ID_Opcion }}','{{ 'Cont_Producto_' . $row->ID_Opcion }}','{{ 'Item_'. $row->ID_Opcion }}','{{ $row->cantidad }}','{{ 'ID_BotonMas_'. $row->ID_Opcion }}','{{ 'ID_BloquearMas_'. $row->ID_Opcion }}','{{ $id_comerciante }}')"/>
                                @endif
                                        
                                <!-- BOTON MAS Y MENOS -->                            
                                <div class="contenedor_14" id="{{ 'Cont_Leyenda_' . $row->ID_Opcion }}">
                                    <!-- BOTON MAS Y MENOS -->
                                    <label class="menos MenosJS" id="{{ 'ID_BotonMenos_'. $row->ID_Opcion }}">-</label>
                                    <input class="input_2" type="text" id="{{ 'Item_'. $row->ID_Opcion }}"  value="1"/>
                                    <label class="mas MasJS" id="{{ 'ID_BotonMas_'. $row->ID_Opcion }}">+</label>

                                    <i class="fas fa-ban icono_7" id="{{ 'ID_BloquearMas_'. $row->ID_Opcion }}" onclick="BotonBloqueado()"></i>
                                    <input class="Default_ocultar BloquearMasJS" type="text" value="{{ $row->cantidad }}"/>

                                    <!-- cantidad alimentado desde E_Vitrina.js agregarOpcion()-->
                                    <input type="text" class="input_1e Default_ocultar" id="{{ 'Cantidad_' . $row->ID_Opcion }}"/>
                                    <!-- seccion -->
                                    <input type="text" class="input_1g Default_ocultar" name="seccion" id="{{ 'Seccion_' . $row->ID_Opcion }}"/>
                                    <!-- producto - alimentado desde E_Vitrina.js agregarOpcion() -->
                                    <input type="text" class="input_1a Default_ocultar" name="Desc_Producto" id="{{ 'Producto_' . $row->ID_Opcion }}"/>
                                    <!-- opcion alimentado desde E_Vitrina.js agregarOpcion()-->
                                    <input type="text" class="input_1c Default_ocultar" name="" id="{{ 'Opcion_' . $row->ID_Opcion }}"/>
                                    <!-- Precio - alimentado desde E_Vitrina.js agregarOpcion() -->
                                    <input type="text" class="input_1d Default_ocultar" id="{{ 'Precio_' . $row->ID_Opcion }}"/>
                                    <!-- Total - alimentado desde E_Vitrina.js agregarOpcion()-->
                                    <input type="text" class="input_1f Default_ocultar" id="{{ 'Total_' . $row->ID_Opcion }}"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <!-- DATOS VENDEDOR -->
                    <div class="contOpciones--vendedor"> 
                        <div class="cont_vendedor--span">                        
                            <div class="cont_vendedor--span-2">              
                                <span class="span--vendedor--ubicacion"></span>
                                <img class="icono--ubicacion" src="{{ asset('/iconos/ubicacion/outline_place_black_24dp.png') }}"/>{{ $comerciante[0]->parroquiaComerciante}} 
                            </div>
                            <span class="span--vendedor">Vendedor: {{ $comerciante[0]->pseudonimoComerciante }}</span> 
                        </div> 
                    </div>

                    <!-- LEYENDA -->
                    <div class="contenedor_19">
                        <!-- LEYENDA A MOSTRAR alimentado desde E_Catalogo.js -->
                        <input class="input_2a" type="text" name="leyenda" id="{{ 'Leyenda_'. $row->ID_Opcion }}"/>
                    </div> 
                </div>
            @endforeach                    
        </div>
        </form>

        <!-- En este div se carga el archivo carrito_V.php -->
        <div id="Mostrar_Orden"></div>

        {{-- se entregan a JS el ID_Suscriptor y el pseudonimoSuscripto de la tienda para verificar que no existan productos cargado de dos tendas diferentes --}}
        <input class="Default_ocultar" type="text" id="ID_Suscriptor" value='{{ $id_comerciante }}'/>   
        <input class="Default_ocultar" type="text" id="PseudonimoSuscripto" value='{{ $comerciante[0]->pseudonimoComerciante }}'/>
    </section>

    <!-- BOTON CARRITO DE COMPRAS -->
    <div class="contenedor_61" id="Contenedor_61"> 
        <input type="text" class="Default_ocultar" id="PrecioDolar" value="{{ $dolar }}" />
        <div class="contenedor_21" id="Mostrar_Carrito" onclick="llamar_PedidoEnCarrito('{{ route('VerCarrito', ['id_comerciante' => $id_comerciante, 'dolar' => $dolar]) }}')">
            <div class="contenedor_31">
                <small class="small_1 small_4" id="Small_4--JS">Ver <br class="br_3"> carrito</small>
                <img class="Default_pointer" style="width: 1.8em;" id="Cerrar" src="{{ asset('/iconos/carritoCompras/outline_shopping_cart_white_24dp.png') }}"/>
                <input type="text" class="input_5" id="Input_5" readonly/>
            </div>
        </div>
    </div>

    <!-- CINTILLO  -->
    <p class="contenedor_34--p" id="Contenedor_34--p">Cambio oficial BCV: 1 $ = {{ number_format($dolar, 2, ",", ".") }} Bs.</p>
    
    {{-- @include('layouts/footer') --}}

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/E_Catalogos.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/A_Catalogos.js?v='. rand()) }}"></script>

@endsection()
@extends('layouts.partiers.header_Noticia')

@section('titulo', 'MarketPlace')

@section('contenido')
    <section class="section_9" id="Section_3"> 
            
        <header>
            <div class="cont_clasificados">    
                <div class="cont_clasificados--item-1 Default_quitarMovil">
                    <h1 class="h1_1">Clasificados</h1> 
                </div>

                <!-- BUSCADOR -->
                <div style="display:flex; justify-content: space-around; align-items: center; margin-top: 5px; width: 100%; ">
                    <div>
                        <input style="width: 110%;" class="login_cont--input borde--input" type="text" name="buscador" id="Buscador" placeholder="Buscar producto"/>
                    </div>
                    <div>
                        <img class="Default_pointer" style="width: 100%;" src="{{ asset('/iconos/refrescar/outline_refresh_black_24dp.png') }}" id="Refrescar"/>
                    </div>
                </div>
                <div class="cont_clasificados--item-2">
                    <a class="boton boton--publicar" href="<?php //echo RUTA_URL . '/Categoria_C/';?>" rel="noopener noreferrer">Categorias</a>
                    <a class="boton boton--publicar" href="<?php //echo RUTA_URL . '/LoginController/index/SinID_Noticia,SinBandera';?>" rel="noopener noreferrer">Publicar</a>
                </div>
            </div>
        </header>   

        <div class="contenedor_13 contenedor_13--marginTOp" id="Contenedor_13Js">  
            @php($ContadorLabel = 1)

            @foreach($productos as $row)
                {{-- Se da formato al precio, sin decimales y con separación de miles --}}
                @php(settype($row->precioBolivar, "float")) 
                @php(settype($row->precioDolar, "float"))
                @php($row->precioBolivar = number_format($row->precioBolivar, 2, ",", ".")) 
                @php($row->precioDolar = number_format($row->precioDolar, 2, ",", "."))  
                
                <div class="contenedor_95" id="<?php echo 'Cont_Producto_' . $ContadorLabel;?>"> 

                    <!-- IMAGEN -->
                    <div class="contOpciones">
                        
                        {{-- PRODUCTO NUEVO O USADO --}}
                        @if($row->nuevo == 'Nuevo'){                          
                            <label class="contOpciones--textoVertical">Articulo {{ $row->nuevo }}</label>
                        @elseif($row->nuevo == 'Usado'){ 
                            <label class="contOpciones--textoVertical">Articulo {{ $row->nuevo }}</label>
                        @endif
                        
                        <!-- IMAGEN -->
                        <a href="{{ route('ProductoAmpliado', $row->ID_Producto) }}" rel="noopener noreferrer" target="_blank"><img class="contOpciones__img" alt="Fotografia del producto" src="{{ asset('/images/clasificados/' . $row->ID_Suscriptor . '/productos/' . $row->nombre_img) }}"/></a>
                    </div>
                                                        
                    <div class="cont_producto"> 
                        <div class="cont_catalogos--producto">

                            <!-- PRODUCTO -->
                            <label class="input_8 input_8D hyphen" id="<?php echo 'EtiquetaProducto_' . $ContadorLabel;?>"><?php echo $row->producto;?></label>

                            <!-- OPCION -->
                            <label class="input_8 input_8C hyphen" id="<?php echo 'EtiquetaOpcion_' . $ContadorLabel;?>">{{ $row->opcion }}</label>
                        </div>     
                            
                        <!-- PRECIO -->
                        <div class="cont_Precios--clasificados">
                            <div style="width: 55%">  
                        
                                <!-- PRECIO EN Bs -->
                                <label class="input_8" id="<?php echo 'EtiquetaPrecio_' . $ContadorLabel;?>" >Bs. {{ $row->precioBolivar }}</label>

                                <!-- PRECIO EN $-->
                                <label class="input_8" id="<?php echo 'EtiquetaPrecio_' . $ContadorLabel;?>" >$ {{ $row->precioDolar }}</label>
                            </div>
                        </div> 
                    </div>
                    
                    <!-- VENDEDOR -->
                    <div class="contOpciones--vendedor">   
                        @foreach($suscriptor as $Key)
                            @if($row->ID_Suscriptor == $Key->ID_Suscriptor)         
                                <div class="cont_vendedor--span">                        
                                    <div class="cont_vendedor--span-2">              
                                        <span class="span--vendedor--ubicacion"></span>
                                        <img class="icono--ubicacion" src="{{ asset('/iconos/ubicacion/outline_place_black_24dp.png') }}"/>{{ $Key->parroquiaSuscriptor }} 
                                    </div>
                                    <span class="span--vendedor">Vendedor: {{ $Key->pseudonimoSuscripto }}</span> 
                                </div> 
                            @endif
                        @endforeach
                    </div>
                </div>
                @php($ContadorLabel++)

            @endforeach                   
        </div>
        
        <!--Carga mediante Ajax las productos disponibles para la busqueda solicitada desde buscador_V.php -->
        <div class="contenedor_58" id="Buscar_Pedido">
        
        <!-- BOTONES DEL PANEL FRONTAL (solo en dispositivos moviles)-->	
        <div class="cont_portada--botones">                
            <div>
                <label class="boton boton--corto"><a class="Default_font--white boton_a" href="<?php //echo RUTA_URL . '/Categoria_C/';?>" rel="noopener noreferrer">Categorias</a></label> 
            </div>        
            <div>
                <label class="boton boton--corto"><a class="Default_font--white boton_a" href="<?php //echo RUTA_URL . '/LoginController/index/SinID_Noticia,SinBandera';?>" rel="noopener noreferrer">Publicar</a></label> 
            </div>        
        </div>

        <!-- CINTILLO  -->    
        <p class="contenedor_34--p" id="Contenedor_34--p">Cambio oficial BCV: 1 $ = {{ number_format($dolar, 2, ",", ".") }} Bs.</p>
        
    </section>

    {{-- @include('layouts/partiers/footer') --}}

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/E_Clasificados.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/A_Clasificados.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/FullScreem.js?v=' . rand()) }}"></script> 
@endsection()
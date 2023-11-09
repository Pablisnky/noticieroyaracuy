@extends('layouts.header_Noticia')

@section('titulo', 'MarketPlace Tiendas por categoria')

@section('contenido')

    <section class="section_9" id="Section_3"> 
            
        <header>
            <div class="cont_catalogosCateg--header">    
                <h1 class="h1_1">{{ str_replace("_", " ", $comercianteCategorias[0]->categoriaComerciante) }}</h1> 
            </div>
        </header>

        {{-- CINTILLO DE ALERTA --}}
        <!-- <h3 class="contenedor_13--clasificados h3_1 bandaAlerta">Periodo de prueba (simulación)</h3> -->
        
        <div class="cont_catalogosCateg">
            @foreach($comercianteCategorias as $row)
                @php($Categoria = $row->categoriaComerciante)
                
                <div class="cont_catalogosCateg--item  borde_1 borde_3"> 

                    <!-- IMAGEN -->
                    <div class="">
                        @if(!isset($row->nombreImgCatalogo))
                            <figure>  
                                <a style="display: block;" href="{{ route('Catalogo', ['id_comerciante' => $row->ID_Comerciante]) }}" rel="noopener noreferrer" target="_blank"><img class="cont_catalogosCateg_imgDefault" id="blah" alt="Fotografia del producto" src="{{ asset('/images/clasificados/tienda.png') }}"/></a>
                            </figure>
                        @else
                            <a href="{{ route('Catalogo', ['id_comerciante' => $row->ID_Comerciante]) }}" rel="noopener noreferrer" target="_blank"><img class="cont_catalogosCateg_img borde_top" alt="Portada de catalogo" src="{{ asset('/images/clasificados/' . $row->ID_Comerciante . '/' . $row->nombreImgCatalogo) }}"/></a>
                        @endif
                    </div>    
                
                    <!-- VEDEDOR -->
                    <div class="">                                         
                        <span class="cont_catalogosCateg_tienda">{{ $row->pseudonimoComerciante }}</span> 
                    </div>
                    
                    <!-- IMAGENES MINIATURAS DE SLIDER -->
                    <article class="cont_miniaturaSlider" id="Cont_miniaturaSlider">
                        <div class="cont_miniaturaSlider__2" id="Cont_miniaturaSlider__2">   
                            @php($ContadorLabel = 1)
                            @foreach($comerciante_productosDestacados as $Key) 
                                @if($Key->ID_Comerciante == $row->ID_Comerciante)
                                    <div class="cont_miniaturaSlider__3" id="Cont_miniaturaSlider__3" >
                                        <img class="contOpciones__img--tienda" alt="Fotografia del producto" src="{{ asset('/images/clasificados/' . $Key->ID_Comerciante . '/productos/' . $Key->nombre_img) }}"/>  
                                    </div>  
                                @endif
                            @endforeach
                        </div>
                    </article> 
                                        
                    <!-- BOTONES DELANTEROS -->
                    {{-- <article class="Componente_boton">
                        <div class="contBoton contBoton--100">
                            <label class="boton boton--corto" onclick="AtrasTarjeta({{ $row->ID_Comerciante }})">Información</label>

                            <a class="boton boton--corto" href="{{ route('Catalogo', ['id_comerciante' => $row->ID_Comerciante]) }}">Entrar</a>
                        </div>
                    </article> --}}
                </div> 
            @endforeach                  
        </div>
        
        <!-- BOTONES DEL PANEL FRONTAL (solo en dispositivos moviles)-->	
        <div class="cont_portada--botones">                
            <div>
                <label class="boton boton--corto"><a class="Default_font--white boton_a" href="<?php //echo RUTA_URL . '/Categoria_C/';?>" rel="noopener noreferrer">Categorias</a></label> 
            </div>        
            <div>
                <label class="boton boton--corto"><a class="Default_font--white boton_a" href="<?php //echo RUTA_URL . '/Login_C/index/SinID_Noticia,SinBandera';?>" rel="noopener noreferrer">Publicar</a></label> 
            </div>        
        </div>
    </section>

    {{-- @include('layouts/footer') --}}

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>

@endsection()
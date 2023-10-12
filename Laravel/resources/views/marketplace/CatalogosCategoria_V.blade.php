@extends('layouts.partiers.header_Noticia')

@section('titulo', 'MarketPlace Tiendas por categoria')

@section('contenido')

    <section class="section_9" id="Section_3"> 
            
        <header>
            <div class="cont_clasificados">    
                <div class="cont_clasificados--item-4">
                    <h1 class="h1_1">{{ str_replace("_", " ", $tiendasCategorias[0]['categoriaComerciante']) }}</h1> 
                </div>
            </div>
        </header>
        <!-- <h3 class="contenedor_13--clasificados h3_1 bandaAlerta">Periodo de prueba (simulación)</h3> -->
        
        <div class="cont_catalogosCateg">
            @foreach($tiendasCategorias as $row)
                @php($Categoria = $row['categoria'])
                
                <div class="cont_catalogosCateg--item"> 

                    <!-- IMAGEN -->
                    <div class="">
                        @if(!isset($row->nombreImgCatalogo))
                            <figure>  
                                <a href="{{ route('Catalogo', ['ID_Suscriptor' => $row->ID_Comerciante]) }}" rel="noopener noreferrer" target="_blank"><img class="cont_catalogosCateg_imgDefault" id="blah" alt="Fotografia del producto" src="{{ asset('/images/clasificados/tienda.png') }}"/></a>
                            </figure>
                        @else
                            <a href="{{ route('Catalogo', ['ID_Suscriptor' => $row->ID_Comerciante]) }}" rel="noopener noreferrer" target="_blank"><img class="cont_catalogosCateg_img" alt="Portada de catalogo" src="{{ asset('/images/clasificados/' . $row->ID_Comerciante . '/' . $row->nombreImgCatalogo) }}"/></a>
                        @endif
                    </div>     
                
                    <!-- VEDEDOR -->
                    <div class="">                                         
                        <span class="cont_catalogosCateg_tienda">{{ $row->pseudonimoComerciante }}</span> 
                    </div>
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

    {{-- @include('layouts/partiers/footer') --}}

    <script src="<?php //echo RUTA_URL . '/public/javascript/funcionesVarias.js?v='. rand();?>"></script>
    <!-- <script src="<?php ////echo RUTA_URL . '/public/javascript/E_Clasificados.js?v='. rand();?>"></script> -->
    <!-- <script src="<?php ////echo RUTA_URL . '/public/javascript/A_Clasificados.js?v='. rand();?>"></script> -->

@endsection()
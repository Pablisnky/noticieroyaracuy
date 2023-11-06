@extends('layouts.header_Noticia')

@section('titulo', 'Profesionales por categoria')

@section('contenido')

    <section class="section_9" id="Section_3"> 
            
        <header>
            <div class="cont_clasificados">    
                <div class="cont_clasificados--item-1 Default_quitarMovil">
                    <h1 class="h1_1">Directorio Profesional</h1> 
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
                    <a class="boton boton--publicar" href="{{ route('Categoria') }}" rel="noopener noreferrer">Categorias</a>
                    <a class="boton boton--publicar" href="{{ route('Login', ['id_noticia' => 'sin_id_noticia', 'bandera' => 'sin_bandera', 'id_comentario' => 'sin_id_comentario']) }}" rel="noopener noreferrer">Crear perfil</a>
                </div>
            </div>
        </header>

        {{-- CINTILLO DE ALERTA --}}
        <!-- <h3 class="contenedor_13--clasificados h3_1 bandaAlerta">Periodo de prueba (simulación)</h3> -->
        
        <div class="cont_catalogosCateg">
            @foreach($profesionales as $row)                
                <div class="cont_catalogosCateg--item  borde_1 borde_3"> 

                    <!-- IMAGEN -->
                    <div class="">
                        <a href="" rel="noopener noreferrer" target="_blank"><img class="cont_catalogosCateg_img borde_top" alt="Portada de catalogo" src="{{ asset('/images/directorioProfesional/' . $row->ID_Profesional . '/' . $row->nombre_ImagenProfesional) }}"/></a>
                    </div>    
                    
                    <!-- IMAGENES MINIATURAS DE SLIDER -->
                    <article class="cont_miniaturaSlider" id="Cont_miniaturaSlider">
                        <div class="cont_miniaturaSlider__2" id="Cont_miniaturaSlider__2">    
                            {{-- Se quitan los espacios en el nombre de la tienda para comparar con la carpeta donde se encuentran las imagenes de la tienda --}}
                            @php($ContadorLabel = 1)
                            @foreach($profesionalesImagenes as $Key) 
                                @if($row->ID_Profesional == $Key->ID_Profesional)
                                    <div class="cont_miniaturaSlider__3" id="Cont_miniaturaSlider__3" >
                                        <img class="contOpciones__img--tienda" alt="Fotografia del producto" src="{{ asset('/images/directorioProfesional/' . $Key->ID_Profesional . '/' . $Key->nombre_ImagenProfesional) }}"/>  
                                    </div> 
                                @endif 
                            @endforeach
                        </div>
                    </article>  
                
                    <!-- PROFESIONAL -->
                    <div class="">                                         
                        <span class="cont_catalogosCateg_tienda">{{ $row->nombre_Poofesional . ' ' . $row->apellido_Poofesional }}</span>
                    </div>
                                        
                    <!-- BOTONES DELANTEROS -->
                    <article class="Componente_boton">
                        <div class="contBoton contBoton--100">
                            <label class="boton boton--corto" onclick="AtrasTarjeta({{ $row->ID_Profesional }})">Información</label>
                        </div>
                    </article>
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
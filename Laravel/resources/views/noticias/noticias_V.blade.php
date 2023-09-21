@extends('layouts.partiers.header_Noticia')

@section('titulo', 'Noticias generales')

@section('contenido')

    <div class="cont_noticias" id="Cont_Noticia">
        @foreach($secciones as $Row)

            <!-- NOMBRE SECCION - CHEVRON - FILTROS -->
            <div class="cont_noticias--mun" id="{{ $Row['seccion'] }}">
        
                <div class="cont_noticia--tituloSeccion">
                    <!-- ICONO REGRESAR --> 
                    <div style="display: flex; align-items: center;">
                        <img class="Default_ocultar" style="width: 2em" src="{{ asset('/iconos/chevron/outline_chevron_left_black_24dp.png') }}" onclick="regresaSeccion('<?php //echo  'Busqueda_' . $Row['seccion'];?>')"/>

                        <!-- NOMBRE SECCION -->
                        <h1 class="cont_noticia--tituloSeccion--h1">{{ $Row['seccion'] }}</h1> 

                        <!-- ICONO EXPNDIR -->
                        <img class="Default_pointer" style="width: 2em;" alt="icono_expandir" src="{{ asset('/iconos/chevron/outline_expand_more_black_24dp.png') }}"  onclick="MostrarSecciones('<?php //echo $Row['seccion'];?>')"/>
                    </div>
                    
                    <!-- ICONO CEVRON MUNICIPIOS -->
                    <div class="cont_noticia--filtros">

                        <!-- PONER FILTRO -->
                        <img class="Default_pointer" style="width: 1.5em;" src="{{ asset('/iconos/filtro/outline_filter_alt_black_24dp.png') }}" onclick="MostrarMunicipios('<?php //echo $Row['seccion'];?>')"/>

                        <!-- QUITAR FILTRO -->                     
                        <img class="Default_ocultar Default_pointer" id="<?php //echo 'Filtro_'. $Row['seccion'];?>" style="width: 1.5em" src="{{ asset('/iconos/filtro/outline_filter_alt_off_black_24dp.png') }}" id="<?php //echo 'Filtro_'. $Row['seccion'];?>" onclick="Llamar_Quitarfiltro('<?php //echo $Row['seccion'];?>')"/>
                    </div>
                </div>
            </div>

            <!-- DIV NOTICIA -->
            <section class="cont_noticia--seccion seccion_JS" id="<?php echo 'Busqueda_' . $Row['seccion'];?>"> 
                @foreach ($noticiasSeccion as $Key)  
                    @foreach ($Key as $Key_2) 
                        @if($Row->ID_Seccion == $Key_2->ID_Seccion)
                            <div class="cont_noticia--sencilla Default_pointer " >
                                                                    
                                <!-- IMAGEN -->
                                <a href="{{ route('DetalleNoticia', $Key_2->ID_Noticia) }}" rel="noopener noreferrer" target="_blank">
                                    <div style="display: flex; ">
                                        <div style="flex-grow: 1;flex-shrink: 1;">
                                            <img class="cont_noticia-imagen" style="border-top-left-radius: 15px;" alt="Fotografia" src="{{ asset('/images/noticias/' . $Key_2->nombre_imagenNoticia) }}"/>
                                        </div>                                    
                                        <?php
                                        if($Key_2['municipio'] != 'Ambito estadal'){    ?>

                                            <!-- TEXTO VERTICAL -->
                                            <div  class="cont_portada--municipio cont_noticia--verticlal">
                                                <p class="cont_portada--municipio--p cont_noticia--verticlal--p"><?php echo $Key_2['municipio'];?> </p>
                                                <p class="cont_portada--abreviatura cont_noticia--abreviatura--verticlal">Mcpio.</p>
                                            </div>
                                            <?php
                                        } 
                                        else{   ?>

                                            <!-- TEXTO VERTICAL -->
                                            <div  class="cont_portada--municipio cont_noticia--verticlal">
                                                <p class="cont_portada--municipio--p cont_noticia--verticlal--p"><?php echo $Key_2['municipio'];?> </p>
                                            </div>
                                            <?php
                                        }
                                            ?>
                                    </div>        
                                </a>                          
    
                                <div class="cont_noticia--titular">
                                    <p class="cont_noticias--titulo"><?php echo $Key_2['titulo'];?></p>
                                    
                                    <!-- INFORMACION -->
                                    <?php
                                    // CANTIDAD DE IMAGENES
                                    foreach($cantidadImagenes as $Row_3)   :  
                                        if($Key_2['ID_Noticia'] == $Row_3['ID_Noticia']){ 
                                            if($Row_3['cantidadImagenes'] == 1){ ?> 
                                                <small class="cont_noticias_informacion--span"><?php echo $Row_3['cantidadImagenes'];?> imagen</small>
                                                <?php
                                            }
                                            else{   ?>
                                                <small class="cont_noticias_informacion--span"><?php echo $Row_3['cantidadImagenes'];?> imagenes</small>   
                                                <?php
                                            } 
                                        }
                                    endforeach; 
    
                                    // VIDEO
                                    foreach($videos as $Row_4)  : 
                                        if($Key_2['ID_Noticia'] == $Row_4['ID_Noticia']){ ?> 
                                            <small class="cont_noticias_informacion--span">video</small> 
                                            <?php
                                        }
                                    endforeach;
    
                                    // COMENTARIOS
                                    foreach($cantidadCmentarios as $Row_10)   :  
                                        if($Key_2['ID_Noticia'] == $Row_10['ID_Noticia']){ 
                                            if($Row_10['cantidadComentario'] > 1 ){ ?>
                                                <small class="cont_portada_informacion--span"><?php echo $Row_10['cantidadComentario']?> Comentarios</small>
                                                <?php
                                            }
                                            else{   ?>
                                                <small class="cont_portada_informacion--span"><?php echo $Row_10['cantidadComentario'];?> Comentario</small> 
                                                <?php
                                            }    
                                        }
                                    endforeach; 
                                    
                                    //  SI EXISTE ANUNCIO PUBLICITARIO
                                    foreach($anuncios as $Row_2)   :  
                                        if($Key_2['ID_Noticia'] == $Row_2['ID_Noticia']){ ?>
                                            <small class="cont_noticias_informacion--span">+ Anuncio</small>
                                            <?php
                                        }
                                    endforeach; ?>
    
                                    <!-- FUENTE -->
                                    <br>
                                    <small class="cont_noticias_informacion--span"><?php echo $Key_2['fuente'];?></small>     
    
                                    <!-- FECHA -->
                                    <br>
                                    <small class="cont_noticias_informacion--span">{{ \Carbon\Carbon::parse(strtotime($Key_2->fecha))->format('d-m-Y') }}</small>
                                    <br>                           
                                </div>  
                            </div>
                        @endif
                    @endforeach              
                @endforeach  
            </section>
        @endforeach
    </div>

    @include('layouts/partiers/footer')

    <script src="{{ asset('/js/funcionesVarias.js') }}"></script>
@endsection()
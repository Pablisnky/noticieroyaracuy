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
                        <img class="Default_pointer" style="width: 2em;" alt="icono_expandir" src="{{ asset('/iconos/chevron/outline_expand_more_black_24dp.png') }}"  onclick="MostrarSecciones('{{ $Row->seccion }}')"/>
                    </div>
                    
                    <!-- ICONO CHEVRON MUNICIPIOS -->
                    <div class="cont_noticia--filtros">

                        <!-- PONER FILTRO -->
                        <img class="Default_pointer" style="width: 1.5em;" src="{{ asset('/iconos/filtro/outline_filter_alt_black_24dp.png') }}" onclick="MostrarMunicipios('{{ $Row->seccion }}')"/>

                        <!-- QUITAR FILTRO -->                     
                        <img class="Default_ocultar Default_pointer" id="{{ 'Filtro_'. $Row->seccion }}" style="width: 1.5em" src="{{ asset('/iconos/filtro/outline_filter_alt_off_black_24dp.png') }}" onclick="Llamar_Quitarfiltro('{{ $Row->seccion }}','{{ route('QuitarFiltroMunicicpio', ['seccion' => $Row->seccion]) }}')"/>
                    </div>
                </div>
            </div>

            <!-- MUESTRA MENU DE BUSQUEDA POR MUNICIPIOS --> 
            <div class="cont_noticias--municipios borde_1" id="Con_Municipios">
                <img class="Default_pointer" style="width: 2em; margin-left: 90%;" onclick="MostrarMunicipios('{{ $Row->seccion }}')" src="{{ asset('/iconos/cerrar/outline_close_black_24dp.png') }}"/>
                <h1 class="cont_noticias--menuSeccion" id="NombreSeccion"></h1><!--contenido asignado desde Js-->
    
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('Aristides Bastidas')">Aristides Bastidas</label>
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('Simon Bolivar')">Simon Bolivar</label>                    
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('Manuel Bruzual')">Manuel Bruzual</label>
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('Cocorote')">Cocorote</label>
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('Independencia')">Independencia</label>
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('Jose Antonio Paez')">Jose Antonio Paez</label>
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('La Trinidad')">La Trinidad</label>
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('Manuel Monge')">Manuel Monge</label>
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('Nirgua')">Nirgua</label>
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('José Vicente Peña')">José Vicente Peña</label>
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('San Felipe')">San Felipe</label>
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('Antonio J. de Sucre')">Antonio J. de Sucre</label>
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('Urachiche')">Urachiche</label>
                <label class="cont_noticias--label" onclick="Llamar_filtrarMunicipio('Jose Joaquin Veroes')">Jose Joaquin Veroes</label>               
            </div>
                
            <!-- MUESTRA MENU DE BUSQUEDA POR SECCIONES --> 
            <div class="cont_noticias--municipios borde_1" id="Con_Secciones">
                <img class="Default_pointer" style="width: 2em; margin-left: 90%;" onclick="MostrarSecciones()" src="{{ asset('/iconos/cerrar/outline_close_black_24dp.png') }}"/>
                <h1 class="cont_noticias--menuSeccion">Secciones</h1>
    
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion('Cultura')">Cultura</label>
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion('Politica')">Politica</label>
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion('Sucesos')">Sucesos</label>
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion('Infraestructura')">Infraestructura</label>
                <!-- <a onclick="jumpto('Deporte');">One</a> -->
    
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion('Salud')">Salud</label>
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion('Deporte')">Deporte</label>
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion()">Comunidad y sociales </label>
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion('Educación')">Educación</label>
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion('Economia')">Economía</label>
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion('Religion')">Religión</label>
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion()">Ciencia y tecnología</label>
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion()">Servicios públicos </label>
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion('Turismo')">Turismo</label>
                <label class="cont_noticias--label Default_font--black" onclick="Mostrar_Seccion('Comuna')">Comuna</label>
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

                <!-- LINK A HEMEROTECA -->
                <div class="cont_noticias--libreria">       
                    <?php        
                    foreach($cantidadSeccion as $Key) : 
                        foreach($Key as $Key_2) :
                            if(($Row->ID_Seccion == $Key_2->ID_Seccion) AND $Key_2->cantidad > 15){ ?> 
                                <label class="cont_noticias--hemeroteca">Hemeroteca <br>{{ $Row->seccion }}</label>      
                                <a style="display: block; text-align: center;" href="{{ route('Archivo', ['id_seccion' => $Row->ID_Seccion]) }}" rel="noopener noreferrer" target="_blank"><img class="Default_pointer" style="width: 2.5em; margin-left:41%;" src="{{ asset('/iconos/library/outline_library_books_black_24dp.png') }}"/>+ {{ $Key_2->cantidad  - 15 }} Noticias</a>
                                <?php
                            }
                        endforeach;
                    endforeach;
                    ?>
                </div>   
            </section>
        @endforeach
    </div>

    @include('layouts/partiers/footer')

    <script src="{{ asset('/js/funcionesVarias.js') }}"></script>
    <script src="{{ asset('/js/E_Noticia.js') }}"></script>
    <script src="{{ asset('/js/A_Noticia.js') }}"></script>
    <script src="{{ asset('/js/FullScreem.js?v=' . rand()) }}"></script> 
@endsection()
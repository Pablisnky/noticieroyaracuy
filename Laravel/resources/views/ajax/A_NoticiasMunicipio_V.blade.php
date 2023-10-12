@if($noticiasSeccion != Null)
    @php($Iterador = 1)
    @foreach($noticiasSeccion as $Key_2)
        <div class="cont_noticia--sencilla Default_pointer">
            
            <!-- IMAGEN -->
            <a href="<?php //echo RUTA_URL . '/Noticias_C/detalleNoticia/' . $Key_2['ID_Noticia'];?>" rel="noopener noreferrer" target="_blank">
                <div style="display: flex;">
                    <div style="flex-grow: 1;flex-shrink: 1;">
                        <img class="cont_noticia-imagen" style="border-top-left-radius: 15px;" alt="Fotografia" src="{{ asset('/images/noticias/' . $Key_2->nombre_imagenNoticia) }}"/>
                    </div>
                    <?php
                    if($Key_2['municipio'] != ''){    ?>
                        <!-- TEXTO VERTICAL -->
                        <div class="cont_portada--municipio cont_noticia--verticlal">
                            <p class="cont_portada--municipio--p cont_noticia--verticlal--p">{{ $Key_2->municipio }} </p>
                            <p class="cont_portada--abreviatura cont_noticia--abreviatura--verticlal">Mcpio</p>
                        </div>
                        <?php
                    } ?>   
                </div>                  
            </a>                          

            <div class="cont_noticia--titular">
                <p class="cont_noticias--titulo">{{ $Key_2->titulo }}</p>
                
                {{-- CANTIDAD DE IMAGENES --}}
                @foreach($imagenes as $Row_3) 
                    @if($Key_2->ID_Noticia == $Row_3->ID_Noticia) 
                        @if($Row_3->cantidad == 1)
                            <small class="cont_noticias_informacion--span">{{ $Row_3->cantidad }} imagen</small>
                        @else
                            <small class="cont_noticias_informacion--span">{{ $Row_3->cantidad }} imagenes</small>   
                        @endif
                    @endif
                @endforeach

                {{-- VIDEO --}}
                {{-- @foreach($videos as $Row_4) 
                    @if($Key_2->ID_Noticia == $Row_4->ID_Noticia) 
                        <small class="cont_noticias_informacion--span">video</small> 
                    @endif
                @endforeach --}}
                
                {{-- COMENTARIOS --}}
                {{-- @foreach($cantidadCmentarios as $Row_10)  
                    @if($Key_2->ID_Noticia == $Row_10->ID_Noticia) 
                        @if($Row_10->cantidadComentario > 1 )
                            <small class="cont_portada_informacion--span"><?php //echo $Row_10['cantidadComentario']?> Comentarios</small>
                        @else
                            <small class="cont_portada_informacion--span"><?php //echo $Row_10['cantidadComentario'];?> Comentario</small> 
                        @endif
                    @endif
                @endforeach --}}

                {{-- SI EXISTE ANUNCIO PUBLICITARIO --}}
                {{-- @foreach($anuncios as $Row_2)   
                    @if($Key_2->ID_Noticia == $Row_2->ID_Noticia)
                        <small class="cont_noticias_informacion--span">+ Anuncio</small>
                    @endif
                @endforeach --}}

                <!-- FUENTE -->
                <br>
                <small class="cont_noticias_informacion--span">{{ $Key_2->fuente }}</small>     

                <!-- FECHA -->
                <br>
                <small class="cont_noticias_informacion--span">{{ $Key_2->fechaPublicacion }}</small style="font-size: 0.8em;">
                <br>                           
            </div>  
        </div> 
    @endforeach      

            {{-- {{'ID_Seccion= ' . $Key_2->D_Seccion}} --}}
    <!-- CANTIDAD DE NOTICIAS POR SECCION -->
    <div class="cont_noticias--libreria"> 
        {{-- @foreach($cantidadSeccion as $row) 
            @foreach($row as $row_1)
            {{$row_1->ID_Seccion}}
                @if($Key_2->D_Seccion == $row_1->ID_Seccion)                   
                    <a style="display: block; text-align: center;" href="<?php //echo RUTA_URL . '/Noticias_C/archivo/' . $Row['ID_Seccion'];?>" rel="noopener noreferrer" target="_blank"><img class="Default_pointer" style="width: 2.5em; margin-left:41%;" src="<?php //echo RUTA_URL . '/public/iconos/library/outline_library_books_black_24dp.png'?>"/>+ <?php //echo $Key_2['cantidad'] - 15?> Noticias</a>
                @endif
            @endforeach
        @endforeach --}}
    </div>  
@else
    <div class="cont_noticia-sinRegistro borde_1">
        <div>
            <img style="width: 3em; display: block;margin: auto" src="{{ asset('/iconos/error/outline_error_outline_black_24dp.png') }}"/>
            <p>No se han encontrados noticias de {{ $seccion }} para el Mcpio. {{ $municipio }}</p>
        </div>
    </div>
@endif
@extends('layouts.partiers.header_PanelPortada')

@section('titulo', 'Panel periodista')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/periodistas/periodistaMenu_V')

    <!-- CDN CALENDARIO y previsualización de la imagen -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <div class="cont_panel--actualizar">   
        <form action="{{ route('RecibeActualizarNoticia') }}" method="POST" enctype="multipart/form-data" autocomplete="off" onsubmit="return validarActualizarNoticia()">	
            {!! csrf_field() !!}

            <fieldset class="fieldset_1" id="Portada"> 
                <legend class="legend_1">Actualizar Noticia</legend>
                <div class="cont_panel--actualizar--contenido">
                    <div class="cont_panel--actualizar--media">                       

                        <!-- IMAGEN PRINCIPAL-->
                        <div>
                            <label class="cont_panel--label">Imagen principal</label>
                            <div class="cont_edit">

                                <!-- ICONO EDITAR -->
                                <label class="Default_pointer" for="imgInp"><img class="Default_pointer" src="{{ asset('/iconos/edit/outline_edit_black_24dp.png') }}"/></label>
                            </div> 
                            <figure>
                                <img class="cont_panel--imagen" alt="Fotografia Principal" id="ImagenPrincipal" src="{{ asset('/images/noticias/' . $noticiaActualizar->nombre_imagenNoticia) }}"/> 
                            </figure>                                
                            <input class="Default_ocultar" type="file" accept="image/*" name="imagenPrincipal" id="imgInp"/>
                        </div>

                        <!-- ANUNCIO PUBLICITARIO --> 
                        <div style="margin-top: 30px">
                            <label class="cont_panel--label">Anuncio publicitario</label>
                            <div id="Contenedor_Anuncio">
                                @if(empty($anuncio->ID_Anuncio)) 
                                    
                                    <!-- ICONO EDITAR PUBLICIDAD-->
                                    <div class="cont_edit">
                                        <label class="Default_pointer" id="Anuncio"><img class="Default_pointer" src="{{ asset('/iconos/edit/outline_edit_black_24dp.png') }}"/></label>
                                        <!-- <label class="Default_pointer"><span class="material-icons-outlined cont_edit--label" id="Anuncio">edit</span> </label> -->
                                    </div>   

                                    <!-- IMAGEN ANUNCIO PUBLICITARIO-->
                                    <figure>
                                        <img class="imagen_Default" name="imagenAnunio" alt="Fotografia Principal" id="ImgAnuncio" src="{{ asset('/images/imagen.png') }}"/>
                                    </figure>
                                    
                                    <input class="Default_ocultar" type="text" name="id_anuncio" id="ID_Anuncio" value="no existe"/>
                                    <input class="Default_ocultar" type="text" value="SiActualizar" name="actualizar" id="Actualiza"/>
                                @else
                                    <!-- ICONO EDITAR PUBLICIDAD-->
                                    <div class="cont_edit">
                                        <label class="Default_pointer" id="Anuncio"><img class="Default_pointer" src="{{ asset('/iconos/edit/outline_edit_black_24dp.png') }}"/></label>
                                        <!-- <label class="Default_pointer" id="Anuncio"><span class="material-icons-outlined cont_edit--label">edit</span></label> -->
                                    </div>   
                                    <figure>
                                        <img class="cont_panel--imagen" alt="Fotografia Anuncio" id="ImgAnuncio" src="{{ asset('/images/publicidad/' . $anuncio->nombre_imagenPublicidad) }}"/> 
                                    </figure>      
                                    <input class="Default_ocultar" type="text" name="id_anuncio" id="ID_Anuncio" value="{{ $anuncio->ID_Anuncio }}"/>
                                    <input class="Default_ocultar" type="text" value="SiActualizar" name="actualizar" id="Actualiza"/>
                                @endif
                            </div> 
                        </div>

                        <!-- VIDEO -->
                        <div style="margin-top: 30px">  
                                <label class="cont_panel--label">Video</label>  
                                @if(empty($video->ID_Noticia)) 
                                    <div class="cont_edit">
                                        <label class="Default_pointer" for="imgVideo"><img class="Default_pointer" src="{{ asset('/iconos/edit/outline_edit_black_24dp.png') }}"/></label>
                                        <!-- <label class="Default_pointer" for="imgVideo"><span class="material-icons-outlined cont_edit--label">edit</span></label> -->
                                    </div> 
                                    <figure id="FigureVideo">
                                        <img class="cont_panel--video" alt="Icono video" id="ImagenCamara" src="{{ asset('/video/video.png') }}"/>
                                    </figure> 
                                    
                                    <video class="cont_panel--imagen cont_panel--viedo" id="video-tag">
                                        <source id = "video-source"/>
                                    </video>

                                    <div style="display:flex; justify-content: space-around">
                                        <button style="padding:0% 3%" class="Default_ocultar" id="Reproducir" onclick="reproducir()">Reproducir</button>
                                        <button style="padding:0% 3%" class="Default_ocultar" id="Pausar" onclick="pausar()">Pausar</button>
                                    </div>

                                    <input class="Default_ocultar" type="file" accept="video/*" name="video" id="imgVideo"/>
                                @else  {{-- si existe un video y se va a actualizar ?>  --}}
                                    <div>
                                        <div class="cont_edit">
                                            <label class="Default_pointer" for="imgVideo"><img class="Default_pointer" src="{{ asset('/iconos/edit/outline_edit_black_24dp.png') }}"/></label>
                                            <!-- <label class="Default_pointer" for="imgVideo"><span class="material-icons-outlined cont_edit--label">edit</span></label> -->
                                        </div> 
                                        <video class="cont_panel--imagen" id="video-tag" controls src="{{ asset('/video/' . $video->nombreVideo) }}">
                                            <source id = "video-source"/>
                                        </video>

                                        <div style="display:flex; justify-content: space-around">
                                            <button style="padding:0% 3%" class="Default_ocultar" id="Reproducir" onclick="reproducir()">Reproducir</button>
                                            <button style="padding:0% 3%" class="Default_ocultar" id="Pausar" onclick="pausar()">Pausar</button>
                                        </div>
                                        <input class="Default_ocultar" type="file" accept="video/*" name="video" id="imgVideo"/>
                                    </div>
                                    <input class="Default_ocultar" type="text" value="{{ $video->ID_Video }}" name="id_video"/>
                                @endif
                        </div>
                    </div>

                    <div style="width: 100%; padding-left: 1%">
                        <!-- TITULO  -->
                        <label class="cont_panel--label">TItulo</label>
                        <textarea class="textarea--panel" name="titulo">{{ $noticiaActualizar->titulo }}</textarea>
                        
                        <!-- RESUMEN -->
                        <label class="cont_panel--label">Resumen</label>
                        <textarea class="textarea--panel" name="subtitulo">{{ $noticiaActualizar->subtitulo }}</textarea> 
                    
                        <!-- CONTENIDO -->
                        <label class="cont_panel--label">Contenido</label>
                        <textarea class="cont_panel--textarea Default--textarea--scrol" name="contenido" id="Contenido">{{ $noticiaActualizar->contenido }}</textarea> 

                        <!-- SECCION -->
                        <label class="cont_panel--label">Sección</label>
                        <input class="cont_panel--titulo" type="text" name="seccion" value="{{ $noticiaActualizar->seccion }}" id="SeccionPublicar"/>
                                                        
                        <!-- FECHA -->
                        <label class="cont_panel--label">Fecha</label> 
                        <input class="cont_panel--titulo" type="text" name="fecha" id="datepicker" value="{{ \Carbon\Carbon::parse(strtotime($noticiaActualizar->fecha))->format('d-m-Y') }}">
                        
                        <!-- MUNICIPIO -->                
                        <label class="cont_panel--label">Municipio</label>
                        <select class="login_cont--select borde--input" name="municipio" id="Municipio">
                            <option hidden>{{ $noticiaActualizar->municipio }}</option> <!--se da el valor hidden para que no lo muestre al desplegar el select -->
                            <option value="Aristides Bastidas">Aristides Bastidas</option>
                            <option value="Simón Bolivar">Bolivar</option>
                            <option value="Manuel Bruzual">Bruzual</option>
                            <option value="Cocorote">Cocorote</option>
                            <option value="Independencia">Independencia</option>
                            <option value="Jose Antonio Paez">Paez</option>
                            <option value="La Trinidad">La Trinidad</option>
                            <option value="Manuel Monge">Manuel Monge</option>
                            <option value="Nirgua">Nirgua</option>
                            <option value="José Vicente Peña"> Peña</option>
                            <option value="San Felipe">San Felipe</option>
                            <option value="Antonio J. de Sucre"> Sucre</option>
                            <option value="Urachiche">Urachiche</option>
                            <option value="Jose Joaquín Veroes">Veroes</option>
                        </select>  

                        <!-- FUENTE -->
                        <label class="cont_panel--label">Fuente</label>
                        <select class="login_cont--select borde--input" name="fuente" id="Fuente" onchange="especificarFuente()">
                            <option hidden>{{ $noticiaActualizar->fuente }}</option>
                            @foreach($fuentes as $Key)  
                                <option>{{ $Key->fuente }}</option>
                            @endforeach
                            <option value="Otra">Otra</option>
                        </select>
                        <div id="InsertarFuente"></div>
                    </div>                     
                </div>                        
            </fieldset>                

            <!-- IMAGENES SECUNDARIAS -->
            <fieldset class="fieldset_1">   
                <!-- AGREGAR MAS IMAGENES SECUNDARIAS -->
                <label class="actualizar_cont--label Default_pointer" for="imgSec"><img class=" actualizar_cont--span" src="{{ asset('/iconos/agregar/outline_add_circle_outline_black_24dp.png') }}"/></label>
                <input class="Default_ocultar" type="file" name="imagenesSecundarias[]" multiple="multiple" id="imgSec" onchange="muestraImgSecundarias()"/>

                <br><br> 
                <legend class="legend_1">Imagenes secundarias</legend> 
                
                <!-- EDITAR IMAGEN SECUNDARIA-->
                <div class="cont_panel--imagenSec">
                    @foreach($imagenesNoticiaActualizar as $Row)                    
                        <div style="margin: 1%;" id=PadreImagenes">
                            <input class="Default_ocultar" type="file" name="img_sSecundaria"  id="imgInp_3"/>
                            <div class="cont_edit--dosBotones" id="Cont_Botones--{{ $Row->ID_Imagen }}">
                                <div>
                                    <img class="Default_pointer" style="width: 2em" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}" onclick="EliminarImagenSecundaria('{{  $Row->ID_Imagen }}','Cont_Botones--{{ $Row['ID_Imagen'] }}')"/>
                                </div>
                            </div> 
                            <figure id="{{ $Row->ID_Imagen }}"> 
                                <img class="actualizar_cont--imagen" alt="Fotografia Principal" id="ImagenSecundaria" src="{{ asset('/images/noticias/' .  $Row->nombre_imagenNoticia) }}"/> 
                            </figure>
                        </div>
                    @endforeach
                </div>

                <!-- muestra las imagenes secundarias -->
                <div style="display:flex" id="muestrasImgSec_2"></div> 
            </fieldset> 
                    
            <!-- BOTON DE ENVIO Y DATOS OCULTOS -->
            <div class="cont_panel--guardar"> 
                <input class="Default_ocultar" type="text" name="ID_Noticia" value="{{ $noticiaActualizar->ID_Noticia }}"/> 
                <input class="Default_ocultar" type="text" name="id_fotoPrincipal" value="{{ $noticiaActualizar->ID_Imagen }}" />
                {{-- el valor optional es para cuando la consulta a la BD no traiga registros --}}
                <input class="Default_ocultar" type="text" name="ID_Anuncio" value="{{ optional($anuncio)->ID_Anuncio }}" /> 
                <input class="Default_ocultar" type="text" name="bandera" value="{{ $bandera }}" />

                <input class="boton" type="submit" value="Actualizar noticia"/>  
            </div>
        </form>
    </div>

    <!--div alimentado desde modal_seccionesDisponibles_V.php que muestra las secciones -->    
    <div id="Contenedor_90"></div>

    <!--div alimentado desde modal_anunciosDisponibles_V.php que muestra los anuncios publicitarios -->    
    <div id="Contenedor_91"></div>

    <!--div alimentado desde modal_coleccionesDisponibles_V.php que muestra las colecciones publicitarios -->    
    <!-- <div id="Contenedor_92"></div> -->


    <script src="{{ asset('/js/funcionesVarias.js?v=' . rand()) }}"></script>
    <script src="{{ asset('/js/A_ActualizarNoticia.js?v=' . rand()) }}"></script>
    <script src="{{ asset('/js/E_ActualizarNoticia.js?v=' . rand()) }}"></script> 
    <script src="{{ asset('/js/funcion_Calendario.js?v=' . rand()) }}"></script>

    <script>       
        //Da una vista previa de la foto de la noticia
        function readImage(input, id_Label){
            // console.log("______Desde readImage()______", input + ' | ' + id_Label)
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    id_Label.attr('src', e.target.result); //Renderizamos la imagen
                }
                reader.readAsDataURL(input.files[0]);
            }
        }        
        $("#imgInp").change(function(){
            // console.log("Desde cargar foto de perfil")
            // Código a ejecutar cuando se detecta un cambio de imagen de tienda
            var id_Label = $('#ImagenPrincipal');
            readImage(this, id_Label);
        });
                    
        // ************************************************************************************************
        //Da una vista previa del video de la noticia
        const videoSrc = document.querySelector("#video-source");
        const videoTag = document.querySelector("#video-tag");
        const inputTag = document.querySelector("#imgVideo");

        
        inputTag.addEventListener('change',  readVideo)

        function readVideo(event) {

            if(document.getElementById("FigureVideo")){
                document.getElementById("FigureVideo").style.display = "none"
            } 
            document.getElementById("video-tag").style.display = "block"
            document.getElementById("Reproducir").style.display = "inline"
            document.getElementById("Pausar").style.display = "inline"
            

            console.log(event.target.files)
            if(event.target.files && event.target.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                console.log('loaded')
                videoSrc.src = e.target.result
                videoTag.load()
                }.bind(this)

                reader.readAsDataURL(event.target.files[0]);
            }
        }
        
        window.reproducir = function() {
            document.getElementById("video-tag").play();
        }

        window.pausar = function() {
            document.getElementById("video-tag").pause();
        };

        // ************************************************************************************************  
        //Array contiene las imagenes secundarias insertadas, sus elementos sumados no pueden exceder de 7
        SeleccionImagenes = [];
        function muestraImgSecundarias(){
                // Muestra grupo de imagenes
                // console.log("______Desde muestraImgSecundarias()______")

                // document.getElementById("ImagenSecundaria").style.display = "none";
                var contenedorPadre = document.getElementById("muestrasImgSec_2");
                var archivos = document.getElementById("imgSec").files;
                
                var CantidadImagenes = archivos.length
                // console.log("Cantidad Imagenes recibidas= ", CantidadImagenes)
            
                if(CantidadImagenes < 8){
                    SeleccionImagenes.push(CantidadImagenes) 
                    // console.log("Imagenes recibidas= ",SeleccionImagenes)
                    // Suma la cantidad de imagenes que se han insertado  
                    TotalSeleccionImagenes = SeleccionImagenes.reduce((a, b) => a + b)
                    console.log("Suma de Imagenes = ",TotalSeleccionImagenes)
                    
                    if(TotalSeleccionImagenes < 8){
                        for(i = 0; i < CantidadImagenes; i++){
                            console.log(i)
                            var imgTagCreada = document.createElement("img");
                            var spanTagCreada = document.createElement("span")

                            imgTagCreada.width = 150;
                            imgTagCreada.height = 150;
                            ImagenD = imgTagCreada.id = "Imagen_" + i;
                            // imgTagCreada.marginBottom = 250
                            imgTagCreada.src = URL.createObjectURL(archivos[i]);

                            // spanTagCreada.innerHTML = "Eliminar"
                            spanTagCreada.id = "Etiqueta_" + i
                            spanTagCreada.style.color = "rgb(24, 24, 238)"
                            spanTagCreada.style.cursor = "pointer"
                            spanTagCreada.style.marginBottom = 100

                            //Se detecta la etiqueta dondes se hizo click
                            spanTagCreada.addEventListener("click", function(e){   
                                var click = e.target
                                EliminarImagenSecundaria(click, SeleccionImagenes)
                            }, false)

                            contenedorPadre.appendChild(imgTagCreada); 
                            contenedorPadre.appendChild(spanTagCreada); 
                        }
                    }
                    else{
                        alert("Máximo 7 imagenes permitidas")
                        //Se elimina la ultima cantidad de imagenes que se quiso insertar
                        SeleccionImagenes.pop() 
                        console.log("Array imagenes seleccionadas= ", SeleccionImagenes)
                    }
                }
                else{
                    alert("Máximo 7 imagenes permitidas")
                }
            }
    </script>

    {{-- @include('layouts/partiers/footer') --}}

@endsection()
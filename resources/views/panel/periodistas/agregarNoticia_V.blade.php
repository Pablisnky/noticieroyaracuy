@extends('layouts.partiers.header_PanelPortada')

@section('titulo', 'Panel periodista')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/periodistas/periodistaMenu_V')

    <!-- CDN CALENDARIO Y PREVISUALIZACION DE IMAGEN -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
 
    <div class="cont_panel--main">  
        <form action="{{ route('RecibeAgregarNoticia') }}" method="POST" enctype="multipart/form-data" autocomplete="off" id="Agregar" onsubmit="return validarAgregarNoticia()">
            {!! csrf_field() !!}
            <fieldset class="fieldset_1" id="Portada"> 
                <legend class="legend_1">Agregar Noticia</legend>
                <div class="cont_panel--actualizar--contenido">
                    <div class="cont_panel--actualizar--media">    

                        <!-- IMAGEN PRINCIPAL -->
                        <div>
                            <label class="cont_panel--label">Imagen principal</label>
                            <label class="Default_pointer" for="imgInp">    
                                <figure>
                                    <img class="cont_panel--imagen" name="imagenNoticia" alt="Fotografia Principal" id="blah" src="{{ asset('/images/imagen.png') }}"/>
                                </figure>
                            </label>
                            <input class="Default_ocultar" type="file" name="imagenPrincipal" id="imgInp"/>
                        </div>

                        <!-- IMAGEN ANUNCIO PUBLICITARIO -->
                        <div style="margin-top: 40px">
                            <label class="cont_panel--label">Anuncio publicitario</label>
                            <label class="Default_pointer" id="Anuncio">
                                <figure> 
                                    <img class="cont_panel--imagen" alt="Fotografia Principal" id="ImgAnuncio" src="{{ asset('/images/imagen.png') }}"/>
                                </figure>
                            </label>
                            <input class="Default_ocultar" type="text" id="ID_Anuncio" name="id_anuncio"/>
                        </div>

                        <!-- VIDEO -->
                        <div style="margin-top: 40px; margin-bottom: 40px;">  
                            <label class="cont_panel--label">Video</label>    
                            <label class="cont_panel--label Default_pointer" for="imgVideo">
                                <figure id="FigureVideo">
                                    <img class="cont_panel--video" alt="Icono video" id="ImagenCamara" src="{{ asset('/video/video.png') }}"/>
                                </figure> 
                            </label>
                            <div id="Cont_FigureVideo" style="display: none;">
                                <video class="cont_panel--imagen" id="video-tag" >
                                    <source id = "video-source"/>
                                </video>
                                <div style="display:flex; justify-content: space-around">
                                    <button style="padding:0% 3%" class="Default_ocultar" id="Reproducir" onclick="reproducir()">Reproducir</button>
                                    <button style="padding:0% 3%" class="Default_ocultar" id="Pausar" onclick="pausar()">Pausar</button>
                                </div>
                                <input class="Default_ocultar" type="file" accept="video/*" name="video" id="imgVideo"/>
                            </div>
                        </div>
                    </div>
                    
                    <div style="width: 100%; padding-left: 1%" id="AgregarNoticia">

                        <!-- TITULO -->
                        <label class="cont_panel--label">TItulo</label>
                        <textarea class="textarea--panel borde_1 borde_2" name="titulo" id="Titulo"></textarea> 
                        <input class="cont_panel--contador" type="text" id="ContadorTitulo" value="90" readonly/>
                        @error('titulo')
                            <label class="bandaAlerta">{{ $message }}</label>
                        @enderror

                        <!-- RESUMEN -->
                        <label class="cont_panel--label">Resumen</label>
                        <textarea class="textarea--panel borde_1 borde_2" name="subtitulo" id="Resumen"></textarea> 
                        <input class="cont_panel--contador" type="text" id="ContadorResumen" value="120" readonly/>

                        <!-- CONTENIDO -->
                        <label class="cont_panel--label">Contenido</label>
                        <textarea class="cont_panel--textarea Default--textarea--scrol borde_1 borde_2" name="contenido" id="Contenido" autosize="none"></textarea> 
                        <input class="cont_panel--contador" type="text" id="ContadorContenido" value="" readonly/>
                        
                        <!-- SECCION -->
                        <label class="cont_panel--label" id="LabelSeccion">Sección</label>
                        <input class="login_cont--input borde--input" type="text" name="seccion" id="SeccionPublicar" readonly  onfocus="Llamar_seccionesDisponible('{{ route('SeccionesNoticia') }}')"/>
                        
                        <!-- FECHA -->
                        <label class="cont_panel--label">Fecha</label>
                        <input class="login_cont--input borde--input" type="text" name="fecha" id="datepicker">

                        <!-- MUNICIPIO -->                
                        <label class="cont_panel--label">Municipio</label>
                        <select class="login_cont--select borde--input" name="municipio" id="Municipio">
                            <option></option>
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
                            <option hidden>{{ $fuenteDefault->fuenteDefault }}</option>
                            
                            @foreach($fuentes as $Key)
                                <option value="{{ $Key->fuente }}">{{ $Key->fuente }}</option>
                            @endforeach
                            <option value="Otra">Otra</option>
                        </select>
                        <div id="InsertarFuente"></div>
                        
                        <!-- IMAGENES SECUNDARIAS -->     
                        <label class="cont_panel--label Default_pointer" style="display: block; color: blue; font-weight: lighter;" for="ImgInp_2">Imagenes secundarias</label>
                        <input class=" Default_ocultar" type="file" name="imagenesSecUndariaNoticia[]" multiple="multiple" id="ImgInp_2" onchange="muestraImg()"/>  
                                
                        <!-- muestra las imagenes secundarias -->
                        <div class="cont_panel--imagenSec" id="muestrasImg_2"></div>                    
                    </div>                     
                </div>
                <br style="margin-bottom: 15%">

                <!-- BOTON DE ENVIO -->
                <div class="cont_panel--guardar"> 
                    <input class="boton" type="submit" form="Agregar" id="Boton_Agregar" value="Agregar noticia"/>  
                </div> 
            </fieldset> 
        </form>   
    </div>

    <!--div alimentado desde modal_seccionesDisponibles_V.php que muestra las secciones -->    
    <div id="Contenedor_80"></div>

    <!--div alimentado desde modal_anunciosDisponibles_V.php que muestra las anuncios publicitarios -->    
    <div id="Contenedor_91"></div>

    <script src="{{ asset('/js/funcionesVarias.js?v=' . rand()) }}"></script>
    <script src="{{ asset('/js/E_AgregarNoticia.js?v=' . rand()) }}"></script> 
    <script src="{{ asset('/js/A_AgregarNoticia.js?v=' . rand()) }}"></script> 
    <script src="{{ asset('/js/funcion_Calendario.js?v=' . rand()) }}"></script>

    <script>       
        // calendario  
        $( function() {
            $( "#datepicker" ).datepicker();
        } );

        // ************************************************************************************************ 

        //Da una vista previa de la foto principal de la noticia
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
            var id_Label = $('#blah');
            readImage(this, id_Label);
        });
        
        // ************************************************************************************************ 
        //Da una vista previa del video de la noticia
        const videoSrc = document.querySelector("#video-source");
        const videoTag = document.querySelector("#video-tag");
        const inputTag = document.querySelector("#imgVideo");

        
        inputTag.addEventListener('change',  readVideo)

        function readVideo(event) {

            document.getElementById("FigureVideo").style.display = "none"
            document.getElementById("Cont_FigureVideo").style.display = "block"
            document.getElementById("Reproducir").style.display = "inline"
            document.getElementById("Pausar").style.display = "inline"
            

            // console.log(event.target.files)
            if (event.target.files && event.target.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                // console.log('loaded')
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
        //Array contiene las imagenes insertadas, sus elementos sumados no pueden exceder de 7 imagenes
        SeleccionImagenes = [];
        
        function muestraImg(){
                // Muestra grupo de imagenes
                // console.log("______Desde muestraImg()______")

                var contenedorPadre = document.getElementById("muestrasImg_2");
                var archivos = document.getElementById("ImgInp_2").files;
                
                var CantidadImagenes = archivos.length
            
                if(CantidadImagenes < 8){
                    SeleccionImagenes.push(CantidadImagenes) 

                    // Suma la cantidad de imagenes que se han insertado  
                    TotalSeleccionImagenes = SeleccionImagenes.reduce((a, b) => a + b)
                    // console.log("Suma de Imagenes = ",TotalSeleccionImagenes)
                    
                    if(TotalSeleccionImagenes < 8){
                        for(i = 0; i < CantidadImagenes; i++){
                            var imgTagCreada = document.createElement("img");
                            var spanTagCreada = document.createElement("span")

                            imgTagCreada.setAttribute("width", 150)
                            imgTagCreada.setAttribute("height", 150)
                            ImagenD = imgTagCreada.id = "Imagen_" + i;
                            imgTagCreada.src = URL.createObjectURL(archivos[i]);

                            // spanTagCreada.innerHTML = "Eliminar"
                            // spanTagCreada.id = "Etiqueta_" + i
                            // spanTagCreada.style.color = "rgb(24, 24, 238)"
                            // spanTagCreada.style.cursor = "pointer"
                            // spanTagCreada.style.marginBottom = 100

                            //Se detecta la etiqueta donde se hizo click
                            spanTagCreada.addEventListener("click", function(e){   
                                var click = e.target
                                EliminarImagenSecundaria(click, SeleccionImagenes)
                            }, false)

                            contenedorPadre.appendChild(imgTagCreada); 
                            // contenedorPadre.appendChild(spanTagCreada); 
                        }
                    }
                    else{
                        alert("Máximo 7 imagenes permitidas")
                        //Se elimina la ultima cantidad de imagenes que se quiso insertar
                        SeleccionImagenes.pop() 
                        // console.log("Array imagenes seleccionadas= ", SeleccionImagenes)
                    }
                }
                else{
                    alert("Máximo 7 imagenes permitidas")
                }
            }
    </script>

    {{-- @include('layouts/partiers/footer') --}}

@endsection()
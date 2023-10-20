@extends('layouts.header_PanelPortada')

@section('titulo', 'Panel actualizar producto')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/comerciantes/comerciante_menu_V')

    <?php 
    //se invoca sesion con el ID_Afiliado creada en validarSesion.php para autentificar la entrada a la vista
    // if(!empty($_SESSION["ID_Suscriptor"])){
        ?>
        
        <!-- CDN libreria JQuery, necesario para la previsualización de la imagen   --> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
            
        <div class="cont_suscrip_publicar">    
            <form action="{{ route('RecibeAtualizarProducto') }}" method="POST" enctype="multipart/form-data" autocomplete="off" onsubmit = "return validarActualizacion()">
                {!! csrf_field() !!}

                <a id="Ancla_01" class="ancla_1"></a>
                <fieldset class="fieldset_1 fieldset_3">
                    <legend class="legend_1">Actualizar datos de producto</legend>
                    
                    <div class="contenedor_47" id="Contenedor_47">     

                        <!-- IMAGEN PRINCIPAL -->
                        <div class="contenedor_129">              
                            <label class="Default_pointer" for="imgInp"> 
                                <figure>  
                                    <img class="contenedor_119__img" id="blah_2" alt="Fotografia de producto" src="{{ asset('/images/clasificados/' . session('id_comerciante') . '/productos/' .  $imagenPrin->nombre_img) }}"/>
                                </figure>
                            </label>
                            <input class="Default_ocultar" type="file" accept="image/*" name="imagenPrinci_Editar" id="imgInp"/>

                            <!-- NUEVO O USADO -->
                            <div class="cont_radioButon">
                                <input class="cont_radioButon--input" type="radio" id="Nuevo" name="grupo" value="Nuevo" onclick="gestionarClickRadio(this);"> 
                                <label class="contInputRadio__label" for="Nuevo">Nuevo</label>
                                <br> <br>
                                <input class="cont_radioButon--input" type="radio" id="Usado" name="grupo" value="Usado" onclick="gestionarClickRadio(this);">
                                <label class="contInputRadio__label" for="Usado">Usado</label>
                            </div>
                        </div>               
                        <div class="cont_suscrip--editar">
                            
                            <!-- PRODUCTO -->
                            <label class="default_bold">Producto</label>
                            <textarea class="textarea_1 borde_1 borde_2" name="producto" id="ContenidoPro">{{ $especificaciones->producto }}</textarea>
                            <input class="contador" type="text" id="ContadorPro" value="50"/>

                            <!-- DESCRIPCION -->
                            <label class="default_bold">Descripcion</label>
                            <textarea class="textarea_1 borde_1 borde_2" name="descripcion" id="ContenidoDes">{{ $especificaciones->opcion }}</textarea>
                            <input class="contador" type="text" id="ContadorDes" value="100"/>

                            <!-- SECCION -->        
                            <label class="default_bold">Sección</label>
                            <select class="login_cont--select borde--input" name="id_seccion" id="Seccion">
                                <option value="{{ $seccion->ID_Seccion }}" hidden>{{ $seccion->seccion }}</option>
                                @foreach($secciones as $Row_3)  
                                    <option value="{{ $Row_3->ID_Seccion }}">{{ $Row_3->seccion }} </option>
                                @endforeach
                            </select>

                            <!-- PRECIO -->
                            <div style="display: flex;">
                                <div>
                                    <label class="default_bold">Bs.</label><br>
                                    <input class="placeholder placeholder_2 placeholder_5 borde_1 borde_2" type="text" name="precioBolivar" id="PrecioBolivar" value="{{ $especificaciones->precioBolivar }}"/>
                                </div>
                                <div>
                                    <label class="default_bold">$</label><br>
                                    <input class="placeholder placeholder_2 placeholder_5 borde_1 borde_2" type="text" name="precioDolar" id="PrecioDolar" value="{{ $especificaciones->precioDolar }}"/>
                                </div>
                            </div> 
                            <small class="small_1">El sistema realiza automaticamente la conversión Bolivar / Dolar según BCV. <strong class="strong_1">( $ 1 = Bs. {{ number_format($dolarHoy, 2, ",", ".") }})</strong></small>
                            <input class="Default_ocultar" id="CambioOficial" type="text" value="{{ $dolarHoy }}"/>

                            <!-- CANTIDAD EN EXISTENCIA -->
                            <div>
                                <label class="login_cont--label">Existencia</label>                       
                                <input class="placeholder placeholder_2 placeholder_4 borde_1 borde_2" type="text" name="existencia" id="Cantidad" value="{{ $especificaciones->cantidad }}">   
                            </div>  
                            
                            <!-- IMAGENES SECUNDARIAS -->
                            <div class="cont_suscrip_publicar--imgSec">
                                <label class="Default_pointer" style="display: block; color: blue; font-weight: lighter;" for="ImgInp_3">Añadir imagenes secundarias</label>
                                <small class="small_1">Añada hasta 5 fotografias no mayor a 4 Mb / CU</small>

                                <input class="Default_ocultar" type="file" name="imagenSecundariiaProdActualizar[]" multiple="multiple" id="ImgInp_3" onchange="VariasImg()"/>  
                            </div>  

                            {{-- DIV QUE MUESTRA LAS IMGENES SECUNDARIAS --}}
                            <div class="cont_suscrip_ImgSec">
                                @foreach($imagenSec as $Row_2)                   
                                    <div style="margin: 1%;" id=PadreImagenes">

                                        <!-- ICONO ELIMINAR IMAGEN -->
                                        <input class="Default_ocultar" type="file" name="img_sSecundaria"  id="imgInp_3"/>
                                        <div class="cont_edit--dosBotones" id="Cont_Botones--{{ $Row_2->ID_Imagen }}">
                                            <!-- <div> -->
                                            <img class="Default_pointer" style="width: 2em" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png') }}" onclick="EliminarImagenSecundaria('{{ $Row_2->ID_Imagen }}','Cont_Botones--{{ $Row_2->ID_Imagen }}','{{ route('EliminarImgSecundariaPRoducto', ['id_imagenSec' => $Row_2->ID_Imagen] ) }}')"/>
                                            <!-- </div> -->
                                        </div>

                                        <!-- IMAGEN SECUNDARIAS -->
                                        <figure id="{{ $Row_2->ID_Imagen }}"> 
                                            <img class="actualizar_cont--imagen" alt="Fotografia Producto" id="ImagenSecundaria" src="{{ asset('/images/clasificados/' . session('id_comerciante') . '/productos/'  .  $Row_2->nombre_img) }}"/> 
                                        </figure>
                                    </div>
                                @endforeach
                            </div>

                            <!-- Muestra imagenes secundrias añadidas -->
                            <div id="muestrasImg_3"></div>
                        </div>  
                    </div>

                    <!-- BOTON DE ENVIO Y DATOS OCULTOS -->
                    <div class="contBoton contBoton--marginTop">
                        <input class="Default_ocultar" type="text" name="id_comerciante" value="{{ session('id_comerciante') }}"/>
                        <input class="Default_ocultar" type="text" name="id_producto" value="{{ $especificaciones->ID_Producto }}">
                        <input class="Default_ocultar" type="text" name="id_opcion" value="{{ $especificaciones->ID_Opcion }}">
                        <!-- <input class="Default_ocultar" type="text" name="id_imagen" value="<?php ////echo $ID_ImagenPrincipal;?>"/> -->

                        <input class="boton boton--largo" type="submit" value="Actualizar cambios"/>
                    </div>  
                </fieldset> 
            </form>
        </div>
        
        <script src="{{ asset('/js/funcionesVarias.js?v=' . rand()) }}"></script>
        <script src="{{ asset('/js/E_Comerciante_editar_producto.js?v=' . rand()) }}"></script> 
        <script src="{{ asset('/js/A_Comerciante_editar_producto.js?v=' . rand()) }}"></script> 

        <script> 
            //Da una vista previa de la imagen principal antes de guardarla en la BD
            function readImage(input){
                // console.log("______Desde readImage()______", input)

                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#blah_2').attr('src', e.target.result); // Renderizamos la imagen
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#imgInp").change(function(){
                //Código a ejecutar cuando se detecta un cambio de archivo en imagen principal
                readImage(this);
            });
            
            //Da una vista previa de las imagenes secundarias seleccionadas
            // function muestraImg(){
            //     var contenedor = document.getElementById("muestrasImg");
            //     var archivos = document.getElementById("ImgInp_2").files;
            //     for(i = 0; i < archivos.length; i++){
            //         imgTag = document.createElement("img");
            //         imgTag.height = 100;//ESTAS LINEAS NO SON "NECESARIAS"
            //         imgTag.width = 200; //ÚNICAMENTE HACEN QUE LAS IMÁGENES SE VEAN
            //         // imgTag.class = "imagen_6";
            //         imgTag.id = i;      // ORDENADAS CON UN TAMAÑO ESTÁNDAR
            //         imgTag.src = URL.createObjectURL(archivos[i]);
            //         contenedor.appendChild(imgTag);
            //     }
            // }

            //Array que contiene la cantidad de imagenes insertadas, sus elementos sumados no pueden exceder de 5
            SeleccionImagenes = [];
            function VariasImg(){
                // console.log("______Desde CantidadImg()______")

                var contenedorPadre = document.getElementById("muestrasImg_3");
                var archivos = document.getElementById("ImgInp_3").files;
                
                var CantidadImagenes = archivos.length
                console.log("Cantidad Imagenes recibidas= ", CantidadImagenes)
            
                if(CantidadImagenes < 6){
                    SeleccionImagenes.push(CantidadImagenes) 
                    console.log("Imagenes recibidas= ",SeleccionImagenes)
                    // Suma la cantidad de imagenes que se han insertado  
                    TotalSeleccionImagenes = SeleccionImagenes.reduce((a, b) => a + b)
                    console.log("Suma de Imagenes = ",TotalSeleccionImagenes)
                    
                    if(TotalSeleccionImagenes < 6){
                        for(i = 0; i < CantidadImagenes; i++){
                            console.log(i)
                            var imgTagCreada = document.createElement("img");
                            var spanTagCreada = document.createElement("span")

                            imgTagCreada.height = 200;
                            imgTagCreada.width = 290;
                            ImagenD = imgTagCreada.id = "Imagen_" + i;
                            imgTagCreada.marginBottom = 250
                            imgTagCreada.src = URL.createObjectURL(archivos[i]);

                            spanTagCreada.innerHTML = "Eliminar"
                            spanTagCreada.id = "Etiqueta_" + i
                            spanTagCreada.style.color = "rgb(24, 24, 238)"
                            spanTagCreada.style.cursor = "pointer"
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
                        alert("Máximo imagenes alcanzado (5)")
                        //Se elimina la ultima cantidad de imagenes que se quiso insertar
                        SeleccionImagenes.pop() 
                        console.log("Array imagenes seleccionadas= ", SeleccionImagenes)
                    }
                }
                else{
                    alert("Máximo 5 imagenes permitidas")
                }
            }
        </script>        
        
        <?php //include(RUTA_APP . "/vistas/footer/footer.php");
    // }
    // else{
    //     header("location:" . RUTA_URL. "/Inicio_C");
    // }   ?>
    
@endsection()     
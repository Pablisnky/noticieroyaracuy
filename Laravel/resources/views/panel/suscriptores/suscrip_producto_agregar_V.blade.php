@extends('layouts.partiers.header_suscriptor')

@section('titulo', 'Panel agregar producto')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/suscriptores/suscrip_menu_V')
    
    <?php    
    //se invoca sesion con el ID_Afiliado creada en validarSesion.php para autentificar la entrada a la vista
    // if(!empty($_SESSION["Publicar"])){
        
        // $ID_Suscriptor = $_SESSION["ID_Suscriptor"];

        //Se da formato al precio, sin decimales y con separación de miles
        // $PrecioDolar = number_format($Datos['dolarHoy'], 2, ",", "."); 
        ?>       
            
        <!-- SDN libreria JQuery, necesaria para la previsualización de la imagen del producto--> 
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <div class="cont_suscrip_publicar">  
            <form action="<?php //echo RUTA_URL; ?>/Panel_Clasificados_C/recibeProductoPublicar" method="POST" enctype="multipart/form-data" autocomplete="off" onsubmit="return validarPublicacion()">

                <fieldset class="fieldset_1 fieldset_3"> 
                    <legend class="legend_1">Cargar producto</legend>
                    <div class="contenedor_47">    
                    
                        <!-- IMAGEN PRINCIPAL PRODUCTO-->
                        <div class="contenedor_129">
                            <label class="Default_pointer" for="imgInp"> 
                                <figure>  
                                    <img class="contenedor_119__img" id="blah" alt="Fotografia del producto" src="{{ asset('/images/imagen.png') }}"/>
                                </figure>
                            </label>
                            <input class="Default_ocultar" type="file" name="imagenProducto" id="imgInp"/>
                            
                            <!-- NUEVO O USADO -->
                            <div class="cont_radioButon">
                                <input class="cont_radioButon--input" type="radio" id="Nuevo" name="grupo" value="Nuevo" onclick="gestionarClickRadio(this)"> 
                                <label class="contInputRadio__label" for="Nuevo">Nuevo</label>
                                <br> <br>
                                <input class="cont_radioButon--input" type="radio" id="Usado" name="grupo" value="Usado" onclick="gestionarClickRadio(this)">
                                <label class="contInputRadio__label" for="Usado">Usado</label>
                            </div>
                        </div>        

                        <div>
                            <!-- PRODUCTO -->
                            <label class="login_cont--label">Producto</label>
                            <textarea class="textarea_1 borde_1 borde_2" name="producto" id="ContenidoPro"  tabindex="1" ></textarea>
                            <!-- CONTADOR PRODUCTO -->
                            <input class="contador" type="text" id="ContadorPro" value="50" readonly/>

                            <!-- DESCRIPCION -->
                            <label class="login_cont--label">Descripcion</label>
                            <textarea class="textarea_1 textarea_4 borde_1 borde_2" name="descripcion" id="ContenidoDes" tabindex="2"></textarea>
                            <!-- CONTADOR DESCRIPCION -->
                            <input class="contador" type="text" id="ContadorDes" value="100" readonly/>

                            <!-- SECCION -->        
                            <label class="default_bold">Sección</label>
                            <select class="login_cont--select borde--input" name="id_seccion" id="Seccion">
                                <option></option>
                                <?php
                                // foreach($Datos['secciones'] as $Row_3)   :   ?>
                                    <option value="<?php //echo $Row_3['ID_Seccion'];?>"><?php //echo $Row_3['seccion'];?></option>
                                    <?php
                                // endforeach; ?>
                            </select>

                            <!-- PRECIO -->                    
                            <div style="display: flex; justify-content: space-around;">
                                <div>
                                    <label>Bs.</label><br>
                                    <input class="placeholder placeholder_2 placeholder_5 borde_1 borde_2" type="text"  name="precioBs" id="PrecioBs" placeholder="0.00" tabindex="3"/>
                                </div>
                                <div>
                                    <label>$</label><br>
                                    <input class="placeholder placeholder_2 placeholder_5 borde_1 borde_2" type="text" name="precioDolar" id="PrecioDolar" placeholder="0.00" tabindex="3"/>
                                </div>
                            </div>
                            <small class="small_1">El sistema realiza automaticamente la conversión Bolivar / Dolar según BCV. <strong class="strong_1">( $ 1 = Bs. <?php //echo $PrecioDolar;?>)</strong></small>
                            <input class="Default_ocultar" id="CambioOficial" type="text" value="<?php //echo $Datos['dolarHoy'];?>"/> 
                            
                            <!-- CANTIDAD EN EXISTENCIA -->
                            <div class="Default_ocultar" id="Contenedor_152">
                                <label class="login_cont--label">Existencia</label>
                                <input class="placeholder placeholder_2 placeholder_4 borde_1 borde_2" type="text" name="cantidad" id="Cantidad">
                            </div>  
                            
                            <!-- IMAGENES SECUNDARIAS -->
                            <div class="cont_suscrip_publicar--imgSec">
                                <label class="Default_pointer" style="display: block; color: blue; font-weight: lighter;" for="ImgInp_2">Añadir imagenes secundarias</label>
                                <small class="small_1">Añada hasta 5 fotografias no mayor a 4 Mb / CU</small>

                                <input class="Default_ocultar" type="file" name="imagenSecundariiaProducto[]" multiple="multiple" id="ImgInp_2" onchange="muestraImg()"/>  
                            </div>     
                            
                            <!-- muestra las imagenes secundarias -->
                            <div class="cont_panel--imagenSec" id="muestrasImg_2"></div>  
                        </div>         
                    </div>       

                    <!-- BOTON DE ENVIO Y DATOS OCULTOS -->
                    <div class="contBoton contBoton--marginTop">
                        <input class="Default_ocultar" type="text" name="id_suscriptor" value="<?php //echo $ID_Suscriptor;?>"/>
                        <input class="boton boton--largo" type="submit" value="Agregar producto"/>
                    </div>  
                </fieldset>          
            </form>
        </div>        

        <!--div alimentado desde Secciones_Ajax_V.php con las secciones que el usuario cargó previamente -->    
        <div id="Contenedor_80"></div>

        <script src="<?php //echo RUTA_URL . '/public/javascript/funcionesVarias.js?v=' . rand();?>"></script>
        <script src="<?php //echo RUTA_URL . '/public/javascript/E_Suscrip_publicar.js?v=' . rand();?>"></script> 

        <script> 
            //Da una vista previa de la imagen principal antes de guardarla en la BD
            function readImage(input){
                if(input.files && input.files[0]){
                    var reader = new FileReader();
                    reader.onload = function(e){
                        $('#blah').attr('src', e.target.result); // Renderizamos la imagen
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }

            $("#imgInp").change(function(){
                // Código a ejecutar cuando se detecta un cambio de imagen individual
                readImage(this);
            });

            // ******************************************************************************************
            //Da una vista previa de las imagenes secndarias agregadas
            //Array contiene cantidad de imagenes insertadas, sus elementos sumados no pueden exceder de 5
            SeleccionImagenes = [];
            function muestraImg(){
                // console.log("______Desde muestraImg()______")

                var contenedorPadre = document.getElementById("muestrasImg_2");
                var archivos = document.getElementById("ImgInp_2").files;
                
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

                            imgTagCreada.width = 150;
                            imgTagCreada.height = 150;
                            ImagenD = imgTagCreada.id = "Imagen_" + i;
                            imgTagCreada.marginBottom = 50
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

            // ***********************************************************************************
            // GESTION DE RADIO BUTTOMS
            //Para distinguir la opción actualmente pulsada en cada grupo
            var pref_opcActual = "opcActual_";

            //Verifica si una variable definida dinámicamente existe o no
            function varExiste(sNombre){
                return (eval("typeof(" + sNombre + ");") != "undefined");
            }

            //Asigna un valor a una variable creada dinámicamente a partir de su nombre
            function asignaVar(sNombre, valor){
                eval(sNombre + " = " + valor + ";");
            }

            //generamos dinámicamente variables globales para contener la opción pulsada en cada uno de los grupos
            console.log("Cantidad elementos en el formulario = ",document.forms.length)
            for(f= 0; f<document.forms.length; f++){
                for(i = 0; i< document.forms[f].elements.length; i++){
                    var elementoExistente = document.forms[f].elements[i];
                    console.log("elementos form existente", elementoExistente)
                    var exprCrearVariable = "";

                    if(elementoExistente.type == "radio"){
                        //Si la variable no existe la definimos siempre, pero sólo la redefinimos en caso de que el elemento actual del grupo esté asignado
                        if(!varExiste(pref_opcActual + elementoExistente.name)){
                            exprCrearVariable = "var " + pref_opcActual + elementoExistente.name + " = ";
                            console.log("En el IF", exprCrearVariable)
                        }
                        else{
                            exprCrearVariable = pref_opcActual + elementoExistente.name + " = ";
                            console.log("En el ELSE", exprCrearVariable)
                        }
                        
                        //El valor será nulo o una referencia al radio actual en función de si está seleccionado o no
                        if(elementoExistente.checked)
                            exprCrearVariable += "document.getElementById(‘" + elementoExistente.id + "‘)";
                        else
                            exprCrearVariable += "null";

                        //Definimos la variable y asignamos el valor sólo si no existe o si el radio actual está marcado 
                        if(!varExiste(pref_opcActual + elementoExistente.name) || elementoExistente.checked)
                            eval(exprCrearVariable);
                    }
                }
            }

            function gestionarClickRadio(opcPulsada){
                console.log("____Desde gestionarClickRadio()____",opcPulsada)
                //El nombre de la variable que contiene el nombre del grupo actual
                var svarOpcAct = pref_opcActual + opcPulsada.name;
                var opcActual = null;
                
                //recupero dinámicamente una referencia al último radio pulsado de este grupo
                opcActual = eval(svarOpcAct);  

                if(opcActual == opcPulsada){
                    //deselecciono
                    opcPulsada.checked = false; 
                    
                    //y quito referencia (es como si nunca se hubiera pulsado)
                    asignaVar(svarOpcAct, "null");  
                }
                else{
                    //Anoto la última opción pulsada de este grupo
                    asignaVar(svarOpcAct, "document.getElementById('" + opcPulsada.id + "')");  
                }
            }
        </script>

        <?php //include(RUTA_APP . "/vistas/footer/footer.php");
    // }
    // else{
    //     header("location:" . RUTA_URL. "/Login_C/index/SinID_Noticia,SinBandera");
    // }   ?>

@endsection()     
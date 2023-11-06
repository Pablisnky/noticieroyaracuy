@extends('layouts.header_SoloEstilos')

@section('titulo', 'Panel agregar efemerides')

@section('contenido')

    <!-- CDN libreria JQuery, necesaria para la previsualización de la imagen--> 
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

    <!-- CDN CALENDARIO -->
    <link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
    <link rel="stylesheet" href="/resources/demos/style.css">
    <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

    <!-- MENU LATERAL -->
    @include('panel/periodistas/periodistaMenu_V')

    <div style="margin-left: 20%;">
        <fieldset class="fieldset_1" id="Portada"> 
            <legend class="legend_1">Agregar Efemerides</legend>
                <form action="{{ route('RecibeEfemerideAgregada') }}" method="POST" enctype="multipart/form-data" autocomplete="off" onsubmit="return validarAgregarEfemride()">
                    @csrf
                    <div style="display: flex; margin-bottom: 30px">   
                        <div class="width: 30%">    
                            <!-- IMAGN -->
                            <div>
                                <label class="cont_panel--label">Imagen principal</label>
                                <label class="Default_pointer" for="imgInp">    
                                <figure>
                                    <img class="cont_panel--imagen" alt="Fotografia Principal" id="blah" src="<?php //echo RUTA_URL?>/public/images/imagen.png"/>
                                </figure>
                                <input class="Default_ocultar" type="file" accept=".jpeg,.jpg,.png,.gif,.webp"  name="imagenEfemeride" id="imgInp"/>
                            </div>
                        </div>
                        <div style="width: 100%; padding-left: 1%">
                            <!-- TITULO -->
                            <label class="cont_panel--label">Titulo</label>
                            <input class="cont_panel--titulo" type="text" name="titulo"/>

                            <!-- CONTENIDO -->
                            <label class="cont_panel--label">Contenido</label>
                            <textarea class="cont_panel--textarea" name="contenido" id="Contenido" autosize="none"></textarea> 
                                                        
                            <!-- FECHA -->
                            <label class="cont_panel--label">Fecha</label>
                            <input class="cont_panel--select" type="text" name="fecha" id="datepicker">
                            
                        </div>                     
                    </div>
                    <div class=""> 
                        <input class="boton" type="submit" id="Boton_Agregar" value="Agregar efemerides"/>  
                    </div>
                </form>
        </fieldset>
    </div>

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/E_AgregarEfemeride.js?v=' . rand()) }}"></script> 
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
            var id_Label = $('#blah');
            readImage(this, id_Label);
        });
    </script>

    {{-- @include('layouts/footer') --}}

@endsection()

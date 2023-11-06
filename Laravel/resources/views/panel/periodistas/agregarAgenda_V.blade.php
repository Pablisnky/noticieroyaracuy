@extends('layouts.header_SoloEstilos')

@section('titulo', 'Panel agregar agenda')

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


    <div class="cont_panel--main">
        <form action="{{ route('RecibeAgendaAgregada') }}" method="POST" enctype="multipart/form-data" autocomplete="off" onsubmit="return validarRegistroAgenda()">
            @csrf
            <fieldset class="fieldset_1" id="Portada"> 
                <legend class="legend_1">Agregar Agenda</legend>
                    <div class="cont_panel--actualizar--media">    

                        <!-- IMAGN -->
                        <div class="cont_panel--agregarublicidad">   
                            <label for="imgInp"class="Default_pointer">
                                <figure>
                                    <img class="cont_panel--imagen"  alt="Fotografia Principal" id="blah" src="{{ asset('/images/imagen.png') }}"/> 
                                </figure>
                            </label>
                            <!-- <span class="material-icons-outlined span_18">edit</span> -->
                            <input class="Default_ocultar" type="file" accept=".jpeg,.jpg,.png,.gif,.webp"  name="imagenAgenda" id="imgInp"/>
                        </div>    
                            
                        <div>
                            <label>Fecha caducidad</label>
                            <input class="cont_panel--select" type="text" name="caducidad" id="datepicker">
                        </div>     
                    </div>

                    <!-- BOTON DE ENVIO Y DATOS OCULTOS -->
                    <div> 
                        <input class="boton" type="submit" id="Boton_Agregar" value="Agregar agenda"/>  
                    </div>
            </fieldset>
        </form>
    </div>

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    <script src="{{ asset('/js/E_AgregarAgenda.js?v=' . rand()) }}"></script> 
    <script src="{{ asset('/js/funcion_Calendario.js?v=' . rand()) }}"></script>

    <script>       
        //Da una vista previa de la foto del evento 
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
            // Código a ejecutar cuando se detecta un cambio de imagen
            var id_Label = $('#blah');
            readImage(this, id_Label);
        });
    </script>

    {{-- @include('layouts/footer') --}}

@endsection()
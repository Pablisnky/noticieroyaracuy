@extends('layouts.partiers.header_suscriptor')

@section('titulo', 'Panel obras')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/suscriptores/suscrip_menu_V')
    
    <section class="cont_suscrip_productos">
        <div class="cont_suscrip_productos--membrete">

            <!-- TITULO PAGINA -->
            <h2 class="h2_9">Portafolio de obras</h2>
            
            <!-- ICONO AGREGAR -->
            <a href="<?php //echo RUTA_URL?>/Panel_Artista_C/CargarObras/<?php //echo $Datos['ID_Suscriptor'];?>" rel="noopener noreferrer"><img class="cont_suscrip_productos--membrete--icono  Default_pointer" src="{{ asset('/iconos/agregar/outline_add_circle_outline_black_24dp.png') }}"/></a> 
        </div>

        <div class="contenedor_13 cont_suscrip_productos-13"> 
            @php($Contador = 1)
            @foreach($obras as $Arr) 
                <div class="contenedor_95 contenedor_95--producto borde_1" id="{{'Cont_Producto_' . $Contador }}">
                    <!-- IMAGEN OBRA -->
                    <div class="contenedor_9 contenedor_9--pointer">
                        <div class="contenedor_142" style="background-image: url('{{ asset('/images/galeria/' .  session('id_suscriptor') . '_' . $datosArtista->nombreSuscriptor . '_' . $datosArtista->apellidoSuscriptor . '/' . $Arr->imagenObra) }}')">
                        <input class="input_14 borde_1" type="text" value="{{ $Contador }}"/>
                        </div>
                    </div>

                    <!-- NOMBRE OBRA -->
                    <div id="<?php //echo 'ContenedorProducto_' . $Contador?>">
                        <label class="input_8 input_8D" id="{{ 'EtiquetaProducto_' . $Contador }}">{{ $Arr->nombreObra }}</label>

                        <!-- PRECIO EN DOLARES-->
                        <label class="input_8 " id="{{ 'EtiquetaPrecio_' . $Contador }}">$. {{ $Arr->precioDolarObra }}</label>

                        <!-- PRECIO EN BOLIVARES-->
                        <label class="input_8" id="{{ 'EtiquetaPrecio_' . $Contador }}" > Bs. {{ $Arr->precioBsObra }}</label>
                        
                        <!-- TECNICA-->
                        <label class="input_8" id="{{ 'EtiquetaPrecio_' . $Contador }}" >{{ $Arr->tecnicaObra }}</label>

                        <!-- COLECCION-->
                        <label class="input_8" id="{{ 'EtiquetaPrecio_' . $Contador }}" >{{ $Arr->coleccionObra }}</label>

                        <!-- ACTUALIZAR - ELIMINAR -->
                        <div class="contenedor_96" id="<?php //echo $Arr['ID_Obra']?>">                
                            <a class="a_9" href="<?php //echo RUTA_URL?>/Panel_Artista_C/actualizarObra/<?php //echo $Arr['ID_Obra'];?>">Actualizar</a>
                            
                            <label style="color: blue;" class="Default_pointer" onclick = "EliminarObra('<?php //echo $Arr['ID_Obra'];?>')">Eliminar</label>
                        </div>
                    </div>
                </div>
            @php($Contador ++)   
            @endforeach 
        </div>

        <!-- Muestra respuesta de servidor al eliminar un producto, (es solo para debuggear) -->
        <!-- <div id="ReadOnly"></div> -->
    </section>
       
    <script src="{{ asset('/js/funcionesVarias.js?v=' . rand()) }}"></script>
    <script src="{{ asset('/js/E_suscrip_obras.js?v=' . rand()) }}"></script>
    <script src="{{ asset('/js/A_suscip_obras.js?v=' . rand()) }}"></script>

@endsection()  
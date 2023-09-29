@extends('layouts.partiers.header_suscriptor')

@section('titulo', 'Panel marketplace')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/suscriptores/suscrip_menu_V')

    <?php     
    //se invoca sesion con el ID_Suscriptor creada en validarSesion.php para autentificar la entrada a la vista
    // if(!empty($_SESSION["ID_Suscriptor"])){
        // $ID_Suscriptor = $_SESSION["ID_Suscriptor"];  
        ?>
        
        <section class="cont_suscrip_productos">
            <div class="cont_suscrip_productos--membrete">
                <h2 class="h2_9">Anuncios clasificados</h2>
                
                <!-- ICONO AGREGAR -->
                <a href="{{ route('PublicarProducto', ['id_suscriptor' => session('id_suscriptor')]) }}" rel="noopener noreferrer"><img class="cont_suscrip_productos--membrete--icono  Default_pointer" src="{{ asset('/iconos/agregar/outline_add_circle_outline_black_24dp.png') }}"/></a> 
            </div>

            <div class="contenedor_13 cont_suscrip_productos-13"> 
                @php($Contador = 1)
        
                @foreach($productos as $arr)
                {{-- 
                //     $PrecioBolivar = number_format($arr["precioBolivar"], "2", ",", ".");
                //     $PrecioDolar = number_format($arr["precioDolar"], "2", ",", "."); --}}

                    <div class="contenedor_95 contenedor_95--producto borde_1" id="{{ 'Cont_Producto_' . $Contador }}">
                    
                        <!-- IMAGEN PRINCIPAL -->
                        <div class="contenedor_9 contenedor_9--pointer">
                            <div class="contenedor_142" style="background-image: url('{{ asset('/images/clasificados/' . session('id_suscriptor') . '/productos/' . $arr->nombre_img) }}')">
                            <input class="input_14 borde_1" type="text" value="{{ $Contador }}"/>
                            </div>
                        </div>

                        <!-- PRODUCTO -->
                        <div id="{{ 'ContenedorProducto_' . $Contador }}">
                            <label class="input_8 input_8D" id="{{ 'EtiquetaProducto_' . $Contador }}">{{ $arr->producto }}</label>

                            <!-- OPCION -->                        
                            <label class="input_8 input_8C" id="{{ 'EtiquetaOpcion_' . $Contador }}" >{{ $arr->opcion }}</label>

                            <!-- UNIDADES EN EXISTNCIA -->   
                            @if($arr->cantidad == 1)                 
                                <label class="input_8 input_8C" id="{{ 'EtiquetaOpcion_' . $Contador }}" >Existencia: {{ $arr->cantidad }} Ud.</label> 
                            @elseif($arr->cantidad > 1)
                                <label class="input_8 input_8C" id="{{ 'EtiquetaOpcion_' . $Contador }}" >Existencia: {{ $arr->cantidad }} Uds.</label> 
                            @else
                                <label class="input_8 input_8C" id="{{ 'EtiquetaOpcion_' . $Contador }}" >Existencia: Agotado</label>
                            @endif

                            <!-- PRECIO -->
                            <label class="input_8 " id="{{ 'EtiquetaPrecio_' . $Contador }}">Bs. {{ number_format($arr->precioBolivar, "2", ",", ".") }}</label>

                            <label class="input_8" id="{{ 'EtiquetaPrecio_' . $Contador }}" > $ {{ number_format($arr->precioDolar, "2", ",", ".") }}</label>

                            <!-- ACTUALIZAR - ELIMINAR -->
                            <div class="contenedor_96" id="{{ $arr->ID_Producto }}">                
                                <a class="a_9" href="{{ route('ActualizarProducto', ['id_producto' => $arr->ID_Producto, 'opcion' => $arr->opcion]) }}">Actualizar</a>
                                
                                <label style="color: blue;" class="Default_pointer" onclick = "EliminarProducto('<?php //echo $ID_Producto;?>','<?php //echo $ID_Opcion?>')">Eliminar</label>
                            </div>
                        </div>
                    </div>
                @php($Contador ++)   
                @endforeach 
            </div>

            <!-- Muestra respuesta de servidor al eliminar un producto, (es solo para debuggear) -->
            <!-- <div id="Borrar"></div> -->
        </section>
        
        <script src="{{ asset('/js/funcionesVarias.js?v=' . rand()) }}"></script>
        <script src="{{ asset('/js/E_suscrip_producto.js?v=' . rand()) }}"></script>
        <script src="{{ asset('/js/A_Suscip_producto.js?v=' . rand()) }}"></script>

        <?php
    // }
    // else{
    //     header("location:" . RUTA_URL. "/Inicio_C");
    // }   ?>

@endsection()  
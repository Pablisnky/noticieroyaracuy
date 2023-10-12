@extends('layouts.partiers.header_PanelPortada')

@section('titulo', 'Panel inventario')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/comerciantes/comerciante_menu_V')

    <?php     
    //se invoca sesion con el ID_Suscriptor creada en validarSesion.php para autentificar la entrada a la vista
    // if(!empty($_SESSION["ID_Suscriptor"])){  
        ?>
        
        <section class="cont_suscrip_productos">
            <div class="cont_suscrip_productos--membrete">
                <h2 class="h2_9">Productos en inventaro</h2>
            </div>

            <div class="contenedor_13 cont_suscrip_productos-13" id="ContenedorPrincipal"> 
                @php($Contador = 1)        
                @foreach($productos as $arr)
                    <div class="contenedor_95 contenedor_95--producto borde_1" id="{{ 'Cont_Producto_' . $Contador }}">
                    
                        <!-- IMAGEN PRINCIPAL -->
                        <div class="contenedor_9 contenedor_9--pointer">                            <div class="contenedor_142" style="background-image: url('{{ asset('/images/clasificados/' . session('id_comerciante') . '/productos/' . $arr->nombre_img) }}')">
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

                            <div class="contenedor_96" id="{{ $arr->ID_Producto }}"> 

                                <!-- ACTUALIZAR -->               
                                <a class="a_9" href="{{ route('ActualizarProducto', ['id_producto' => $arr->ID_Producto, 'opcion' => $arr->opcion]) }}">Actualizar</a>
                                
                                <!-- ELIMINAR -->
                                <label style="margin-left: 50px; color: blue;" class="Default_pointer" onclick="EliminarProducto('{{$arr->ID_Producto }}','{{ route('EliminarProducto', ['id_producto' => $arr->ID_Producto, 'id_opcion' => $arr->ID_Opcion]) }}')">Eliminar</label>
                            </div>
                        </div>
                    </div>
                @php($Contador ++)   
                @endforeach 
            </div>

            <!-- Muestra respuesta de servidor al eliminar un producto, (es solo para debuggear) -->
            {{-- <div id="ReadOnly"></div> --}}
        </section>
        
        <script src="{{ asset('/js/funcionesVarias.js?v=' . rand()) }}"></script>
        <script src="{{ asset('/js/E_Comerciante_Inicio.js?v=' . rand()) }}"></script>
        <script src="{{ asset('/js/A_Comerciante_Inicio.js?v=' . rand()) }}"></script>

        <?php
    // }
    // else{
    //     header("location:" . RUTA_URL. "/Inicio_C");
    // }   ?>

@endsection()  
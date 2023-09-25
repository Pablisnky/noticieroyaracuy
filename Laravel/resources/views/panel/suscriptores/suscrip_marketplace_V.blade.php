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
                <a href="<?php //echo RUTA_URL?>/Panel_Clasificados_C/Publicar/<?php //echo $ID_Suscriptor;?>" rel="noopener noreferrer"><img class="cont_suscrip_productos--membrete--icono  Default_pointer" src="<?php //echo RUTA_URL . '/public/iconos/agregar/outline_add_circle_outline_black_24dp.png';?>"/></a> 
            </div>

            <div class="contenedor_13 cont_suscrip_productos-13"> 
                <?php 
                // $Contador = 1; 
        
                // foreach($Datos['productos'] as $arr) :
                //     $Producto = $arr["producto"]; 
                //     $Opcion = $arr["opcion"];
                //     //Se cambia el formato del precio, viene sin separador de miles
                //     $PrecioBolivar = number_format($arr["precioBolivar"], "2", ",", ".");
                //     //Se cambia el formato del precio, viene sin separador de miles
                //     $PrecioDolar = number_format($arr["precioDolar"], "2", ",", ".");
                //     $Existencia = $arr["cantidad"];
                //     $ID_Producto = $arr["ID_Producto"];
                //     $ID_Opcion = $arr["ID_Opcion"];
                //     $FotoPrincipal = $arr['nombre_img'];

                    ?>              
                    <div class="contenedor_95 contenedor_95--producto borde_1" id="<?php //echo 'Cont_Producto_' . $Contador;?>">
                    
                        <!-- IMAGEN PRINCIPAL -->
                        <div class="contenedor_9 contenedor_9--pointer">
                            <div class="contenedor_142" style="background-image: url('<?php //echo RUTA_URL?>/public/images/clasificados/<?php //echo $_SESSION['ID_Suscriptor'];?>/productos/<?php //echo $FotoPrincipal;?>')">
                            <input class="input_14 borde_1" type="text" value="<?php //echo $Contador;?>"/>
                            </div>
                        </div>

                        <!-- PRODUCTO -->
                        <div id="<?php //echo 'ContenedorProducto_' . $Contador?>">
                            <label class="input_8 input_8D" id="<?php //echo 'EtiquetaProducto_' . $Contador;?>"><?php //echo $Producto;?></label>

                            <!-- OPCION -->                        
                            <label class="input_8 input_8C" id="<?php //echo 'EtiquetaOpcion_' . $Contador;?>" ><?php //echo $Opcion;?></label>

                            <!-- UNIDADES EN EXISTNCIA -->    
                            <?php
                            // if($Existencia == 1){  ?>                   
                                <label class="input_8 input_8C" id="<?php //echo 'EtiquetaOpcion_' . $Contador;?>" >Existencia: <?php //echo $Existencia;?> Ud.</label> <?php
                            // }
                            // elseif($Existencia > 1){   ?>
                                <label class="input_8 input_8C" id="<?php //echo 'EtiquetaOpcion_' . $Contador;?>" >Existencia: <?php //echo $Existencia;?> Uds.</label> <?php
                            // }
                            // else{  ?>
                                <label class="input_8 input_8C" id="<?php //echo 'EtiquetaOpcion_' . $Contador;?>" >Existencia: Agotado</label>
                                <?php
                            // }  ?>

                            <!-- PRECIO -->
                            <label class="input_8 " id="<?php //echo 'EtiquetaPrecio_' . $Contador;?>">Bs.<?php //echo $PrecioBolivar;?></label>

                            <label class="input_8" id="<?php //echo 'EtiquetaPrecio_' . $ContadorLabel;?>" > $ <?php //echo $PrecioDolar;?></label>

                            <!-- ACTUALIZAR - ELIMINAR -->
                            <div class="contenedor_96" id="<?php //echo $ID_Producto?>">                
                                <a class="a_9" href="<?php //echo RUTA_URL?>/Panel_Clasificados_C/actualizarProducto/<?php //echo $ID_Producto;?>,<?php //echo $Opcion;?>">Actualizar</a>
                                
                                <label style="color: blue;" class="Default_pointer" onclick = "EliminarProducto('<?php //echo $ID_Producto;?>','<?php //echo $ID_Opcion?>')">Eliminar</label>
                            </div>
                        </div>
                    </div>
                    <?php 
                //     $Contador ++;   
                // endforeach;     ?>  
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
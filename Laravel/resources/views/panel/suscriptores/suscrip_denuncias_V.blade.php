@extends('layouts.partiers.header_suscriptor')

@section('titulo', 'Panel denuncias')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/suscriptores/suscrip_menu_V')

    <?php     
    //se invoca sesion con el ID_Suscriptor creada en validarSesion.php para autentificar la entrada a la vista
    // if(!empty($_SESSION["ID_Suscriptor"])){ 

        // MENU LATERAL 
        // require(RUTA_APP . '/vistas/suscriptores/panel_suscrip_V.php'); ?>

        <section class="cont_suscrip_productos">
            <div class="cont_suscrip_productos--membrete">
                <h2 class="h2_9">Quejas y reclamos</h2>
                
                <!-- ICONO AGREGAR -->
                <a href="<?php //echo RUTA_URL?>/Panel_Denuncias_C/denuncias/<?php //echo $_SESSION["ID_Suscriptor"];?>" rel="noopener noreferrer"><img class="cont_suscrip_productos--membrete--icono  Default_pointer" src="<?php //echo RUTA_URL . '/public/iconos/agregar/outline_add_circle_outline_black_24dp.png';?>"/></a> 
            </div>

            <?php
            // if($denuncias != Array()){ ?>
                <div class="contenedor_13 cont_suscrip_productos-13"> 
                    <?php 
                    // $Contador = 1; 
            
                    // foreach($Datos['denuncias'] as $Arr) :
                    //     $ID_Denuncia = $Arr['ID_Denuncia'];
                    //     $Denuncia = $Arr["descripcionDenuncia"]; 
                    //     $Ubicacion = $Arr["ubicacionDenuncia"];
                    //     $Municipio = $Arr["municipioDenuncia"];
                    //     $Solucionado = $Arr["solucionado"];
                    //     $Fecha = $Arr["fecha_denuncia"];
                        
                        ?>              
                        <div class="contenedor_95 contenedor_95--producto borde_1" id="<?php //echo 'Cont_Producto_' . $Contador;?>">
                        
                            <!-- IMAGEN PRINCIPAL -->
                            <?php
                            // foreach($Datos['denunciasImagenes'] as $Row) :  
                                // if($ID_Denuncia == $Row['ID_Denuncia']){ ?>
                                    <div class="contenedor_9 contenedor_9--pointer">
                                        <div class="contenedor_142" style="background-image: url('<?php //echo RUTA_URL?>/public/images/denuncias/<?php //echo $Row["nombre_imgDenuncia"];?>')">
                                        <input class="input_14 borde_1" type="text" value="<?php //echo $Contador;?>"/>
                                        </div>
                                    </div>
                                    <?php
                            //     }
                            // endforeach;     ?>

                            <!-- DESCRIPCION DENUNCIA -->
                            <div id="<?php //echo 'ContenedorProducto_' . $Contador?>">
                                <label class="input_8 input_8D" id="<?php //echo 'EtiquetaProducto_' . $Contador;?>"><?php //echo $Denuncia;?></label>

                                <!-- UBICACION -->                        
                                <label class="input_8 input_8C" id="<?php //echo 'EtiquetaOpcion_' . $Contador;?>"><?php //echo $Ubicacion;?></label>

                                <!-- MUNICIPIO -->
                                <label class="input_8 " id="<?php //echo 'EtiquetaPrecio_' . $Contador;?>"><?php //echo $Municipio;?></label>

                                <!-- SOLUCIONADO -->
                                <?php
                                // if($Solucionado == 1){   ?>
                                    <label class="input_8">Solucionado</label>
                                    <?php
                                // }
                                // else{   ?>
                                    <label class="input_8">No solucionado</label>
                                    <?php
                                // }   ?>
                                
                                <!-- FECHA -->
                                <label class="input_8" id="<?php //echo 'EtiquetaPrecio_' . $ContadorLabel;?>"><?php //echo $Fecha;?></label>

                                <!-- ACTUALIZAR - ELIMINAR -->
                                <div class="contenedor_96" id="<?php //echo $ID_Denuncia?>">                
                                    <a class="a_9" href="<?php //echo RUTA_URL?>/Panel_Denuncias_C/actualizarDenuncia/<?php //echo $ID_Denuncia;?>">Actualizar</a>
                                    
                                    <label style="color: blue;" class="Default_pointer" onclick = "EliminarDenuncia('<?php //echo $ID_Denuncia;?>')">Eliminar</label>
                                </div>
                            </div>
                        </div>
                        <?php 
                        // $Contador ++;   
                    // endforeach;     ?>  
                </div>

                <!-- Muestra respuesta de servidor al eliminar una denuncia, (es solo para debuggear) -->
                <!-- <div id="ReadOnly"></div> -->
                <?php
            // }
            // else{   ?> 
                {{-- <p class="cont_panel--NoNoticia bandaAlerta">No has reportado problemas en la comunidad</p>  --}}
                <?php
            // }   ?>
        </section>
        
        <script src="{{ asset('/js/funcionesVarias.js?v=' . rand()) }}"></script>
        <script src="{{ asset('/js/E_suscrip_denuncias.js?v=' . rand()) }}"></script>
        <script src="{{ asset('/js/A_Suscip_denuncia.js?v=' . rand()) }}"></script>

        <?php
    // }
    // else{
    //     header("location:" . RUTA_URL. "/Inicio_C");
    // }   ?>

@endsection()     
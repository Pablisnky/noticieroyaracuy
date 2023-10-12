@extends('layouts.partiers.header_Noticia')

@section('titulo', 'MarketPlace categorias')

@section('contenido')

    <!-- CDN iconos de font-awesome-->
    <link rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'/>

    <div class="contenedor_4">
        
        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Arte';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>ARTE LITERATURA</h2>
                <i class="fas fa-pen-nib icono_2"></i>      
                <div class="contenedor_106">
                    <span class="span_21 borde_1 arte_js">
                        @foreach($cantidadTiendasCategoria as $arr)
                            @if($arr->categoriaComerciante == 'Arte') 
                                @php($CantidaArte = $arr->cantidad)
                                <style>
                                    .arte_js{
                                        background-color: var(--Aciertos);
                                    }
                                </style> 
                            @endif
                        @endforeach
                        @if(!isset($CantidaArte))                           
                            <label>0</label>         
                            <style>
                                .arte_js{         
                                    background-color: var(--Fallos);
                                }
                            </style>  
                        @endif
                    </span>
                </div>     
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Bodega';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>BODEGAS</h2>
                <i class="fas fa-store icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 bodega_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Bodega') 
                                    @php($CantidaBodega = $arr->cantidad)
                                    <style>
                                        .bodega_js{
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidaBodega))                                
                                <label>0</label>
                                <style>
                                    .bodega_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>   
            </div>
        </a>
        
        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/ComidaRapida';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>COMIDA RAPIDA</h2>
                <i class="fas fa-drumstick-bite icono_2"></i>            
                <div class="contenedor_106">
                    <span class="span_21 borde_1 comida_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'ComidaRapida') 
                                    @php($CantidadMascota = $arr->cantidad)
                                    <style>
                                        .comida_js{
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadMascota))                               
                                <label>0</label> 
                                <style>
                                    .comida_js{         
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div> 
            </div> 
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Cosmeticos';?>" rel="noopener noreferrer">    
            <div>
                <h2 class='h2_1'>COSMETICOS</h2>  
                <i class="fas fa-female icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 cosmetico_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Cosmeticos') 
                                    @php($CantidadCosmetico = $arr->cantidad)
                                    <style>
                                        .cosmetico_js{
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadCosmetico))                              
                                <label>0</label>   
                                <style>
                                    .cosmetico_js{         
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>  
            </div> 
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Mascotas';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>MASCOTAS</h2>
                <i class="fas fa-cat icono_2"></i>                
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Mascotas') 
                                    @php($CantidadMascota = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadMascota))                              
                                <label>0</label>                                     
                                <style>
                                    .mascota_js{         
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div> 
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/RepuestoAutomotriz';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>REPUESTO AUTOMOTRIZ</h2>
                <i class="fas fa-car-crash icono_2"></i>                
                <div class="contenedor_106">
                    <span class="span_21 borde_1 repuesto_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'RepuestoAutomotriz') 
                                    @php($CantidadRepuesto = $arr->cantidad)
                                    <style>
                                        .repuesto_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadRepuesto))                              
                                <label>0</label>                                        
                                <style>
                                    .repuesto_js{         
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div> 
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/MaterialMedicoQuirurgico';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>MATERIAL MÉDICO</h2>
                <i class="fas fa-hospital icono_2"></i>              
                <div class="contenedor_106">
                    <span class="span_21 borde_1 materialQuirurgco_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'MaterialMedicoQuirurgico') 
                                    @php($CantidadMateerialQuirurgico = $arr->cantidad)
                                    <style>
                                        .materialQuirurgco_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadMateerialQuirurgico))                                  
                                <label>0</label>                                    
                                <style>
                                    .materialQuirurgco_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>     
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Caramelos';?>" rel="noopener noreferrer">    
            <div>
                <h2 class='h2_1'>CHOCOLATES CARAMELOS</h2>
                <i class="fas fa-candy-cane icono_2"></i>         
                <div class="contenedor_106">
                    <span class="span_21 borde_1 caramelos_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Caramelos') 
                                    @php($CantidadCaramelos = $arr->cantidad)
                                    <style>
                                        .caramelos_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadCaramelos))                                    
                                <label>0</label>                                  
                                <style>
                                    .caramelos_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>     
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Merceria';?>" rel="noopener noreferrer">    
            <div>
                <h2 class='h2_1'>MERCERÍA TALABARTERÍA</h2>
                <i class="fas fa-hat-cowboy-side icono_2"></i>      
                <div class="contenedor_106">
                    <span class="span_21 borde_1 merceria_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Merceria') 
                                    @php($CantidadMerceria = $arr->cantidad)
                                    <style>
                                        .merceria_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadMerceria))                                
                                <label>0</label>                                      
                                <style>
                                    .merceria_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div> 
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Frutas';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>FRUTAS VERDURAS</h2>
                <i class="fas fa-carrot icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 frutas_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Frutas') 
                                    @php($CantidadFrutas = $arr->cantidad)
                                    <style>
                                        .frutas_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadFrutas))                          
                                <label>0</label>                                               
                                <style>
                                    .frutas_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>     
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Minimarket';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>MINIMARKET</h2>
                <i class="fas fa-shopping-basket icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 minimarket_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Minimarket') 
                                    @php($CantidadMinimarket = $arr->cantidad)                        
                                    {{ $CantidadMinimarket }} 
                                    <style>
                                        .minimarket_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadMinimarket))                          
                                <label>0</label>                         
                                <style>
                                    .minimarket_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>  
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="{{ route('TiendasCategoria', ['nombreCategoria' => 'Ropa']) }}" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>ROPA ZAPATO</h2>
                <i class="fas fa-tshirt icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 ropa_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Ropa') 
                                    @php($CantidadRopa = $arr->cantidad)
                                    {{ $CantidadRopa }}
                                    <style>
                                        .ropa_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadRopa))                                
                                <label>0</label>                                      
                                <style>
                                    .ropa_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>  
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Farmacia';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>FARMACIA SALUD</h2>
                <i class="fas fa-medkit icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 farmacia_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Farmacia') 
                                    @php($CantidadFarmacia = $arr->cantidad)
                                    <style>
                                        .farmacia_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadFarmacia))                               
                                <label>0</label>                                       
                                <style>
                                    .farmacia_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>       
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Ferreteria';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>FERRETRÍA HOGAR</h2>
                <i class="fas fa-screwdriver icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 ferreteria_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Ferreteria') 
                                    @php($CantidadFerreteria = $arr->cantidad)
                                    <style>
                                        .ferreteria_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadFerreteria))                                
                                <label>0</label>                                      
                                <style>
                                    .ferreteria_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>     
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Panaderia';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>PANADERÍA PASTELERÍA</h2>
                <i class="fas fa-birthday-cake icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 panaderia_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Panaderia') 
                                    @php($CantidadPanaderia = $arr->cantidad) 
                                    <style>
                                        .panaderia_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadPanaderia))                               
                                <label>0</label>                                       
                                <style>
                                    .panaderia_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>       
            </div> 
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Licoreria';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>LICORES</h2>
                <i class="fas fa-wine-bottle icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 licores_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Licoreria') 
                                    @php($CantidadLicoreria = $arr->cantidad)
                                    <style>
                                        .licores_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadLicoreria))                                  
                                <label>0</label>                                    
                                <style>
                                    .licores_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>          
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/JoyasRelojeria';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>JOYAS RELOJERÍA</h2>
                <i class="fas fa-gem icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 joyas_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'JoyasRelojeria') 
                                    @php($CantidadJoyas = $arr->cantidad)
                                    <style>
                                        .joyas_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadJoyas))                                  
                                <label>0</label>                                    
                                <style>
                                    .joyas_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>       
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Deportes';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>DEPORTES</h2>
                <i class="fas fa-biking icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 deporte_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Deportes') 
                                    @php($CantidadDeportes = $arr->cantidad)
                                    <style>
                                        .deporte_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDeportes))                               
                                <label>0</label>                                       
                                <style>
                                    .deporte_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>    
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Floristeria';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>FLORISTERÍA DECORACIÓN</h2>
                <i class="fas fa-leaf icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 floristeria_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Floristeria') 
                                    @php($CantidadFloristeria = $arr->cantidad)
                                    <style>
                                        .floristeria_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadFloristeria))                              
                                <label>0</label>                                        
                                <style>
                                    .floristeria_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>         
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Construccion';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>CONSTRUCCIÓN</h2>
                <i class="fas fa-hard-hat icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 construccion_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Construccion') 
                                    @php($CantidadConstruccion = $arr->cantidad)
                                    <style>
                                        .construccion_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadConstruccion))                                    
                                <label>0</label>                                  
                                <style>
                                    .construccion_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>   
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Telefonos';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>TELEFONOS COMPUTADORAS</h2>
                <i class="fas fa-mobile-alt icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 telefono_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Telefonos') 
                                    @php($CantidadTelefonos = $arr->cantidad)
                                    <style>
                                        .telefono_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadTelefonos))                                  
                                <label>0</label>                                    
                                <style>
                                    .telefono_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>  
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Papeleria';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>PAPELERÍA OFICINA</h2>
                <i class="fas fa-paperclip icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 papeleria_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Papeleria') 
                                    @php($CantidadPapeleria = $arr->cantidad)
                                    <style>
                                        .papeleria_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadPapeleria))                              
                                <label>0</label>                                        
                                <style>
                                    .papeleria_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div>   
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="{{ route('TiendasCategoria', ['nombreCategoria' => 'Juguetes'])}}" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>JUGUETES</h2>
                <i class="fas fa-gamepad icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 juguetes_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Juguetes') 
                                    @php($CantidadJuguetes = $arr->cantidad)
                                    <style>
                                        .juguetes_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadJuguetes))                                      
                                <label>0</label>                                
                                <style>
                                    .juguetes_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div> 
            </div>
        </a>

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/Suscriptor_C/categoria/Papeleria';?>" rel="noopener noreferrer">
            <div>
                <h2 class='h2_1'>LIBRERÍAS Y MÚSICA</h2>
                <i class="fas fa-book icono_2"></i>    
                <div class="contenedor_106">
                    <span class="span_21 borde_1 papeleria_js">
                            @foreach($cantidadTiendasCategoria as $arr)
                                @if($arr->categoriaComerciante == 'Papeleria') 
                                    @php($CantidadPapeleria = $arr->cantidad)
                                    <style>
                                        .papeleria_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadPapeleria))                                        
                                <style>
                                    .papeleria_js{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif
                    </span>
                </div> 
            </div>
        </a>
    </div>
        
    <!-- BOTONES DEL PANEL FRONTAL (solo en dispositivos moviles)-->	
    <div class="cont_boton--categoria ">                
        <div>
            <label class="boton boton--corto" style="width: 120%; margin: auto"><a class="Default_font--white boton_a" href="<?php //echo RUTA_URL . '/Clas@ificados_C/';?>" rel="noopener noreferrer">Ver todas las categorías</a></label> 
        </div>         
    </div>

    {{-- @include('layouts/partiers/footer') --}}

    <script src="<?php //echo RUTA_URL . '/public/javascript/funcionesVarias.js?v='. rand();?>"></script>
    
@endsection()

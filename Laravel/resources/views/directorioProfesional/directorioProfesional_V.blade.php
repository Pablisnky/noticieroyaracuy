@extends('layouts.header_Noticia')

@section('titulo', 'Directorio profesional')

@section('contenido')

    <header>
        <div class="cont_clasificados">    
            <div class="cont_clasificados--item-1 Default_quitarMovil">
                <h1 class="h1_1">Directorio profesional</h1> 
            </div>

            <!-- BUSCADOR -->
            <div style="display:flex; justify-content: space-around; align-items: center; margin-top: 5px; width: 100%; ">
                <div>
                    <input style="width: 110%;" class="login_cont--input borde--input" type="text" name="buscador" id="Buscador" placeholder="Buscar por nombre y apellido"/>
                </div>
                <div>
                    <img class="Default_pointer" style="width: 100%;" src="{{ asset('/iconos/refrescar/outline_refresh_black_24dp.png') }}" id="Refrescar"/>
                </div>
            </div>
            <div class="cont_clasificados--item-2">
                {{-- <a class="boton boton--publicar" href="{{ route('Categoria') }}" rel="noopener noreferrer">Categorias</a> --}}
                <a class="boton boton--publicar" href="{{ route('Registro') }}" rel="noopener noreferrer">Crear perfil</a>
            </div>
        </div>
    </header>
    <div class="cont_directorio--main">        
        <a class="contenedor_6 borde_1 Default_font--black" href="{{ route('Dir_Abogados', ['nombreCategoria' => 'Abogado']) }}" rel="noopener noreferrer">
            <h2 class='h2_1'>Abogado</h2>                
            <div class="cont_directorio">
                <div>
                    <img style="width: 7em;" src="{{ asset('/iconos/profesiones/abogado.png') }}"/>
                </div>
                <div class="contenedor_106">
                    <span class="span_21 borde_1 arte_js">
                        @foreach($cantidadProfesionales as $arr)
                            @if($arr->profesion == 'Abogado') 
                                @php($CantidaAbogado = $arr->cantidad)                         
                                <label>{{ $CantidaAbogado }}</label>    
                                <style>
                                    .arte_js{
                                        background-color: var(--Aciertos);
                                    }
                                </style> 
                            @endif
                        @endforeach
                        @if(!isset($CantidaAbogado))                           
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Bodega';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Carpiteros</h2>
            <div class="cont_directorio">
                <div>
                    <img style="width: 6em;" src="{{ asset('/iconos/profesiones/carpintero.png') }}"/> 
                </div>
                <div class="contenedor_106">
                    <span class="span_21 borde_1 bodega_js">
                        @foreach($cantidadProfesionales as $arr)
                            @if($arr->profesion == 'Carpintero') 
                                @php($CantidaCarpintero = $arr->cantidad)
                                <style>
                                    .bodega_js{
                                        background-color: var(--Aciertos);
                                    }
                                </style> 
                            @endif
                        @endforeach 
                        @if(!isset($CantidaCarpintero))                                
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
        
        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/ComidaRapida';?>" rel="noopener noreferrer">           
            <h2 class='h2_1'>Técnico Aire Acondicionado</h2>  
            <div class="cont_directorio">
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/aire_acondicionado.png') }}"/>         
                <div class="contenedor_106">
                    <span class="span_21 borde_1 comida_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'ComidaRapida') 
                                    @php($CantidadTecnicoAA = $arr->cantidad)
                                    <style>
                                        .comida_js{
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadTecnicoAA))                               
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

        <a class="contenedor_6 borde_1 Default_font--black" href="" rel="noopener noreferrer"> 
            <h2 class='h2_1'>Electricistas</h2>     
            <div class="cont_directorio">
                <img style="width: 5.5em;" src="{{ asset('/iconos/profesiones/electricista.png') }}"/> 
                <div class="contenedor_106">
                    <span class="span_21 borde_1 cosmetico_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Electricista') 
                                    @php($CantidadElectricista = $arr->cantidad)
                                    <style>
                                        .cosmetico_js{
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadElectricista))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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

        <a class="contenedor_6 borde_1 Default_font--black" href="<?php //echo RUTA_URL . '/SuscriptorController/categoria/Mascotas';?>" rel="noopener noreferrer">
            <h2 class='h2_1'>Doctores</h2>         
            <div class="cont_directorio">      
                <img style="width: 7em;" src="{{ asset('/iconos/profesiones/doctor.png') }}"/>   
                <div class="contenedor_106">
                    <span class="span_21 borde_1 mascota_js">
                            @foreach($cantidadProfesionales as $arr)
                                @if($arr->profesion == 'Doctor') 
                                    @php($CantidadDoctor = $arr->cantidad)
                                    <style>
                                        .mascota_js {
                                            background-color: var(--Aciertos);
                                        }
                                    </style> 
                                @endif
                            @endforeach 
                            @if(!isset($CantidadDoctor))                              
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
    </div>
        
    <!-- BOTONES DEL PANEL FRONTAL (solo en dispositivos moviles)-->	
    <div class="cont_boton--categoria ">                
        <div>
            <label class="boton boton--corto" style="width: 120%; margin: auto"><a class="Default_font--white boton_a" href="<?php //echo RUTA_URL . '/Clas@ificados_C/';?>" rel="noopener noreferrer">Ver todas las categorías</a></label> 
        </div>         
    </div>

    {{-- @include('layouts/footer') --}}

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    
@endsection()

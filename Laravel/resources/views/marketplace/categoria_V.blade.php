@extends('layouts.header_Noticia')

@section('titulo', 'MarketPlace categorias')

@section('contenido')

    <!-- CDN iconos de font-awesome-->
    <link rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'/>

    <header class="cont_clasificados">
        <div class="cont_clasificados--item-1 Default_quitarMovil">
            <h1 class="h1_1">Directorio Comercial</h1> 
        </div>

        <!-- BUSCADOR -->
        <div style="display:flex; justify-content: space-around; align-items: center; margin-top: 5px; width: 100%; ">
            <div>
                <input style="width: 110%;" class="login_cont--input borde--input" type="text" name="buscador" id="Buscador" placeholder="Buscar por nombre de tienda"/>
            </div>
            <div>
                <img class="Default_pointer" style="width: 100%;" src="{{ asset('/iconos/refrescar/outline_refresh_black_24dp.png') }}" id="Refrescar"/>
            </div>
        </div>
        <div class="cont_clasificados--item-2">
            <a class="boton boton--publicar" href="{{ route('Registro') }}" rel="noopener noreferrer">Crear Tienda</a>
        </div>
    </header>
   
    <div class="cont_directorio--main">
        @foreach($categorias as $Key)        
            <a class="cont_directorio--item borde_1 Default_font--black" href="{{ route('TiendasCategoria', ['nombreCategoria' => $Key->categoria]) }}" rel="noopener noreferrer">
                
                {{-- Se coloca nombre de la categoria, solo la primera palabra en casos de categorias largas --}}
                @php($Categoria = explode('_', $Key->categoria ))
                <h2 class='h2_1'>{{ $Categoria[0] }}</h2>

                <div class="cont_directorio--contenido">
                    <img class="cont_directorio--img" src="{{ asset('/iconos/marketplace/' . $Key->categoria . '.png') }}"/>
                    <div class="contenedor_106">
                        <span class="span_21 borde_1 ExisteTienda"> 
                            {{-- @foreach($tiendasProductos as $Arr) --}}
                                @foreach($cantidadTiendas as $arr)
                                    {{-- @break --}}
                                    @if($arr->categoriaComerciante == $Key->categoria)
                                        @php($TotalTiendas = $arr->cantidad)
                                        {{ $TotalTiendas }}
                                        <style>
                                            .ExisteTienda {
                                                background-color: var(--Aciertos);                                                
	                                            margin-left: -60%;                                             
	                                            margin-bottom: -70%;
                                            }
                                        </style> 
                                    @endif
                                @endforeach 
                            {{-- @endforeach --}}
                            {{-- @if(!isset($TotalTiendas))                          
                                <label>0</label>                                      
                                <style>
                                    .ExisteTienda{
                                        background-color: var(--Fallos);
                                    }
                                </style>   
                            @endif --}}
                        </span>
                    </div>
                </div>
            </a>
        @endforeach
    </div>












    {{-- <a class="contenedor_6 borde_1 Default_font--black" href="{{ route('TiendasCategoria', ['nombreCategoria' => 'Ropa']) }}" rel="noopener noreferrer">
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
        </div> --}}











        
    <!-- BOTONES DEL PANEL FRONTAL (solo en dispositivos moviles)-->	
    <div class="cont_boton--categoria ">                
        <div>
            <label class="boton boton--corto" style="width: 120%; margin: auto"><a class="Default_font--white boton_a" href="{{ route('Marketplace') }}" rel="noopener noreferrer">Ver marketplace</a></label> 
        </div>         
    </div>

    {{-- @include('layouts/footer') --}}

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
    
@endsection()

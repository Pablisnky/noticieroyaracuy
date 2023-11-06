@extends('layouts.header_SinMembrete')

@section('titulo', 'N.Y Post Instagram')

@section('contenido')

    <style>
        .iconoRegresar{
            width: 1em; 
            background-color: orange;
            position: absolute;
            top: 1%;
            left: 2%;
            border-radius: 50%;
            font-size: 2.8em !important;
        }
    </style>

    <main>
        <!-- ICONO CERRAR cont_modal--cerrar-->
        <a href='javascript: history.go(-1)'><img class="iconoRegresar" src="{{ asset('/iconos/flecha/outline_arrow_back_black_24dp.png') }}"/></a>

        {{-- ICONO CAPTURA DE PANTALLA --}}

        <section style="width: 30%; margin: auto" >


            <br style="margin-bottom: 10%">
            <div class="borde_3">
                <p class="cont_instagram--web">www.noticieroyaracuy.com</p>
                
                <!-- IMAGEN -->
                <div style="display: flex;"> 
                    <div style="flex-grow: 1; flex-shrink: 1;">         
                        <figure> 
                            <img class="imagen--portada--instagram section__img" alt="Fotografia Principal" src="{{ asset('/images/noticias/' . $imagenNoticia->nombre_imagenNoticia) }}"/>
                        </figure>
                    </div>

                    @if($noticia['municipio'] != 'Ambito estadal')
                        {{-- TEXTO MUNICIPIO VERTICAL --}}
                        <div  class="cont_portada--municipio--instagram">
                            <p class="cont_portada--municipio--p--instagram"><?php echo $noticia['municipio'];?> </p>
                            <p class="cont_portada--abreviatura--instagram">Mcpio.</p>
                        </div>
                    @else
                        {{-- TEXTO VERTICAL  --}}
                        <div  class="cont_portada--municipio--instagram">
                            <p class="cont_portada--municipio--p--instagram"><?php echo $noticia['municipio'];?> </p>
                        </div>
                    @endif
                    
                </div>

                <!-- FUENTE -->
                <small class="cont_portada_informacion--span--instagram">{{$noticia->fuente}}</small>

                <div class="cont_portada--tituloResumen--instagram">

                    <!-- TITULAR -->
                    <div class="cont_portada--titular""> 
                        <h2 class="titular--texto--instagram">{{$noticia->titulo}}</h2>
                    </div>
                </div>

                <div class="cont_instegram--pie">
                    <div>                        
                        <!-- FECHA -->    
                        <small class="cont_portada_informacion--span--instagram">{{ \Carbon\Carbon::parse(strtotime($noticia->fecha))->format('d-m-Y') }}</small>
                    </div>
                    <div>
                        <!-- SECCION -->
                        <p class="cont_portada--seccion--instagram">{{$noticia->seccion}} </p>
                    </div>
                </div> 
            </div>
        </section>
    </main>
@endsection()


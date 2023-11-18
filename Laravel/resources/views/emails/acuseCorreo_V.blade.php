<!DOCTYPE html>
<html lang="es">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1"/>
        <title>Recibo de compra</title>
        <style type="text/css">        
            body{margin: 0; padding: 0; min-width: 100% !important;} 
            p{font-size: 1rem;}        
            .p{width: 90%; margin: auto}    
            img{
                width: 100%; 
                height: 15rem; 
                object-fit: cover;
                border-top-right-radius: 15px;
                border-top-left-radius: 15px;
            }
            .borde_3{
                border-color: var(--BordeClaro);
                border-width: 1px;
                border-style: solid;
                border-radius: 15px
            }
            .cont_correo--p{
                font-size: 2em;
                text-decoration: none;
            }
            .cont_correo--a{
                font-size: 1.6em;
                text-decoration: none;
            }
            .cont_correo--div{
                width: 30%; 
                margin-top: 3%
            }
            .cont_correo--titular{
                text-align: justify;
                padding: 2%;
                font-weight: bold;
            }
            @media(max-width: 800px){/*medio con dimensiones menores a lo indicado*/
                h1{
                    font-size: 1.6em;
                }
                .cont_correo--p{
                    font-size: 1.6em;
                    text-decoration: none;
                }
                .cont_correo--a{
                    font-size: 1.2em;
                    text-decoration: none;
                }
                .cont_correo--div{
                    width: 90%; 
                    margin-top: 3%;
                }
            }
        </style>
    </head>
    <body>
        <p class="cont_correo--p">www.noticieroyaracuy.com</p>
        <p>Hemos publicado una nota de prensa que ha compartido con nosotros.</p>
        <a class="cont_correo--a" href="{{ route('DetalleNoticia', $Datos['id_noticia']) }}">Ver nota</a>
        
        <div class="borde_3 cont_correo--div">
            
            <!-- IMAGEN -->  
            <img alt="Fotografia Principal" src="{{ asset('/images/noticias/' . $Datos['imagen']) }}"/>

            <!-- FUENTE -->
            <small>{{ $Datos['fuente'] }}</small>

            <!-- TITULAR -->
            <p class="cont_correo--titular">{{ $Datos['titulo'] }}</p>

            <div class="cont_instegram--pie">
                <div>                        
                    <!-- FECHA -->    
                    {{-- <small class="">{{ \Carbon\Carbon::parse(strtotime($noticia->fecha))->format('d-m-Y') }}</small> --}}
                </div>
                <div>
                    <!-- SECCION -->
                    {{-- <p class="cont_portada--seccion--instagram">{{ $Datos['seccion'] }} </p> --}}
                </div>
            </div> 
        </div>  
    </body>
    </html>
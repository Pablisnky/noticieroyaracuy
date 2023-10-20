@extends('layouts.header_eventos')

@section('titulo', 'Eventos')

@section('contenido')
    <div class="cont_galeria--maain">
        
        <!-- TEXTO VERTICAL  -->
        <div>
            <h1 class="cont_agenda_h1 Default--textoVertical">Agenda de eventos</h1>
        </div>

        <div class="cont_galeria cont_galeria--agenda" id="PantallaCompleta">
            @foreach($eventos as $Key) : 
                <div class="cont_Galeria--item">
                    <figure>
                        <img class="cont_Galeria--img lazyload" id="Imagen_{{ $Key->ID_Agenda }}" data-src="{{ asset('/images/agenda/' . $Key->nombre_imagenAgenda) }}" loading="lazy" width="320" height="10"/> 
                    </figure>
                </div>

                <!-- REDES SOCIALES -->
                <div class="detalle_cont--redesSociales--Panel" style="width: 70%; margin:-8% auto 15% 20% ">
                    <!-- COMPARTIR FACEBOOK -->       
                    <div class="detalle_cont--red">      
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?php //echo RUTA_URL;?>/agenda_C/redes_sociales/<?php //echo $Key['ID_Agenda'];?>" target="_blank" rel="noopener noreferrer"><img style="height: 1.8em;" alt="facebook" src="{{ asset('/images/facebook.png') }}"/></a>
                    </div> 
                    
                    <!-- COMPARTIR TWITTER -->
                    <div class="detalle_cont--red">
                        <a href="https://twitter.com/intent/tweet?url=<?php //echo RUTA_URL;?>/agenda_C/redes_sociales/<?php //echo $Key['ID_Agenda'];?>" target="_blank"><img style="height: 2em;" src=""/></a>
                    </div>  
                    
                    <!-- WHATSAPP -->
                    <div class="detalle_cont--red">
                        <a href="whatsapp://send?text=Evento. {{ route('EventoAgendado', $Key->ID_Agenda) }}" data-action="share/whatsapp/share"><img style="height: 2em;" alt="Whatsapp" src="{{ asset('/images/Whatsapp.png') }}"/></a>
                    </div>  
                </div>
            @endforeach
        </div>
    </div>  

    <script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>

    <!-- Script para evaluar si el navegador soporta lazy-load -->
    <script>
        if ('loading' in HTMLImageElement.prototype){  
            // Si el navegador soporta lazy-load, toma todas las imágenes que tienen la clase
            // `lazyload`, obtenemos el valor de su atributo `data-data-src` y lo inyectamos en el `data-src`.
            const images = document.querySelectorAll("img.lazyload");
            images.forEach(img => {
                img.src = img.dataset.src;
            });
        } 
        else {     
            // Importa dinámicamente la libreria `lazysizes`
            let script = document.createElement("script");
            script.async = true; 
            script.src="https://cdn.jsdelivr.net/npm/lazysizes@5.3.2/lazysizes.min.js";
            document.body.appendChild(script);
        }

    </script>
@endsection()
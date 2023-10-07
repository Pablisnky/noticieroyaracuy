@if(isset($imagenSeleccionada->nombre_imagenNoticia))
    <div>
        <figure>
            <img class="cont_detalle--imagen" alt="Fotografia Noticia" src="{{ asset('/images/noticias/' . $imagenSeleccionada->nombre_imagenNoticia) }}"/> 
        </figure>
    </div>
@else
    <div>
        <figure>
            <img class="cont_detalle--imagen" alt="Fotografia Producto" src="{{ asset('/images/clasificados/' . $imagenSeleccionada->ID_Comerciante . '/productos/' . $imagenSeleccionada->nombre_img) }}"/> 
        </figure>
    </div>
@endif
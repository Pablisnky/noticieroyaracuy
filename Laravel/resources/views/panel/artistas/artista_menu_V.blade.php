<!-- MENU LATERAL -->

<div class="cont_panel--menu" id="MenuResponsive">
    <div class="cont_panel--div-1">
        <a class="h_2 bordeAlerta" href="{{ route('PerfilArtista', ['id_artista' => session('id_artista')]) }}">{{ session('nombreArtista') }}  {{ session('apellidoArtista') }}</a>
    </div>          
    
    <ul class="cont_panel--ul">

        <!-- OBRAS -->
        <li><a class="cont_panel--li" href="{{ route('PanelArtista', ['id_artista' => session('id_artista')]) }}" rel="noopener noreferrer">Obras de arte</a></li>

        <!-- AGREGAR OBRA -->
        <li><a class="cont_panel--li" href="{{ route('AgregarObra', ['id_artista' => session('id_artista')]) }}" rel="noopener noreferrer">Agregar obra</a></li>

        <li><a class="cont_panel--li" href="{{ route('Artista', ['id_artista' => session('id_artista')]) }}">Galeria de arte</a></li>

        <!-- ROLES -->
        <li><a class="cont_panel--li" href="" rel="noopener noreferrer">Cambio de rol</a></li>
        
        <li><hr class="hr--panel"></li>
        <li><label class="cont_panel--li Default_pointer" onclick="cerrarSecion('{{ route('CerrarSesion') }}')">Cerrar sesión</label></li>
    </ul>
</div>
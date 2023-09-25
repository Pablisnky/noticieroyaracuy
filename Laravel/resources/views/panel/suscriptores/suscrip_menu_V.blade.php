<!-- MENU LATERAL -->

<div class="cont_panel--menu" id="MenuResponsive">
    <div class="cont_panel--div-1">
        {{-- <h1 class="cont_panel--h"><?php //echo $Datos["nombre"] . " ". $Datos["apellido"]?></h1> --}}
    </div>          
    
    <ul class="cont_panel--ul">

        <!-- INICIO --> 
        <li><a class="cont_panel--li" href="{{ route('DashboardSuscriptor', ['ID_Suscriptor' => session('id_suscriptor')]) }}">Inicio</a></li>

        <!-- OBRAS -->
        <li><a class="cont_panel--li" href="{{ route('SuscriptorArtista', ['ID_Suscriptor' => session('id_suscriptor')]) }}" rel="noopener noreferrer">Obras</a></li>

        <!-- COMENTARIOS -->
        {{-- <li><a class="cont_panel--li" href="<?php //echo RUTA_URL . '/Panel_Comentarios_C/comentarios/' . $_SESSION['ID_Suscriptor']?>" rel="noopener noreferrer">Comentarios</a></li> --}}

        <!-- QUEJAS -->  
        <li><a class="cont_panel--li" href="{{ route('SuscriptorDenuncias', ['ID_Suscriptor' => session('id_suscriptor')]) }}" rel="noopener noreferrer">Quejas y reclamos</a></li>

        <!-- NOTICIAS -->
        {{-- <li><a class="cont_panel--li" href="<?php //echo RUTA_URL . '/Panel_Noticias_C/noticiaGuardada/' . $_SESSION['ID_Suscriptor']?>" rel="noopener noreferrer">Noticias</a></li> --}}

        <!-- MARKETPLACE -->
        <li><a class="cont_panel--li" href="{{ route('SuscriptorMarketplace', ['ID_Suscriptor' => session('id_suscriptor')]) }}" rel="noopener noreferrer">Marketplace</a></li>  

        <!-- PERFIL -->  
        <li><a class="cont_panel--li" href="{{ route('PerfilSuscriptor', ['ID_Suscriptor' => session('id_suscriptor')]) }}" rel="noopener noreferrer">Perfil</a></li>
        
        <li><a class="cont_panel--li" href="{{ route('NoticiasPortada') }}">Sitio web</a></li>

        <li><hr class="hr--panel"></li>
        <li><label class="cont_panel--li Default_pointer" onclick="cerrarSecion('{{ route('CerrarSesion') }}')">Cerrar sesión</label></li>
    </ul>
</div>
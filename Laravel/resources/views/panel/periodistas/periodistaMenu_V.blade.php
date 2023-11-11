<?php
if(session('id_periodista') == 1){  ?>

    <div class="cont_panel--menu"  id="MenuResponsive">
        <a class="h_2 bordeAlerta" href="">{{ session('nombreSuscriptor') }}  {{ session('apellidoSuscriptor') }}</a>
        
        <ul class="cont_panel--ul">
            <li><a class="{{request()->routeIs('AgregarNoticia') ? 'active' : ''}} cont_panel--li" href="{{ route('AgregarNoticia') }}">Agregar noticia</a></li>
            <li><a class="{{request()->routeIs('Index') ? 'active' : ''}} cont_panel--li" href="{{ route('Index') }}" rel="noopener noreferrer">Noticias en portada</a></li>
            <li><a class="{{request()->routeIs('NoticiasGenerales') ? 'active' : ''}} cont_panel--li" href="{{ route('NoticiasGenerales') }}" rel="noopener noreferrer">Noticias generales</a></li>
            {{-- <li><a class="cont_panel--li" href="<?php //echo RUTA_URL?>/Panel_C/yaracuyEnVdeo">Yaracuy en video</a></li> --}}
            <li><a class="{{request()->routeIs('Efemerides') ? 'active' : ''}} cont_panel--li" href="{{ route('Efemerides') }}">Efemerides</a></li>
            <li><a class="{{request()->routeIs('Agenda') ? 'active' : ''}} cont_panel--li" href="{{ route('Agenda') }}">Agenda</a></li>
            {{-- <li><a class="cont_panel--li" href="<?php echo //RUTA_URL?>/Panel_C/obituario">Obituario</a></li> --}}
            <li><a class="{{request()->routeIs('Publicidad') ? 'active' : ''}} cont_panel--li" href="{{ route('Publicidad') }}">Anuncio publicitario</a></li>
            {{-- <li><a class="cont_panel--li" href="<?php echo //RUTA_URL?>/Panel_C/galeria">Galeria de arte</a></li> --}}
            <li><a class="cont_panel--li" href="{{ route('NoticiasPortada') }}">Sitio web</a></li>

            <li><hr style="margin: 2%; width: 60%"></li>
            <li><label class="cont_panel--li Default_pointer" onclick="cerrarSecion('{{ route('CerrarSesion') }}')">Cerrar sesión</label></li>
        </ul>
    </div>
    <?php
}
else{   ?>
    <div class="cont_panel--menu"  id="MenuResponsive" onmouseover= "MostrarModal()">
        <a class="h_2 bordeAlerta" href="{{ route('Perfil_periodista', session('id_periodista')) }}">{{ session('nombreSuscriptor') }}  {{ session('apellidoSuscriptor') }}</a>             
                
        <ul class="cont_panel--ul">
            <li><a class="{{request()->routeIs('AgregarNoticia') ? 'active' : ''}} cont_panel--li" href="{{ route('AgregarNoticia') }}"">Agregar noticia</a></li>
            <li><a class="{{request()->routeIs('Index') ? 'active' : ''}} cont_panel--li" href="{{ route('Index') }}" rel="noopener noreferrer">Noticias en portada</a></li>           
            <li><a class="{{request()->routeIs('NoticiasGenerales') ? 'active' : ''}} cont_panel--li" href="{{ route('NoticiasGenerales') }}" rel="noopener noreferrer">Noticias generales</a></li>  
            <li><a class="{{request()->routeIs('Efemerides') ? 'active' : ''}} cont_panel--li" href="{{ route('Efemerides') }}">Efemerides</a></li>
            <li><a class="{{request()->routeIs('Agenda') ? 'active' : ''}} cont_panel--li" href="{{ route('Agenda') }}">Agenda</a></li>
            <li><a class="{{request()->routeIs('Publicidad') ? 'active' : ''}} cont_panel--li" href="{{ route('Publicidad') }}">Anuncio publicitario</a></li>
            <li><a class="cont_panel--li" href="{{ route('NoticiasPortada') }}">Sitio web</a></li>
            {{ session('perfilCompleto') }}
            <li><hr style="margin: 2%; width: 60%"></li>
            <li><p class="cont_panel--li Default_pointer" onclick = "cerrarSecion('{{ route('CerrarSesion') }}')">Cerrar sesión</p></li>
        </ul>
    </div>
    <?php
}   ?>


    <!-- muestra que se debe llenar todos los datos del perfil comerciante, antes de armar un catalogo -->
    @if(session('perfilCompleto') == 'total')
        <section class="sectionModal Default_ocultar" id="Mostrar_modal">
            <div class="contenedor_24 contenedor_24--widt">
                <h1 class="h1_1 h1_4 bandaAlerta">Completa tu perfil.</h1>

                <p class="cont_modal--p">Antes de cargar noticias.</h2>
            
                <a class="boton cont_modal--boton" href="{{ route('Perfil_periodista', ['id_periodista' => session('id_periodista')]) }}">Ver perfil</a>
            </div>
        </section>
    @endif

    <script>
        function MostrarModal(){
            document.getElementById("Mostrar_modal").style.display = "block"
        }
    </script>
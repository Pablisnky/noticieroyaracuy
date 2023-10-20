<!-- ICONO HAMBURGUESA"-->		
<div>									
    <img class="header--menu" id="ComandoMenu" onclick="mostrarMenu()" src="{{ asset('/iconos/menu/outline_menu_black_24dp.png') }}"/>
</div>

<!-- BARRA DE NAVEGACION -->
<div>
    <nav class="header__menuResponsive" id="MenuResponsive">
        <div class="header--scroll-snap">
            <div class="header--nav">
                <ul id="MenuContenedor">
                    <li><a class="header__li--Enlaces" href="{{ route('NoticiasPortada') }}" rel="noopener noreferrer">Inicio</a></li>
                    <li><a class="header__li--Enlaces" href="{{ route('Noticias') }}" rel="noopener noreferrer">Noticias</a></li>
                    <li><a class="header__li--Enlaces" href="{{ route('Eventos') }}" rel="noopener noreferrer">Agenda de eventos</a></li>
                    <li><a class="header__li--Enlaces" href="{{ route('Marketplace') }}" rel="noopener noreferrer">Marketplace</a></li> 
                    <li><a class="header__li--Enlaces" href="{{ route('GaleriaArte') }}">Galeria de arte</a></li>
                    <li><a class="header__li--Enlaces" href="{{ route('Efemeride') }}" rel="noopener noreferrer">Efemérides</a></li>
                    {{-- <li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Directorio comercial</a></li> --}}
                    {{-- <li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Obituario</a></li> --}}
                    {{-- <li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Tarifas</a></li> --}}
                    <li><a class="header__li--Enlaces" href="https://yaracultura.blogspot.com/" target="_blank" rel="noopener noreferrer">Blog Yaracultura</a></li>
                    {{-- <li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Quejas y reclamos</a></li> --}}
                    {{-- <li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">PodCast</a></li> --}}
                </ul>
            </div>
        </div>
    </nav>
</div>
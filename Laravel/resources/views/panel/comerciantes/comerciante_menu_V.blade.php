<!-- MENU LATERAL -->

<div class="cont_panel--menu" id="MenuResponsive">
    <div class="cont_panel--div-1">
        <a class="h_2 bordeAlerta" href="{{ route('perfil_comerciante', ['id_comerciante' => session('id_comerciante')]) }}">{{ session('nombreComerciante') }}  {{ session('apellidoComerciante') }}</a>
    </div>          
    
    <ul class="cont_panel--ul">

        <!-- INICIO --> 
        {{-- <li><a class="cont_panel--li" href="{{ route('DashboardPanelComerciante', ['id_Comerciante' => session('id_Comerciante')]) }}">Inicio</a></li> --}}

        <!-- AGREGAR PRODUCTO -->
        <li><a class="{{request()->routeIs('AgregarProducto') ? 'active' : ''}} cont_panel--li" href="{{ route('AgregarProducto', ['id_comerciante' => session('id_comerciante')]) }}" rel="noopener noreferrer">Agregar producto</a></li>

        <!-- FACTURAS -->
        <li><a class="cont_panel--li" href="" rel="noopener noreferrer">facturas</a></li>

        <!-- PROMOCIONES -->
        <li><a class="cont_panel--li" href="" rel="noopener noreferrer">Promociones</a></li>

        <!-- CUENTAS POR COBRAR -->  
        <li><a class="cont_panel--li" href="" rel="noopener noreferrer">Cuentas por cobrar</a></li>

        <!-- INVENTARIO -->
        <li><a class="{{request()->routeIs('PanelProducto') ? 'active' : ''}} cont_panel--li" href="{{ route('PanelProducto', ['id_comerciante' => session('id_comerciante')]) }}" rel="noopener noreferrer">Inventario</a></li> 
        
        {{-- CATALOGO ID_Suscriptor}/{pseudonimoSuscripto--}}
        <li><a class="cont_panel--li" href="{{ route('Catalogo', ['ID_Suscriptor' => session('id_comerciante')]) }}">Vista catalogo</a></li>

        <!-- ROLES -->
        <li><a class="cont_panel--li" href="{{ route('Roles', ['correo' => session('correoComerciante')]) }}" rel="noopener noreferrer">Cambio de rol</a></li>
        <li><hr class="hr--panel"></li>

        <li><label class="cont_panel--li Default_pointer" onclick="cerrarSecion('{{ route('CerrarSesion') }}')">Cerrar sesión</label></li>
    </ul>
</div>

<div id="Mostrar_cambioRol"></div>
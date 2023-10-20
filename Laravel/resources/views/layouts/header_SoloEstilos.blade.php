<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('titulo')</title>

		<meta http-equiv="content-type"  content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
		        
		<link rel="stylesheet" href="{{ asset('/css/estilosNoticieroYaracuy.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_350.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_370.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_800.css?v=' . rand()) }}"/>
		
		<!-- CDN FUENTES DE GOOGLE-->
        <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=RLato|Raleway:400|Montserrat|Gruppo'>        
    </head>
    <body>		
		<header class="header" id="Header">
			<!-- ICONO HAMBURGUESA"-->				
			<img class="header--menu header--menu--panel" id="ComandoMenu" onclick="mostrarMenu()" src="{{ asset('/iconos/menu/outline_menu_black_24dp.png') }}"/>	
			
			<!-- MEMBRETE FIJO -->
			<label class="header__titulo">Noticiero Yaracuy</label>	
			<!-- <figure>
				{{-- <img class="tapa-logo--mapa" src="{{ asset('/images/Mapa-Venezuela-yaracuy.png') }}"/> --}}
			</figure> -->
		</header>
		
		<!-- CONTENIDO -->
        @yield('contenido')
    </body>
</html>
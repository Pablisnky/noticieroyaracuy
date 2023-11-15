<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('titulo')</title>

		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="description" content="Noticias de Yaracuy"/>
		<meta name="keywords" content="noticias, yaracuy, publicidad"/>
		<meta name="author" content="Pablo Cabeza"/>
		<meta name="MobileOptimized" content="width"/>
		<meta name="HandheldFriendly" content="true"/>
		<!-- <meta http-equiv="Expires" content="0">  -->
		<!-- <meta http-equiv="Last-Modified" content="0"> -->
		<!-- <meta http-equiv="Cache-Control" content="no-cache, mustrevalidate">
 		<meta http-equiv="Pragma" content="no-cache"> -->

        <link rel="stylesheet" href="{{ asset('/css/estilosNoticieroYaracuy.css?v=' . rand()) }}"/>
        <link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_350.css?v=' . rand()) }}"/>
        <link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_370.css?v=' . rand()) }}"/>
        <link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_800.css?v=' . rand()) }}"/>
				
		<!-- CDN FUENTES DE GOOGLE-->
        <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=RLato|Raleway:400|Montserrat|Gruppo'/>
		
		<style>    
			#ConoDesplegar:hover #MenuSecundario{ 
				margin-top: 0px; 
				opacity: 1;        
				z-index: 3;
			}
			#ConoDesplegar:hover #IconoExpandir{
				transform: rotate(180deg);
				transition: all 0.4s;
			}
			/* .cambiar{ */
				/* margin-top: -10%!important; */
			/* } */
			.rotar{        
				/* transform: rotate(0deg);
				transition: all 0.4s; */
			}
		</style>
    </head>
    <body>				
		<header class="header" id="Header">
			<!-- ICONO HAMBURGUESA"-->				
			<img class="header--menu Default_quitarEscritorio" id="ComandoMenu" onclick="mostrarMenu()" src="{{ asset('/iconos/menu/outline_menu_black_24dp.png') }}"/>

			<!-- MEMBRETE FIJO -->
			<label class="header__titulo">Noticiero Yaracuy</label>

			{{-- ROLES --}}			
			{{-- <div class="partials_rol" id="ConoDesplegar"> 
				@include('layouts.partials.roles')
			</div> --}}
			
			<!-- CARITA -->
			<div class="cont_header--loginFecha Default_quitarMovil">
				<label class="Default_pointer"><img class="Default_login" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}" onclick= "cerrarSecion('{{ route('CerrarSesion') }}')"/></label>	
			</div>
		</header>
        
		<!-- CONTENIDO -->
        @yield('contenido')
    </body>
</html>
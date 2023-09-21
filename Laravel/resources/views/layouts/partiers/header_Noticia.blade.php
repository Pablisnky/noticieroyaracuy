<!DOCTYPE html>
<html lang="es">
    <head>
		
        <title>@yield('titulo')</title>

		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<meta name="description" content="Noticias de Yaracuy"/>
		<meta name="keywords" content="noticias, yaracuy, publicidad"/>
		<meta name="author" content="Pablo Cabeza"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="MobileOptimized" content="width"/>
		<meta name="HandheldFriendly" content="true"/>

		<link rel="stylesheet" href="{{ asset('/css/estilosNoticieroYaracuy.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_350.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_370.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_800.css?v=' . rand()) }}"/>
				
		
		<!-- CDN FUENTES DE GOOGLE-->
        <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=RLato|Raleway:400|Montserrat|Gruppo|Moon+Dance'>

		<style>
			.active{
				background: black;
				color: white;
			}
		</style>
    </head>
	<body>
		<header class="header" id="Header">
			
			<!-- ICONO HAMBURGUESA -->	
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
								<li><a class="header__li--Enlaces" href="{{ route('Efemeride') }}" rel="noopener noreferrer">Efemérides</a>
								{{-- <li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Directorio comercial</a></li> --}}
								{{-- <li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Obituario</a></li> --}}
								{{-- <li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Tarifas</a></li> --}}
								<li><a class="header__li--Enlaces" href="https://yaracultura.blogspot.com/" target="_blank" rel="noopener noreferrer">Blog Yaracultura</a></li>
								{{-- <li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Quejas y reclamos</a></li> --}}
								{{-- <li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">PodCast</a></li>                             --}}
							</ul>
						</div>
					</div>
				</nav>
			</div>

			<!-- BOTONES DE MARKETPLACE Y EVENTOS -->
			<div class="cont_botones_destacados">
				<div>
					<label class="boton boton--corto"><a class="Default_font--white boton_a" href="{{ route('Eventos') }}">Eventos</a></label> 
				</div>        
				<div>
					<label class="boton boton--corto"><a class="Default_font--white boton_a"" href="{{ route('Noticias') }}">Mas noticias</a></label> 
				</div>         
				<div>
					<label class="boton boton--corto"><a class="Default_font--white boton_a"" href="{{ route('Marketplace') }}">Marketplace</a></label> 
				</div>          
				<div>
					<label class="boton boton--corto"><a class="Default_font--white boton_a"" href="{{ route('GaleriaArte') }}">Galeria de arte</a></label> 
				</div>      
			</div> 

			<!-- MEMBRETE FIJO -->
			<label class="header__titulo">Noticiero Yaracuy</label>
			
			<!-- FECHA Y CARITA -->
			<div class="cont_header--loginFecha">
				<div style="margin-right: 15px;">
					<label class="header__fecha">San Felipe, {{ date('d') }} de {{ date('M') }}</label>
				</div>
				
				<!--CARITA -->
				<div>
					@if(!empty(session('id_suscriptor')))
						<a class="Default_quitarMovil" href="#"><img class="Default_login" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}"/></a>				
					@elseif(empty(session('id_suscriptor')) AND empty(session('id_periodista')))
						<a class="Default_quitarMovil" href="{{ route('Login', ['id_noticia' => 'sin_id_noticia', 'bandera' => 'sin_bandera', 'id_comentario' => 'sin_id_comentario']) }}" rel="noopener noreferrer"><img class="Default_logout" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}"/></a>
					@elseif(!empty(session('id_periodista')))
						<a class="Default_quitarMovil" href="{{ route('Index') }}"><img class="Default_login" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}"/></a>		
					@endif
				</div>
			</div>
		</header>
		
		<!-- MEMBRETE DESPLAZANTE -->
		<div class="tapa-logo" id="Tapa_Logo">
			
			<!-- NUESTRO ADN-->			            
			<a class="tapa-logo--ADN--font Default_quitarMovil" href="#">
				<div class="tapa-logo--ADN">
					<img style="width: 2em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_groups_white_24dp.png') }}" rel="noopener noreferrer"/>Nuestro ADN
				</div>
			</a>
			
			<div style="position: absolute; bottom: 0pt">

				<!-- MEMBRETE DESPLAZANTE -->
				<label class="tapa-logo--font">Noticiero Yaracuy</label>
				
				<!-- MAPA -->
				<figure class="tapa-logo--mapa Default_pointer">
					<img id="Abrir" src="{{ asset('/images/Mapa-Venezuela-yaracuy.png') }}"/>
				</figure>
			</div>

			<!--CARITA FUERA DE HEADER-->
			<div class="carita">
				<!-- CARITA -->
				<?php
				if(!empty($_SESSION['ID_Suscriptor'])){	?>     
					<a class="tapa-logo--ADN--font Default_quitarMovil" href="#">
						<div class="tapa-logo--ADN">
							<img style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_account_circle_white_24dp.png') }}" rel="noopener noreferrer"/>Iniciar sesión 
						</div>
					</a>
					
					<a class="carita--texto Default_quitarEscritorio" href="#">Iniciar sesión <img class="Default_login--movil"  style=" margin-right: 10px" src="{{ asset('/iconos/perfil/outline_account_circle_white_24dp.png') }}"/>Iniciar sesión</a>				
					<?php
				}	
				else if(empty($_SESSION['ID_Suscriptor']) AND empty($_SESSION['ID_Periodista'])){	?>     
					<a class="tapa-logo--ADN--font Default_quitarMovil" href="#">
						<div class="tapa-logo--ADN">
							<img style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_no_accounts_white_24dp.png') }}" rel="noopener noreferrer"/>Iniciar sesión 
						</div>
					</a>
					
					<a class="carita--texto Default_quitarEscritorio" href="#" rel="noopener noreferrer"><img class="Default_logout--movil" style=" margin-right: 10px" src="{{ asset('/iconos/perfil/outline_no_accounts_white_24dp.png') }}"/> Iniciar sesión</a>
					<?php
				}				
				else if(!empty($_SESSION['ID_Periodista'])){	?>
									
					<a class="tapa-logo--ADN--font Default_quitarMovil" href="#">
						<div class="tapa-logo--ADN">
							<img style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_account_circle_white_24dp.png') }}" rel="noopener noreferrer"/>Iniciar sesión 
						</div>
					</a>

					<a class="carita--texto Default_quitarEscritorio" href=""><img class="Default_login--movil" style=" margin-right: 10px" src="{{ asset('/iconos/perfil/outline_account_circle_white_24dp.png') }}"/> Iniciar sesión</a>				
					<?php
				}	
					?>

				<!-- NUESTRO ADN-->			            
				<a class="Default_quitarEscritorio" style=" color: white; " href="#">
					<div class="tapa-logo--ADN" style="margin-left: -10px; margin-top: 12px">
						<img style="width: 2em; margin-lef:0px; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_groups_white_24dp.png') }}" rel="noopener noreferrer"/>Nuestro ADN
					</div>
				</a>
			</div>
		</div>

		<!-- CONTENIDO -->
        @yield('contenido')
    </body>
</html>
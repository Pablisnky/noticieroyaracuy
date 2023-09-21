<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('titulo')</title>

		<meta http-equiv="content-type" content="text/html; charset=utf-8"/>
		<meta name="description" content="Ventas por internet a pedido"/>
		<meta name="keywords" content="pedido, despacho, compra"/>
		<meta name="author" content="Pablo Cabeza"/>
		<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
		<meta name="apple-mobile-web-app-capable" content="yes"/>
		<meta name="apple-mobile-web-app-status-bar-style" content="black-translucent"/>
		<meta name="MobileOptimized" content="width"/>
		<meta name="HandheldFriendly" content="true"/>

		<link rel="stylesheet" href="{{ asset('/css/estilosNoticieroYaracuy.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_350.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_370.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_800.css?v=' . rand()) }}"/>
		
		<link rel="shortcut icon" type="image/png" href="<?php //echo RUTA_URL;?>/public/images/logo.png"/>
		
		<!-- CDN ICONOS DE GOOGLE -->
		<link href="https://fonts.googleapis.com/css2?family=Material+Icons+Outlined" rel="stylesheet"/>

		<!-- CDN FUENTES DE GOOGLE -->
		<link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet"> 

		<!-- CDN iconos de font-awesome-->
		<link rel='stylesheet' type='text/css' href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css'/>
    </head>
    <body>	
		<header class="header header--inicio">

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
								<li><a class="header__li--Enlaces" href="{{ route('Noticias') }}" rel="noopener noreferrer">Noticias</a></li>
								<li><a class="header__li--Enlaces" href="efemeride" rel="noopener noreferrer">Efemérides</a></li>
								<li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Agenda de eventos</a></li>
								<li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Marketplace</a></li> 
								<li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Directorio comercial</a></li>
								<li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Obituario</a></li>
								<li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Tarifas</a></li>

								<li><a class="header__li--Enlaces" href="https://yaracultura.blogspot.com/" target="_blank" rel="noopener noreferrer">Blog Yaracultura</a></li>
								<li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">Quejas y reclamos</a></li>
								<li><a class="header__li--Enlaces" href="">Galeria de arte</a></li>
								<li><a class="header__li--Enlaces" href="" rel="noopener noreferrer">PodCast</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>

			<!-- MEMBRETE FIJO -->
			<div class="cont_header_membrete">
				<label class="header__titulo">Noticiero Yaracuy</label>
			</div>
		</header>   

		<!-- MEMBRETE DESPLAZANTE -->
		<div class="tapa-logo" id="Tapa_Logo">
			<!-- NUESTRO ADN-->			            
			<a class="tapa-logo--ADN--font Default_quitarMovil" href="">
				<div class="tapa-logo--ADN">
					<img style="width: 2em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_groups_white_24dp.png')}}" rel="noopener noreferrer"/>Nuestro ADN
				</div>
			</a>
						
			<div class="tapa-logo--2">
				
				<!-- MEMBRETE DESPLAZANTE -->
				<label class="tapa-logo--font">Noticiero Yaracuy</label>
				
				<!-- MAPA -->
				<figure class="tapa-logo--mapa Default_pointer">
					<img id="Abrir" src="{{ asset('/images/Mapa-Venezuela-yaracuy.png')}}"/>
				</figure>
			</div>

			<!--CARITA FUERA DE HEADER-->
			<div class="carita">

				<!-- CARITA -->
				<?php
				if(!empty($_SESSION['ID_Suscriptor'])){	?>     
					<a class="tapa-logo--ADN--font Default_quitarMovil" href="">
						<div class="tapa-logo--ADN">
							<img style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_account_circle_white_24dp.png')}}" rel="noopener noreferrer"/>Iniciar sesión 
						</div>
					</a>
					<a class="carita--texto Default_quitarEscritorio" href="">Sesión <img class="Default_login--movil" style=" margin-right: 10px" src="{{ asset('/iconos/perfil/outline_account_circle_white_24dp.png')}}"/>Iniciar sesión</a>				
					<?php
				}	
				else if(empty($_SESSION['ID_Suscriptor']) AND empty($_SESSION['ID_Periodista'])){	?>     
					<a class="tapa-logo--ADN--font Default_quitarMovil" href="">
						<div class="tapa-logo--ADN">
							<img style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_no_accounts_white_24dp.png')}}" rel="noopener noreferrer"/>Iniciar sesión 
						</div>
					</a>
					<a class="carita--texto Default_quitarEscritorio" href="" rel="noopener noreferrer"><img class="Default_logout--movil" style=" margin-right: 10px" src="{{ asset('/iconos/perfil/outline_no_accounts_white_24dp.png')}}"/>Iniciar sesión</a>
					<?php
				}				
				else if(!empty($_SESSION['ID_Periodista'])){	?>
						            
					<a class="tapa-logo--ADN--font Default_quitarMovil" href="">
						<div class="tapa-logo--ADN">
							<img style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_account_circle_white_24dp.png')}}" rel="noopener noreferrer"/>Iniciar sesión 
						</div>
					</a>
					<a class="carita--texto Default_quitarEscritorio" href=""><img class="Default_login--movil" style="margin-right: 10px" src="{{ asset('/iconos/perfil/outline_account_circle_white_24dp.png')}}"/>Iniciar sesión</a>				
					<?php
				}	
					?>

				<!-- NUESTRO ADN-->			            
				<a class="Default_quitarEscritorio" style="color: white;" href="">
					<div class="tapa-logo--ADN" style="margin-left: -10px; margin-top: 12px">
						<img style="width: 2em; margin-lef:0px; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_groups_white_24dp.png')}}" rel="noopener noreferrer"/>Nuestro ADN
					</div>
				</a>
			</div>
		</div>

		<!-- MEMBRETE FIJO-->
		<div class="contenedor_111" style="z-index:1">
			<a class="a_1 font--negro" href="<?php //echo RUTA_URL . '/Inicio_C/NoVerificaLink';?>">PedidoRemoto</a>
			<h2 class="h2_5">compras y despachos</h2>
		</div>

		<!-- DIV USADO PARA TAPAR EL BODY MIENTRAS ESTA EL MENU RESPONSIVE -->
		<div class="tapa" id="Tapa">
		</div>

		<noscript>
			<p>Bienvenido a PedidoRemoto.com</p>
			<p>La tienda online requiere para su funcionamiento el uso de JavaScript, si lo has deshabilitado intencionadamente, por favor vuelve a activarlo.</p>
		</noscript>
		
		<!-- CONTENIDO -->
        @yield('contenido')
    </body>
</html>
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
    </head>
	<body>
		<header class="header" id="Header">
			
			{{-- MENU NAVEGACION --}}
			@include('layouts.partials.menu')			

			<!-- BOTONES DESTACADOS -->
			<div class="cont_botones_destacados">
				@include('layouts.partials.botones')
			</div>

			<!-- MEMBRETE FIJO -->			
			<div class="cont_header_membrete">
				<label class="header__titulo">Noticiero Yaracuy</label>
			</div>
			
			<!-- FECHA Y CARITA -->
			@include('layouts.partials.carita')
			    
			<!-- YARACUY EN VIDEO -->
			{{-- <a class="con_portada--titulo Default_pointer" href="{{ route('YaracuyVideo') }}" rel="noopener noreferrer"><img style="width: 2em;" src="{{ asset('/iconos/video/outline_videocam_white_24dp.png') }}"/>Yaracuy<br> en video</a> --}}
		</header>

		<!-- MEMBRETE DESPLAZANTE -->
		<div class="tapa-logo" id="Tapa_Logo">
			
			<!-- NUESTRO ADN-->			            
			<a class="Default_quitarMovil" href="">
				<div class="tapa-logo--ADN">
					<div style="width: 50px; display: flex; justify-content: center;">
						<img style="width: 2em;" src="{{ asset('/iconos/perfil/outline_groups_white_24dp.png')}}" rel="noopener noreferrer"/>
					</div>
					<label style="display: block; cursor: pointer; color: white;">Nuestro ADN</label> 
				</div>
			</a>
				
			<!-- CONTACTANOS -->		
				{{-- <div class="tapa-logo--ADN Default_quitarMovil" onclick="window.location.href='https://wa.me/584245374044?text=NoticieroYaracuy;%20¿En%20que%20podemos%20ayudarte?'">
					<div style="width: 50px; display: flex; justify-content: center;">
						<img style="width: 2em;" src="{{ asset('/iconos/telefono/outline_phone_iphone_white_24dp.png')}}" rel="noopener noreferrer"/>
					</div>
					<label style="display: block; cursor: pointer; color: white;">Contactanos</label>
				</div> --}}
						
			<div class="tapa-logo--2">
				
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
					<a class="tapa-logo--ADN--font Default_quitarMovil" href="">
						<div class="tapa-logo--ADN">
							<img style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_account_circle_white_24dp.png')}}" rel="noopener noreferrer"/>Iniciar sesión 
						</div>
					</a>
					<a class="carita--texto Default_quitarEscritorio" href="">Sesión <img class="Default_login--movil" style=" margin-right: 10px" src="{{ asset('/iconos/perfil/outline_account_circle_white_24dp.png')}}"/>Iniciar sesión</a>				
					<?php
				}	
				else if(empty($_SESSION['ID_Suscriptor']) AND empty($_SESSION['ID_Periodista'])){	?>     
					<a class="tapa-logo--ADN--font Default_quitarMovil" href="{{ route('Login', ['id_noticia' => 'sin_id_noticia', 'bandera' => 'sin_bandera', 'id_comentario' => 'sin_id_comentario']) }}">
						<div class="tapa-logo--ADN">
							<img style="width: 1.5em; margin-right: 5px" src="{{ asset('/iconos/perfil/outline_no_accounts_white_24dp.png')}}" rel="noopener noreferrer"/>Iniciar sesión 
						</div>
					</a>
					<a class="carita--texto Default_quitarEscritorio" href="{{ route('Login', ['id_noticia' => 'sin_id_noticia', 'bandera' => 'sin_bandera', 'id_comentario' => 'sin_id_comentario']) }}" rel="noopener noreferrer"><img class="Default_logout--movil" style=" margin-right: 10px" src="{{ asset('/iconos/perfil/outline_no_accounts_white_24dp.png')}}"/>Iniciar sesión</a>
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
				
				<!-- CONTACTANOS -->					
				<div class="cont_adn--iconos">
					<img style="margin-left: -4px; margin-right: 5px; cursor: pointer" src="{{ asset('/iconos/telefono/outline_phone_iphone_white_24dp.png') }}" width="27" height="27" alt="Whatsapp"/>
					<a style="display: block; cursor: pointer; color: white;" href="https://wa.me/584245374044?text=NoticieroYaracuy;%20¿En%20que%20podemos%20ayudarte?">Contacto</a>
				</div>
			</div>
		</div>
		
		<!-- FULLSCREEM -->
		<div class="Default_ocultar" id="Miimagen">	
			<!-- ICONO CERRAR -->
			<a href="{{ route('Noticias') }}"><img class="cont_modal--cerrar Default_pointer" style="width: 1em;" src="{{ asset('/iconos/cerrar/outline_cancel_black_24dp.png')}}"/></a>
			
			<div class="fullscreem--inicio--texto">
				<h1 class="fullscreem--inicio--h1">Poema Yaracuy</h3>
				<h3 class="fullscreem--inicio--h3">Poeta yaracuyano Jose Parra</h1>
				<h2 style="color:white">I</h2>
				<p style="color:white">Esta es mi tierra. Yaracuy la nombran.<br>
				Yaracuy es río y es la hazaña<br>
				Y el nombre de su selva<br>
				Y su montaña preso en las aguas<br>
				Que su plano alfombran.</p>

				<h2 style="color:white">II</h2>
				<p style="color:white">Su luz, su magia, su verdor asombran<br>
				Y a orillas de las espumas que la bañan<br>
				De su seno de miel surge la caña<br>
				Para endulzar los labios que la nombran.</p>

				<h2 style="color:white">III</h2>
				<p style="color:white">Es tierra oscura… mas si en paz florece<br>
				Y en el vaivén del corazón nos crece<br>
				El cobre de su glóbulo aborigen.</p>

				<h2 style="color:white">IV</h2>
				<p style="color:white">Vemos entonces sus azules sendas<br>
				Y hasta oímos la voz de sus leyendas<br>
				Llenándonos la noche del origen.</p>
			</div>
			<div class="fullscreem--inicio--mapa">
				<figure>
					<img src="{{ asset('/images/Mapa-Venezuela-yaracuy.png')}}"/>
				</figure>
			</div>
		</div>

		<!-- CONTENIDO -->
        @yield('contenido')
    </body>
</html>
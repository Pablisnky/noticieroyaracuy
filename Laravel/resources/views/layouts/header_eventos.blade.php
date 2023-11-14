<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('titulo')</title>

		<meta http-equiv="content-type"  content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- ETIQUETAS OPEN-GRAPH para ayudar a la red social de turno a identificar mejor qué hay en un recurso de nuestra web que alguien está compartiendo -->
		<meta property="og:title" content="www.noticieroyaracuy.com"/>
		<meta property="og:description" content="Agenda de eventos"/>
		<meta property="og:image:width" content="1200"/>
		<meta property="og:image:height" content="630"/>
		<meta property="og:type" content="website"/>
		<meta property="og:site_name" content="NoticieroYaracuy"/>
		<meta property="fb:app_id" content="928977633900253"/>
		<meta property="og:image:alt" content="Imagen descriptiva del evento"/> 
		{{-- <meta property="og:url" content="{{ route('EventoAgendado', $Key->ID_Agenda) }}"/>  --}}
		{{-- <meta property="og:image:secure_url" itemprop="image" content="{{ asset('/images/agenda/'.$eventos['nombre_imagenAgenda']) }}"/> --}}
		<meta property="og:image" itemprop="#"/>
		<meta property="og:locale:alternate" content="es_ES"/>

		<!--ETIQUETAS META TWITTER --> 
		<meta name="twitter:card" content="summary_large_image">
		<meta property="og:image" itemprop="#"/>
		
		<link rel="stylesheet" href="{{ asset('/css/estilosNoticieroYaracuy.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_350.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_370.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_800.css?v=' . rand()) }}"/>
		
		<!-- CDN FUENTES DE GOOGLE-->
        <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=RLato|Raleway:400|Montserrat|Gruppo'>        
    </head>
    <body>				
		<header class="header" id="Header">		
			
			{{-- MENU NAVEGACION --}}
			@include('layouts.partials.menu')

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
			<div class="cont_header_membrete">
				<label class="header__titulo">Noticiero Yaracuy</label>
			</div>

			<!-- FECHA Y CARITA -->
			<div class="cont_header--loginFecha">
				
				<!-- FECHA -->
				<div style="margin-right: 15px;">
					<label class="header__fecha">San Felipe, <?php echo date('d');?> de <?php echo date('M');?></label>
				</div>
				
				<!--CARITA -->
				<div>
					@if(!empty(session('id_suscriptor'))) 
						<a class="Default_quitarMovil" href="{{ route('DashboardPanelSuscriptor', ['id_suscriptor' => session('id_suscriptor')]) }}"><img class="Default_login" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}"/></a>	
					@elseif(empty(session('id_suscriptor')) AND empty(session('id_periodista')))
						<p>{{ session('id_periodista') }}</p>
						<a class="Default_quitarMovil" href="{{ route('Login', ['id_noticia' => 'sin_id_noticia', 'bandera' => 'sin_bandera', 'id_comentario' => 'sin_id_comentario']) }}"><img class="Default_logout" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}"/></a>
					@elseif(!empty(session('id_periodista')))
						<a class="Default_quitarMovil" href="{{ route('Index') }}"><img class="Default_login" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}"/></a>	
					@endif
				</div>
			</div>
		</header>
		
		<!-- MEMBRETE DESPLAZANTE -->
		<div class="tapa-logo" id="Tapa_Logo">
			<!-- NUESTRO ADN-->			            
			<a class="tapa-logo--ADN--font Default_quitarMovil" href="<?php //echo RUTA_URL . '/MenuController/nuestroADN';?>">
				<div class="tapa-logo--ADN">
					<img style="width: 2em; margin-right: 5px" src="<?php //echo RUTA_URL . '/public/iconos/perfil/outline_groups_white_24dp.png'?>" rel="noopener noreferrer"/>Nuestro ADN
				</div>
			</a>
			
			<div style="position: absolute; bottom: 0pt">

				<!-- MEMBRETE DESPLAZANTE -->
				<label class="tapa-logo--font">Noticiero Yaracuy</label>
				
				<!-- MAPA -->
				<figure class="tapa-logo--mapa Default_pointer">
					<img id="Abrir" src="<?php //echo RUTA_URL . '/public/images/Mapa-Venezuela-yaracuy.png'?>"/>
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
			</div>
		</div>

		<!-- FULLSCREEM -->
		<div class="Default_ocultar" id="Miimagen">	
			<!-- ICONO CERRAR -->
			<a href="<?php //echo RUTA_URL ;?>/InicioController"><img class="cont_modal--cerrar Default_pointer" style="width: 1em;" src="<?php //echo RUTA_URL . '/public/iconos/cerrar/outline_cancel_black_24dp.png'?>"/></a>

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
					<img src="<?php //echo RUTA_URL . '/public/images/Mapa-Venezuela-yaracuy.png'?>"/>
				</figure>
			</div>
		</div>

		<!-- CONTENIDO -->
        @yield('contenido')
    </body>
</html>
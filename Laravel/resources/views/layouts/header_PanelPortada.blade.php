<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('titulo')</title>

		<meta http-equiv="content-type"  content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- ETIQUETAS OPEN-GRAPH para ayudar a la red social de turno a identificar mejor qué hay en un recurso de nuestra web que alguien está compartiendo -->
		<meta property="og:title" content="www.noticieroyaracuy.com"/>
		<meta property="og:description" content="Noticias locales de Yaracuy"/>
		<meta property="og:image:width" content="1200"/>
		<meta property="og:image:height" content="630"/>
		<meta property="og:type" content="website"/>
		<meta property="og:site_name" content="NoticieroYaracuy"/>
		<meta property="fb:app_id" content="928977633900253"/>
		<meta property="og:image:alt" content="Imagen descriptiva de la noticia"/>
		{{-- <meta property="og:url" content="{{ route('DetalleNoticia', $noticia->ID_Noticia) }}"/> --}}
		{{-- <meta property="og:url" content="{{ 'https://www.noticieroyaracuy.com/noticias/detalleNoticia/' . $noticia['ID_Noticia'] }}"/> --}}
		<meta property="og:image" itemprop="#"/>
		<meta property="og:locale:alternate" content="es_ES"/>

		<!--ETIQUETAS META TWITTER --> 
		<meta name="twitter:card" content="summary_large_image">
		<meta name='twitter:image' content='#'>
		        
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
			<img class="header--menu Default_quitarEscritorio" id="ComandoMenu" onclick="mostrarMenu()" src="{{ asset('/iconos/menu/outline_menu_black_24dp.png') }}"/>		
			
			<!-- MEMBRETE FIJO -->
			<label class="header__titulo--Panelperiodista">Noticiero Yaracuy</label>
			
			<!-- CARITA -->
			<div class="cont_header--loginFecha Default_quitarMovil">
				<label class="Default_pointer"><img class="Default_login" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}" onclick="cerrarSecion('{{ route('CerrarSesion') }}')"/></label>							
			</div>
		</header>
		
		<!-- CONTENIDO -->
        @yield('contenido')
    </body>
</html>
<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('titulo')</title>

		<meta http-equiv="content-type"  content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- ETIQUETAS OPEN-GRAPH para ayudar a la red social de turno a identificar mejor qué hay en un recurso de nuestra web que alguien está compartiendo -->
		<meta property="og:title" content="www.noticieroyaracuy.com"/>
		<meta property="og:description" content="Catalogo de productos"/>
		<meta property="og:type" content="website"/>
		<meta property="og:site_name" content="NoticieroYaracuy"/>
		<meta property="fb:app_id" content="928977633900253"/>
		<meta property="og:image:alt" content="Imagen descriptiva del catalogo"/>
		<meta property="og:url" content="<?php //echo RUTA_URL?>/Catalogos_C/index/<?php //echo $Datos['Suscriptor'][0]['ID_Suscriptor'];?>"/>




		<meta property="og:image:secure_url" itemprop="image" content="<?php //echo RUTA_URL?>/public/images/clasificados/<?php //echo $Datos['Suscriptor'][0]['ID_Suscriptor']?>/<?php //echo $Datos['Suscriptor'][0]['nombreImgCatalogo'];?>"/>
		<meta property="og:image:width" content="1200"/>
		<meta property="og:image:height" content="630"/>
		<meta property="og:locale:alternate" content="es_ES"/>

		<!--ETIQUETAS META TWITTER --> 
		<meta name="twitter:card" content="summary_large_image">
		<meta name='twitter:image' content='<?php //echo RUTA_URL?>/public/images/clasificados/<?php //echo $Datos['ID_Suscriptor']?>/<?php //echo $Datos['Suscriptor'][0]['nombreImgCatalogo'];?>'>
		        
		<link rel="stylesheet" href="{{ asset('/css/estilosNoticieroYaracuy.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_350.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_370.css?v=' . rand()) }}"/>
		<link rel="stylesheet" href="{{ asset('/css/MediaQuery_EstilosNoticieroYaracuy_800.css?v=' . rand()) }}"/>
		
		<!-- CDN FUENTES DE GOOGLE-->
        <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=RLato|Raleway:400|Montserrat|Gruppo'>        
		
		<!-- CARGA SDK FONTAWESONE PARA ICONOS DE REDES SOCIALES se uso esta libreria porque los iconos no tienen fondo-->
		<script src="https://kit.fontawesome.com/2d6db4c67d.js" crossorigin="anonymous"></script>
    </head>
    <body onload="ProductosEnCarrito()"">	
			
        {{-- CONTENIDO  --}}
        @yield('contenido')
    </body>
</html>
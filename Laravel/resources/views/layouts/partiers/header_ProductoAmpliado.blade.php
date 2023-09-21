<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('titulo')</title>

		<meta http-equiv="content-type"  content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- ETIQUETAS OPEN-GRAPH para ayudar a la red social de turno a identificar mejor qué hay en un recurso de nuestra web que alguien está compartiendo -->
		<meta property="og:title" content="CLASIFICADOS - Compra y venta"/>
		<!-- <meta property="og:description" content="Clasificados"/> -->
		<meta property="og:type" content="website"/>
		<meta property="og:site_name" content="NoticieroYaracuy"/>
		<meta property="fb:app_id" content="928977633900253"/>
		<meta property="og:image:alt" content="Imagen descriptiva del clasificado"/>
		<meta property="og:url" content="<?php //echo RUTA_URL?>/Clasificados_C/productoAmpliado/<?php //echo $Datos['Producto']['ID_Producto']?>"/>
		<meta property="og:image:secure_url" itemprop="image" content="<?php //echo RUTA_URL?>/public/images/clasificados/<?php //echo $Datos['Producto']['ID_Suscriptor']?>/productos/<?php //echo $Datos['Imagenes']['nombre_img'];?>"/>
		<meta property="og:image:width" content="1200"/>
		<meta property="og:image:height" content="630"/>
		<meta property="og:locale:alternate" content="es_ES"/>

		<!--ETIQUETAS META TWITTER --> 
		<meta name="twitter:card" content="summary_large_image">
		<meta name='twitter:image' content='<?php //echo RUTA_URL?>/public/images/clasificados/<?php //echo $Datos['Producto']['ID_Suscriptor']?>/productos/<?php //echo $Datos['Imagenes']['nombre_img'];?>'>
		        
		<link rel="stylesheet" type="text/css" href="{{ asset('/css/estilosNoticieroYaracuy.css?v=' . rand()) }}"/>
		{{-- <link rel="stylesheet" type="text/css" href="<?php //echo RUTA_URL;?>/public/css/MediaQuery_EstilosNoticieroYaracuy_350.css?v=<?php //echo rand();?>"/>
		<link rel="stylesheet" type="text/css" href="<?php //echo RUTA_URL?>/public/css/MediaQuery_EstilosNoticieroYaracuy_370.css?v=<?php //echo rand();?>"/>
		<link rel="stylesheet" type="text/css" href="<?php //echo RUTA_URL;?>/public/css/MediaQuery_EstilosNoticieroYaracuy_800.css?v=<?php //echo rand();?>"/> --}}
		
		<!-- CDN FUENTES DE GOOGLE-->
        <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=RLato|Raleway:400|Montserrat|Gruppo'>        
    </head>
    <body>		
        <!-- CONTENIDO -->
        @yield('contenido')
    </body>
</html>
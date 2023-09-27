<!DOCTYPE html>
<html lang="es">
    <head>
        <title>@yield('titulo')</title>

		<meta http-equiv="content-type"  content="text/html; charset=utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<!-- ETIQUETAS OPEN-GRAPH para ayudar a la red social de turno a identificar mejor qué hay en un recurso de nuestra web que alguien está compartiendo -->
		<meta property="og:title" content="www.noticieroyaracuy.com"/>
		<meta property="og:description" content="Agenda de eventos"/>
		<meta property="og:type" content="website"/>
		<meta property="og:site_name" content="NoticieroYaracuy"/>
		<meta property="fb:app_id" content="928977633900253"/>
		<meta property="og:image:alt" content="Imagen descriptiva del evento"/>
		<meta property="og:url" content="<?php //echo RUTA_URL?>/Agenda_C/redes_sociales/<?php //echo $Datos['agenda']['ID_Agenda'];?>"/>
		<meta property="og:image:secure_url" itemprop="image" content="<?php //echo RUTA_URL?>/public/images/agenda/<?php //echo $Datos['agenda']['nombre_imagenAgenda'];?>"/>
		<meta property="og:image:width" content="1200"/>
		<meta property="og:image:height" content="630"/>
		<meta property="og:locale:alternate" content="es_ES"/>

		<!--ETIQUETAS META TWITTER --> 
		<meta name="twitter:card" content="summary_large_image">
		<meta name='twitter:image' content='<?php //echo RUTA_URL?>/public/images/agenda/<?php //echo $Datos['agenda']['nombre_imagenAgenda'];?>'>
		        
		<!-- WHATSAPP -->
		<!-- Fotos mayores a 300 kb no seran mostradas en la miniatura al compartir la noticia -->
		
		<link rel="stylesheet" type="text/css" href="<?php //echo RUTA_URL;?>/public/css/estilosNoticieroYaracuy.css?v=<?php //echo rand();?>"/>
		<link rel="stylesheet" type="text/css" href="<?php //echo RUTA_URL;?>/public/css/MediaQuery_EstilosNoticieroYaracuy_350.css?v=<?php //echo rand();?>"/>
		<link rel="stylesheet" type="text/css" href="<?php //echo RUTA_URL?>/public/css/MediaQuery_EstilosNoticieroYaracuy_370.css?v=<?php //echo rand();?>"/>
		<link rel="stylesheet" type="text/css" href="<?php //echo RUTA_URL;?>/public/css/MediaQuery_EstilosNoticieroYaracuy_800.css?v=<?php //echo rand();?>"/>
		
		<!-- CDN FUENTES DE GOOGLE-->
        <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=RLato|Raleway:400|Montserrat|Gruppo'>        
    </head>
    <body>				
		<header class="header" id="Header">

			<!-- ICONO HAMBURGUESA -->
			<div>			
				<img class="header--menu" id="ComandoMenu" onclick="mostrarMenu()" src="<?php //echo RUTA_URL . '/public/iconos/menu/outline_menu_black_24dp.png'?>"/>
			</div>

			<!-- BARRA DE NAVEGACION -->
			<div>
				<nav class="header__menuResponsive" id="MenuResponsive" >
					<div class="header--scroll-snap">
						<div class="header--nav">
							<ul id="MenuContenedor">
								<li><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Inicio_C';?>" rel="noopener noreferrer">Inicio</a></li>								
								<li><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Noticias_C/NoticiasGenerales';?>" rel="noopener noreferrer">Noticias</a></li>
								<li><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/YaracuyEnVideo_C';?>" rel="noopener noreferrer">Yaracuy en videos</a></li>
								<li><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Efemeride_C';?>" rel="noopener noreferrer">Efemérides</a></li>
								<li><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Agenda_C';?>" rel="noopener noreferrer">Agenda de eventos</a></li>
								<li><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/ClasificadoController';?>" rel="noopener noreferrer">Clasificados</a></li> 
								<li><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Publicidad_C';?>" rel="noopener noreferrer">Directorio comercial</a></li>
								<li><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Obituario_C';?>" rel="noopener noreferrer">Obituario</a></li>
								<li><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Menu_C/afiliacion';?>" rel="noopener noreferrer">Tarifas</a></li>
								<li><a class="header__li--Enlaces" href="https://yaracultura.blogspot.com/" target="_blank" rel="noopener noreferrer">Blog Yaracultura</a></li>
								<hr class="hr_1">
								<li><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Contraloria_C';?>" rel="noopener noreferrer">Contraloría social</a></li>
								<li class="Default_quitarMovil"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/GaleriaArte_C';?>">Galeria de arte regional</a></li>
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Login_C/index/NA,NA';?>" rel="noopener noreferrer">Abrir sesión</a></li>
								<li><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/PodCast_C';?>" rel="noopener noreferrer">PodCast</a></li>
								
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Contraloria_C';?>" rel="noopener noreferrer">Contraloria social</a></li>
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Menu_C/afiliacion';?>" rel="noopener noreferrer">Suscribirse</a></li>
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/VitrinaMayorista_C';?>">Editorial</a></li>
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Login_C/index/CE';?>" rel="noopener noreferrer">Pod Cast</a></li>
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Login_C/index/CE';?>" rel="noopener noreferrer">Directorio</a></li>
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Ciudades_C';?>" rel="noopener noreferrer">Agenda</a></li>
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Login_C/index/CE';?>" rel="noopener noreferrer">Archivo</a></li>
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Login_C/index/CE';?>" rel="noopener noreferrer">Galeria de arte</a></li>
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Login_C/index/CE';?>" rel="noopener noreferrer">Contraloria social</a></li>
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Login_C/index/CE';?>" rel="noopener noreferrer">Efemerides</a></li>
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Login_C/index/CE';?>">Turismo</a></li>
								<!-- <hr> -->
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Login_C/index/CE';?>" rel="noopener noreferrer">Nuestro ADN</a></li>
								<li class="Default_ocultar"><a class="header__li--Enlaces" href="<?php //echo RUTA_URL . '/Login_C/index/CE';?>" rel="noopener noreferrer">LOGOS REDES SOCIALES</a></li>
							</ul>
						</div>
					</div>
				</nav>
			</div>

			<!-- BOTONES DE CLASIFICADOS Y EVENTOS -->
			<div class="cont_botones_destacados">
				<div>
					<label class="boton boton--corto"><a class="Default_font--white boton_a" href="<?php //echo RUTA_URL . '/Agenda_C';?>">Eventos</a></label> 
				</div>        
				<div>
					<label class="boton boton--corto"><a class="Default_font--white boton_a"" href="<?php //echo RUTA_URL . '/Noticias_C/NoticiasGenerales';?>">Mas noticias</a></label> 
				</div>         
				<div>
					<label class="boton boton--corto"><a class="Default_font--white boton_a"" href="<?php //echo RUTA_URL . '/ClasificadoController';?>">Clasificados</a></label> 
				</div>          
				<div>
					<label class="boton boton--corto"><a class="Default_font--white boton_a"" href="<?php //echo RUTA_URL . '/GaleriaArte_C';?>">Galeria de arte</a></label> 
				</div>      
			</div> 

			<!-- MEMBRETE FIJO -->
			<label class="header__titulo">Noticiero Yaracuy</label>

			<!-- FECHA -->
			<!-- <label class="header__fecha">San Felipe, <?php ////echo date('d');?> de <?php ////echo date('M');?></label> -->
			
			<!-- SIGUENOS REDES SOCIALES -->
            <!-- <div class="" style="display:flex; background-color:red; width: 10%"> -->
                <!-- FACEBOOK -->
                <!-- <div class="">
                    <img class="" alt="facebook" src="<?php //echo RUTA_URL?>/public/images/facebook.png"/>
                </div>         -->
                
                <!-- TWITTER -->
                <!-- <div class="">
					<img class="" alt="twitter" src="<?php //echo RUTA_URL?>/public/images/twitter.png"/>
                </div>      -->
                
                <!-- E-MAIL -->
                <!-- <div class="">
					<img style="" alt="correo" src="<?php //echo RUTA_URL . '/public/iconos/correo/outline_email_black_24dp.png'?>"/>
                </div>     -->
                
                <!-- INSTAGRAM -->
                <!-- <div class=" ">
					<img class="" alt="Whatsapp" src="<?php //echo RUTA_URL?>/public/images/Whatsapp.png"/>
                </div>     -->
                <!-- <div>
                    <p style="text-align: center; font-size: 0.7em">visita nuestras redes sociales</p>
                </div> -->
            <!-- </div> -->
			
			<!-- FECHA Y CARITA -->
			<div class="cont_header--loginFecha">
				<div style="margin-right: 15px;">
					<label class="header__fecha">San Felipe, <?php //echo date('d');?> de <?php //echo date('M');?></label>
				</div>
				
				<!--CARITA -->
				<div>
					<?php
					if(!empty($_SESSION['ID_Suscriptor'])){	?>
						<a class="Default_quitarMovil" href="<?php //echo RUTA_URL . '/Suscriptor_C/accesoSuscriptor/' . $_SESSION['ID_Suscriptor'];?>"><img class="Default_login" src="<?php //echo RUTA_URL . '/public/iconos/perfil/outline_face_6_black_24dp.png'?>"/></a>				
						<?php
					}	
					else if(empty($_SESSION['ID_Suscriptor']) AND empty($_SESSION['ID_Periodista'])){	?>
						<a class="Default_quitarMovil" href="<?php //echo RUTA_URL . '/Login_C/index/SinID_Noticia,SinBandera';?>" rel="noopener noreferrer"><img class="Default_logout" src="<?php //echo RUTA_URL . '/public/iconos/perfil/outline_face_6_black_24dp.png'?>"/></a>
						<?php
					}				
					else if(!empty($_SESSION['ID_Periodista'])){	?>
					<a class="Default_quitarMovil" href="<?php //echo RUTA_URL . '/Panel_C/portadas'?>"><img class="Default_login" src="<?php //echo RUTA_URL . '/public/iconos/perfil/outline_face_6_black_24dp.png'?>"/></a>				
						<?php
					}	
						?>
				</div>
			</div>
		</header>
		
		<!-- MEMBRETE DESPLAZANTE -->
		<div class="tapa-logo" id="Tapa_Logo">
			<!-- NUESTRO ADN-->			            
			<a class="tapa-logo--ADN--font Default_quitarMovil" href="<?php //echo RUTA_URL . '/Menu_C/nuestroADN';?>">
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
					<a class="tapa-logo--ADN--font Default_quitarMovil" href="<?php //echo RUTA_URL . '/Suscriptor_C/accesoSuscriptor/' . $_SESSION['ID_Suscriptor'];?>;?>">
						<div class="tapa-logo--ADN">
							<img style="width: 1.5em; margin-right: 5px" src="<?php //echo RUTA_URL . '/public/iconos/perfil/outline_account_circle_white_24dp.png'?>" rel="noopener noreferrer"/>Sesión 
						</div>
					</a>
					
					<a class="carita--texto Default_quitarEscritorio" href="<?php //echo RUTA_URL . '/Suscriptor_C/accesoSuscriptor/' . $_SESSION['ID_Suscriptor'];?>">Sesión <img class="Default_login--movil"  style=" margin-right: 10px" src="<?php //echo RUTA_URL . '/public/iconos/perfil/outline_account_circle_white_24dp.png'?>"/>Sesión</a>				
					<?php
				}	
				else if(empty($_SESSION['ID_Suscriptor']) AND empty($_SESSION['ID_Periodista'])){	?>     
					<a class="tapa-logo--ADN--font Default_quitarMovil" href="<?php //echo RUTA_URL . '/Login_C/index/SinID_Noticia,SinBandera';?>">
						<div class="tapa-logo--ADN">
							<img style="width: 1.5em; margin-right: 5px" src="<?php //echo RUTA_URL . '/public/iconos/perfil/outline_no_accounts_white_24dp.png'?>" rel="noopener noreferrer"/>Sesión 
						</div>
					</a>
					
					<a class="carita--texto Default_quitarEscritorio" href="<?php //echo RUTA_URL . '/Login_C/index/SinID_Noticia,SinBandera';?>" rel="noopener noreferrer"><img class="Default_logout--movil" style=" margin-right: 10px" src="<?php //echo RUTA_URL . '/public/iconos/perfil/outline_no_accounts_white_24dp.png'?>"/> Sesión</a>
					<?php
				}				
				else if(!empty($_SESSION['ID_Periodista'])){	?>
									
					<a class="tapa-logo--ADN--font Default_quitarMovil" href="<?php //echo RUTA_URL . '/Panel_C/portadas';?>">
						<div class="tapa-logo--ADN">
							<img style="width: 1.5em; margin-right: 5px" src="<?php //echo RUTA_URL . '/public/iconos/perfil/outline_account_circle_white_24dp.png'?>" rel="noopener noreferrer"/>Sesión 
						</div>
					</a>

					<a class="carita--texto Default_quitarEscritorio" href="<?php //echo RUTA_URL . '/Panel_C/portadas'?>"><img class="Default_login--movil" style=" margin-right: 10px" src="<?php //echo RUTA_URL . '/public/iconos/perfil/outline_account_circle_white_24dp.png'?>"/> Sesión</a>				
					<?php
				}	
					?>

				<!-- NUESTRO ADN-->			            
				<a class="Default_quitarEscritorio" style=" color: white; " href="<?php //echo RUTA_URL . '/Menu_C/nuestroADN';?>">
					<div class="tapa-logo--ADN" style="margin-left: -10px; margin-top: 12px">
						<img style="width: 2em; margin-lef:0px; margin-right: 5px" src="<?php //echo RUTA_URL . '/public/iconos/perfil/outline_groups_white_24dp.png'?>" rel="noopener noreferrer"/>Nuestro ADN
					</div>
				</a>
			</div>
		</div>

		<!-- FULLSCREEM -->
		<div class="Default_ocultar" id="Miimagen">	
			<!-- ICONO CERRAR -->
			<a href="<?php //echo RUTA_URL ;?>/Inicio_C"><img class="cont_modal--cerrar Default_pointer" style="width: 1em;" src="<?php //echo RUTA_URL . '/public/iconos/cerrar/outline_cancel_black_24dp.png'?>"/></a>

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
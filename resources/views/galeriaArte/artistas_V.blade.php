@extends('layouts.partiers.header_Artista')

@section('titulo', 'Artista')

@section('contenido')

	<!-- CARGA SDK FONTAWESONE PARA ICONOS DE REDES SOCIALES se uso esta libreria porque los iconos no tienen fondo-->
	<script src="https://kit.fontawesome.com/2d6db4c67d.js" crossorigin="anonymous"></script>

	<div style="display: flex; min-height: 100vh;" id="Obra">	
		
		<!-- TEXTO VERTICAL -->
		<div class="cont_artista--vertical">

			<div style="flex-grow: 1; flex-shrink: 1;">

				<!-- FLECHA REGRESAR -->
				<div> 
					<a class="cont_artista--icono" href="{{ route('GaleriaArte') }}"><img src="{{ asset('/iconos/flecha/outline_arrow_back_white_24dp.png') }}"/></a>
				</div>

				<!-- NOMBRE ARTISTA -->
				<div>
					<p class="cont_artista--textoVertical Default--textoVertical" id="DescripcionArtista">{{ $datosArtistas->nombreSuscriptor . ' ' . $datosArtistas->apellidoSuscriptor }}</p>
				</div>
			</div>

			<!-- UBICACION ARTISTA -->
			<div>
				<p class="cont_artista--textoVertical--2 Default--textoVertical">{{ $datosArtistas->estadoSuscriptor . ' - ' . $datosArtistas->paisSuscriptor }}</p>
			</div>

			<!-- COMPARTIR REDES SOCIALES -->
			<div class="cont_artista--redesSociales cont_artista--margin">
				<!-- FACEBOOK -->
				<div class="cont_catalogos--iconos">
					<a href="https://www.facebook.com/sharer/sharer.php?u=<?php //echo RUTA_URL;?>/GaleriaArte_C/artistas/<?php //echo $Datos['datosArtistas']['ID_Suscriptor']?>" target="_blank"><i class="fa-brands fa-facebook-f fa-sm catalogo-RS" style="color: rgba(255, 255, 255, 0.5)"></i></a>
				</div>        
				
				<!-- TWITTER -->
				<div class="cont_catalogos--iconos">
					<a href="https://twitter.com/intent/tweet?url=<?php //echo RUTA_URL;?>/GaleriaArte_C/artistas/<?php //echo $Datos['datosArtistas']['ID_Suscriptor']?>" target="_blank"><i class="fa-brands fa-twitter catalogo-RS" style="color: rgba(255, 255, 255, 0.5)"></i></a>
				</div>     
				
				<!-- E-MAIL -->
				<div class="cont_catalogos--iconos">
					<a href="#" target="_blank"><i class="fa-regular fa-envelope catalogo-RS" style="color: rgba(255, 255, 255, 0.5)"></i></a>
				</div>      
				
				<!-- WHATSAPP -->
				<div class="whatsapp cont_catalogos--iconos">
					<a href="whatsapp://send?text=Portafolio de obras <?php //echo $Datos['datosArtistas']['nombreSuscriptor'] . ' ' . $Datos['datosArtistas']['apellidoSuscriptor']?>&nbsp;<?php //echo RUTA_URL?>/GaleriaArte_C/artistas/<?php //echo $Datos['datosArtistas']['ID_Suscriptor']?>" data-action="share/whatsapp/share"><i class="fa-brands fa-whatsapp catalogo-RS WHhatsApp-catalogo" style="color: rgba(255, 255, 255, 0.5)"></i></a>
				</div>    
				<div>
					<p style="text-align: center; font-size: 0.7em; color: rgba(255, 255, 255, 0.5)">Compartir</p>
				</div>
			</div> 
		</div>

		<!-- OBRAS CON LAZYLOAD -->
		<div class="cont_obras" id="ContObras">
			<div class="cont_galeria cont_galeria--obras" id="Cont_obras--mosaico">
				@foreach($obraArtista as $Row)
					@if($Row->ID_Suscriptor == $datosArtistas->ID_Suscriptor)
						<div class="cont_Galeria--item efectoZoom">
							<figure>
							<img class="cont_Galeria--img lazyload borde_1 imagen_2--JS efectoBrillo efectoZoom--imagen" name="imagenNoticia" alt="Fotografia Obra" data-src="{{ asset('/images/galeria/' . $Row->ID_Suscriptor . '_' . $datosArtistas->nombreSuscriptor. '_' . $datosArtistas->apellidoSuscriptor . '/' . $Row->imagenObra) }}" id="{{ $Row->ID_Obra }}" loading="lazy" width="320" height="10"/>
							</figure>
						</div> 
					@endif
				@endforeach
			</div>
		</div>
	</div>

<!-- DESCRIPCION DEL ARTISTA -->
<div class="cont_descripcionArtista" id="VerArtista">
	<div class="cont_descripcionArtista--titulo">
		<img class="cont_artista--icono Default_pointer" id="Cerrar" src="{{ asset('/iconos/flecha/outline_arrow_back_white_24dp.png') }}"/>

		<p class="cont_artista--textoVertical Default--textoVertical"id="DescripcionArtista"><?php //echo $Datos['datosArtistas']['nombreSuscriptor'] . ' ' . $Datos['datosArtistas']['apellidoSuscriptor'];?></p>
	</div>
	<div style="text-align: center">
		<figure>
			<img class="cont_descripcionArtista--img" alt="Fotografia Artista" src="<?php //echo RUTA_URL?>/public/images/galeria/<?php //echo $Row['ID_Suscriptor'];?>_<?php //echo $Datos['datosArtistas']['nombreSuscriptor'];?>_<?php //echo $Datos['datosArtistas']['apellidoSuscriptor'];?>/perfil/<?php //echo $Datos['datosArtistas']['nombre_imagenPortafolio'];?>" />
		</figure>
	</div>
	<div class="cont_descripcionArtista--descripcion">
		<p style="color:white">Why do we use it?</p>
		<p style="color:white">VICTORIA PATRICIA PROAÑO TOVAR
           Artista multimedia
Videoartista, ilustradora, Pintura e instalación
https://www.instagram.com/vicpaty13/?hl=es

Fue docente en la Escuela de artes aplicadas Carmelo Fernández de San Felipe, ha compartido su investigación a través de Talleres y charlas en Escuelas y Universidades como la Escuela de Diseño y Turismo de la UNEY.

Cortometrajes- videoarte- Documental

Cátedra libre Maria Lionza, Mito y Devoción, Archivo Regional del Folklore del Estado Yaracuy  2022

La lengua del órgano, Biología de las creencias del estado Yaracuy, IUTY –UNEY, 2019-2022.
Festival in situ Francia 2020, Eglise Bazancourt, Petroglifos en algoritmo  

María lionza Una deessa en movimiento museu etnologic I del cultures del mom de Barcelona, España. 2021 

Festival de video arte Camagüey 2013 Habana Cuba. 2013

Festival internacional de arte independiente incubarte,  Entre la luz  Valencia. España 2012   

Festival  de cine andaluz y del Mediterraneo., Archidona, Málaga, España 2013 Festival Videt .

Fiva festival internacional de videoarte/noviembre 2012, Buenos Aires, Argentina.
 
Madatac IV edición muestra de artes digitales audiovisuales y tecnologías avanzadas contemporáneas Madrid  2012.

Festival internacional de arte independiente incubarte,  Entre la luz  valencia. España  2012.     

Participación Documental de Maria lionza y su diversidad cultural  antropología audiovisual de la filmografía: chansons d’un été à clamecy (2004) les coulissesde sorte (2006). Francia
             
                Exposición individual
Muestra individual, criaturas onzas en la Embajada Francesa de Maracay 2022
Criaturas femeninas onzas 2022, sala 04 Museo Carmelo Fernández
Imaginario trasmutado, sala 01 museo Carmelo Fernández, agosto del 2009
         
              
Premio II lugar “salón Yaracuy” 7° Edición  bicentenario de la batalla de Carabobo
II lugar, premio Cirilo Mendoza. Salón regional Edgar Giménez Peraza.
III premio CONAC, D.G.S artes visuales y museo, XIII salon Carmelo Fernández.
Mención de honor en el salón Yaracuy museo Carmelo Fernández 2011 única edición San Felipe Edo Yaracuy

                Exposiciones colectivas 
Festival de arte corporal, sueños en la piel, Colectivo entre Locos 2022
Festival #insitu Bazancourt, municipio francés situado en el departamento de oise en la región de hauts en francia 2021
Exposición virtual, "pleural del tiempo" 2021
museo carmelo fernández
www.museocarmelofernandez.weebly.com
 
Arte sonoro, mujer ojos de agua, museo Carmelo Fernández 2020
Encuentro de lunas y entrega del agua sagrada de la naciente de Naiguatá a la mujer tambor de la escuela de herencia, en la patana, Teresa Carreño 2019.
Colectivo tres potencias museo Carmelo Fernández .
Exposición Colectiva Entre Locos, Museo de Coro, 2010
Velada de santa lucia, Maracaibo estado Zulia 2010-2009
4º salón regional de artes visuales Edgar Giménez Peraza, museo Carmelo Fernández, marzo 2007.
MaríA lionza diversidad cultural, museo Carmelo Fernández octubre 2006
Exposición anual colegios de médicos del estado yaracuy, marzo del 2006
Certamen mayor de las artes, museo Sofía Imber, caracas 2006
María lionza códigos de arte y culto, museo Jacobo Borges, Caracas septiembre 2005
María lionza Dialogo en Aroa, ateneo de Aroa agosto 2002
XII  salón de artes visuales Carmelo Fernández noviembre 2002
ExpressunLliber azul, exposición colectiva, Casa dela cultura de la Habana  vieja Cuba septiembre 2002.
XIII  salón de artes visuales Carmelo Fernández noviembre 2003
II Muestra de artes visuales Sanare, casa de la cultura José Nemesio, noviembre del 2002.
Terreno de lo imaginario, Ateneo de Aroa, municipio Bolívar  2000
9ª Analógica Philips art expression, jovenes talentos, sala de conferencia de la Torre Philips, caracas Venezuela.
III salón anual de arte ecológico, 2000, galeria de arte de niños cantores. noviembre 2000
II salon anual de arte ecológico, museo de Barquisimeto, noviembre 1999
Exposición colectiva nuevos horizontes en la escuela de arte Arturo Michelena, Valencia Edo Carabobo 1997
Arte textil en la red de galería de arte, estado Yaracuy el 24 de noviembre del 2011
Colectivo en la universidad nacional abierta  del estado Yaracuy el 28 de noviembre del 2011
Exposición colectiva nuevos horizontes en la escuela Martín Tovar y Tovar Barquisimeto Edo Lara 1997
Talento joven, museo Carmelo Fernández san Felipe Edo Yaracuy 1996.</p>
	</div>
</div>

	<script src="{{ asset('/js/funcionesVarias.js?v='. rand()) }}"></script>
	<script src="{{ asset('/js/E_Artista.js?v=' . rand()) }}"></script>  

	<!-- Script para evaluar si el navegador soporta lazy-load -->
	<script>
		if ('loading' in HTMLImageElement.prototype){  
			// Si el navegador soporta lazy-load, tomamos todas las imágenes que tienen la clase
			// `lazyload`, obtenemos el valor de su atributo `data-data-src` y lo inyectamos en el `data-src`.
			const images = document.querySelectorAll("img.lazyload");
			images.forEach(img => {
				img.src = img.dataset.src;
			});
		} 
		else {     
			// Importamos dinámicamente la libreria `lazysizes`
			let script = document.createElement("script");
			script.async = true; 
			script.src="https://cdn.jsdelivr.net/npm/lazysizes@5.3.2/lazysizes.min.js";
			// script.src = "https://cdnjs.cloudflare.com/ajax/libs/lazysizes/5.3.0/lazysizes.min.js";
			document.body.appendChild(script);
		}
	</script>
@endsection()
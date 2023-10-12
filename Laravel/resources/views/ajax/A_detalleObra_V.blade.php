<!-- Archivo llamado via AJAX por medio de la función Llamar_detalleObra() ubicada en detalleObra_V.php reemplaza el contenido del div id="Imagen_Detalle"-->
<?php
	if(!empty($ultimoID_Obra->ID_Obra)){ //cuando llega a la primera obra y muestra nuevamente la ultima	
		$ID_MostrarObra = $ultimoID_Obra->ID_Obra;	
		$NombreImgObra = $ultimoID_Obra->imagenObra;

		if($ultimoID_Obra->disponible){	?>
			<!-- <label class="disponible disponible--true" onclick="Llamar_carrito()">disponible</label> -->
			<?php
		}
		else{	
			?>
			<!-- <label class="disponible"></label> -->
			<?php
		}	
	}
	else if(!empty($primerID_Obra->ID_Obra)){ //cuando llega a la ultima cuobraadro y muestra nuevamente el primero		
		$ID_MostrarObra = $primerID_Obra->ID_Obra;	
		$NombreImgObra = $primerID_Obra->imagenObra;

		if($primerID_Obra->disponible){	?>
			<!-- <label class="disponible disponible--true" onclick="Llamar_carrito()">disponible</label> -->
			<?php
		}
		else{	?>
			<!-- <label class="disponible" ></label> -->
			<?php
		}	
	}
	else{//Cuando se encuantra entre los cuadros intermedios (Entre el primero y el ultimo)
		$ID_MostrarObra = $diapositivaObra->ID_Obra;
		$NombreImgObra= $diapositivaObra->imagenObra;
		
		if($diapositivaObra->disponible == 1){	
			$NombreImgObra = $diapositivaObra->imagenObra;
			$Nombre_Obra = $diapositivaObra->nombreObra;
			$Tecnica_Obra = $diapositivaObra->tecnicaObra;
			$Medida_Obra = $diapositivaObra->medidaObra;	?>
			<!-- <label class="disponible disponible--true" onclick="Llamar_carrito('<?php //echo $artista']['ID_Suscriptor'];?>','<?php //echo $artista']['nombreSuscriptor'];?>','<?php //echo $artista']['apellidoSuscriptor'];?>','<?php //echo $NombreImgObra?>','<?php //echo $Nombre_Obra?>','<?php //echo $Tecnica_Obra?>','<?php //echo $Medida_Obra?>')">disponible</label> -->
			<?php
		}
		else{	?>
			<!-- <label class="disponible"></label> -->
			<?php
		}	
	}
?>
<div class="carta-box"> 
	<div class="carta" id="Carta">
		<!-- LADO FRONTAL DE TARJETA -->
		<div class="cont_ObraDetalle cara" id="Cont_PinturaDetalle">

			<!-- IMAGEN OBRA -->
			<div class="cont_ObraDetalle--img" id="Imagen_Detalle">
				<img class="imagen_3" src="{{ asset('/images/galeria/' . $artista->ID_Artista . '_' . $artista->nombreArtista . '_' . $artista->apellidoArtista . '/' . $diapositivaObra->imagenObra) }}"/>
			</div>
			<div class="cont_ObraDetalle--iconos">
			
				<!-- FLECHA DE RETROCESO -->
				<img class="Default_pointer cont_ObraDetalle--iconoLeft" onclick="Llamar_detalleObra('{{ route('DiapositivaObra', ['id_obra' => $ID_MostrarObra, 'id_artista' => $artista->ID_Artista, 'posicion' => 'Retroceder']) }}')" src="{{ asset('/iconos/chevron/outline_arrow_back_ios_white_24dp.png') }}"/>

				<!-- BOTON DE GIRO-->
				<img class="cont_ObraDetalle--giro Default_pointer Default_quitarEscritorio" onclick="AtrasTarjeta('Cont_PinturaDetalle')" src="{{ asset('/iconos/giro/outline_switch_right_black_24dp.png') }}"/>

				<!-- FLECHA DE AVANCE -->
				<img class="Default_pointer cont_ObraDetalle--iconoRight" onclick="Llamar_detalleObra('{{ route('DiapositivaObra', ['id_obra' => $ID_MostrarObra, 'id_artista' => $artista->ID_Artista, 'posicion' => 'Avanzar']) }}')" src="{{ asset('/iconos/chevron/outline_arrow_forward_ios_white_24dp.png') }}"/>
			</div>
		</div>

		<!-- LADO POSTERIOR DE TARJETA -->
		<div class="cont_ObraDetalle--atras cara detras">
			<div class="cont_ObraDetalle--atras-1">		
				<h1 class="cont_ObraDetalle--h1">{{ $diapositivaObra->nombreObra }}</h1>
				<p class="cont_ObraDetalle--p1"><b>Autor: &nbsp;</b> {{ $artista->nombreArtista }} {{ $artista->apellidoArtista }}</p>
				<p class="cont_ObraDetalle--p1"><b>Año: &nbsp;</b> {{ $diapositivaObra->anioObra }}</p>
				<p class="cont_ObraDetalle--p1"><b>Dimensiones: &nbsp;</b> {{ $diapositivaObra->medidaObra }}/p> 
				<p class="cont_ObraDetalle--p1"><b>Tecnica: &nbsp;</b> {{ $diapositivaObra->tecnicaObra }}</p> 
				<p class="cont_ObraDetalle--p1"><b>Colección: &nbsp;</b> {{ $diapositivaObra->coleccionObra }}</p> 
				<p class="cont_ObraDetalle--p1"><b>Descripción: &nbsp;</b> {{ $diapositivaObra->descripcionObra }}</p> 
				<p class="cont_ObraDetalle--p1"><b>Precio: &nbsp;</b> {{ $diapositivaObra->precioDolarObra }}</p> 
				<p class="cont_ObraDetalle--p1"><b>Factura: &nbsp;</b> Si</p> 
				<label class="boton boton--marg">Comprar</label> 
			</div>

			<!-- BOTON DE GIRO-->
			<div>		
				<img class="cont_ObraDetalle--giro Default_pointer Default_quitarEscritorio" onclick="FrenteTarjeta('Cont_PinturaDetalle')" src="{{ asset('/iconos/giro/outline_switch_right_black_24dp.png') }}"/>
			</div>
		</div>
	</div>
</div>
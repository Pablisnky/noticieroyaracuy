	//Muestra el sitio web en pantalla completa
	var imagen = document.getElementById("Miimagen");
	
	function getFullscreen(element){
		// console.log("FullScreem imagen: ", element)

		if(element.requestFullscreen) {
			element.requestFullscreen();
		} 
		else if(element.mozRequestFullScreen) {
			element.mozRequestFullScreen();
		} 
		else if(element.webkitRequestFullscreen) {
			element.webkitRequestFullscreen();
		} 
		else if(element.msRequestFullscreen) {
			element.msRequestFullscreen();
		}
	}

	if(document.getElementById("Abrir")){
		document.getElementById("Abrir").addEventListener("click", function(){//E= el id dela fotografia donde se hizo click  DOMContentLoaded
			getFullscreen(imagen);
		},false);
	}
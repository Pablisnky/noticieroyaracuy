//Voltea la tarjeta de tiendas para mostrar el reverso
function AtrasTarjeta(){ 
    // document.getElementById(ID_Tienda).style.transform = "rotateY(180deg)" //Gira la tarjeta
    // document.getElementById(ID_Tienda).style.transformStyle = "preserve-3d" //Voltea para poder leer el lado de atras cuando se pase al frente
    // document.getElementById(ID_Tienda).style.transition = ".5s ease" 
    // document.getElementById(ID_Tienda).style.perspective = "600px"

    document.getElementById("Carta").style.transform = "rotateY(180deg)"
    document.getElementById("Carta").style.transformStyle = "preserve-3d"
    document.getElementById("Carta").style.transition = ".5s ease" 
    document.getElementById("Carta").style.perspective = "600px"
    // document.getElementById(ID_Tienda).classList.add('giro') 
    // document.getElementById("Carta").classList.add('giro') 
}

//************************************************************************************************
//Voltea la tarjeta para mostrar nuevamente el frente
function FrenteTarjeta(){ 
    document.getElementById("Carta").style.transform = "rotateY(0deg)"
    document.getElementById("Carta").style.transformStyle = "preserve-3d"
    document.getElementById("Carta").style.transform = ".5s ease"
    document.getElementById("Carta").style.transformStyle = "600px"
   
    // document.getElementById(ID_Tienda).style.transform = "rotateY(0deg)"; //Gira la tarjeta
    // document.getElementById(ID_Tienda).style.transformStyle = "preserve-3d"; //Voltae para poder leer el lado de atras cuando se pase al frente
    // document.getElementById(ID_Tienda).style.transition = ".5s ease";
    // document.getElementById(ID_Tienda).style.perspective = "600px";
}
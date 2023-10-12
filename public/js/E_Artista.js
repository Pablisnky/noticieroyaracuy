document.getElementById("DescripcionArtista").addEventListener('mouseover', mostrarDescripcionArtista, false)
document.getElementById("Cerrar").addEventListener('click', ocultarDescripcionArtista, false)

//Por medio de funcion autoejecutable se svalua si el carrito de compras esta cargado
// (function(){ 
//     if(localStorage.getItem('ContenidoCarrito')){
//         //Se crea el elemento que contendra el nombre del proyecto 
//         var Nombre_Proyect = document.createElement("label")

//         // Se añaden propiedades al elemento creado
//         Nombre_Proyect.innerHTML = 1 
//         Nombre_Proyect.style.color = "white;"
//         // Nombre_Proyect.classList.add("label_2")
        
//         //Se especifica el elemento donde se va a insertar el nuevo elemento
//         var ElementoPadreTarjetaFrontal = document.getElementById("Carrito")
        
//         //Se especifica la posicón donde se inerta el nuevo elemento
//         ElementoPadreTarjetaFrontal.appendChild(Nombre_Proyect)
//     }
// })();

//************************************************************************************************
//Por medio de delegación de eventos se detectan los item del submenu para oculatrlo al hacer click
// document.getElementById("MenuContenedor").addEventListener('click', function(e){
//     if(e.target.classList[2] == "enlace_JS"){
//         var ID_Elemento = e.target
//         console.log(ID_Elemento)
//         document.getElementById("MenuContenedor_3").style.visibility = "hidden"
//         document.getElementById("MenuContenedor_4").style.visibility = "hidden"
//     }
// }, false)

//************************************************************************************************
//Por medio de delegación de eventos se detecta click en una pintura para ver sus detalles
document.getElementById("Cont_obras--mosaico").addEventListener('click', function(e){
    // console.log("______Desde Cont_obras--mosaico()______")
    
    if(e.target.classList[3] == "imagen_2--JS"){
        var ID_Obra = e.target.id
        // console.log("ID_Obra", ID_Obra)
        
        // remoto
        // window.location.replace("https://www.noticieroyaracuy.com/galeriaArte/obras/" + ID_Obra);
        
        // local
        window.location.replace("http://localhost/proyectos/nuevoNoticiero/public/galeriaArte/obras/" + ID_Obra);
    }
}, false)

//************************************************************************************************
function mostrarDescripcionArtista(){        
    // if(document.getElementById("VerArtista").style.marginLeft = "-100%"){
        // e.stopPropagation();
        document.getElementById("VerArtista").style.marginLeft = "0%"
        // document.getElementById("VerArtista").style.transition =  "0.5s";
        // document.getElementById("VerArtista").classList.add('mostrarArtista')
        // document.getElementById("VerArtista").classList.remove('ocultarArtista')
    // }
}

//************************************************************************************************
function ocultarDescripcionArtista(){   
    // if(document.getElementById("VerArtista").style.marginLeft = "4%"){
        // document.getElementById("VerArtista").classList.remove('mostrarArtista')
        // document.getElementById("VerArtista").classList.add('ocultarArtista')

        document.getElementById("VerArtista").style.marginLeft = "-100%"
        // document.getElementById("VerArtista").style.transition =  "0.5s";
        // document.getElementById("VerArtista").style.backgroundColor = "red"
        //Se detiene la propagación de los eventos en caso de hacer click en un elemento que contenga algun evento
        // e.stopPropagation();
    // } 
}
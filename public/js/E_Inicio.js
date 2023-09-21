// document.getElementById("Mostrar_Promocion").addEventListener('click', MostrarPromocion, false)

// document.getElementById("CerrarVentana").addEventListener('click', function(){CerrarModal('VentanaModal')}, false)
//************************************************************************************************
//Función autoejecuble que muestra la ventana modal automatica inicial
var VentanaModal = (function(){ 
    setTimeout(function(){mostrarModal();}, 100)
})();

//************************************************************************************************ 
//obtiendo informacion del DOM para identificar el elemento donde se hizo click 
    // window.addEventListener("click", function(e){   
    //     var click = e.target
    //     console.log("Se hizo click en: ", click)
    // }, false)

//************************************************************************************************ 
    function MostrarPromocion(){
        document.getElementById("MiVideo").style.display = "block" 
        document.getElementById("Promocion").style.display = "block" 
        // window.location.reload();
    }

//************************************************************************************************
    function mostrarModal(){        
        document.getElementById("VentanaModal").classList.add("mostrarModal")
    }   

//************************************************************************************************
    function CerrarModal(id){
        // console.log("______Desde CerrarModal()______", id)
        document.getElementById(id).style.display = "none"
    }

//************************************************************************************************ 
    //oculta el boton de mostrar video promconal
    function retrasaOcultar_Boton(){
        document.getElementById("Mostrar_Promocion").classList.remove("BotonPromocion--mostrar")
        document.getElementById("Mostrar_Promocion").classList.add("BotonPromocion--ocultar")
    }
    

//************************************************************************************************
    //oculta el boton de mostrar video promconal
    function retrasaMostar_Boton(){
        document.getElementById("Mostrar_Promocion").classList.remove("BotonPromocion--ocultar")
        document.getElementById("Mostrar_Promocion").classList.add("BotonPromocion--mostrar")
    }

//************************************************************************************************   
   window.pausar = function(){
        document.getElementById("VideoPromocion").pause();
        document.getElementById("MiVideo").style.display = "none"
    };

//************************************************************************************************
// Realiza el scroll a pantalla completa utilizando la API "IntersectionObserver"
const sections = [...document.querySelectorAll("section")];

let options = {
    rootMargin: "0px",
    threshold: 0.8,
};

const callback = (entries, observer) => {
    entries.forEach((entry) => {
        const { target } = entry;

        if (entry.intersectionRatio >= 0.1) {
            target.classList.add("is-visible");
        } 
        else{
            target.classList.remove("is-visible");
        }
    });
};

//1.- Se instancia un objetao de la clase "IntersectionObserver"
const observer = new IntersectionObserver(callback, options);

sections.forEach((section, index) => {
    const sectionChildren = [...section.querySelector("[data-content]").children];

    sectionChildren.forEach((el, index) => {
        el.style.setProperty("--delay", `${index * 250}ms`);
    });

    observer.observe(section);
});

//************************************************************************************************






//saber posicion del scrool vertical
// window.onscroll = function() {
//     var y = window.scrollY;
//     document.getElementById('y').innerText = y;
//     console.log(y);
//   };


//Se detecta si se sube o se baja en la busqueda de noticia (Se usa cuando existian las flechas, tenia la ventaja de que era noticia a noticia)
// window.addEventListener('click', function(e){
//     console.log("______Desde Slider vertical noticias______", e)
    
//     let Noticias = document.getElementsByClassName('flecha_Arriba_JS')
//     // console.log("🚀 ~ file: E_Inicio.js:120 ~ window.addEventListener ~ F:", F)

//     var ElementoSeleccionado = e.target.id
//     console.log(ElementoSeleccionado)

//     CantidadNoticias = Noticias.length
//     for(let i = 0; i<CantidadNoticias; i++){ 
//         // if(CantidadNoticias != ElementoSeleccionado){
    
//             var CLaseElementoSeleccionado = e.target.classList[1]
            
//             if(CLaseElementoSeleccionado == "flecha_Arriba_JS"){
                
//                 // Se consulta la distancia en px desde el top de la pantalla hasta el borde superior de cada sección
//                 // let Prueba = document.getElementById(ElementoSeleccionado).offsetTop;
//                 // console.log("🚀 ~ file: E_Inicio.js:120 ~ NoticiaArriba ~ Prueba:", Prueba)
                
//                 // let T = document.getElementById(ElementoSeleccionado).getBoundingClientRect().top
//                 // console.log("🚀 ~ file: E_Inicio.js:121 ~ NoticiaArriba ~ T:", T)
                
//                 let A = document.getElementById(ElementoSeleccionado).parentElement
//                 // console.log("🚀 ~ file: E_Inicio.js:122 ~ NoticiaArriba ~ A:", A)

//                 let B = A.parentElement
//                 // console.log("🚀 ~ file: E_Inicio.js:139 ~ window.addEventListener ~ B:", B)
                
//                 let C = B.parentElement
//                 // console.log("🚀 ~ file: E_Inicio.js:139 ~ window.addEventListener ~ B:", C)

//                 let D = parseInt(ElementoSeleccionado) + 1
//                 // console.log("🚀 ~ file: E_Inicio.js:152 ~ window.addEventListener ~ D:", D)

//                 //Se obtiene el icono de la proxima noticia que se quiere mostrar en pantalla
//                 let IconoNotiiciaMostrar = document.getElementById(D)

//                 //Se procede a buscar el DIV padre de la noticia
//                 let A_I = IconoNotiiciaMostrar.parentElement
//                 let A_II = A_I.parentElement
//                 let A_III = A_II.parentElement

//                 let ID_ElementoSUbir = A_III.id

//                 window.scroll(0, Position(document.getElementById(ID_ElementoSUbir)))
//                 function Position(obj){
//                     var currenttop = -50;// aqui s 60 px que hay que bajar el div que contiene la noticia, para que el membrete y el menu hambuerguesa no tape parte de la fotografia
//                     if(obj.offsetParent){
//                         do{
//                             currenttop += obj.offsetTop;
//                         }
//                         while((obj = obj.offsetParent));
//                             return [currenttop];
//                     }
//                 }
//             }  
//             else if(CLaseElementoSeleccionado == "flecha_Abajo_JS"){
                
//                 let A = document.getElementById(ElementoSeleccionado).parentElement

//                 let B = A.parentElement
                
//                 let C = B.parentElement

//                 let D = parseInt(ElementoSeleccionado) - 1

//                 //Se obtiene el icono de la proxima noticia que se quiere mostrar en pantalla
//                 let IconoNotiiciaMostrar = document.getElementById(D)

//                 //Se procede a buscar el DIV padre de la noticia
//                 let A_I = IconoNotiiciaMostrar.parentElement
//                 let A_II = A_I.parentElement
//                 let A_III = A_II.parentElement

//                 let ID_ElementoSUbir = A_III.id

//                 window.scroll(0, Position(document.getElementById(ID_ElementoSUbir)))
//                 function Position(obj){
//                     var currentBottom = -50;// aqui s 60 px que hay que bajar el div que contiene la noticia, para que el membrete y el menu hambuerguesa no tape parte de la fotografia
//                     if (obj.offsetParent){
//                     console.log("🚀 ~ file: E_Inicio.js:202 ~ Position ~ obj.offsetParent:", obj.offsetParent)
//                     do{
//                         currentBottom -= obj.offsetTop;
//                     }
//                     while ((obj = obj.offsetParent));
//                     return [currentBottom];
//                     }
//                 }
//             }
//     }    
// }, false) 
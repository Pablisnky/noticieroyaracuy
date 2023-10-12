// document.getElementById("Municipios").addEventListener('click',MostrarMunicipios, false)

//************************************************************************************************
//Cuando se carga el archivo le da valor false a "statu", solo la primera vez luego el valor cambia al llamar la funcion
var statu = false 
function MostrarMunicipios(seccion){       
    console.log("______Desde MostrarMunicipios()______", statu + ',' + seccion)
    
    if(statu == true){
        document.getElementById("Con_Municipios").classList.remove("mostrar_1");        
        statu = false
    }
    else{
        document.getElementById("Con_Municipios").classList.add("mostrar_1");
        statu = true
    }

    localStorage.setItem('LS_Seccion', seccion)
    document.getElementById('NombreSeccion').innerText = "Sección " + localStorage.getItem('LS_Seccion')
}

//************************************************************************************************
//Cuando se carga el archivo le da valor false a "statu", solo la primera vez luego el valor cambia al llamar la funcion
var statu_2 = false 
function MostrarSecciones(seccion_2){       
    console.log("______Desde MostrarSecciones()______", statu_2 + ',' + seccion_2)
    
    if(statu_2 == true){
        document.getElementById("Con_Secciones").classList.remove("mostrar_1");        
        statu_2 = false
        
    }
    else{
        document.getElementById("Con_Secciones").classList.add("mostrar_1");
        statu_2 = true
    }
}

//************************************************************************************************
//
function Mostrar_Seccion(S){       
    // console.log("______Desde MostrarSeccion()______", S)

    document.getElementById("Con_Secciones").classList.remove("mostrar_1");        
    statu_2 = false
    
        //Coloca el curso en el ancla
        document.getElementById(S).style.backgroundColor = "blue"
        // document.getElementById(S).location.href = '#'+tag
        // document.
}
function jumpto(anchor){
    window.location.href = "#"+anchor;
}

//  document.getElementById("Con_Secciones").addEventListener("click", function(e){
      
//     var click = e.target.id
//         console.log("Se hizo click en: ", click)
    
//     });  

//************************************************************************************************
//
function regresaSeccion(seccion){       
    // console.log("______Desde regresaSeccion()______", seccion)

    document.getElementById(seccion).scroll({
        left: 0,
        behavior: 'smooth'
      });    
}
// window.addEventListener("click", function(e){   
//     var click = e.target
//     console.log("Se hizo click en: ", click)
// }, false)

// var scrollLeft, scrollTop;
// ELement = localStorage.getItem('LS_Click')
// console.log(Element)

// document.getElementById(ELement).addEventListener("scroll",function(e){
//     if (scrollLeft !== document.getElementById(ELement).scrollLeft) {
//         console.log("horizontally scrolled")

//         scrollLeft = document.getElementById(ELement).scrollLeft;
//     }

//     if (scrollTop !== document.getElementById(ELement).scrollTop) {
//         console.log("vertically scrolled")

//         scrollTop = document.getElementById(ELement).scrollTop;
//     }


    //Se consulta la distancia en px desde el top de la pantalla hasta el borde superior de cada sección
    // let ProfundidadScroll = document.getElementsByClassName('seccion_JS')
    // console.log(ProfundidadScroll)
    // console.log(ProfundidadScroll.length)
    // //Se recorren las opciones del producto     e.target !== this
    // for(let i = 0; i < ProfundidadScroll.length; i++){
    //     console.log(ProfundidadScroll[i])
    // }
    
    // Click = e.target
    // console.log('Click', Click)
    // let A = ProfundidadImagen_2.getBoundingClientRect().top
    // console.log("A= ", A)
    
    // localStorage.setItem('LS_Seccion',seccion)
// });  
    

// Por medio de delegación de eventos en div 
// document.querySelectorAll('seccion_JS').addEventListener('click', function(event){ 
//     console.log("______Desde DE--contenedor municipios______")

    

// }, false); 
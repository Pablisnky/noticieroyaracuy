document.getElementById("Label_5").addEventListener('click', clonarSeccion, false)
    
//************************************************************************************************
//CLONA UNA SECCION
//Añade un nuevo input clonado del div secciones
var incrementoSeccion = 1
function clonarSeccion(){
    // console.log("______Desde CrearSección()______")
    
    //Contenedor a clonar 
    let clonar = document.getElementById("Contenedor_80A")
    // console.log("div a clonar", clonar)
    
    //Contenedor padre
    let Padre = document.getElementById("Contenedor_79")
    // console.log("div padre", Padre)

    //Se crea el clon
    let Div_clon = clonar.cloneNode(true)
    // console.log("div clon", Div_clon)

    //Se da una clase (Al parecer no hace ninguna función, pero se elimina y no hace el clon)
    Div_clon.classList = "contenedorUnico"

    //Se da un ID al input que se encuentra en el nuevo elemento clonado, el valor del id debe ser concecutivo a los que ya existan
    let SeccionesExistentes = document.getElementsByClassName("input_12")
    // console.log("Secciones Existentes", SeccionesExistentes.length)
    CantidadID_Existente = SeccionesExistentes.length
    incrementoSeccion = CantidadID_Existente + 1

    Div_clon.getElementsByClassName("input_12")[0].id = 'InputClon_' + incrementoSeccion 
    
    //Se da un name al input que se encuentra en el nuevo elemento clonado
    Div_clon.getElementsByClassName("input_12")[0].name = "seccion[]" 
            
    //El valor del nuevo input debe estar vacio
    Div_clon.getElementsByClassName("input_12")[0].value = "" 

    //El placeholder del nuevo input 
    Div_clon.getElementsByClassName("input_12")[0].placeholder="Indica una sección"

    // Se añade estilos al input dentro del nuevo elemento
    // Div_clon.getElementsByClassName("input_12")[0].classList.add('login_cont--label') 
        
    //Se especifica el div padre, donde se insertará el nuevo nodo (aparecerá de ultimo)
    Padre.appendChild(Div_clon)
    incrementoSeccion++
} 

//************************************************************************************************ 
//ELIMINAR SECCIONES 
//Por medio de delegación de eventos se detecta la sección a eliminar
document.getElementById("Contenedor_79").addEventListener('click', function(e){
    // console.log("______Desde eliminar secciones______")

    var ElementoSeleccionado = e.target.classList[2]
    // console.log(ElementoSeleccionado)

    //Se ubica el id de BD del elemento seleccionado
    let ID_Seccion = e.target.id
    // console.log("ID_Seccion a eliminar= ", ID_Seccion)

    if(ElementoSeleccionado == "span_14_js"){
        let ConfirmaEliminar = confirm("Se eliminará la sección y todos sus productos")

        if(ConfirmaEliminar == true){            
            //Contenedor padre de secciones
            let PadreSecciones = document.getElementById("Contenedor_79")
            // console.log(PadreSecciones.childElementCount)

            //Si hay más de una sección la elimina, si solo hay una, borrar el contenido del input
            if(PadreSecciones.childElementCount > 4){
                // Se obtiene el elemento que se quieren eliminar
                let current_a = e.target.parentElement
                let elementoEliminar = current_a.parentElement
                // console.log("ELemento a eliminar", elementoEliminar)

                //Se busca el elemento padre donde esta el elemento que se desea borrar
                let elementoPadre = elementoEliminar.parentElement
                // console.log("Padre del elemento a eliminar", elementoPadre)
               
                //Se elimina la sección
                elementoPadre.removeChild(elementoEliminar)  
                
                var SeccionUnica = false         
            }
            else{
                document.getElementById("Seccion").value = ""
                var SeccionUnica = true
            }

            //Se procede a eliminar la sección del servidor
            Llamar_EliminarSeccion(ID_Seccion, SeccionUnica)
        }  
    }  
}, false)

//************************************************************************************************  
    //Establece el alto del fondo de la ventana modal para que sea igual a todo el contenido de la ista cuenta_editar_V.php de la tienda en curso
    function mostrarSecciones(){
        // console.log("______Desde mostrarSecciones()______")

        document.getElementById("Ejemplo_Secciones").style.display = "grid"

        //Coloca el cursor en el top de la pagina
        window.scroll(0, 0)
        
        //Si la resolucion de la pantalla del dispositivo es menor a 880 px
        if(window.screen.width<=800){
            var tapaFondo = document.getElementById("Contenedor_42")
            
            //Se consulta el alto de la página cuenta_editar_V.php, este tamaño varia segun las secciones que tenga un tienda, cuentas bancarias y categorias
            AltoVitrina = tapaFondo.scrollHeight
            
            //Este alto se estable al div padre en cuenta_editar_V.php para garantizar que cubra todo el contenido, ya que el div que Ejemplo_Secciones es cargado sobreeste
            document.getElementById("Ejemplo_Secciones").style.height = AltoVitrina + "px"
        }
    }   
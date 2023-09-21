document.addEventListener('DOMContentLoaded',function(){resize('Contenido')}, false)

document.getElementById("CerrarVentana").addEventListener('click', Cerrar, false)

if(document.getElementById("CerrarVentanaModal")){
    document.getElementById("CerrarVentanaModal").addEventListener('click', function(){CerrarModal('VentanaModal--Publicidad')}, false)
}

// document.getElementById("Comentario").addEventListener('keyup', function(){autosize('Comentario')}, false)
// document.getElementById("Comentario").addEventListener('keydown', function(){autosize('Comentario')}, false)

//************************************************************************************************
//Función autoejecuble que muestra la ventana modal que contiene la publicidad
var VentanaModal = (function(){ 
    setTimeout(function(){mostrarModal();}, 500)
})();

//************************************************************************************************
function mostrarModal(){  
    if(document.getElementById("VentanaModal--Publicidad")){     
        document.getElementById("VentanaModal--Publicidad").classList.add("mostrarModal--publicidad")
    }
}

//************************************************************************************************ 
    //Cierra ventana window donde se abrio la noticia
    function Cerrar(){            
        window.close();
    }

//************************************************************************************************   
//cierra ventana modal que contiene la publicidad
function CerrarModal(id){
    // console.log("______Desde CerrarModal()______", id) 
    document.getElementById(id).style.display = "none"
}

//************************************************************************************************ 
 //Confirma si se desea eliminar un comentario
 function EliminarComentario(ID_Comentario){
    // console.log("______Desde EliminarComentario()______", ID_Comentario)
    let ConfirmaEliminar = confirm("Desea eliminar el comentario");
    
    if(ConfirmaEliminar == true){
        Llamar_EliminarComentario(ID_Comentario)
                    
        // Quita la noticia de pantalla
        //Se detecta  el contenedor que contiene el comentario a eliminar
        let DivEliminar = document.getElementById(ID_Comentario)
        // console.log(DivEliminar)

        //Se detecta el elemento padre que contiene el elemento a eliminar
        let Padre = DivEliminar.parentElement
        // console.log(Padre)

        //Se elimina el elemento
        Padre.removeChild(DivEliminar)
    } 
    else{
        return
    }
}

//************************************************************************************************
function EliminarComentarioNuevo(ID_Comentario){
    
    Llamar_EliminarComentario(ID_Comentario)
    document.getElementById("Contenedor_Padre").style.display = "none"

}

//************************************************************************************************
    //Ajusta la altura del texarea según se vaya escribiendo en el mismo                
    function autosize(id){
        // console.log("______Desde autosize()______", id)
        var el = document.getElementById(id);
        
        setTimeout(function(){
            el.style.cssText = 'height:auto; padding:0';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
        },0);
    }

//**********************************************************************************************
// function transferirComentario(ID_Comentario){
//     console.log("______Desde transferirComentario()______", ID_Comentario)
    
//     let Respuesta = document.getElementById("ComentarioRespuesta").value
//     console.log(Respuesta)

//     //Se transfiere el valor del textarea  al <p></p> del formulario
//     document.getElementById(ID_Comentario).value = Respuesta   
//     document.getElementById("MostrarSeccion").style.display = "none"        
// }

//**********************************************************************************************
// function mostrar_DivRespuesta(ID_Comentario, ID_BotonRespuesta){
    // console.log("______Desde mostrar_DivRespuesta()______", ID_Comentario + "/" + ID_BotonRespuesta)

    // document.getElementById(ID_Comentario).style.display = "block"; 
    // document.getElementById(ID_BotonRespuesta).style.display = "none"; 
// }

//************************************************************************************************ 
function enviarRespuesta(form, ID_Comentario){
    // console.log("______Desde enviarRespuesta()______") 
    console.log(form)
    console.log(ID_Comentario)
}

function mostrarRrespuesta(ID_Comentario, Respuesta, ID_Respuesta, ID_LabelEnviar, ID_insertaRespuesta){
    // console.log("______Desde mostrarRrespuesta()______ ",ID_Comentario + "/" + Respuesta + "/" + ID_Respuesta + "/" + ID_LabelEnviar)
    // let A = document.getElementById(ID_RespuestaInsertada).value = Respuesta
    
    document.getElementById(ID_Respuesta).style.display = "none"
    document.getElementById(ID_LabelEnviar).style.display = "none"
    document.getElementById(ID_insertaRespuesta).textContent = Respuesta

    //Se crea un parrafo que contendra la respuesta a un comentario
    // var NuevoElemento = document.createElement("p")

    // //Se dan valores a la propiedades del nuevo elemento 
    // NuevoElemento.id = "respuestaCOmentario_" + ID_Comentario
    // NuevoElemento.textContent = Respuesta
    // console.log("NuevoElemento", NuevoElemento)

    // //Se especifica el elemento donde se va a insertar el nuevo elemento
    // var ElementoPadre = document.getElementById(ID_DivPadre)
    // console.log("ElementoPadre", ElementoPadre)

    // //Se inserta en el DOM el parafo creado
    // ElementoPadre.appendChild(NuevoElemento) 
}
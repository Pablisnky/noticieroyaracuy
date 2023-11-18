    // elimina una noticia
    function EliminarNoticia(ID_Noticia, Ruta){
        // console.log("______ Desde EliminarNoticia() ______", ID_Noticia + '/' + Ruta)
        
        let ConfirmaEliminar = confirm("Desea eliminar la noticia");
        
        //Se confirma si se desea eliminar la noticia
        if(ConfirmaEliminar == true){              
                      
            // Quita la noticia de pantalla
            //Se detecta  el contenedor que contiene la noticia a eliminar
            let DivEliminar = document.getElementById(ID_Noticia)
            // console.log(DivEliminar)

            //Se detecta el elemento padre que contiene el elemento a eliminar
            let Padre = DivEliminar.parentElement
            // console.log(Padre)

            //Se elimina el elemento
            Padre.removeChild(DivEliminar)

            Llamar_EliminarNoticia(Ruta)
        } 
        else{
            return
        }
    }
    
//************************************************************************************************ 

var Condicion = false
function Mostrar_Correo(ID_DireccionCorreo, ID_EnviarCorreo_){
    if(Condicion == false){
        document.getElementById(ID_DireccionCorreo).style.display = "block"
        document.getElementById(ID_EnviarCorreo_).style.display = "block"
        Condicion = true
    }
    else{
        document.getElementById(ID_DireccionCorreo).style.display = "none"
        document.getElementById(ID_EnviarCorreo_).style.display = "none"
        Condicion = false

    }
}
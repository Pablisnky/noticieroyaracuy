    //obtiendo informacion del DOM para identificar el elemento donde se hizo click 
    // window.addEventListener("click", function(e){   
    //     var click = e.target
    //     console.log("Se hizo click en: ", click)
    // }, false)

// document.getElementById("Refrescar").addEventListener('click', refrecarPagina, false)

//************************************************************************************************
    // elimina una noticia
    function EliminarNoticia(ID_Noticia, Ruta){
        // console.log("______ Desde EliminarNoticia() ______", ID_Noticia + '-' + Ruta)

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
    function refrecarPagina(){
        location.reload()
    }

//************************************************************************************************
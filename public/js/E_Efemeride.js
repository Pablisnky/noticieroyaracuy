    // elimina una efemeride
    function EliminarEfemeride(ID_Efemeride, Ruta){
        // console.log("______ Desde EliminarEfemeride() ______", ID_Efemeride + '/' + Ruta)
        
        let ConfirmaEliminar = confirm("Desea eliminar la efemeride");
        
        //Se confirma si se desea eliminar la efemeride
        if(ConfirmaEliminar == true){              
                      
            // Quita la efemeride de pantalla
            //Se detecta  el contenedor que contiene la efemeride a eliminar
            let DivEliminar = document.getElementById(ID_Efemeride)
            // console.log(DivEliminar)

            //Se detecta el elemento padre que contiene el elemento a eliminar
            let Padre = DivEliminar.parentElement
            // console.log(Padre)

            //Se elimina el elemento
            Padre.removeChild(DivEliminar)

            Llamar_EliminarEfemeride(Ruta)
        } 
        else{
            return
        }
    }
    
//************************************************************************************************  
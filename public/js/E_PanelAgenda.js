    // elimina una efemeride
    function EliminarAgenda(ID_Agenda, Ruta){
        // console.log("______ Desde EliminarAgenda() ______", ID_Agenda + '/' + Ruta)
        
        let ConfirmaEliminar = confirm("Desea eliminar el evento agendado");
        
        //Se confirma si se desea eliminar el evento agendado
        if(ConfirmaEliminar == true){              
                      
            // Quita el evento agendado de pantalla
            //Se detecta  el contenedor que contiene el evento agendado a eliminar
            let DivEliminar = document.getElementById(ID_Agenda)
            // console.log(DivEliminar)

            //Se detecta el elemento padre que contiene el elemento a eliminar
            let Padre = DivEliminar.parentElement
            // console.log(Padre)

            //Se elimina el elemento
            Padre.removeChild(DivEliminar)

            Llamar_EliminarAgenda(Ruta)
        } 
        else{
            return
        }
    }
    
//************************************************************************************************  
var http_request = false
var peticion= conexionAJAX()
function conexionAJAX(){
    http_request = false
    if(window.XMLHttpRequest){ // Mozilla, Safari,...
        http_request = new XMLHttpRequest()
        if (http_request.overrideMimeType){
            http_request.overrideMimeType('text/xml')
        }
    }
    else if(window.ActiveXObject){ // IE
        try{
            http_request = new ActiveXObject("Msxml2.XMLHTTP")
        }
            catch(e){
                try{
                    http_request = new ActiveXObject("Microsoft.XMLHTTP")
                } 
                catch(e){}
            }
        }
        if(!http_request){
            alert('No es posible crear una instancia XMLHTTP')
            return false
        }
        //   else{
        //     alert("Instancia creada exitosamente ok")
        // }
        return http_request
    } 

// *************************************************************************************************
    //Elimina una seccion
    function Llamar_EliminarSeccion(ID_Seccion, SeccionUnica){
        console.log("______Desde Llamar_EliminarSeccion()______", ID_Seccion + '/' + SeccionUnica)
        
        //Si hay una sola sección se detiene el proceso de eliminación
        if(SeccionUnica == true){
            return
        }
        else{
            // remoto
            // var url = "https://www.noticieroyaracuy.com/marketplace/eliminaSeccion/" + ID_Seccion

            // local
            var url = "http://nuevonoticiero.com/marketplace/eliminaSeccion/" + ID_Seccion


            http_request.open('GET', url, true)  
            peticion.onreadystatechange = respuesta_EliminarSeccion
            peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
            peticion.send("null")
        }
    }                                                                        
    function respuesta_EliminarSeccion(){
        if(peticion.readyState == 4){
            if(peticion.status == 200){  
                //No hace falta traer una respuesta del servidor, la operacion se hace y ya
                // document.getElementById('ReadOnly').innerHTML = peticion.responseText             
            } 
            else{
                alert('Problemas con la petición.')
            }
        }
        else{ //en caso contrario, mostramos un gif simulando una precarga
            // document.getElementById('Mostrar_Maquinas').innerHTML='Cargando registros';
        }   
    } 

// *************************************************************************************************
    //Cambia el nombre de una sección cuando se avandona el foco
    function Llamar_ActualizarSeccion(Seccion, ID_Seccion){
        // console.log("______Desde Llamar_ActualizarSeccion()______",Seccion + " / "  + ID_Seccion)

        // Remoto
        var url = "https://www.noticieroyaracuy.com/marketplace/actualizarSeccion/" + Seccion + "/"  + ID_Seccion
        
        // local
        // var url = "http://nuevonoticiero.com/marketplace/actualizarSeccion/" + Seccion + "/"  + ID_Seccion

        http_request.open('GET', url, true)  
        peticion.onreadystatechange = respuesta_ActualizarSeccion
        peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
        peticion.send("null")
    }                                                                        
    function respuesta_ActualizarSeccion(){
        if(peticion.readyState == 4){
            if(peticion.status == 200){  
                // solo para mostrar respuesta del servidor, esta llamada ajax solo ejecuta una accion en el servidor
                // document.getElementById('ReadOnly').innerHTML = peticion.responseText 
            } 
            else{
                alert('Problemas con la petición.')
            }
        }
        else{ //en caso contrario, mostramos un gif simulando una precarga
            // document.getElementById('Mostrar_Maquinas').innerHTML='Cargando registros';
        }
    }

// *************************************************************************************************
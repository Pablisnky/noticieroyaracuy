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
    //Esta funcion no retorna nada al documento donde se llama, solo ejecuta la accion de eliminar la noticia del servidor
    function Llamar_EliminarNoticia(Ruta){
        // console.log("______ Desde Llamar_NoticiaPrincipal() ______", Ruta)
        
        var url = Ruta
        http_request.open('GET', url, true)  
        peticion.onreadystatechange = respuesta_EliminarNoticia
        peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
        peticion.send("null")
    }                                                                        
    function respuesta_EliminarNoticia(){
        if(peticion.readyState == 4){
            if(peticion.status == 200){ 
                //No recibe ninguna respuesta del servidor para insertar en el documento, la accion solo es necesaria en el servidor
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
//Esta funcion no retorna nada al documento donde se llama, solo ejecuta la accion de insertar datos en la noticia del servidor
function Llamar_compartirNoticia(Ruta){
    // console.log("______ Desde Llamar_compartirNoticia() ______", Ruta)
    
    var url = Ruta
    http_request.open('GET', url, true)  
    peticion.onreadystatechange = respuesta_CompartirNoticia
    peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
    peticion.send("null")
}                                                                        
function respuesta_CompartirNoticia(){
    if(peticion.readyState == 4){
        if(peticion.status == 200){ 
            //No recibe ninguna respuesta del servidor para insertar en el documento, la accion solo es necesaria en el servidor
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
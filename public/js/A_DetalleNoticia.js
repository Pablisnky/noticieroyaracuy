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
    //Muestra las miniaturas de las imagenes de una noticia
    function Llamar_VerMiniatura(Ruta){
        console.log("______Desde Llamar_VerMiniatura()______", Ruta)
        
        var url = Ruta
        http_request.open('GET', url, true)  
        peticion.onreadystatechange = respuesta_VerMiniatura
        peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
        peticion.send("null")
    }                                                                        
    function respuesta_VerMiniatura(){
        if(peticion.readyState == 4){
            if(peticion.status == 200){  
                document.getElementById('Contenedor_Imagen').innerHTML = peticion.responseText 
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
    //Verifica que el usuario este logeado antes de realizar un comentario 
    function Llamar_VerificarSuscripcion(Ruta){
        // console.log("______Desde Llamar_VerificarSuscripcion()______", Ruta  )
        
        var url = Ruta //en web.php se encuentra el detalle de la ruta
        http_request.open('GET', url, true)  
        peticion.onreadystatechange = respuesta_VerificarSuscripcion
        peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
        peticion.send("null")
    }                                                                        
    function respuesta_VerificarSuscripcion(){
        if(peticion.readyState == 4){
            if(peticion.status == 200){  
                document.getElementById('ComentarioInsertado').innerHTML = peticion.responseText 
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
    //Inserta un comentario de un suscriptor
    function Llamar_InsertarComentario(ID_Noticia){
        // console.log("______Desde Llamar_InsertarComentario()______", ID_Noticia )

        let Comentario = document.getElementById("Comentario").value
        // console.log(Comentario)
        
        var url = "../../Noticias_C/recibeComentario/" + ID_Noticia  + "/" + Comentario
        http_request.open('GET', url, true)  
        peticion.onreadystatechange = respuesta_InsertarComentario
        peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
        peticion.send("null")
    }                                                                        
    function respuesta_InsertarComentario(){
        if(peticion.readyState == 4){
            if(peticion.status == 200){  
                document.getElementById('ComentarioInsertado').innerHTML = peticion.responseText 

                document.getElementById('Comentario').value = "";
                document.getElementById('Comentario').disabled = true
                document.getElementById('ComentarioInsertado').style.display = "block"
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
    //Esta funcion no retorna nada al documento donde se llama, solo ejecuta la accion de eliminar el comentario del servidor
    function Llamar_EliminarComentario(ID_Comentario){
        // console.log("______Desde Llamar_EliminarComentario()______", ID_Comentario)
        
        var url = "../../Noticias_C/eliminar_comentario/" + ID_Comentario
        http_request.open('GET', url, true)  
        peticion.onreadystatechange = respuesta_EliminarCOmentario
        peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
        peticion.send("null")
    }                                                                        
    function respuesta_EliminarCOmentario(){
        if(peticion.readyState == 4){
            if(peticion.status == 200){ 
                //No recibe ninguna respuesta del servidor para insertar en el documento, la accion solo es necesaria en el servidor
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
    //Inserta una respuesta a un comentario existente
    function Llamar_InsertarRespuesta(ID_Comentario, ID_Respuesta, ID_LabelEnviar, ID_insertaRespuesta, ID_Noticia){
        // console.log("______Desde Llamar_InsertarRespuesta()______", ID_Comentario + "/" + ID_Respuesta + "/" + ID_LabelEnviar + "/" + ID_insertaRespuesta + "/" + ID_Noticia)

        let Respuesta = document.getElementById(ID_Respuesta).value
        // console.log(Respuesta)
        
        var url = "../../Noticias_C/recibeRespuesta/" + ID_Comentario  + "/" + Respuesta + "/" + ID_Noticia
        http_request.open('GET', url, true)  
        peticion.onreadystatechange = respuesta_InsertarRespuesta
        peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
        peticion.send("null")
        
        mostrarRrespuesta(ID_Comentario, Respuesta, ID_Respuesta, ID_LabelEnviar, ID_insertaRespuesta)
    }                                                                        
    function respuesta_InsertarRespuesta(){
        if(peticion.readyState == 4){
            if(peticion.status == 200){  
                //No recibe ninguna respuesta del servidor para insertar en el documento, la accion solo es necesaria en el servidor
                // document.getElementById(ID_RespuestaInsertada).innerHTML = peticion.responseText 
                // document.getElementById('Respuesta').value = "";
                // document.getElementById('Respuesta').disabled = true
                // document.getElementById('RespuestaInsertada').style.display = "block"
            } 
            else{
                alert('Problemas con la petición.')
            }
        }
        else{ //en caso contrario, mostramos un gif simulando una precarga
            // document.getElementById('Mostrar_Maquinas').innerHTML='Cargando registros';
        }
    }

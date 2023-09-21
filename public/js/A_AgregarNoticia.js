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

//************************************************************************************************
// document.getElementById("SeccionPublicar").addEventListener('click', Llamar_seccionesDisponible, false)
// document.getElementById("SeccionPublicar").addEventListener('keydown', Llamar_seccionesDisponible, false)

document.getElementById("Anuncio").addEventListener('click', Llamar_AnunciosDisponible, false)
document.getElementById("Anuncio").addEventListener('keydown', Llamar_AnunciosDisponible, false)

//************************************************************************************************
function Llamar_seccionesDisponible(Ruta){
    console.log("_____ Desde Llamar_seccionesDisponible() _____ ")

    var url = Ruta //en web.php se encuentra el detalle de la ruta
    http_request.open('GET', url, true)  
    peticion.onreadystatechange = respuesta_seccion
    peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
    peticion.send("null")
}                                
                           
function respuesta_seccion(){
    if(peticion.readyState == 4){
        if(peticion.status == 200){    
            
            window.scroll(0,0)
            
            document.getElementById("Contenedor_80").innerHTML = peticion.responseText
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
function Llamar_AnunciosDisponible(){
    // console.log("_____ Desde Llamar_AnunciosDisponible() _____ ")
    var url = "../Panel_C/Anuncios"
    http_request.open('GET', url, true)  
    peticion.onreadystatechange = respuesta_AnunciosDisponible
    peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
    peticion.send("null")
}                                                           
function respuesta_AnunciosDisponible(){
    if(peticion.readyState == 4){
        if(peticion.status == 200){    
            //Coloca el cursor en el top de la pagina
            window.scroll(0, 0)
            
            document.getElementById("Contenedor_91").innerHTML = peticion.responseText
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

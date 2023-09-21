// document.getElementById("BuscadorTitular").addEventListener('keyup', function(){Llamar_buscadorTitular(this.value)})

//*********************************************************************************************** 
    //Busca un titular de noticia segun lo que escriba el usuario en el input de busqueda
    function Llamar_buscadorTitular(titular){
        // console.log("______Desde Llamar_buscadorTitular()______", titular)
        
        var divContenedor = document.getElementById("Mostrar_NoticiasFiltradas")

        var xmlhttp
        if(window.XMLHttpRequest){ //Mozilla, Safari, Chrome...
            xmlhttp = new XMLHttpRequest()
        } 
        else{ 
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP")
            if(!xmlhttp){
                alert('No es posible crear una instancia XMLHTTP')
                return false
            }
            else{
                alert("Instancia creada exitosamente")
            }     
        }

        if(titular.length === ""){//sino hay nada escrito en el input de buscar, no se ejecuta ninguna accion
            divContenedor.innerHTML = ""
        }
        else{//si hay algo escrito en el input de buscar se ejecuta la peticion de Ajax
            xmlhttp.onreadystatechange = function(){
                if(xmlhttp.readyState === 4 && this.status === 200){
                    divContenedor.innerHTML = xmlhttp.responseText
                } 
                else{ //en caso contrario, mostramos un gif simulando una precarga
                    divContenedor.innerHTML ="<div class='preloder'></div>"                  
                    return   
                }  
            }          
            // divContenedor.style.display = "flex"
            xmlhttp.open("GET", "../Panel_C/buscadorTitulares/" + titular, true)
            //se envia la informacion cargada en el input por el usuario al servidor, true, significa que se va a hacer de manera asincrona se utiliza el metodo send para enviar.               
            xmlhttp.send()
        }
    }
    
//*********************************************************************************************** 

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
        // console.log("______ Desde Llamar_EliminarNoticia() ______", Ruta)
        
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
    function llamar_noticiaSeccion(Seccion){
        // console.log("______Desde llamar_noticiaSeccion()______", Seccion )
        
        var url = "../Panel_C/filtrarNoticiaSeccion/" + Seccion 
        http_request.open('GET', url, true)  
        peticion.onreadystatechange = respuesta_noticiaSeccion
        peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
        peticion.send("null")
    }                                                                        
    function respuesta_noticiaSeccion(){
        if(peticion.readyState == 4){
            if(peticion.status == 200){ 
                document.getElementById('Mostrar_NoticiasFiltradas').innerHTML = peticion.responseText
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
        function Llamar_noticiaMunicipio(Municipio){
            console.log("______Desde llamar_noticiaSeccion()______", Municipio )
            
            var url = "../Panel_C/filtrarNoticiaMunicipio/" + Municipio 
            http_request.open('GET', url, true)  
            peticion.onreadystatechange = respuesta_noticiaSeccion
            peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
            peticion.send("null")
        }                                                                        
        function respuesta_noticiaSeccion(){
            if(peticion.readyState == 4){
                if(peticion.status == 200){ 
                    document.getElementById('Mostrar_NoticiasFiltradas').innerHTML = peticion.responseText
                } 
                else{
                    alert('Problemas con la petición.')
                }
            }
            else{ //en caso contrario, mostramos un gif simulando una precarga
                // document.getElementById('Mostrar_Maquinas').innerHTML='Cargando registros';
            }
        }
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

//-------------------------------------------------------------------------------------------------
    function llamar_verificaCorreo(correo){
        // console.log("_____ Desde validarRegistro() _____")

        // remoto
        // var url="https://www.noticieroyaracuy.com/registro/verificaCorreo/" + correo;
   
        // local
        var url= "http://nuevonoticiero.com/registro/verificaCorreo/" + correo;

        http_request.open('GET',url,true);     
        peticion.onreadystatechange = respuesta_verificaCorreo;
        peticion.setRequestHeader("content-type","application/x-www-form-urlencoded");
        peticion.send("null");
    }                                                           
    function respuesta_verificaCorreo(){
        if (peticion.readyState == 4){
            if(peticion.status == 200){
                document.getElementById('Mostrar_verificaCorreo').style.display = "block"
                document.getElementById('Mostrar_verificaCorreo').innerHTML = peticion.responseText;
            } 
            else{
                alert('Hubo problemas con la petición en L_VeCo.');
            }
        }
    }

//-------------------------------------------------------------------------------------------------
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
// document.getElementById("Secciones").addEventListener('click', Llamar_secciones, false)

//************************************************************************************************
// function Llamar_seccion(ID_Suscriptor,ID_Seccion){
//     // console.log("_____ Desde Llamar_seccion() _____ ", ID_Suscriptor + ',' + ID_Seccion)
    
//     var url = "../../Catalogos_C/Secciones/" + ID_Suscriptor + ',' + ID_Seccion
//     http_request.open('GET', url, true)  
//     peticion.onreadystatechange = respuesta_secciones
//     peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
//     peticion.send("null")
// }                                                           
// function respuesta_secciones(){
//     if(peticion.readyState == 4){
//         if(peticion.status == 200){    
//             //Oculta el menu que muestra las secciones           
//             document.getElementById("Con_Secciones").classList.remove("ocultar");                   
//             statu = false

//             //Coloca el div que se va a mostrar en el borde superior del viewport
//             // document.getElementById("Contenedor_13Js").scroll(0,0)

//             document.getElementById("Contenedor_13Js").innerHTML = peticion.responseText
//         } 
//         else{
//             alert('Problemas con la petición.')
//         }
//     }
//     else{ //en caso contrario, mostramos un gif simulando una precarga
//         // document.getElementById('Mostrar_Maquinas').innerHTML='Cargando registros';
//     }
// }

// *************************************************************************************************
// function Llamar_Todasseccion(ID_Suscriptor, Pseudonimo){
//     // console.log("_____ Desde Llamar_Todasseccion() _____ ", ID_Suscriptor + ',' + Pseudonimo)

//     var url = "../../Catalogos_C/Secciones/" + ID_Suscriptor + ',' + Pseudonimo
//     http_request.open('GET', url, true)  
//     peticion.onreadystatechange = respuesta_secciones
//     peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
//     peticion.send("null")
// }                                                           
// function respuesta_secciones(){
//     if(peticion.readyState == 4){
//         if(peticion.status == 200){    
//             //Oculta el menu que muestra las secciones           
//             document.getElementById("Con_Secciones").classList.remove("ocultar");                   
//             statu = false

//             document.getElementById("Contenedor_13Js").innerHTML = peticion.responseText
//         } 
//         else{
//             alert('Problemas con la petición.')
//         }
//     }
//     else{ //en caso contrario, mostramos un gif simulando una precarga
//         // document.getElementById('Mostrar_Maquinas').innerHTML='Cargando registros';
//     }
// }

//****************************************************************************************************
//Muestra la orden de compra
function llamar_PedidoEnCarrito(Ruta){
    // console.log("______Desde llamar_PedidoEnCarrito()______", Ruta)
    
    var url= Ruta
    http_request.open('GET', url, true);    
    peticion.onreadystatechange = respuesta_PedidoEnCarrito;
    peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
    peticion.send("null");

    var ValorDolar = document.getElementById("PrecioDolar").value
    localStorage.setItem('ValorDolarHoy', ValorDolar)         
    LS_ValorDolarHoy = localStorage.getItem('ValorDolarHoy')
}                                                           
function respuesta_PedidoEnCarrito(){
    if(peticion.readyState == 4){
        if(peticion.status == 200){            
            document.getElementById("Mostrar_Orden").style.display="block"

            //Coloca el cursor en el top de la pagina
            window.scroll(0,0)            

            document.getElementById('Mostrar_Orden').innerHTML=peticion.responseText
    
            PedidoEnCarrito(LS_ValorDolarHoy)           
        } 
        else{
            alert('Hubo problemas con la petición en llamar_PedidoEnCarrito()')
        }
    }
    else{ //en caso contrario, mostramos un gif simulando una precarga
        // document.getElementById('Mostrar_Maquinas').innerHTML='Cargando registros';
    }    
}

//****************************************************************************************************
//Muestra el formulario de usuario registrado
function Llamar_UsuarioRegistrado(CedulaUsuario){

    // console.log("______Desde Llamar_UsuarioRegistrado()______", CedulaUsuario)

    // remoto
    // var url= "https://www.noticieroyaracuy.com/marketplace/mostrarUsuario/" + CedulaUsuario
   
    // local
    var url= "http://nuevonoticiero.com/marketplace/mostrarUsuario/" + CedulaUsuario 
    
    http_request.open('GET', url, true);    
    peticion.onreadystatechange = respuesta_UsuarioRegistrado;
    peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
    peticion.send("null");

}                                                         
function respuesta_UsuarioRegistrado(){
    if(peticion.readyState == 4){
        if(peticion.status == 200){                   
            
            //para debuggear respuesta AJAX
            // document.getElementById("Cedula_Usuario").innerHTML = peticion.responseText 

            //Coloca el cursor en el top de la pagina
            window.scroll(0, 0)

            // Se recibe desde php (MarketplaceController/mostrarUsuario()) una cadena de texto con los datos del usuario que se guarda en A,
            var A = peticion.responseText 
            // console.log("Respuesta contolador= ", A)

            // La variable A se convierte en un Array
            A = A.split(','); 

            // E caso de que el usuario no este registrado se recibira un string con "Usuario no registado"
            if(A[0] == "Usuario no registrado"){
                alert("Usuario no registrado")        
                document.getElementById("Cedula_Usuario").value = "";
                document.getElementById("Cedula_Usuario").focus();
                return
            }
            else{   
                document.getElementById("ConfirmarOrden").style.display = "none"
                document.getElementById("MuestraEnvioFactura").style.display = "block" 

                document.getElementById('NombreUsuario').value =  A[0];  
                document.getElementById('ApellidoUsuario').value =  A[1]; 
                document.getElementById('CedulaUsuario').value =  A[2]; 
                document.getElementById('TelefonoUsuario').value =  A[3]; 
                document.getElementById('CorreoUsuario').value =  A[4];  
                document.getElementById('Estado').value =  A[5];      
                document.getElementById('Ciudad').value =  A[6];    
                document.getElementById('DireccionUsuario').value =  A[7];  
                document.getElementById('ID_Usuario').value =  A[8];  
            }

            //Crea el boton de formas de pago
            
        } 
        else{
            alert('Hubo problemas con la petición en llamar_UsuarioRegistrado()')
        }
    }
    else{ //en caso contrario, mostramos un gif simulando una precarga
        // document.getElementById('Mostrar_Maquinas').innerHTML='Cargando registros';
    }    
}

//****************************************************************************************************
window.addEventListener('DOMContentLoaded', function(){autofocus('Correo')}, false)
// document.getElementById("Label_7").addEventListener('click', ReestablecerContrasena, false)

//************************************************************************************************
//Por medio de delegación de eventos se detecta cada input donde se debe aplicar la funcion blanquearInput()
document.getElementsByTagName("body")[0].addEventListener('keydown', function(e){
    // console.log("______Desde función anonima que detecta INPUTS______")   
    if(e.target.tagName == "INPUT"){
        var ID_Input = e.target.id
        
        document.getElementById(ID_Input).addEventListener('keyup', function(){blanquearInput(ID_Input)}, false)
    } 
}, false)

//************************************************************************************************
    function autofocus(id){
        document.getElementById(id).focus();  
    }

//************************************************************************************************
    //Recupera contraseña olvidada
    // function ReestablecerContrasena(){
    //     document.getElementById("Contenedor_43").style.display = "block";
    //     autofocus('Input_13_JS');        
    // }

//************************************************************************************************
    //Valida el formulario de login
    function validarLogin(){
        document.getElementById("Boton_Login").value = "Iniciando sesión ..."
        document.getElementById("Boton_Login").disabled = "disabled"
        document.getElementById("Boton_Login").style.backgroundColor = "var(--OficialClaro)"
        document.getElementById("Boton_Login").style.color = "var(--OficialOscuro)"
        document.getElementById("Boton_Login").classList.add('borde_1')
        document.getElementById("Boton_Login").style.cursor = "wait"
        
        let usuario = document.getElementById('Correo').value
        let clave = document.getElementById('Clave').value  
        
        //Expresion regular para el correo electronico
        let ER_Correo = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

        if(usuario =="" || usuario.indexOf(" ") == 0 || usuario.length > 70 || ER_Correo.test(usuario) == false){
            alert ("Correo no valido");
            document.getElementById("Correo").value = "";
            document.getElementById("Correo").focus();
            document.getElementById("Correo").style.backgroundColor = "var(--Fallos)"
            document.getElementById("Boton_Login").value = "Entrar"
            document.getElementById("Boton_Login").disabled = false
            document.getElementById("Boton_Login").style.backgroundColor = "var(--OficialOscuro)"
            document.getElementById("Boton_Login").style.color = "var(--OficialClaro)"
            document.getElementById("Boton_Login").classList.remove('borde_1')
            document.getElementById("Boton_Login").style.cursor = "pointer"
            return false;
        }
        else if(clave =="" || clave.indexOf(" ") == 0 || clave.length > 20){
            alert ("Introduzca una clave de acceso");
            document.getElementById("Clave").value = "";
            document.getElementById("Clave").focus();
            document.getElementById("Clave").style.backgroundColor = "var(--Fallos)"
            document.getElementById("Boton_Login").value = "Entrar"
            document.getElementById("Boton_Login").disabled = false
            document.getElementById("Boton_Login").style.backgroundColor = "var(--OficialOscuro)"
            document.getElementById("Boton_Login").style.color = "var(--OficialClaro)"
            document.getElementById("Boton_Login").classList.remove('borde_1')
            document.getElementById("Boton_Login").style.cursor = "pointer"
            return false;
        }
        //Si se superan todas las validaciones la función devuelve verdadero
        return true
    }

//************************************************************************************************
    function validarCorreo(){
        // console.log("______Desde validarCorreo ______")  

        document.getElementById("BotonCambioCOntrasenia").value = "Procesando"
        document.getElementById("BotonCambioCOntrasenia").disabled = "disabled"
        document.getElementById("BotonCambioCOntrasenia").style.backgroundColor = "var(--OficialClaro)"
        document.getElementById("BotonCambioCOntrasenia").style.color = "var(--OficialOscuro)"
        document.getElementById("BotonCambioCOntrasenia").classList.add('borde_1')
        document.getElementById("BotonCambioCOntrasenia").style.cursor = "wait"
        
        let correo = document.getElementById('Input_13_JS').value
        
        //Expresion regular para el correo electronico
        let ER_Correo = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;

        if(correo =="" || correo.indexOf(" ") == 0 || correo.length > 70 || ER_Correo.test(correo) == false){
            alert ("Correo no valido");
            document.getElementById("Input_13_JS").value = "";
            document.getElementById("Input_13_JS").focus();
            document.getElementById("Input_13_JS").style.backgroundColor = "var(--Fallos)"
            document.getElementById("BotonCambioCOntrasenia").value = "Entrar"
            document.getElementById("BotonCambioCOntrasenia").disabled = false
            document.getElementById("BotonCambioCOntrasenia").style.backgroundColor = "var(--OficialOscuro)"
            document.getElementById("BotonCambioCOntrasenia").style.color = "var(--OficialClaro)"
            document.getElementById("BotonCambioCOntrasenia").classList.remove('borde_1')
            document.getElementById("BotonCambioCOntrasenia").style.cursor = "pointer"
            return false;
        }
        return true;
    }
   

    

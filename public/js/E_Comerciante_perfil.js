document.getElementById("Label_5").addEventListener('click', clonarSeccion, false)

//************************************************************************************************
//Por medio de delegación de eventos se detecta cada input donde se debe aplicar la funcion blanquearInput()
document.getElementsByTagName("body")[0].addEventListener('keydown', function(e){
    // console.log("______ Desde función anonima que detecta INPUTS ______") 

    if(e.target.tagName == "INPUT"){
        var ID_Input = e.target.id
        
        document.getElementById(ID_Input).addEventListener('keyup', function(){blanquearInput(ID_Input)}, false)
    } 
}, false)
//************************************************************************************************

//Por medio de delegación de eventos se detecta cada input donde se debe aplicar la funcion blanquearInput()
document.getElementsByTagName("body")[0].addEventListener('click', function(e){
    // console.log("______ Desde función anonima que detecta INPUTS ______") 

    if(e.target.tagName == "SELECT"){
        var ID_Select = e.target.id

        document.getElementById(ID_Select).addEventListener('click', function(){blanquearInput(ID_Select)}, false)
    } 
}, false)

//************************************************************************************************
//CLONA UNA SECCION
//Añade un nuevo input clonado del div secciones
var incrementoSeccion = 1
function clonarSeccion(){
    // console.log("______Desde CrearSección()______")
    
    //Contenedor a clonar 
    let clonar = document.getElementById("Contenedor_80A")
    // console.log("div a clonar", clonar)
    
    //Contenedor padre
    let Padre = document.getElementById("Contenedor_79")
    // console.log("div padre", Padre)

    //Se crea el clon
    let Div_clon = clonar.cloneNode(true)
    // console.log("div clon", Div_clon)

    //Se da una clase (Al parecer no hace ninguna función, pero se elimina y no hace el clon)
    Div_clon.classList = "contenedorUnico"

    //Se da un ID al input que se encuentra en el nuevo elemento clonado, el valor del id debe ser concecutivo a los que ya existan
    let SeccionesExistentes = document.getElementsByClassName("input_12")
    // console.log("Secciones Existentes", SeccionesExistentes.length)
    CantidadID_Existente = SeccionesExistentes.length
    incrementoSeccion = CantidadID_Existente + 1

    Div_clon.getElementsByClassName("input_12")[0].id = 'InputClon_' + incrementoSeccion 
    
    //Se da un name al input que se encuentra en el nuevo elemento clonado
    Div_clon.getElementsByClassName("input_12")[0].name = "seccion[]" 
            
    //El valor del nuevo input debe estar vacio
    Div_clon.getElementsByClassName("input_12")[0].value = "" 

    //El placeholder del nuevo input 
    Div_clon.getElementsByClassName("input_12")[0].placeholder="Indica una sección"

    // Se añade estilos al input dentro del nuevo elemento
    // Div_clon.getElementsByClassName("input_12")[0].classList.add('login_cont--label') 
        
    //Se especifica el div padre, donde se insertará el nuevo nodo (aparecerá de ultimo)
    Padre.appendChild(Div_clon)
    incrementoSeccion++
} 

//************************************************************************************************ 
//ELIMINAR SECCIONES 
//Por medio de delegación de eventos se detecta la sección a eliminar
document.getElementById("Contenedor_79").addEventListener('click', function(e){
    // console.log("______Desde eliminar secciones______")

    var ElementoSeleccionado = e.target.classList[2]
    // console.log(ElementoSeleccionado)

    //Se ubica el id de BD del elemento seleccionado
    let ID_Seccion = e.target.id
    // console.log("ID_Seccion a eliminar= ", ID_Seccion)

    if(ElementoSeleccionado == "span_14_js"){
        let ConfirmaEliminar = confirm("Se eliminará la sección y todos sus productos")

        if(ConfirmaEliminar == true){            
            //Contenedor padre de secciones
            let PadreSecciones = document.getElementById("Contenedor_79")
            // console.log(PadreSecciones.childElementCount)

            //Si hay más de una sección la elimina, si solo hay una, borrar el contenido del input
            if(PadreSecciones.childElementCount > 4){
                // Se obtiene el elemento que se quieren eliminar
                let current_a = e.target.parentElement
                let elementoEliminar = current_a.parentElement
                // console.log("ELemento a eliminar", elementoEliminar)

                //Se busca el elemento padre donde esta el elemento que se desea borrar
                let elementoPadre = elementoEliminar.parentElement
                // console.log("Padre del elemento a eliminar", elementoPadre)
               
                //Se elimina la sección
                elementoPadre.removeChild(elementoEliminar)  
                
                var SeccionUnica = false         
            }
            else{
                document.getElementById("Seccion").value = ""
                var SeccionUnica = true
            }

            //Se procede a eliminar la sección del servidor
            Llamar_EliminarSeccion(ID_Seccion, SeccionUnica)
        }  
    }  
}, false)

//************************************************************************************************  
//Establece el alto del fondo de la ventana modal para que sea igual a todo el contenido de la ista cuenta_editar_V.php de la tienda en curso
function mostrarSecciones(){
    // console.log("______Desde mostrarSecciones()______")

    document.getElementById("Ejemplo_Secciones").style.display = "grid"

    //Coloca el cursor en el top de la pagina
    window.scroll(0, 0)
    
    //Si la resolucion de la pantalla del dispositivo es menor a 880 px
    if(window.screen.width<=800){
        var tapaFondo = document.getElementById("Contenedor_42")
        
        //Se consulta el alto de la página cuenta_editar_V.php, este tamaño varia segun las secciones que tenga un tienda, cuentas bancarias y categorias
        AltoVitrina = tapaFondo.scrollHeight
        
        //Este alto se estable al div padre en cuenta_editar_V.php para garantizar que cubra todo el contenido, ya que el div que Ejemplo_Secciones es cargado sobreeste
        document.getElementById("Ejemplo_Secciones").style.height = AltoVitrina + "px"
    }
}   

//************************************************************************************************
//Valida el formulario de datos del comerciante        
function validarPerfil(){
    console.log("_____Desde validarPerfil()_____")

    let ImagenCatalogo = document.getElementById('ImgCatalogo').value
    let NombreComerciante = document.getElementById('NombreComerciante').value
    let ApellidoComerciante = document.getElementById('ApellidoComerciante').value      
    let CorreoComerciante = document.getElementById('CorreoComerciante').value  
    let MunicipioComerciante = document.getElementById('MunicipioComerciante').value
    let ParroquiaComerciante = document.getElementById('ParroquiaComerciante').value  
    let TelefonoComerciante = document.getElementById('TelefonoComerciante').value         
    let PseudonimoComerciante = document.getElementById('PseudonimoComerciante').value         
    let Categoria = document.getElementById('Categoria').value        
    let Seccion = document.getElementById('Seccion').value  
    let Transferencia = document.getElementById('Transferencia').checked 
    let Pago_movil = document.getElementById('Pago_movil').checked
    let Paypal = document.getElementById('Paypal').checked 
    let Criptomoneda = document.getElementById('Criptomoneda').checked
    let Acordado = document.getElementById('Acordado').checked      
    
    // let lunes_M = document.getElementById('Lunes_M').checked
    // let martes_M = document.getElementById('Martes_M').checked
    // let miercoles_M = document.getElementById('Miercoles_M').checked
    // let jueves_M = document.getElementById('Jueves_M').checked
    // let viernes_M = document.getElementById('Viernes_M').checked
    // let Sabado_M = document.getElementById('Sabado_M').checked
    // let Domingo_M = document.getElementById('Domingo_M').checked
    // let lunes_T = document.getElementById('Lunes_T').checked
    // let martes_T = document.getElementById('Martes_T').checked
    // let miercoles_T = document.getElementById('Miercoles_T').checked
    // let jueves_T = document.getElementById('Jueves_T').checked
    // let viernes_T = document.getElementById('Viernes_T').checked
    // let Sabado_T = document.getElementById('Sabado_T').checked
    // let Domingo_T = document.getElementById('Domingo_T').checked
    // console.log(lunes_M)
    // console.log(martes_M)
    // console.log(miercoles_M)
    // console.log(jueves_M)
    // console.log(viernes_M)
    // console.log(Sabado_M)
    // console.log(Domingo_M)        
    // let InicioManana = document.getElementById('InicioManana').value
    // let CulminaManana = document.getElementById('CulminaManana').value
    // let IniciaTarde = document.getElementById('IniciaTarde').value
    // let CulminaTarde = document.getElementById('CulminaTarde').value
    // let InicioManana_Sab = document.getElementById('InicioManana_Sab').value
    // let CulminaManana_Sab = document.getElementById('CulminaManana_Sab').value
    // let InicioTarde_Sab = document.getElementById('InicioTarde_Sab').value
    // let CulminaTarde_Sab = document.getElementById('CulminaTarde_Sab').value      
    // let InicioManana_Dom = document.getElementById('InicioManana_Dom').value
    // let CulminaManana_Dom = document.getElementById('CulminaManana_Dom').value
    // let InicioTarde_Dom = document.getElementById('InicioTarde_Dom').value
    // let CulminaTarde_Dom = document.getElementById('CulminaTarde_Dom').value

    document.getElementsByClassName("boton")[0].value = "Guardando ..."
    document.getElementsByClassName("boton")[0].disabled = true
    document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialClaro)"
    document.getElementsByClassName("boton")[0].style.color = "var(--OficialOscuro)"
    document.getElementsByClassName("boton")[0].style.cursor = "wait"
    document.getElementsByClassName("boton")[0].classList.add('borde_1')

    //Patron de entrada solo acepta letras
    let ER_Letras = /^[ñA-Za-z _]*[ñA-Za-z][ñA-Za-z _]*$/

    //Patron de entrada para correos electronicos
    let ER_Correo = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
    
    //Patron de entrada para archivos de carga permitidos
    var ER_Ext_Permitidas = /^[.jpg|.jpeg|.png]*$/
                                                                                
    // if(ER_Ext_Permitidas.exec(ImagenCatalogo) == false || ImagenCatalogo.size > 2000000){
    //     alert("Introduzca una imagen con extención .jpeg .jpg .png menor a 2 Mb")
    //     document.getElementById("ImgCatalogo").value = "";
    //     document.getElementsByClassName("boton")[0].value = "Guardar cambios"
    //     document.getElementsByClassName("boton")[0].disabled = false
    //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
    //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
    //     document.getElementsByClassName("boton")[0].style.cursor = "pointer"
    //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
    //     return false;
    // } 
    if(NombreComerciante == "" || NombreComerciante.indexOf(" ") == 0 || NombreComerciante.length > 20 || ER_Letras.test(NombreComerciante) == false){
        alert ("Necesita introducir su nombre")
        document.getElementById("NombreComerciante").value = ""
        document.getElementById("NombreComerciante").focus()
        document.getElementById("NombreComerciante").style.backgroundColor = "var(--Fallos)"
        document.getElementsByClassName("boton")[0].value = "Guardar cambios"
        document.getElementsByClassName("boton")[0].disabled = false
        document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        document.getElementsByClassName("boton")[0].classList.remove('borde_1')
        return false;
    }
    else if(ApellidoComerciante == "" || ApellidoComerciante.indexOf(" ") == 0 || ApellidoComerciante.length > 20 || ER_Letras.test(ApellidoComerciante) == false){
        alert("Necesita introducir su Apellido")
        document.getElementById("ApellidoComerciante").value = ""
        document.getElementById("ApellidoComerciante").focus()
        document.getElementById("ApellidoComerciante").style.backgroundColor = "var(--Fallos)"
        document.getElementsByClassName("boton")[0].value = "Guardar cambios"
        document.getElementsByClassName("boton")[0].disabled = false
        document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        document.getElementsByClassName("boton")[0].classList.remove('borde_1')
        return false;
    }
    else if(CorreoComerciante == "" || CorreoComerciante.indexOf(" ") == 0 || CorreoComerciante.length > 70 || ER_Correo.test(CorreoComerciante) == false){
        alert ("Introduzca un Correo")
        document.getElementById("CorreoComerciante").value = ""
        document.getElementById("CorreoComerciante").focus()
        document.getElementById("CorreoComerciante").style.backgroundColor = "var(--Fallos)"
        document.getElementsByClassName("boton")[0].value = "Guardar cambios"
        document.getElementsByClassName("boton")[0].disabled = false
        document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        document.getElementsByClassName("boton")[0].classList.remove('borde_1')
        return false;
    }        
    else if(MunicipioComerciante == "" || MunicipioComerciante == "Seleccione municipio"){
        alert ("Necesita introducir el Municipio")
        document.getElementById("MunicipioComerciante").value = ""
        document.getElementById("MunicipioComerciante").focus()
        document.getElementById("MunicipioComerciante").style.backgroundColor = "var(--Fallos)"
        document.getElementsByClassName("boton")[0].value = "Guardar cambios"
        document.getElementsByClassName("boton")[0].disabled = false
        document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        document.getElementsByClassName("boton")[0].classList.remove('borde_1')
        return false;
    }
    else if(ParroquiaComerciante == "" || ParroquiaComerciante == "Seleccione parroquia"){
        alert ("Necesita introducir la Parroquia")
        document.getElementById("ParroquiaComerciante").value = ""
        document.getElementById("ParroquiaComerciante").focus()
        document.getElementById("ParroquiaComerciante").style.backgroundColor = "var(--Fallos)"
        document.getElementsByClassName("boton")[0].value = "Guardar cambios"
        document.getElementsByClassName("boton")[0].disabled = false
        document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        document.getElementsByClassName("boton")[0].classList.remove('borde_1')
        return false;
    }  
    else if(TelefonoComerciante == "" || TelefonoComerciante.indexOf(" ") == 0 || TelefonoComerciante.length > 14){
        alert ("Número de telefono invalido")
        document.getElementById("TelefonoComerciante").value = ""
        document.getElementById("TelefonoComerciante").focus()
        document.getElementById("TelefonoComerciante").style.backgroundColor = "var(--Fallos)"
        document.getElementsByClassName("boton")[0].value = "Guardar cambios"
        document.getElementsByClassName("boton")[0].disabled = false
        document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        document.getElementsByClassName("boton")[0].classList.remove('borde_1')
        return false;
    }
    else if(PseudonimoComerciante == "" || PseudonimoComerciante.indexOf(" ") == 0 || PseudonimoComerciante.length > 50){
        alert ("Necesita introducir el nombre de la tienda")
        document.getElementById("PseudonimoComerciante").value = ""
        document.getElementById("PseudonimoComerciante").focus()
        document.getElementById("PseudonimoComerciante").style.backgroundColor = "var(--Fallos)"
        document.getElementsByClassName("boton")[0].value = "Guardar cambios"
        document.getElementsByClassName("boton")[0].disabled = false
        document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        document.getElementsByClassName("boton")[0].classList.remove('borde_1')
        return false;
    }
    else if(Categoria == "" || MunicipioComerciante == "Seleccione municipio"){
        alert ("Necesita introducir una Categoria")
        document.getElementById("Categoria").value = ""
        document.getElementById("Categoria").focus()
        document.getElementById("Categoria").style.backgroundColor = "var(--Fallos)"
        document.getElementsByClassName("boton")[0].value = "Guardar cambios"
        document.getElementsByClassName("boton")[0].disabled = false
        document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        document.getElementsByClassName("boton")[0].classList.remove('borde_1')
        return false;
    }    
    else if(Seccion == "" || Seccion.indexOf(" ") == 0 || Seccion.length > 20){
        alert("Necesita introducir una sección")
        document.getElementsByClassName("boton")[0].value = "Guardar cambios"
        document.getElementsByClassName("boton")[0].disabled = false
        document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        document.getElementsByClassName("boton")[0].classList.remove('borde_1')            
        return false;
    }
    //Valida que se escoja al menos un metodo de pago
    else if(Transferencia == false && Pago_movil == false && Paypal == false && Criptomoneda == false && Acordado == false){
        alert ("Introduzca al menos un metodo de pago")
        document.getElementsByClassName("boton")[0].value = "Guardar cambios"
        document.getElementsByClassName("boton")[0].disabled = false
        document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        document.getElementsByClassName("boton")[0].classList.remove('borde_1')
        return false;
    }
    // else if(Div_AlertaCorreo.childElementCount >= 1){
    //     alert("El correo ya esta registrado")
    //     document.getElementById("CorreoAfiDes").value = ""
    //     document.getElementById("CorreoAfiDes").focus()
    //     document.getElementById("CorreoAfiDes").style.backgroundColor = "var(--Fallos)"
    //     //Se elimina el nodo hijo donde aparece el mensaje del alert
    //     while(Div_AlertaCorreo.firstChild){
    //         Div_AlertaCorreo.removeChild(Div_AlertaCorreo.firstChild);
    //       };
    //     document.getElementsByClassName("boton")[0].value = "Registrarse"
    //     document.getElementsByClassName("boton")[0].disabled = false
    //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
    //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        // document.getElementsByClassName("boton")[0].style.cursor = "pointer"
    //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
    //     return false;
    // }        
    // else if(Direccion == "" || Direccion.indexOf(" ") == 0 || Direccion.length > 51){
    //     alert ("Necesita introducir la dirección de la tienda")
    //     document.getElementById("Direccion_Tien").value = ""
    //     document.getElementById("Direccion_Tien").focus()
    //     document.getElementById("Direccion_Tien").style.backgroundColor = "var(--Fallos)"
    //     document.getElementsByClassName("boton")[0].value = "Guardar cambios"
    //     document.getElementsByClassName("boton")[0].disabled = false
    //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
    //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        // document.getElementsByClassName("boton")[0].style.cursor = "pointer"
    //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
    //     return false;
    // }
    //Valida que se escoja al menos un dia laboral
    // else if(lunes_M == false && martes_M == false && miercoles_M == false && jueves_M == false && viernes_M == false && lunes_T == false && martes_T == false && miercoles_T == false && jueves_T == false && viernes_T == false && Sabado_M == false && Sabado_T == false && Domingo_M == false && Domingo_T == false){
    //     alert ("Introduzca días laborales")
    //     document.getElementsByClassName("boton")[0].value = "Guardar cambios"
    //     document.getElementsByClassName("boton")[0].disabled = false
    //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
    //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        // document.getElementsByClassName("boton")[0].style.cursor = "pointer"
    //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
    //     return false;
    // }

    //VALIDA HORARIO (TURNO MAÑANA Y TARDE lUNE - VIE)
    //Valida que se haya seleccionado un horario si el bloque de la mañana tiene un dia activo
    // else if((lunes_M == true || martes_M == true || miercoles_M == true || jueves_M == true || viernes_M == true) && (InicioManana == '' || InicioManana == '00:00' || CulminaManana == '' || CulminaManana == '00:00')){
    //     alert ("Introduzca hora de apertura y cierre para el bloque de la mañana")
    //     document.getElementsByClassName("boton")[0].value = "Guardar cambios"
    //     document.getElementsByClassName("boton")[0].disabled = false
    //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
    //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        // document.getElementsByClassName("boton")[0].style.cursor = "pointer"
    //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
    //     return false;
    // }
    //Valida que se haya seleccionado un horario si el bloque de la tarde tiene un dia activo
    // else if((lunes_T == true || martes_T == true || miercoles_T == true || jueves_T == true || viernes_T == true) && (IniciaTarde == '' || IniciaTarde == '00:00' || CulminaTarde == '' || CulminaTarde == '00:00')){
    //     alert ("Introduzca hora de apertura y cierre para el bloque de la tarde")
    //     document.getElementsByClassName("boton")[0].value = "Guardar cambios"
    //     document.getElementsByClassName("boton")[0].disabled = false
    //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
    //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        // document.getElementsByClassName("boton")[0].style.cursor = "pointer"
    //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
    //     return false;
    // }
    //VALIDA HORARIO SABADO (TURNO MAÑANA Y TARDE)
    //Valida que se haya seleccionado un horario si el bloque de la mañana del sabado esta activo 
    // else if((Sabado_M == true) && (InicioManana_Sab == '' || InicioManana_Sab == '00:00' || CulminaManana_Sab == '' || CulminaManana_Sab == '00:00')){
    //     alert ("Introduzca horario para el sabado en la mañana")
    //     document.getElementsByClassName("boton")[0].value = "Guardar cambios"
    //     document.getElementsByClassName("boton")[0].disabled = false
    //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
    //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        // document.getElementsByClassName("boton")[0].style.cursor = "pointer"
    //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
    //     return false;
    // }
    // //Valida que se haya seleccionado un horario si el bloque de la tarde del sabado esta activo 
    // else if((Sabado_T == true) && (InicioTarde_Sab == '' || InicioTarde_Sab == '00:00' || CulminaTarde_Sab == '' || CulminaTarde_Sab == '00:00')){
    //     alert ("Introduzca horario para el sabado en la tarde")
    //     document.getElementsByClassName("boton")[0].value = "Guardar cambios"
    //     document.getElementsByClassName("boton")[0].disabled = false
    //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
    //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        // document.getElementsByClassName("boton")[0].style.cursor = "pointer"
    //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
    //     return false;
    // }        
    // //VALIDA HORARIO DOMINGO(TURNO MAÑANA Y TARDE)
    // //Valida que se haya seleccionado un horario si el bloque de la mañana del domingo esta activo 
    // else if((Domingo_M == true) && (InicioManana_Dom == '' || InicioManana_Dom == '00:00' || CulminaManana_Dom == '' || CulminaManana_Dom == '00:00')){
    //     alert ("Introduzca horario para el domingo en la mañana")
    //     document.getElementsByClassName("boton")[0].value = "Guardar cambios"
    //     document.getElementsByClassName("boton")[0].disabled = false
    //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
    //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        // document.getElementsByClassName("boton")[0].style.cursor = "pointer"
    //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
    //     return false;
    // }
    // //Valida que se haya seleccionado un horario si el bloque de la tarde del domingo esta activo 
    // else if((Domingo_T == true) && (InicioTarde_Dom == '' || InicioTarde_Dom == '00:00' || CulminaTarde_Dom == '' || CulminaTarde_Dom == '00:00')){
    //     alert ("Introduzca horario para el domingo en la tarde")
    //     document.getElementsByClassName("boton")[0].value = "Guardar cambios"
    //     document.getElementsByClassName("boton")[0].disabled = false
    //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
    //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        // document.getElementsByClassName("boton")[0].style.cursor = "pointer"
    //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
    //     return false;
    // }
}
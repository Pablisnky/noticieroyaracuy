document.getElementById("ContenidoPro").addEventListener('keydown', function(){contarCaracteres('ContadorPro','ContenidoPro', 50)}, false)

document.getElementById("ContenidoPro").addEventListener('keydown', function(){valida_LongitudDes(50,'ContenidoPro')}, false)

document.getElementById("ContenidoDes").addEventListener('keydown', function(){contarCaracteres('ContadorDes','ContenidoDes', 100)}, false)

document.getElementById("ContenidoDes").addEventListener('keydown', function(){valida_LongitudDes(100,'ContenidoDes', 100)}, false)   

document.getElementById("PrecioBolivar").addEventListener('keyup', function(){CambioMonetarioBolivar(this.value, "PrecioDolar")}, false)

document.getElementById("PrecioDolar").addEventListener('keyup', function(){CambioMonetarioDolar(this.value, "PrecioBolivar")}, false)

document.getElementById("PrecioBolivar").addEventListener('focus', function(){ReiniciaCampo("PrecioBolivar","PrecioDolar")}, false)

document.getElementById("PrecioDolar").addEventListener('focus', function(){ReiniciaCampo("PrecioBolivar","PrecioDolar")}, false)

//************************************************************************************************
    //Realia el cambio de moneda Dolar a Bolivar
    function CambioMonetarioBolivar(Monto, id){
        // console.log("______Desde CambioMonetarioBolivar______", Monto + " " + id)

        let Dolar = document.getElementById(id)
        let PrecioDolar = document.getElementById("CambioOficial").value
        
        let Cambio_Dolar = Monto / PrecioDolar
       
        Dolar.value = Cambio_Dolar.toFixed(2)
    }

//************************************************************************************************ 
    //Realia el cambio de moneda Bolivar a Dolar
    function CambioMonetarioDolar(Monto, id){
        // console.log("______Desde CambioMonetarioDolar______", Monto + " " + id)

        let Bolivar = document.getElementById(id)
        let PrecioDolar = document.getElementById("CambioOficial").value
        // console.log(Bolivar)
        // console.log(PrecioDolar)

        let Cambio_Bolivar = Monto * PrecioDolar

        Bolivar.value = Cambio_Bolivar.toFixed(2)
    }

//************************************************************************************************
    function ReiniciaCampo(id_1, id_2){
        // console.log("______Desde ReiniciaCampo", id_1 + " " + id_2)

        document.getElementById(id_1).value = ''
        document.getElementById(id_2).value = ''
    }

//************************************************************************************************
    //Muestra la cantidad de caracteres que quedan mientras se escribe
    function contarCaracteres(ID_Contador, ID_Contenido, Max){
        // console.log("______Desde contarCaracteres()______", ID_Contador + " / " + ID_Contenido + " / " + Max) 
        var max = Max; 
        var cadena = document.getElementById(ID_Contenido).value; 
        var longitud = cadena.length; 

        if(longitud <= max) { 
            document.getElementById(ID_Contador).value = max-longitud; 
        } else { 
            document.getElementById(ID_Contador).value = cadena.subtring(0, max);
        } 
    } 

//************************************************************************************************ 
    //Impide que se sigan introduciendo caracteres al alcanzar el limite maximo en un elmento; invocado en quienesSomos_V.php - cuenta_publicar_V.php - registroCom_V.php - cuenta_editar_V.php
    var contenidoControlado = "";    
    function valida_LongitudDes(Max, ID_Contenido){
        // console.log("______Desde valida_LongitudDes()______", Max + " / "+ ID_Contenido) 
                
        var num_caracteres_permitidos = Max;

        //se averigua la cantidad de caracteres escritos 
        num_caracteresEscritos = document.getElementById(ID_Contenido).value.length

        if(num_caracteresEscritos > num_caracteres_permitidos){ 
            document.getElementById(ID_Contenido).value = contenidoControlado; 
        }
        else{ 
            contenidoControlado = document.getElementById(ID_Contenido).value; 
        } 
    } 
    
//************************************************************************************************
    //Muestra la cantidad de caracteres que ya tiene un campo cargado desde BD
    function CaracteresAlcanzados(ID_Contenido, ID_Contador){
        // console.log("______Desde CaracteresAlcanzados()______",ID_Contenido + " / " + ID_Contador) 

        var Contenido = document.getElementById(ID_Contenido).value
        var ContadorContenido = document.getElementById(ID_Contador).value

        var CaracteresDisponibles = ContadorContenido - Contenido.length

        document.getElementById(ID_Contador).value = CaracteresDisponibles
    } 

//************************************************************************************************
//Funcion que permite dejar los radio Buton sin seleccionar
 //Para distinguir la opción actualmente pulsada en cada grupo
 var pref_opcActual = "opcActual_";

 //Verifica si una variable definida dinámicamente existe o no
 function varExiste(sNombre){
     return (eval("typeof(" + sNombre + ");") != "undefined");
 }

 //Asigna un valor a una variable creada dinámicamente a partir de su nombre
 function asignaVar(sNombre, valor){
     eval(sNombre + " = " + valor + ";");
 }

 //generamos dinámicamente variables globales para contener la opción pulsada en cada uno de los grupos
//  console.log("Cantidad elementos en el formulario = ",document.forms.length)
 for(f= 0; f<document.forms.length; f++){
     for(i = 0; i< document.forms[f].elements.length; i++){
         var elementoExistente = document.forms[f].elements[i];
         var exprCrearVariable = "";

         if(elementoExistente.type == "radio"){
             //Si la variable no existe la definimos siempre, pero sólo la redefinimos en caso de que el elemento actual del grupo esté asignado
             if(!varExiste(pref_opcActual + elementoExistente.name)){
                 exprCrearVariable = "var " + pref_opcActual + elementoExistente.name + " = ";
             }
             else{
                 exprCrearVariable = pref_opcActual + elementoExistente.name + " = ";
             }
             
             //El valor será nulo o una referencia al radio actual en función de si está seleccionado o no
             if(elementoExistente.checked)
                 exprCrearVariable += "document.getElementById(‘" + elementoExistente.id + "‘)";
             else
                 exprCrearVariable += "null";

             //Definimos la variable y asignamos el valor sólo si no existe o si el radio actual está marcado 
             if(!varExiste(pref_opcActual + elementoExistente.name) || elementoExistente.checked)
                 eval(exprCrearVariable);
         }
     }
 }

 function gestionarClickRadio(opcPulsada){
    //  console.log("____Desde gestionarClickRadio()____",opcPulsada)
     //El nombre de la variable que contiene el nombre del grupo actual
     var svarOpcAct = pref_opcActual + opcPulsada.name;
     var opcActual = null;
     
     //recupero dinámicamente una referencia al último radio pulsado de este grupo
     opcActual = eval(svarOpcAct);  

     if(opcActual == opcPulsada){
         //deselecciono
         opcPulsada.checked = false; 
         
         //y quito referencia (es como si nunca se hubiera pulsado)
         asignaVar(svarOpcAct, "null");  
     }
     else{
         //Anoto la última opción pulsada de este grupo
         asignaVar(svarOpcAct, "document.getElementById('" + opcPulsada.id + "')");  
     }
 }

//************************************************************************************************
// elimina una imagen secundaria
function EliminarImagenSecundaria(ID_Imagen, Botones){
    console.log("______Desde EliminarImagenSecundaria()______", ID_Imagen)
    let ConfirmaEliminar = confirm("Desea eliminar la noticia");
    
    //Se confirma si se desea eliminar la noticia
    if(ConfirmaEliminar == true){                        
        // Quita la imagen de la pantalla
        //Se detecta  el contenedor que contiene la imagen a eliminar
        let DivEliminar_1 = document.getElementById(ID_Imagen)
        let DivEliminar_2 = document.getElementById(Botones)//Este contenedor por tener la propiedad position convalor relative no es eliminado del DivElimina_1 a pesar de que se encuentra dentro de el en el archivo HTML
        // console.log(DivEliminar)

        //Se detecta el elemento padre que contiene el elemento a eliminar
        let Padre_1 = DivEliminar_1.parentElement
        let Padre_2 = DivEliminar_2.parentElement
        // console.log(Padre)

        //Se elimina el elemento
        Padre_1.removeChild(DivEliminar_1)
        Padre_2.removeChild(DivEliminar_2)
        
        Llamar_EliminarImagenSecundaria(ID_Imagen)
    } 
    else{
        return
    }
}

//************************************************************************************************
    //Valida el formulario de cargar producto
    function validarActualizacion(){
        // let ImagenPrin = document.getElementById('imgInp').value 
        // let ImagenPrin = document.getElementById('imgInp').file.name;
        let Producto = document.getElementById('ContenidoPro').value
        let Descripcion = document.getElementById('ContenidoDes').value 
        let PrecioBs = document.getElementById('PrecioBolivar').value 
        let PrecioDolar = document.getElementById('PrecioDolar').value 
        // let Cantidad = document.getElementById('Cantidad').value 

        document.getElementsByClassName("boton")[0].value = "Actualizando ..."
        document.getElementsByClassName("boton")[0].disabled = true
        document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialClaro)"
        document.getElementsByClassName("boton")[0].style.color = "var(--OficialOscuro)"
        document.getElementsByClassName("boton")[0].style.cursor = "wait"
        document.getElementsByClassName("boton")[0].classList.add('borde_1')    

        // //Patron de entrada solo acepta numeros y punto
        // let Pat_Numeros = /^[0-9.]*$/

        //Patron de entrada para archivos de carga permitidos
        var Ext_Permitidas = /^[.jpg|.jpeg|.png]*$/
                
        // if(Ext_Permitidas.exec(ImagenPrin) == false || ImagenPrin.size > 40000){
        //     alert("Introduzca una imagen con extención .jpeg .jpg .png menor a 2 Mb")
        //     document.getElementById("imgInp").value = "";
        //     document.getElementsByClassName("boton")[0].value = "Actualizar cambios"
        //     document.getElementsByClassName("boton")[0].disabled = false
        //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        //     document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
        //     return false;
        // }        
        if(Producto == "" || Producto.indexOf(" ") == 0 || Producto.length > 55){
            alert ("Necesita introducir un nombre Producto")
            document.getElementById("ContenidoPro").value = "";
            document.getElementById("ContenidoPro").focus()
            document.getElementById("ContenidoPro").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("boton")[0].value = "Actualizar cambios"
            document.getElementsByClassName("boton")[0].disabled = false
            document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("boton")[0].style.cursor = "pointer"
            document.getElementsByClassName("boton")[0].classList.remove('borde_1')
            return false;
        }  
        else if(Descripcion == "" || Descripcion.indexOf(" ") == 0 || Descripcion.length > 100){
            alert ("Introduzca una Descripcion de producto")
            document.getElementById("ContenidoDes").value = ""
            document.getElementById("ContenidoDes").focus()
            document.getElementById("ContenidoDes").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("boton")[0].value = "Actualizar cambios"
            document.getElementsByClassName("boton")[0].disabled = false
            document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("boton")[0].style.cursor = "pointer"
            document.getElementsByClassName("boton")[0].classList.remove('borde_1')
            return false;
        }
        // else if(Pat_Numeros.exec(PrecioBs) == false || PrecioBs == "" || PrecioBs.indexOf(" ") == 0 || PrecioBs.length > 20){
        //     alert ("Introduzca un Precio")
        //     document.getElementById("PrecioBs").value = ""
        //     document.getElementById("PrecioBs").focus()
        //     document.getElementById("PrecioBs").style.backgroundColor = "var(--Fallos)"
        //     document.getElementsByClassName("boton")[0].value = "Actualizar cambios"
        //     document.getElementsByClassName("boton")[0].disabled = false
        //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        //     document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
        //     return false;
        // }
        // else if(Pat_Numeros.exec(PrecioDolar) == false || PrecioDolar == "" || PrecioDolar.indexOf(" ") == 0 || PrecioDolar.length > 20){
        //     alert ("Introduzca un Precio")
        //     document.getElementById("PrecioDolar").value = ""
        //     document.getElementById("PrecioDolar").focus()
        //     document.getElementById("PrecioDolar").style.backgroundColor = "var(--Fallos)"
        //     document.getElementsByClassName("boton")[0].value = "Actualizar cambios"
        //     document.getElementsByClassName("boton")[0].disabled = false
        //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        //     document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
        //     return false;
        // }
        // else if(Cantidad == "" || Cantidad == 0 || Cantidad.indexOf(" ") == 0 || Cantidad.length > 3){
        //     alert ("Introduzca la cantidad de unidades disponibles")
        //     document.getElementById("Cantidad").value = ""
        //     document.getElementById("Cantidad").focus()
        //     document.getElementById("Cantidad").style.backgroundColor = "var(--Fallos)"
        //     document.getElementsByClassName("boton")[0].value = "Actualizar cambios"
        //     document.getElementsByClassName("boton")[0].disabled = false
        //     document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
        //     document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
        //     document.getElementsByClassName("boton")[0].style.cursor = "pointer"
        //     document.getElementsByClassName("boton")[0].classList.remove('borde_1')
        //     return false;
        // }    
        //Si se superan todas las validaciones la función devuelve verdadero
        return true
    }
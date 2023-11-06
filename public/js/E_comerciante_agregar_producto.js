document.getElementById("PrecioBs").addEventListener('keyup', function(){CambioMonetarioBolivar(this.value, "PrecioDolar")}, false)

document.getElementById("PrecioDolar").addEventListener('keyup', function(){CambioMonetarioDolar(this.value, "PrecioBs")}, false)

document.getElementById("PrecioBs").addEventListener('focus', function(){ReiniciaCampo("PrecioBs","PrecioDolar")}, false)

document.getElementById("PrecioDolar").addEventListener('focus', function(){ReiniciaCampo("PrecioBs","PrecioDolar")}, false)

document.getElementById("ContenidoPro").addEventListener('keydown', function(){contarCaracteres('ContadorPro','ContenidoPro', 50)}, false)

document.getElementById("ContenidoPro").addEventListener('keydown', function(){valida_LongitudDes(50,'ContenidoPro')}, false)

document.getElementById("ContenidoDes").addEventListener('keydown', function(){contarCaracteres('ContadorDes','ContenidoDes', 100)}, false)

document.getElementById("ContenidoDes").addEventListener('keydown', function(){valida_LongitudDes(100,'ContenidoDes')}, false)  

// document.getElementById("ContenidoDes").addEventListener('keydown', function(){autosize('ContenidoDes')}, false)
// document.addEventListener("keydown", contarDes, false); 
// document.addEventListener("keyup", contarDes, false);
// document.addEventListener("keydown", valida_LongitudDes, false);//valida_Longitud() se encuentra en Funciones_varias.js 
// document.addEventListener("keyup", valida_LongitudDes, false);//valida_Longitud() se encuentra en 

// document.addEventListener("keydown", contar, false);//contar() se encuentra en Funciones_varias.js 
// document.addEventListener("keyup", contar, false);//contar() se encuentra en Funciones_varias.js 
// document.addEventListener("keydown", valida_Longitud, false);//valida_Longitud() se encuentra en Funciones_varias.js 
// document.addEventListener("keyup", valida_Longitud, false);//valida_Longitud() se encuentra en 
//************************************************************************************************

//************************************************************************************************
//Por medio de delegación de eventos se detecta cada input donde se debe aplicar la funcion blanquearInput()
document.getElementsByTagName("body")[0].addEventListener('keydown', function(e){
    // console.log("______ Desde función anonima que detecta INPUTS ______") 

    if(e.target.tagName == "INPUT" || e.target.tagName == "TEXTAREA"){
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
///Escucha en cuenta_publicar_V.php por medio de delegación de eventos debido ya que el evento no esta cargado en el DOM por ser una solicitud Ajax   
//     document.getElementById('Contenedor_80').addEventListener('click',function(event){    
//     if(event.target.id == 'Span_5'){
//         CerrarModal_X('MostrarSeccion')
//     }
// }, false);

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
    //Realia el cambio de moneda Dolar a Bolivar
    function CambioMonetarioBolivar(Monto, id){
        console.log("______Desde CambioMonetarioBolivar______", Monto + " " + id)

        let Dolar = document.getElementById(id)
        let PrecioDolar = document.getElementById("CambioOficial").value
        console.log(Dolar)
        console.log(PrecioDolar)
        
        let Cambio_Dolar = Monto / PrecioDolar
       
        Dolar.value = Cambio_Dolar.toFixed(2)
    }

//************************************************************************************************ 
    //Realia el cambio de moneda Bolivar a Dolar
    function CambioMonetarioDolar(Monto, id){
        console.log("______Desde CambioMonetarioDolar______", Monto + " " + id)

        let Bolivar = document.getElementById(id)
        let PrecioDolar = document.getElementById("CambioOficial").value

        let Cambio_Bolivar = Monto * PrecioDolar

        Bolivar.value = Cambio_Bolivar.toFixed(2)
    }

//************************************************************************************************
    function ReiniciaCampo(id_1, id_2){
        document.getElementById(id_1).value = ''
        document.getElementById(id_2).value = ''
    }

//************************************************************************************************ 
    //Elimina imagenes previsualizadas
    function EliminarImagenSecundaria(Etiqueta, SeleccionImagenes){
        console.log("______Desde EliminarImagenSecundaria______", Etiqueta + " / " + SeleccionImagenes)
        
        console.log("Array imagenes seleccionadas= ", SeleccionImagenes)
        //Se elimina un elemento del array que contiene las imagenes para evitar que se inserten más de cinco
        b = 1
        SeleccionImagenes.reduce((a, b) => a + b)
        console.log("Array imagenes seleccionadas= ", SeleccionImagenes)
        
        //Se busca el id de la etiqueta donde se hizo click
        let ID_Etiqueta = Etiqueta.id
        console.log(ID_Etiqueta)

        //Se busca la imagen que corresponde a la etiqueta "Eliminar" donde se hizo click
        imagen = document.getElementById(ID_Etiqueta).previousSibling
        console.log(imagen)

        //Detectar la imagen que acompaña la etiqueta
        // let ImagenEliminar = document.getElementById(ID_Imagen)
        // console.log(ImagenEliminar)
        // console.log(EtiquetaEliminar)
                
        //Se busca el nodo padre que contiene la imagen y la etiqueta a eliminar
        let PadreImagen = imagen.parentElement
        // let PadreEtiqueta = EtiquetaEliminar.parentElement
            
        //Se elimina la imagen
        PadreImagen.removeChild(imagen);  
        PadreImagen.removeChild(Etiqueta);
    }
    
//************************************************************************************************
    //Valida el formulario de cargar producto
    function validarPublicacion(){
        let ImagenPrin = document.getElementById('imgInp').value 
        let Producto = document.getElementById('ContenidoPro').value
        let Descripcion = document.getElementById('ContenidoDes').value 
        let Seccion = document.getElementById('Seccion').value
        let PrecioBs = document.getElementById('PrecioBs').value 
        let PrecioDolar = document.getElementById('PrecioDolar').value  
        let Existencia = document.getElementById('Existencia').value 
  
        console.log("Imagen", ImagenPrin)
        document.getElementsByClassName("boton")[0].value = "Guardando ..."
        document.getElementsByClassName("boton")[0].disabled = true
        document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialClaro)"
        document.getElementsByClassName("boton")[0].style.color = "var(--OficialOscuro)"
        document.getElementsByClassName("boton")[0].style.cursor = "wait"
        document.getElementsByClassName("boton")[0].classList.add('borde_1')    

        // //Patron de entrada solo acepta numeros y punto
        let ER_Numeros = /^[0-9.]*$/
        
        // //Patron de entrada solo acepta numeros y punto
        let ER_SoloNumeros = /^[0-9]*$/

        //Patron de entrada para archivos de carga permitidos
        var ER_Ext_Permitidas = /^[.jpg|.jpeg|.png]*$/
                
        // if(ER_Ext_Permitidas.exec(ImagenPrin) == false || ImagenPrin.size > 2000000 || ImagenCatalogo == 'imagen.png'){
        //     alert("Introduzca una imagen con extención .jpeg .jpg .png menor a 2 Mb")
        //     document.getElementById("imgInp").value = "";
        //     document.getElementsByClassName("boton")[0].value = "Agregar producto"
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
            document.getElementsByClassName("boton")[0].value = "Agregar producto"
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
            document.getElementsByClassName("boton")[0].value = "Agregar producto"
            document.getElementsByClassName("boton")[0].disabled = false
            document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("boton")[0].style.cursor = "pointer"
            document.getElementsByClassName("boton")[0].classList.remove('borde_1')
            return false;
        } 
        else if(Seccion == ""){
            alert ("Necesita introducir la sección del producto")
            document.getElementById("Seccion").value = ""
            document.getElementById("Seccion").focus()
            document.getElementById("Seccion").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("boton")[0].value = "Guardar cambios"
            document.getElementsByClassName("boton")[0].disabled = false
            document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("boton")[0].style.cursor = "pointer"
            document.getElementsByClassName("boton")[0].classList.remove('borde_1')
            return false;
        }
        else if(ER_Numeros.exec(PrecioBs) == false || PrecioBs == "" || PrecioBs.indexOf(" ") == 0 || PrecioBs.length > 20){
            alert ("Introduzca un Precio")
            document.getElementById("PrecioBs").value = ""
            document.getElementById("PrecioBs").focus()
            document.getElementById("PrecioBs").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("boton")[0].value = "Agregar producto"
            document.getElementsByClassName("boton")[0].disabled = false
            document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("boton")[0].style.cursor = "pointer"
            document.getElementsByClassName("boton")[0].classList.remove('borde_1')
            return false;
        }
        else if(ER_Numeros.exec(PrecioDolar) == false || PrecioDolar == "" || PrecioDolar.indexOf(" ") == 0 || PrecioDolar.length > 20){
            alert ("Introduzca un Precio")
            document.getElementById("PrecioDolar").value = ""
            document.getElementById("PrecioDolar").focus()
            document.getElementById("PrecioDolar").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("boton")[0].value = "Agregar producto"
            document.getElementsByClassName("boton")[0].disabled = false
            document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("boton")[0].style.cursor = "pointer"
            document.getElementsByClassName("boton")[0].classList.remove('borde_1')
            return false;
        }
        else if(ER_SoloNumeros.exec(Existencia) == false || Existencia == "" || Existencia.indexOf(" ") == 0 || Existencia.length > 4){
            alert ("Introduzca la cantidad en existencia")
            document.getElementById("Existencia").value = ""
            document.getElementById("Existencia").focus()
            document.getElementById("Existencia").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("boton")[0].value = "Agregar producto"
            document.getElementsByClassName("boton")[0].disabled = false
            document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("boton")[0].style.cursor = "pointer"
            document.getElementsByClassName("boton")[0].classList.remove('borde_1')
            return false;
        }
        //Si se superan todas las validaciones la función devuelve verdadero
        return true
    }
document.addEventListener('DOMContentLoaded',function(){resize('Contenido')}, false)

document.getElementById("Contenedor_91").addEventListener('click', function(){CerrarModalAnuncios('MostrarAnuncios')}, false)

// document.getElementById("Contenido").addEventListener('keydown', function(){autosize('Contenido')}, false)

//************************************************************************************************
    //obtiendo informacion del DOM para identificar el elemento donde se hizo click 
    // window.addEventListener("click", function(e){   
    //     var click = e.target
    //     console.log("Se hizo click en: ", click)
    // }, false)
    
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
    //Muestra la cantidad de caracteres que ya tiene el campo; invocado en cuenta_editar_V.php
    function CaracteresAlcanzados(ID_Contenido, ID_Contador){
        // console.log("______Desde CaracteresAlcanzados()______",ID_Contenido + " / " + ID_Contador) 

        var Contenido = document.getElementById(ID_Contenido).value
        var ContadorContenido = document.getElementById(ID_Contador).value

        var CaracteresDisponibles = ContadorContenido - Contenido.length

        document.getElementById(ID_Contador).value = CaracteresDisponibles
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
    //Ajusta la altura del texarea según se vaya escribiendo en el mismo                
    function autosize(id){
        console.log("______Desde autosize()______", id)

        var el = document.getElementById(id);
        
        setTimeout(function(){
            el.style.cssText = 'height:auto; padding:0';
            el.style.cssText = 'height:' + el.scrollHeight + 'px';
        },0);
    }

//************************************************************************************************    
    //
    function CerrarModal(){
        document.getElementById("MostrarSeccion").style.display = "none"

        //Se limpia el input secciones en caso de haber seleccionado alguna
        document.getElementById("SeccionPublicar").value = ""
    } 
    
//************************************************************************************************    
    //
    function ConfirmarTrasferir(){
        document.getElementById("MostrarSeccion").style.display = "none"
    } 

//**********************************************************************************************
     function transferirSeccion(form, id){
        console.log("______Desde transferirSeccion()______", form + id)
        //Se declara el array que contendra la cantidad de categorias seleccionadas
        var TotalCategoria = []

        //Se reciben los elementos del formulario mediante su atributo name
        Seccion = form.seccion

        //Se recorre todos los elementos para encontrar el que esta seleccionado
        for(var i = 0; i<Seccion.length; i++){ 
            if(Seccion[i].checked){
                //Se toma el valor del seleccionado
                Seleccionado = Seccion[i].value
                TotalCategoria.push(Seleccionado );
            }            
        } 

        //Se transfiere el valor del radio boton seleccionado al input del formulario
        document.getElementById(id).value = TotalCategoria           
    }

//************************************************************************************************  
function transferirAnuncio(form){
    // console.log("______Desde transferirAnuncio()______", form )

    //Se reciben los elementos del formulario mediante su atributo name
    ID_Anuncio = form.anuncio

     // En el caso que la seccion tenga un solo producto, se añade un input radio, sino se añade el Opcion.legth sera undefined y no entrará en el ciclo for
     if(ID_Anuncio.length == undefined){

     //Se añade una opcion al input tipo radio para que existan al menos dos opciones, cuando es uno el valor de Opcion.length es undefined lo que impide que se ejecute el ciclo for más adelante, esto sucede cuando solo existe un producto en una seccción
         //Se crea un input tipo radio que pertenezca a los de name="opcion"
         var NuevoElemento = document.createElement("input")

         //Se dan valores a la propiedades del nuevo elemento 
         NuevoElemento.name = "anuncio"
         NuevoElemento.setAttribute("type", "radio");
        //  console.log(NuevoElemento)

         //Se especifica el elemento donde se va a insertar el nuevo elemento
         var ElementoPadre = document.getElementById("Contenedor_Radio")
        //  console.log(ElementoPadre)

         //Se inserta en el DOM el input creado
         inputNuevo = ElementoPadre.appendChild(NuevoElemento) 

         //Se renombra la variable ID_Anuncio
         ID_Anuncio = form.anuncio
     }

    // //Se recorre todos los elementos para encontrar el que esta seleccionado
    for(var i = 0; i<ID_Anuncio.length; i++){ 
        if(ID_Anuncio[i].checked){
            //Se toma el valor del seleccionado
            Seleccionado = ID_Anuncio[i].value
            // TotalCategoria.push(Seleccionado );
        }            
    } 
    
    // console.log("ID_Anuncio", Seleccionado)

    //Se transfiere el valor del radio boton seleccionado al input del formulario
    document.getElementById("ID_Anuncio").value = Seleccionado

    //Se cambia el valor del input que da acceso a actualizar cuando el controlador recibe los datos
    document.getElementById("Actualiza").value = 'SiActualizar'

    //Coloca el curso en el ancla
    window.location.hash = "#Contenedor_Anuncio"; 

    //Se cierra la venana modal
    document.getElementById("MostrarAnuncios").style.display = "none"  
}

//************************************************************************************************   
// elimina una imagen secundaria
function EliminarImagenSecundaria(ID_Imagen, Botones, Ruta){
    console.log("______Desde EliminarImagenSecundaria()______", ID_Imagen + ' -'  +  Botones + ' - ' + Ruta)
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
        
        Llamar_ImagenSecundaria(Ruta)
    } 
    else{
        return
    }
}

//************************************************************************************************

//************************************************************************************************
    //Valida el formulario de actualizar noticia
    function validarActualizarNoticia(){
        document.getElementsByClassName("boton")[0].value = "Actualizando ..."
        document.getElementsByClassName("boton")[0].disabled = "disabled"
        document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialClaro)"
        document.getElementsByClassName("boton")[0].style.color = "var(--OficialOscuro)"
        document.getElementsByClassName("boton")[0].style.cursor = "wait"
        document.getElementsByClassName("boton")[0].classList.add('borde_1')
        
        let usuario = document.getElementById('Correo').value
        let clave = document.getElementById('Clave').value  
        
        //Si se superan todas las validaciones la función devuelve verdadero
        return true
    }
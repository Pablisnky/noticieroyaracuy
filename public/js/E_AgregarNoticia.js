// document.getElementById("Contenido").addEventListener('keydown', function(){autosize('Contenido')}, false)


document.getElementById("Titulo").addEventListener('keydown', function(){contarCaracteres("ContadorTitulo", "Titulo", 90)}, false)
document.getElementById("Titulo").addEventListener('keydown', function(){valida_LongitudDes(90, "Titulo")}, false)
document.getElementById("Titulo").addEventListener('keyup', function(){contarCaracteres("ContadorTitulo", "Titulo", 90)}, false)
document.getElementById("Titulo").addEventListener('keyup', function(){valida_LongitudDes(90, "Titulo")}, false)



document.getElementById("Resumen").addEventListener('keydown', function(){contarCaracteres("ContadorResumen", "Resumen", 120)}, false)
document.getElementById("Resumen").addEventListener('keydown', function(){valida_LongitudDes(120, "Resumen")}, false)
document.getElementById("Resumen").addEventListener('keyup', function(){contarCaracteres("ContadorResumen", "Resumen", 120)}, false)
document.getElementById("Resumen").addEventListener('keyup', function(){valida_LongitudDes(120, "Resumen")}, false)


document.getElementById("Contenido").addEventListener('keydown', function(){contarCaracteres("ContadorContenido", "Contenido", 7000)}, false)
document.getElementById("Contenido").addEventListener('keydown', function(){valida_LongitudDes(7000, "Contenido")}, false)
document.getElementById("Contenido").addEventListener('keyup', function(){contarCaracteres("ContadorContenido", "Contenido", 7000)}, false)
document.getElementById("Contenido").addEventListener('keyup', function(){valida_LongitudDes(7000, "Contenido")}, false)

//llama a la funcion cuando detecta cambio en el textarea, Ej: al pegar un texto
document.getElementById("Titulo").addEventListener("input", (event) => contarCaracteres("ContadorTitulo", "Titulo", 90));
document.getElementById("Resumen").addEventListener("input", (event) => contarCaracteres("ContadorResumen", "Resumen", 120));
document.getElementById("Contenido").addEventListener("input", (event) => autosize("Contenido"));
//************************************************************************************************
    //obtiendo informacion del DOM para identificar el elemento donde se hizo click 
    // window.addEventListener("click", function(e){   
    //     var click = e.target
    //     console.log("Se hizo click en: ", click)
    // }, false)
    
//************************************************************************************************
    //Muestra la cantidad de caracteres que quedan mientras se escribe
    function contarCaracteres(ID_Contador, ID_Contenido, Max){
        console.log("______Desde contarCaracteres()______", ID_Contador + " / " + ID_Contenido + " / " + Max) 
        let max = Max; 
        // console.log(max) 
        let cadena = document.getElementById(ID_Contenido).value; 
        // console.log(cadena)
        let longitud = cadena.length; 

        if(longitud <= max) { 
            document.getElementById(ID_Contador).value = max-longitud; 
        } 
        else{ //Si se escribe mas de lo permitido no permite continuar
            document.getElementById(ID_Contador).value = cadena.subtring(0, max);
           
            document.getElementById(ID_Contenido).addEventListener('blur', function(){blaquearInput("Titulo")}, false)
        } 
    } 

//************************************************************************************************ 
    //Impide que se sigan introduciendo caracteres al alcanzar el limite maximo en un elmento
    let contenidoControlado = "";    
    function valida_LongitudDes(Max, ID_Contenido){
        console.log("______Desde valida_LongitudDes()______", Max + " / "+ ID_Contenido) 
                
        let num_caracteres_permitidos = Max;

        //se detecta la cantidad de caracteres escritos 
        let num_caracteresEscritos = document.getElementById(ID_Contenido).value.length

        if(num_caracteresEscritos > num_caracteres_permitidos){ 
            document.getElementById(ID_Contenido).value = contenidoControlado; 
        }
        else{ 
            contenidoControlado = document.getElementById(ID_Contenido).value; 
        } 
    } 

//************************************************************************************************
    //Ajusta la altura del texarea según se vaya escribiendo en el mismo       
    var autoaumentar = false         
    function autosize(id){
        // console.log("______Desde autosize()______", id)
        if(autoaumentar == false){
            var el = document.getElementById(id);
            
            setTimeout(function(){
                el.style.cssText = 'height:auto; padding:0';
                el.style.cssText = 'height:' + el.scrollHeight + 'px';
            },0);

            autoaumentar = true
        }
    }

//************************************************************************************************ 
    //ajusta la altura de un texarea con respecto al contenido que trae de la BD
    function resize(id){
        // console.log("______Desde resize()______", id) 
        var text = document.getElementById(id);
        text.style.height = 'auto';
        text.style.height = text.scrollHeight+'px';
    }

//************************************************************************************************    
    //
    function CerrarModal(){
        // console.log("______ Desde CerrarModal() ______") 
        document.getElementById("MostrarSeccion").style.display = "none"

        //Se limpia el input secciones en caso de haber seleccionado alguna
        document.getElementById("SeccionPublicar").value = ""
    } 

//************************************************************************************************    
    //
    function CerrarModalAnuncios(){
        document.getElementById("MostrarAnuncios").style.display = "none"
    } 

//************************************************************************************************    
    //
    function ConfirmarTrasferir(){
        // console.log("______ Desde ConfirmarTrasferir() ______") 
        document.getElementById("MostrarSeccion").style.display = "none"

        //Coloca el curso en el ancla
        window.location.hash = "#LabelSeccion";     
    } 

//************************************************************************************************  
     function transferirSeccion(form, id){
        // console.log("______Desde transferirSeccion()______")
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
            //Se crea un input tipo radio que pertenezca a los de name = "opcion"
            var NuevoElemento = document.createElement("input")

            //Se dan valores a la propiedades del nuevo elemento 
            NuevoElemento.name = "anuncio"
            NuevoElemento.setAttribute("type", "radio");

            //Se especifica el elemento donde se va a insertar el nuevo elemento
            var ElementoPadre = document.getElementById("Contenedor_Radio")

            //Se inserta en el DOM el input creado
            inputNuevo = ElementoPadre.appendChild(NuevoElemento) 

            //Se renombra la variable Opcion
            ID_Anuncio = form.anuncio
        }

        // //Se recorre todos los elementos para encontrar el que esta seleccionado
        for(let i = 0; i < ID_Anuncio.length; i++){ 
            if(ID_Anuncio[i].checked){
                //Se toma el valor del seleccionado
                Seleccionado = ID_Anuncio[i].value
                console.log(ID_Anuncio[i].value)
                // TotalCategoria.push(Seleccionado );
            }            
        } 
        
        console.log("ID_Anuncio", Seleccionado)

        //Se transfiere el valor del radio boton seleccionado al input del formulario
        document.getElementById("ID_Anuncio").value = Seleccionado

        //Coloca el curso en el ancla
        window.location.hash = "#Contenedor_Anuncio"; 
    
        //Se cierra la venana modal
        document.getElementById("MostrarAnuncios").style.display = "none"  
    }

//************************************************************************************************  
    function blaquearInput(ID_Contenido){
        // console.log("______Desde blaquearInput()______") 
        document.getElementById(ID_Contenido).value = ""
    }
    
//************************************************************************************************  
    function validarAgregarNoticia(){
        document.getElementById("Boton_Agregar").value = "Procesando..."
        document.getElementById("Boton_Agregar").disabled = "disabled"
        document.getElementById("Boton_Agregar").style.backgroundColor = "var(--OficialClaro)"
        document.getElementById("Boton_Agregar").style.color = "var(--OficialOscuro)"
        document.getElementById("Boton_Agregar").style.cursor = "wait"
        document.getElementById("Boton_Agregar").classList.add('borde_1')

        let ImagenPrin = document.getElementById('imgInp').value 
        let Titulo = document.getElementById('Titulo').value.trim()
        let Resumen = document.getElementById('Resumen').value.trim()
        let Fecha = document.getElementById('datepicker').value
        let Seccion = document.getElementById('SeccionPublicar').value
        
        //Patron de entrada para archivos de carga permitidos
        var Ext_Permitidas = /^[.jpg|.jpeg|.png]*$/
                   
        if(Ext_Permitidas.exec(ImagenPrin) == false || ImagenPrin.size > 2000000){
            alert("Introduzca una imagen con extención .jpeg .jpg .png menor a 2 Mb")
            document.getElementById("imgInp").value = "";
            document.getElementsByClassName("boton")[0].value = "Guardar"
            document.getElementsByClassName("boton")[0].disabled = false
            document.getElementsByClassName("boton")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("boton")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("boton")[0].classList.remove('borde_1')
            document.getElementById("Boton_Agregar").style.cursor = "pointer"
            return false;
        }
        else if(Titulo =="" || Titulo.indexOf(" ") == 0 || Titulo.length > 90){
            alert ("El titulo excede el máximo de caracteres");
            document.getElementById("Titulo").value = "";
            document.getElementById("Titulo").focus();
            // document.getElementById("Titulo").style.backgroundColor = "var(--Fallos)"
            document.getElementById("Boton_Agregar").value = "Agregar noticia"
            document.getElementById("Boton_Agregar").disabled = false
            document.getElementById("Boton_Agregar").style.backgroundColor = "var(--OficialOscuro)"
            document.getElementById("Boton_Agregar").style.color = "var(--OficialClaro)"
            document.getElementById("Boton_Agregar").classList.remove('borde_1')
            document.getElementById("Boton_Agregar").style.cursor = "pointer"
            return false;
        }
        else if(Resumen =="" || Resumen.indexOf(" ") == 0 || Titulo.length > 120){
            alert ("Evalue el contenido del RESUMEN");
            document.getElementById("Resumen").value = "";
            document.getElementById("Resumen").focus();
            // document.getElementById("Resumen").style.backgroundColor = "var(--Fallos)"
            document.getElementById("Boton_Agregar").value = "Agregar noticia"
            document.getElementById("Boton_Agregar").disabled = false
            document.getElementById("Boton_Agregar").style.backgroundColor = "var(--OficialOscuro)"
            document.getElementById("Boton_Agregar").style.color = "var(--OficialClaro)"
            document.getElementById("Boton_Agregar").classList.remove('borde_1')
            document.getElementById("Boton_Agregar").style.cursor = "pointer"
            return false;
        }
        else if(Seccion =="" || Seccion.indexOf(" ") == 0){
            alert ("Ingrese una sección para la noticia");
            document.getElementById("SeccionPublicar").value = "";
            document.getElementById("SeccionPublicar").focus();
            // document.getElementById("SeccionPublicar").style.backgroundColor = "var(--Fallos)"
            document.getElementById("Boton_Agregar").value = "Agregar noticia"
            document.getElementById("Boton_Agregar").disabled = false
            document.getElementById("Boton_Agregar").style.backgroundColor = "var(--OficialOscuro)"
            document.getElementById("Boton_Agregar").style.color = "var(--OficialClaro)"
            document.getElementById("Boton_Agregar").classList.remove('borde_1')
            document.getElementById("Boton_Agregar").style.cursor = "pointer"
            return false;
        }
        else if(Fecha =="" || Fecha.indexOf(" ") == 0){
            alert ("Fecha no valida");
            document.getElementById("datepicker").value = "";
            document.getElementById("datepicker").focus();
            // document.getElementById("Fecha").style.backgroundColor = "var(--Fallos)"
            document.getElementById("Boton_Agregar").value = "Agregar noticia"
            document.getElementById("Boton_Agregar").disabled = false
            document.getElementById("Boton_Agregar").style.backgroundColor = "var(--OficialOscuro)"
            document.getElementById("Boton_Agregar").style.color = "var(--OficialClaro)"
            document.getElementById("Boton_Agregar").classList.remove('borde_1')
            document.getElementById("Boton_Agregar").style.cursor = "pointer"
            return false;
        }
        //Si se superan todas las validaciones la función devuelve verdadero
        return true
    }
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
    function Llamar_filtrarMunicipio(Municipio){
        console.log("______Desde Llamar_filtrarMunicipio()______", Municipio)
        
        // localStorage crada en MostrarMunicipios() del archivo E_Noticias.js
        Seccion = localStorage.getItem('LS_Seccion')

        // remoto
        // var url = 'https://www.noticieroyaracuy.com/noticia/filtrarMunicipio/' + Seccion + '/' + Municipio
        
        // local
        var url = 'http://nuevonoticiero.com/noticia/filtrarMunicipio/' + Seccion + '/' + Municipio

        http_request.open('GET', url, true)  
        peticion.onreadystatechange = respuesta_filtrarMunicipio
        peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
        peticion.send("null")
    }                                                                        
    function respuesta_filtrarMunicipio(){
        if(peticion.readyState == 4){
            if(peticion.status == 200){ 
                // se oculta el menu de municipios
                document.getElementById('Con_Municipios').classList.remove("mostrar_1")       
                statu = false
                           

                let Filtro = 'Filtro_' + Seccion
                console.log(Filtro)

                // se muestra el icono de quitar filtro               
                document.getElementById(Filtro).classList.remove("Default_Ocultar")
                document.getElementById(Filtro).classList.add("Default_Mostrar")

                // se busca la daltura del heaader (desde el top del viewport) para colocar la seccion filtrado justo debajo de esa distancia                
                // var profundidaHeader = document.getElementById('Header').getBoundingClientRect();
                // console.log(profundidaHeader)
                // console.log(document.getElementById(Seccion))
                // document.getElementById(Seccion).style.backgroundColor = "red"
                // // Se coloca la seccion donde se filtro y se coloca en la parte superior deo viewport
                // document.getElementById(Seccion).scroll({
                //     top: 350,
                //     behavior: 'smooth'
                //   });   
                let Busqueda = 'Busqueda_' + Seccion

                document.getElementById(Busqueda).scroll({
                    left: 0,
                    behavior: 'smooth'
                });

                document.getElementById(Busqueda).innerHTML = peticion.responseText 
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
    //Esta funcion no retorna nada al documento donde se llama, solo ejecuta la accion de eliminar la noticia del servidor
    function Llamar_Quitarfiltro(seccion, Ruta){
        console.log("______Desde Llamar_Quitarfiltro()______", seccion + ' / ' +  Ruta)

        localStorage.setItem('LS_QuitarSeccion', seccion)
        QuitarFiltro = localStorage.getItem('LS_QuitarSeccion')
        // console.log(QuitarFiltro)

        var url = Ruta
        http_request.open('GET', url, true)  
        peticion.onreadystatechange = respuesta_Quitarfiltro
        peticion.setRequestHeader("content-type","application/x-www-form-urlencoded")
        peticion.send("null")
    }                                                                        
    function respuesta_Quitarfiltro(){
        if(peticion.readyState == 4){
            if(peticion.status == 200){ 
                // se oculta el icono de quitar filtro               
                
                  
                let Filtro = 'Filtro_' + QuitarFiltro 
                // console.log(Filtro)
                document.getElementById(Filtro).classList.remove("Default_Mostrar")
                document.getElementById(Filtro).classList.add("Default_Ocultar")

                let QuitarBusqueda = 'Busqueda_' + QuitarFiltro

                document.getElementById(QuitarBusqueda).scroll({
                    left: 0,
                    behavior: 'smooth'
                  });

                document.getElementById(QuitarBusqueda).innerHTML = peticion.responseText 
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
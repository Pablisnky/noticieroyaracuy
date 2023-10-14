document.getElementById("Secciones").addEventListener('click',MostrarSecciones, false)

//************************************************************************************************
// Verificar si existen productos previamente cargados en el carrito
LS_Carrito = JSON.parse(localStorage.getItem('CarritoDeCompras'))

//Si no hay nada cargado en el carrito se declaro el array AlContenedor vacio
AlContenedor = LS_Carrito == undefined ? Array () : LS_Carrito 

if(AlContenedor != Array ()){
    let ID_TiendaActual = document.getElementById("ID_Suscriptor").value
    let ID_TiendaEnCarrito = AlContenedor[0]['ID_Suscriptor']
    let PseudonimoSuscripto = document.getElementById("PseudonimoSuscripto").value
    
    // console.log('ID_Suscriptor = ', ID_TiendaEnCarrito)
    // console.log('pseudonimoSuscripto = ', PseudonimoSuscripto)    
    // console.log('ID_TiendaActual = ', ID_TiendaActual)
    // console.log('ID_TiendaPendiente = ', ID_TiendaEnCarrito)

    // Verifica si el carrito de compras tiene cargado productos de otra tienda
    if(ID_TiendaEnCarrito != ID_TiendaActual){
        let ConfirmaCarrito =  confirm("Tienes una compra pendiente en otra tienda, ¿Deseas continuarla o cancelarla?")
        
        //Se confirma si se desea vaciar el carrito de compras
        if(ConfirmaCarrito == true){  

            // redirecciona a la tienda donde estan los productos que quedaron cargados anteriormente 

            // remoto 
            // location.replace("https://www.noticieroyaracuy.com/marketplace/catalogo/" + ID_TiendaEnCarrito + "/" + PseudonimoSuscripto ); 

            // local
            location.replace("http://nuevonoticiero.com/marketplace/catalogo/" + ID_TiendaEnCarrito + "/" + PseudonimoSuscripto );  
            
        } 
        else{                   
            localStorage.removeItem('CarritoDeCompras');
    
            //Se refresca la pagina
            location.reload()
            
            //Coloca el cursor en el top de la pagina
            window.scroll(0, 0)
        } 
    }

    DisplayDestello()
    
    //Guarda la suma del monto total del pedido que se muestra en el display del carrito de compras
    TotalDisplayCarrito = TotalDisplayCarrito == undefined ? Array () : TotalDisplayCarrito
    // console.log('TotalDisplayCarrito', TotalDisplayCarrito)
}

// console.log ('LS_Carrito', LS_Carrito)
// console.log ('AlContenedor', AlContenedor)

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
    function cerrarVentana(){     
        window.close()
    }

//************************************************************************************************
    var statu = false //CUando carga el archivo le da valor false, solo la primera vez luego el valor cambia al llamar la funcion
    function MostrarSecciones(){        
    console.log("______Desde MostrarSecciones______")   
       
        if(statu == true){
            document.getElementById("Con_Secciones").classList.remove("ocultar");        
            statu = false
        }
        else{
            document.getElementById("Con_Secciones").classList.add("ocultar");
            statu = true
        }
    }

//************************************************************************************************
//Declarar el array que contiene los ID_Opcion que se añaden al carrito
//Verificar para que sirve, creo que solo es util en la función decremento
PedidoCarrito = []

//Declarar el array que contiene los detalles de cada producto pedido y la ubicación de cada uno dentro de una sección, cada detalle se inserta al array como un objeto JSON, es usado en opciones_V.php, es usado para alimentar "Tu Orden" en carrito_V.php y las leyendas en cada sección y en cada producto
// AlContenedor = []

//Guarda cada precio de los productos pedidos 
// DisplayCarrito = []  


//Guarda los contenedores que muestran productos que han sido cargados al carrito
ProductoEnCarrito = []

//Mediante el constructor de objetos se crea un objeto con todos los productos del pedido, información solicitada al entrar al carrito, este objeto edita al array AlContenedor[]
function PedidoCar(Producto, Cantidad, Total){
    this.Producto = Producto
    this.Cantidad = Cantidad
    this.Total = Total
}

//Mediante el constructor de objetos se crea un objeto con todos los productos del pedido, información solicitada al entrar al carrito, este objeto alimenta al array AlContenedor[]
function ContenedorCar(Cont_Leyenda, ID_Input_Leyenda, ID_Boton_Agregar, ID_InputCantidad, ID_InputProducto, ID_InputOpcion, ID_InputPrecio, ID_InputTotal, ID_InputDisplayCant, Cantidad, ID_Opcion, Producto, Opcion, Precio,Total, ID_Seccion, Existencia, ID_BotonMas, ID_BotonBloqueo, ID_Suscriptor){
    this.Cont_Leyenda = Cont_Leyenda  
    this.ID_Input_Leyenda = ID_Input_Leyenda
    this.ID_Boton_Agregar = ID_Boton_Agregar
    this.ID_InputCantidad = ID_InputCantidad
    this.ID_InputProducto = ID_InputProducto
    this.ID_InputOpcion = ID_InputOpcion
    this.ID_InputPrecio = ID_InputPrecio
    this.ID_InputTotal = ID_InputTotal
    this.ID_InputDisplayCant = ID_InputDisplayCant
    this.Cantidad = Cantidad
    this.ID_Opcion = ID_Opcion
    this.Producto = Producto
    this.Opcion = Opcion
    this.Precio = Precio
    this.Total = Total
    this.ID_Seccion = ID_Seccion
    this.Existencia = Existencia
    this.ID_BotonMas = ID_BotonMas
    this.ID_BotonBloqueo = ID_BotonBloqueo
    this.ID_Suscriptor = ID_Suscriptor

}

// ************************************************************************************************** 
//obtiendo informacion del DOM para identificar el elemento donde se hizo click 
// window.addEventListener("click", function(e){   
//     var click = e.target
//     console.log("Se hizo click en: ", click)
// }, false)
// ************************************************************************************************** 

//Cuando carga la página clasificados_V.php se registran listener para el evento clic en toda la ventana, es decir, cada vez que se hace click en esa página se esta llamanado a la función Pre_incremento  y Pre_decremento 
document.addEventListener("click", Pre_decremento)
document.addEventListener("click", Pre_incremento)

//Escucha desde modal_fueraHorario_V.php 
if(document.getElementById("Label_1")){
    document.getElementById("Label_1").addEventListener('click', function(){CerrarModal_X('Section_1')}, false)
}

// *****************************************************************************************************
    // Indica si se realiza el delivery o el cliente recoge en tienda
    function Despacho(){
        // console.log("______ Desde Despacho ______")

        let porNombre = document.getElementsByName("entrega")
        //Se recorren todos los valores del radio button para encontrar el seleccionado
        for(var i=0; i<porNombre.length; i++){
            if(porNombre[i].checked){
                E = porNombre[i].value;
                // console.log(E)
            }
        }

        //Se obtiene el valor del domicilio, tarado a un 1,3 dolares (esto se esta haciendo dss veces en este archivo, corregir)
        envio = document.getElementById("PrecioEnvio").value

        //Se muestra la condicion de despacho
        if(E == "Domicilio_No"){
            document.getElementById("Despacho_2").value = 0
            
            //Se cambia el monto total del pedido incluyendo comision y envio
            MontoTotal = Number(TotalDisplayCarrito)

            //Se calcula el monto en Dolares
            MontoTotalDolares = MontoTotal / LS_ValorDolarHoy
            MontoTotalDolares = MontoTotalDolares.toFixed(2)

            //Se muestra el monto de total de la compra incluyendo envio en Bolivares
            document.getElementById("MontoTotal").value = SeparadorMiles(MontoTotal)
            
            //Se muestra el monto de total de la compra incluyendo envio en Dolares, con dos decimales
            document.getElementById("MontoTotalDolares").value = SeparadorMiles(MontoTotalDolares)
        }
        else{//Entra en ele ELSE en caso de pagar por despacho
            envio = Number.parseFloat(envio).toFixed(2);
            // console.log(envio)
            document.getElementById("Despacho_2").value = SeparadorMiles(envio)

            //Se cambia el monto total del pedido incluyendo comision y envio
            MontoTotal = Number(TotalDisplayCarrito) + Number(envio)
            MontoTotal = MontoTotal.toFixed(2)
            // console.log("MontoTotal", MontoTotal)
            
            //Se calcula el monto en Dolares
            MontoTotalDolares = MontoTotal / LS_ValorDolarHoy
            MontoTotalDolares = MontoTotalDolares.toFixed(2)

            //Se muestra el monto de total de la compra incluyendo comision y envio
            document.getElementById("MontoTotal").value = SeparadorMiles(MontoTotal)

            //Se muestra el monto de total de la compra incluyendo envio en Dolares, con dos decimales
            document.getElementById("MontoTotalDolares").value = SeparadorMiles(MontoTotalDolares)
        }
    }
  
    
//************************************************************************************************S
    //
    function MuestraEnvioFactura(){
        // console.log("______Desde MuestraEnvioFactura()______") 

        //Se consulta el alto del DIV id=Contenedor_24, para coloca el cursor en el top de la pagina
        AltoContenedor_24 = document.getElementById("Contenedor_24").scrollHeight
        // console.log("Alto contenedor_24", AltoContenedor_24)
        
        // Desplazamiento = Number("-" + AltoContenedor_24)
        // console.log("Alto contenedor_24", Desplazamiento)
        // window.scroll(0, Desplazamiento) /*posiciona el elemento sin efecto smooth */
        window.scrollBy({
            top: 390,
            left: 0,
            behavior: 'smooth'
          });

        // document.getElementById("Contenedor_24").style.marginTop = "-" + AltoContenedor_24 + "px"
        document.getElementById("MuestraEnvioFactura").style.display = "block"
        document.getElementById("Contenedor_26").style.display = "none"
    }
    
//************************************************************************************************
    // añade un producto al carrito   
    function agregarProducto(form, ID_Etiqueta, ID_Cont_Leyenda, ID_InputCantidad, ID_InputProducto, ID_InputOpcion, ID_InputPrecio, ID_InputTotal, ID_InputLeyenda, ID_Cont_Producto, ID_InputDisplayCan, existencia, ID_BotonMas, ID_BloqueoMas, ID_Suscriptor){
        // console.log("______Desde agregarProducto()______") 
        
        //Se recibe el control del formulario con el nombre "opcion"
        Opcion = form.opcion        

        // En el caso que la seccion tenga un solo producto, se añade un input radio, sino se añade el Opcion.legth sera undefined y no entrará en el ciclo for
        if(Opcion.length == undefined){

        //Se añade una opcion al input tipo radio para que existan al menos dos opciones, cuando es uno el valor de Opcion.length es undefined lo que impide que se ejecute el ciclo for más adelante, esto sucede cuando solo existe un producto en una seccción
            //Se crea un input tipo radio que pertenezca a los de name = "opcion"
            var NuevoElemento = document.createElement("input")

            //Se dan valores a la propiedades del nuevo elemento 
            NuevoElemento.name = "opcion"
            NuevoElemento.setAttribute("type", "radio");

            //Se especifica el elemento donde se va a insertar el nuevo elemento
            var ElementoPadre = document.getElementById("Formulario")

            //Se inserta en el DOM el input creado
            inputNuevo = ElementoPadre.appendChild(NuevoElemento) 

            //Se renombra la variable Opcion
            Opcion = form.opcion
        }
        // console.log("Opcion", Opcion)

        //Se recibe el ID de la etiqueta donde se hizo click
        LabelClick = ID_Etiqueta
        localStorage.setItem('BotonAgregar', LabelClick) 
        LS_ID_BotonAgregar = localStorage.getItem('BotonAgregar')

        //Se recibe el ID del contenedor de la leyenda del producto y los botones de más y menos donde se hizo click
        Cont_Leyenda_Click = ID_Cont_Leyenda
        localStorage.setItem('ID_cont_LeyendaDinamico',Cont_Leyenda_Click) 
        LS_ID_Cont_Leyenda = localStorage.getItem('ID_cont_LeyendaDinamico')
        
        //Se recibe el ID del input que va a mostrar la cantidad (en este momento es 1) del producto donde se hizo click
        Input_CantidadClick = ID_InputCantidad
        localStorage.setItem('ID_InputCantidad', Input_CantidadClick)
        LS_ID_InputCantidad = localStorage.getItem('ID_InputCantidad')

        //Se recibe el ID del input que va a mostrar el producto donde se hizo click
        Input_ProductoClick = ID_InputProducto
        localStorage.setItem('ID_InputProducto', Input_ProductoClick)
        LS_ID_InputProducto = localStorage.getItem('ID_InputProducto')    

        //Se recibe el ID del input que va a mostrar la opcion del producto donde se hizo click
        Input_OpcionClick = ID_InputOpcion
        localStorage.setItem('ID_InputOpcion', Input_OpcionClick)
        LS_ID_InputOpcion = localStorage.getItem('ID_InputOpcion') 
        
        //Se recibe el ID del input que va a mostrar el precio del producto donde se hizo click
        Input_PrecioClick = ID_InputPrecio
        localStorage.setItem('ID_InputPrecio', Input_PrecioClick)
        LS_ID_InputPrecio = localStorage.getItem('ID_InputPrecio')

        //Se recibe el ID del input que va a mostrar el total del producto donde se hizo click
        Input_TotalClick = ID_InputTotal
        localStorage.setItem('ID_InputTotal',Input_TotalClick)
        LS_ID_InputTotal = localStorage.getItem('ID_InputTotal')

        //Se recibe el ID del input que va a mostrar la leyenda del producto donde se hizo click
        Input_LeyendaClick = ID_InputLeyenda
        localStorage.setItem('ID_InputLeyenda',Input_LeyendaClick)
        LS_ID_InputLeyenda = localStorage.getItem('ID_InputLeyenda')

        //Se recibe el ID del contenedor que muestra el producto donde se hizo click
        ID_ContenedorProducto = ID_Cont_Producto
        localStorage.setItem('ID_ContenedorProducto',ID_ContenedorProducto)
        
        //Se recibe el ID del input que va a mostrar la leyenda del producto donde se hizo click
        Input_DisplayCantClick = ID_InputDisplayCan
        localStorage.setItem('ID_InputDisplay',Input_DisplayCantClick)
        LS_ID_InputDisplayCant = localStorage.getItem('ID_InputDisplay')

        //Se recorren las opciones del producto 
        for(let i = 0; i < Opcion.length; i++){
            if(Opcion[i].checked){
                Opcion = Opcion[i].value 
                            
                //La Opcion seleccionada contiene el ID_Opcion(asignado en BD), el producto, la opcion y el precio separados por un _ (guion bajo) es necesario separar estos valores, para convertirlos en un array
                let Separado = Opcion.split("_")  

                //Se eliminan las comas al final de cada elemento del array
                Separado[0] = Separado[0].slice(0,-1)//ID_Opcion
                Separado[1] = Separado[1].slice(0,-1)//Producto
                Separado[2] = Separado[2].slice(0,-1)//Opcion
                Separado[3] = Separado[3].slice(0,-1)//Precio
                Separado[4] = Separado[4].slice(0)//Seccion
                // console.log(Separado[0])
                // console.log(Separado[1])
                // console.log(Separado[2])
                // console.log('Precio', Separado[3])
                // console.log(Separado[4])
                
                localStorage.setItem('ID_Opcion',Separado[0])

                // Para efectos de calculo en el BACKEND al precio se da formato sin separar decimales 
                Separado[3] = Separado[3].replaceAll('.','')

                //Se oculta el boton "Agregar" del elemento donde se hizo click
                document.getElementById(LabelClick).style.display = "none"
   
                //Se muestra el contenedor donde irá la leyenda donde se hizo click
                document.getElementById(Cont_Leyenda_Click).style.display = "block"

                //Se muestra la cantidad de producto deseada por el usuario donde se hizo click
                Cantidad_uno = document.getElementById(Input_CantidadClick).value = 1
                
                //Se muestra el producto donde se hizo click
                document.getElementById(Input_ProductoClick).value = Separado[1]             
                                
                //Se muestra la opcion de producto donde se hizo click
                document.getElementById(Input_OpcionClick).value = Separado[2]

                //Se muestra el precio del producto donde se hizo click, que será el mismo precio del total porque es un solo producto
                Precio = document.getElementById(Input_PrecioClick).value = Separado[3]
                   
                //Si un producto se eliminó en una entrada anterior es necesario activar nuevamente el input donde ira la leyenda y los botones de más y menos
                document.getElementById(Input_LeyendaClick).style.display = "block"         

                //Se muestra la leyenda del producto donde se hizo click
                InputLeyenda = document.getElementById(Input_LeyendaClick)
                InputLeyenda.value = 1 + ' ' + Separado[1] + ' = ' + Separado[3] + ' Bs.'
                                        
                Inp_Leyenda = document.getElementById(LS_ID_InputLeyenda)

                var ID_BotonMas = document.getElementById(ID_BotonMas).id
                var ID_BotonBloqueo = document.getElementById(ID_BloqueoMas).id

                //Guarda en el objeto "AlContenedor", la leyenda del producto, cada detalle en si es un array, por lo que AlContenedor es un array de objetos
                Contenedores = new ContenedorCar(LS_ID_Cont_Leyenda, LS_ID_InputLeyenda, LS_ID_BotonAgregar, LS_ID_InputCantidad, LS_ID_InputProducto, LS_ID_InputOpcion, LS_ID_InputPrecio, LS_ID_InputTotal, LS_ID_InputDisplayCant, Cantidad_uno, Separado[0], Separado[1], Separado[2], Separado[3], Separado[3], Separado[4], existencia, ID_BotonMas, ID_BotonBloqueo, ID_Suscriptor)
                
                  //Si la existencia en BD es igual a 1 se oculta el boton de mas y menos para que no se añadan más productos al carrito
                if(existencia == Cantidad_uno){
                    document.getElementById(ID_BotonMas).style.display = "none" 
                    document.getElementById(ID_BloqueoMas).style.display = "inline" 
                }
                else{
                    document.getElementById(ID_BotonMas).style.display = "inline" 
                    document.getElementById(ID_BloqueoMas).style.display = "none" 
                }
            } 
        }
        
        // console.log(JSON.parse(localStorage.getItem('CarritoDeCompras')))

        // console.log(AlContenedor)
        AlContenedor.push(Contenedores)
        // console.log(AlContenedor)

        // console.log('LS_CarritoDeCompras_ANTES', LS_CarritoDeCompras_Seccion)
        
            //Se guarda el contenido del carrito en una variable localStore para usarla en los archivos involucrados en la compra, teniendo en cuenta que no se puede guardar directamente sin antes convertirlo en JSon
            localStorage.setItem('CarritoDeCompras', JSON.stringify(AlContenedor))//objeto Json convertido en string
            // JSON.parse(localStorage.getItem('CarritoDeCompras')).push(AlContenedor)
        
            // console.log(JSON.parse(localStorage.getItem('CarritoDeCompras')))
          
            //     let nuevaData = LS_CarritoDeCompras_Seccion.push(AlContenedor)
            //     console.log('nuevaData', nuevaData)
              
        DisplayDestello()
    }

//************************************************************************************************
    // Parapadeo display carrito cada vez que se añade un producto
    function DisplayDestello(){    
        // console.log("______ Desde DisplayDestello() ______")
                
        //Este array contendra solo los precios individuales de los productos para luego sumarlos
        DisplayMonto = [];

        for(var i = 0; i < AlContenedor.length; i++){
            //Se toman los precios de cada producto, vienen en formato de presentación de pantalla, las comas deben cambiarse para poder hacer calculaos y se quitan los puntos de separador de miles
            PrecioDisplay = AlContenedor[i].Precio
            // console.log("PrecioDisplay", PrecioDisplay)
            // console.log(typeof PrecioDisplay)

            //Se cambia el formato del precio, la coma decimal se reemplazo por un punto para poder acer calculos matematicos
            PrecioDisplay = PrecioDisplay.replace(/,/g, '.')
            // console.log("PrecioDisplay", PrecioDisplay)

            PrecioDisplay = parseFloat(PrecioDisplay)
            // console.log(typeof PrecioDisplay)
            // console.log("PrecioDisplay", PrecioDisplay)
            
            //Se verifica la cantidad total de cada producto
            let Total = AlContenedor[i].Cantidad * PrecioDisplay 

            DisplayMonto.push(Total)
            // console.log("DisplayMonto", DisplayMonto)

            //Se suma el precio de todos los producto cargado a carrito
            TotalDisplayCarrito = DisplayMonto.reduce((a, b) => a + b, 0);

            //Se permiten solo dos decimales
            TotalDisplayCarrito = TotalDisplayCarrito.toFixed(2)
        }        

        if(AlContenedor.length == 0){
            //Se oculta el div que contiene el icono del carrito
            document.getElementById("Contenedor_61").style.visibility = "hidden"
        }
        else if(TotalDisplayCarrito != 0){
            //Se muestra el div que contiene el icono del carrito
            document.getElementById("Contenedor_61").style.visibility = "visible"

            //Muestra el monto del pedido en el display carrito(se encuentra)
            document.getElementById("Input_5").value = SeparadorMiles(TotalDisplayCarrito) + " Bs."

            document.getElementById("Mostrar_Carrito").classList.add('Blink')

            setTimeout(function(){
                document.getElementById("Mostrar_Carrito").classList.remove('Blink')
            }, 3000);
        }
    }

//************************************************************************************************
    // Agrega las leyendas en cada producto que esta cargado en carrito
    function TransferirPedido(){
        // console.log("______Desde TransferirPedido()______")
        
        //Se especifica el producto donde se va a insertar la leyenda
        // var filtered = AlContenedor.filter(function(item){
        //     console.log('ID_Opcion', item.ID_Opcion)
        //     return item.ID_Opcion; 
        // });
        // console.log(AlContenedor[1]['ID_Opcion'])

        // InputLeyendaDinamico = localStorage.getItem('ContSeccion')
        // Padre = document.getElementById(InputLeyendaDinamico)
        // console.log("Cont_Producto", Padre)

        //Se guarda la sección donde esta el producto cargado a pedido
        // Seccion = localStorage.getItem('SeccionCLick')  
        // console.log("Seccion", Seccion)   

        //Se recorre todos los elementos que contengan la clase input_15 para eliminarlos
        // Se especifica a que seccion pertenecen los productos que se van a eliminar
        // elementoHijo = Padre.getElementsByClassName("input_15")

        //Se cuentan cuantos productos exiten en el contenedor de la seccion en curso
        // Elementos = elementoHijo.length

        // if(Elementos){
        //     for(let i = 0; i<Elementos; i++){ 
        //         //Por cada vuelta elimina el primer hijo con la clase "input_15"
        //         Padre.removeChild(elementoHijo[0])
        //     }
        // }

        //Se evaluaran solo los elementos del array "AlContenedor" que correspondan a la sección donde se hizo click
        function ProductoEditado(Seccion){            
            // console.log("______Desde ProductoEditado()______", Seccion)

            var existe = false;

            // El método filter() crea una nueva matriz con todos los elementos que pasan la prueba dada por la función proporcionada
            var filtered = AlContenedor.filter(function(item){
                // console.log('ID_Seccion', item.ID_Seccion)
                return item.ID_Seccion; 
            });

            let id_dinamico = 1
            // console.log('cantidad de leyendas a colocar', filtered.length)
            for(let i = 0; i < filtered.length; i++){
                existe = true;
                //Se crean los input que cargaran las leyendas contenidas en el array filtered
                var NuevoElemento = document.createElement("input")

                //Se dan propiedades al nuevo elemento creado (leyenda)
                NuevoElemento.value = filtered[i].Cantidad + ' ' + filtered[i].Producto + ' = ' + filtered[i].Total + ' Bs.'
                NuevoElemento.classList.add("input_15")
                NuevoElemento.name = "leyenda"
                NuevoElemento.id = filtered[i].ID_Opcion 
                NuevoElemento.readOnly = true

                //Se especifica el elemento donde se va a insertar el nuevo elemento            
                var ElementoPadre = document.getElementById(InputLeyendaDinamico)
                ElementoPadre.style.backgroundColor = "red"
                //Se inserta en el DOM el input creado
                ElementoPadre.appendChild(NuevoElemento) 
                
                // -------------------------------------

                //Se crean los botones para dar la opción de eliminar las leyendas creadas
                // var EliminarLeyenda = document.createElement("label")

                //Se dan propiedades al nuevo boton creado 
                EliminarLeyenda.innerHTML = "X"
                EliminarLeyenda.classList.add("input_15", "input_15--eliminar")
                // EliminarLeyenda.id = filtered[i].ID_Opcion      
                EliminarLeyenda.readOnly = true
                EliminarLeyenda.onclick = Eliminar_Leyenda
          
                localStorage.setItem('ID_Label_X', EliminarLeyenda.id)

                //Se especifica el elemento donde se va a insertar el nuevo elemento            
                var ElementoPadre = document.getElementById(InputLeyendaDinamico)
                
                //Se inserta en el DOM el input creado
                ElementoPadre.appendChild(EliminarLeyenda) 

                id_dinamico++         
            }
            return existe;
        }
        // ProductoEditado(Seccion)       
    }

//************************************************************************************************
    function Eliminar_Leyenda(e){
    //     console.log("______Desde Eliminar_Leyenda()______")

    //     var ID_ProductoEliminar = e.target.previousSibling.id 
        
    //     for(var i = 0; i < AlContenedor.length; i++){
    //         //Se toma el nombre del producto
    //         if((AlContenedor[i].ID_Opcion) == ID_ProductoEliminar){
    //             // console.log(Producto = AlContenedor[i].ID_Opcion)
    //             Producto = AlContenedor[i].Producto
    //         }
    //     }

    //     let ConfirmaEliminar = confirm('\t\t\t' + Producto.toUpperCase() + '\t\t' + "\n \t\t\teliminar de carrito de compras \t\t")

    //     if(ConfirmaEliminar == true){                
    //         //Se busca en el array AlContenedor, el producto que corresponde a la leyenda que se va a liminar
    //         var filtrado = AlContenedor.filter(function(item_2){
    //             // console.log("ID_ProductoEliminar =", ID_ProductoEliminar);
    //             return item_2.ID_Opcion != ID_ProductoEliminar; 
    //         });

    //         //Array AlContenedor con el producto eliminado
    //         AlContenedor = filtrado
            
    //         e.target.parentElement.removeChild(e.target.previousSibling);
    //         e.target.parentElement.removeChild(e.target);

    //         //Se muestra el div que contiene el icono del carrito
    //         DisplayDestello();
    //     }
    }

//************************************************************************************************
    // Coloca la leyenda a los productos cargado en carrito cuando quedo cargado en sesiones anteriores
    function ProductosEnCarrito(){   
        console.log("______Desde ProductosEnCarrito()______")

        //Se filtran las leyendas que correspondan a la seccion seleccionada
        var filteredSeccion = AlContenedor.filter(function(item){
            console.log('ID_Seccion en carrito', item.ID_Seccion)
            return item.ID_Seccion
        })
        
        //Se especifica el producto donde se va a insertar la leyenda
        var filtered = AlContenedor.filter(function(item){
            console.log('ID_Opcion en carrito', item.ID_Opcion)
            return item.ID_Opcion; 
        });
        // console.log(filtered)        
        // console.log('ID_Seccon seleccionada', localStorage.getItem('SeccionCLick'))

        // localStorage.setItem('SeccionCLick', ID_Seccion) 
        // var filtered = AlContenedor.filter(function(item){
        //     console.log('ID_Seccion = ', item.ID_Seccion)
        //     return item.ID_Seccion; 
        // });

        for(let i = 0; i < filtered.length; i++){              
            // console.log('ID_Opcion a etiquetar', filtered[i].ID_Opcion)  
            // if((filteredSeccion[i].ID_Seccion == localStorage.getItem('SeccionCLick')) || (localStorage.getItem('SeccionCLick') == 'Todos')){            
                //Del objeto filtrado filtered se toman las propiedades Cont_Leyenda para rellenar la leyenda
                //Si el objeto "AlContenedor" tiene el array de un producto no se muestra el boton "Agregar" en este contenedor
                document.getElementById(filtered[i].ID_Boton_Agregar).style.display = "none"
                
                //Detectar el contenedor de la leyenda del producto en opciones_V.php donde se hizo click  
                document.getElementById(filtered[i].Cont_Leyenda).style.display = "block"
                
                //Dar valor al input de la leyenda   
                document.getElementById(filtered[i].ID_Input_Leyenda).style.display = "block"
                document.getElementById(filtered[i].ID_InputCantidad).value = filtered[i].Cantidad 
                document.getElementById(filtered[i].ID_InputProducto).value = filtered[i].Producto 
                // document.getElementById(filtered[i].ID_InputOpcion).value = filtered[i].Opcion 
                document.getElementById(filtered[i].ID_InputPrecio).value = filtered[i].Precio 
                document.getElementById(filtered[i].ID_InputTotal).value = filtered[i].Total 

                document.getElementById(filtered[i].ID_InputDisplayCant).value = filtered[i].Cantidad      
                document.getElementById(filtered[i].ID_Input_Leyenda).value = filtered[i].Cantidad + ' ' + filtered[i].Producto +  ' = ' + filtered[i].Total + ' Bs.'

                //Se busca el boton más y el respectivo boton de bloqueo de la leyenda analizada
                if(Number(filtered[i].Existencia) == filtered[i].Cantidad){
                    document.getElementById(filtered[i].ID_BotonMas).style.display = "none" 
                    document.getElementById(filtered[i].ID_BotonBloqueo).style.display = "inline" 
                }
                else{
                    document.getElementById(filtered[i].ID_BotonMas).style.display = "inline" 
                    document.getElementById(filtered[i].ID_BotonBloqueo).style.display = "none"

                }
                console.log(Number(filtered[i].Existencia))
                console.log(filtered[i].Cantidad)
            }
        // }

        Pre_decremento()
        Pre_incremento()
    }    

//************************************************************************************************
    //muestra "La orden de compra"
    function PedidoEnCarrito(ValorDolar){
        // console.log("______Desde PedidoEnCarrito()______", ValorDolar)
        
        //Se muestra el monto total de la compra en "La Orden". (sin carga por despacho)
        // console.log('TotalDisplayCarrito',TotalDisplayCarrito)
        document.getElementById("MontoTienda").value = SeparadorMiles(TotalDisplayCarrito)
        
        //Se obtiene el monto del envio, esta tarado al precio de un dolar
        envio = document.getElementById("PrecioEnvio").value

        //Se calcula el monto total de la compra incluyendo comision y envio
        MontoTotal = Number(TotalDisplayCarrito) + Number(envio)
        MontoTotal = Number.parseFloat(MontoTotal).toFixed(2);
        
        //Se calcula el monto en Dolares
        MontoTotalDolares = MontoTotal / Number(ValorDolar)

        // Se toman dos decimales del monto en dolares
        MontoTotalDolares = Number.parseFloat(MontoTotalDolares).toFixed(2);

        //Se muestra el monto de total de la compra incluyendo comision y envio
        document.getElementById("MontoTotal").value = SeparadorMiles(MontoTotal)
        
        //Se muestra el monto de total de la compra incluyendo comision y envio en Dolares
        document.getElementById("MontoTotalDolares").value = SeparadorMiles(MontoTotalDolares)
        
        //Se envia a Carrito_V.php todo el pedido que se encuentra en el array de objeto JSON AlContenedor[]
        //1.- Se convierte el JSON en un string
        var sendJSON = JSON.stringify(AlContenedor)

        //2.- Se envia al input que lo almacena en la vista carrito_V.php
        document.getElementById('Pedido').value = sendJSON

        //Se muestra todo el pedido (cantidad - producto - precio unitario - precio por productos)
        for(i = 0; i < AlContenedor.length; i++){
            document.getElementById("Tabla").innerHTML += 
            '<tbody><tr><td class="td_1">' +  AlContenedor[i].Cantidad + 
            '</td><td class="td_2 hyphen">' +  AlContenedor[i].Producto + 
            '</td><td class="td_3">' + AlContenedor[i].Precio + " Bs." +
            '</td><td class="td_3">' + AlContenedor[i].Total + " Bs." + '</td></tr></tbody>'
        }
    }
    
//************************************************************************************************
    //Identifica los elementos de la sección donde se hizo click.
    function verSecion(ID_Seccion){ 
        console.log("______Desde verSecion()______", ID_Seccion)

        //Captura el valor del id dinanmico de la seccion donde se hizo click
        localStorage.setItem('ID_Seccion', ID_Seccion)         
        LS_ID_Seccion = localStorage.getItem('ID_Seccion')

        // Se almacena la seccion donde se hizo click
        localStorage.setItem('SeccionCLick', ID_Seccion)  
    }

//************************************************************************************************
    //ELimina del carrito de compra todos los productos agregados
    function vaciarCarrito(){
        let ConfirmaEliminar = confirm("Desea vaciar el carrito de compras");
        
        //Se confirma si se desea vaciar el carrito de compras
        if(ConfirmaEliminar == true){                        
            localStorage.removeItem('CarritoDeCompras');

            //Se refresca la pagina
            location.reload()
            
            //Coloca el cursor en el top de la pagina
            window.scroll(0, 0)
        } 
        else{
            return
        }
    }
//************************************************************************************************
    //Cambia el formato de una cantidad, los puntos los convierte en comas y las comas en punto, recibe un INT y devuelve un string
    function SeparadorMiles(Numero){
        if(Numero != 0){
            // console.log("______Desde SeparadorMiles()______", Numero) 
             
            Numero = String(Numero)
            Numero = Numero.replace(/\./g, ',');
            Numero += ''
            var x = Numero.split('.')
            var x1 = x[0]
            var x2 = x.length > 1 ? '.' + x[1] : ''
            var rgx = /(\d+)(\d{3})/
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + '.' + '$2')
            }
            // console.log(x1 + x2)
            return x1 + x2;
        }
        else{
            return Numero
        }
    }

// **********************************************************************************************
    //invocada desde clasificados_V  
    function Pre_incremento(){  
        // console.log("______Desde Pre_incremento()______")
       
        //Detectar el boton donde se hace click
        let mas = document.getElementsByClassName("mas")//Se obtienen los botones [+]
        let len = mas.length//Se cuenta cuanto botones mas existen
        let boton
        for(let i = 0; i < len; i++){
            boton = mas[i] //Encontrar el botón [+].
            boton.onclick = incrementar //Asignar la función incrementar(), al evento click.
        }
        function incrementar(e){
            // console.log("______Desde Incrementar()______")

            //Se obtiene el elemento padre donde se encuentra el boton mas al que se hizo click
            let current = e.target.parentElement
            
            //Se obtiene el valor de la cantidad de existencia en stock del producto
            let BloquearMasJS = current.getElementsByClassName("BloquearMasJS")[0]
            
            //Se obtiene el boton "más" respectivo al producto seleccionado
            let ID_LabelMas = current.getElementsByClassName("MasJS")[0].id

            //Se obtiene el boton "más" respectivo al producto seleccionado
            let ID_LabelBloqueo = current.getElementsByClassName("icono_7")[0].id

            //Se busca el input del display que se quiere incrementar            
            let inputSeleccionado = current.getElementsByClassName("input_2")[0]

            //Se accede a la propiedad valor del input display 
            let valor = inputSeleccionado.value

            //Se obtiene el contenedor hermano a "current" para acceder a sus input
            // let inputSeleccionadoLeyen = current.previousElementSibling  
            if(valor < 10){
                A = valor++
                A++

                //Muestra la cantidad en el input display
                inputSeleccionado.value = A
                
                // producto seleccionado 
                let Producto = current.getElementsByClassName("input_1a")[0].value
                
                //Aqui se mostrará la cantidad
                var Cantidades = current.getElementsByClassName("input_1e")[0].value = A

                //Input precio Aqui se muestra el precio
                let Precio = current.getElementsByClassName("input_1d")[0].value
                                
                //Se cambia el formato del precio, se reemplaza la coma por punto para poder hacer la multiplicacion, luego se convierte a numero 
                Precio = Precio.replace(/,/g, '.')
                Precio = Number(Precio)

                //Se calcula el total y se restringe a dos decimales
                let Total = (Cantidades * Precio).toFixed(2)

                //"Total" Se cambia a string y luego se cambia el formato, el punto decimal se convierte en coma
                Total = String(Total)
                Total = Total.replace(/\./g, ',')

                //Input total Aqui se mostrará el total (al parecer no hace falta)
                current.getElementsByClassName("input_1f")[0].value = Total
                
                //Se busca por medio de una "escala DOM" para obtener el input donde se muestra la leyenda para editarla
                //Muestra la leyenda en cada producto seleccionado por el usuario
                Padre_1 = current.parentElement
                
                Padre_2 = Padre_1.parentElement
                
                Padre_3 = Padre_2.parentElement
                
                Hermano_1 = Padre_3.nextElementSibling

                Hermano_2 = Hermano_1.nextElementSibling

                Hermano_2.getElementsByClassName("input_2a")[0].value = Cantidades + " " + Producto + " = " + SeparadorMiles(Total) + " Bs."
              
                //Se crea una nuevo array del objeto PedidoCar 
                PedidoGlobal = new PedidoCar(Producto, Cantidades, TotalDisplayCarrito);

                //Se verifica que el producto existe en el array AlContenedor y que contiene el pedidio, se edita la cantidad y el monto total acumulado por ese producto, esta informacion es la que va al resumen de la orden y a cada leyenda
                function ProductoEditado(Producto){
                    // console.log("------ Entra en ProductoEditado() --------", Producto)
                    var existe = false;
                    for(i = 0; i < AlContenedor.length; i++){
                        if(AlContenedor[i].Producto == Producto ){ 
                            existe = true;
                            AlContenedor[i].Cantidad = Cantidades
                            
                            // console.log("AlContenedor = ", AlContenedor[i].Cantidad)  
                            AlContenedor[i].Total = SeparadorMiles(Total)  
                        }
                    }
                    
                    var existe = false;
                    for(i = 0; i < AlContenedor.length; i++){
                        if(AlContenedor[i].Producto == Producto ){
                            existe = true;
                            AlContenedor[i].Cantidad = Cantidades
                            AlContenedor[i].Total = Total
                        }
                    }

                    // se sobreescribe la variable localStorage que almacena el contenido del carrito
                    localStorage.setItem('CarritoDeCompras', JSON.stringify(AlContenedor))//objeto Json convertido en string
                    return existe;
                }
                ProductoEditado(PedidoGlobal.Producto)                    
            }  
            
            //Se muestra el div que contiene el icono del carrito
            DisplayDestello()
                     
            //Si la existencia en BD es igual a 1 se oculta el boton de mas y menos para que no se añadan más productos al carrito
            if(Number(BloquearMasJS.value) == Cantidades){
                document.getElementById(ID_LabelMas).style.display = "none" 
                document.getElementById(ID_LabelBloqueo).style.display = "inline" 
            }
            else{
                document.getElementById(ID_LabelMas).style.display = "inline" 
                document.getElementById(ID_LabelBloqueo).style.display = "none" 
            }

            // console.log("AlContenedor desde incremento = ", AlContenedor)
        }  
    }   

//************************************************************************************************
    //quita una unidad de producto cargado, llamada al presionar el boton menos de cada producto
    function Pre_decremento(){      
        // console.log("______Desde Pre_decremento()______") 

        //Detectar el boton de restar
        var menos = document.getElementsByClassName("menos")//Se obtienen los botones menos [-]
        var len = menos.length//Se cuentan cuantos botones menos hay  
        var boton
        for(let i = 0; i < len; i++){
            boton = menos[i]; //Se Encontrar el botón [-] seleccionado al hacer click
            boton.onclick = decrementar // Asignar la función decrementar() en su evento click.
        }    
        function decrementar(e){   
            // console.log("______Desde decrementar()______") 
            
            //Se obtiene el div padre donde se encuentra el boton menos al que se hizo click
            current = e.target.parentElement

            //Se obtiene el valor de la cantidad de existencia del producto
            let BloquearMasJS = current.getElementsByClassName("BloquearMasJS")[0]
            // console.log("Existencia = ", Number(BloquearMasJS.value))
            
            //Se obtiene el boton "más" respectivo al producto seleccionado
            let ID_LabelMas = current.getElementsByClassName("MasJS")[0].id
            // console.log(ID_LabelMas)

            //Se obtiene el boton "más" respectivo al producto seleccionado
            let ID_LabelBloqueo = current.getElementsByClassName("icono_7")[0].id
            // console.log(ID_LabelBloqueo)

            //En el div padre se busca el input del display que se quiere incrementar(este es el input que muestra la cantidad entre los botones mas y menos)          
            let inputSeleccionado = current.getElementsByClassName("input_2")[0]

            //Se accede a la propiedad valor al input display 
            let valor = inputSeleccionado.value
            valor = Number(valor)

            //Se obtiene el contenedor hermano a "current" para acceder a sus input (este div contiene la leyenda entre otros input)
            // let Cont_leyenda = current.previousElementSibling  
            
            if((valor > 1) && (valor < 10)){
                //Muestra la cantidad en el input display
                A = valor--
                A--

                //Muestra la cantidad en el input display
                inputSeleccionado.value = A
                
                //Input producto en el elemento hermano del click correspondiente; Aqui se muestra el producto
                let Producto = current.getElementsByClassName("input_1a")[0].value

                //Input opcion en el elemento hermano del click correspondiente; Aqui se muestra el producto
                let Opcion = current.getElementsByClassName("input_1c")[0].value

                //input cantidad en el elemento hermano del click correspondiente; Aqui se mostrará la cantidad
                var Cantidades = current.getElementsByClassName("input_1e")[0].value = A
                // console.log("Cantidad en carrito", Cantidades)

                //Input precio en el elemento hermano del click correspondiente; Aqui se muestra el precio
                let Precio = current.getElementsByClassName("input_1d")[0].value

                //Se cambia el formato del precio
                Precio = Precio.replace(/,/g, '.')
                Precio = Number(Precio)
                                
                //Se calcula el total
                let Total = Cantidades * Precio    

                //"Total" Se cambia a string y luego se cambia el formato, el punto decimal se convierte en coma
                Total = String(Total)
                Total = Total.replace(/\./g, ',')
                 
                //Input total en el elemento hermano del click correspondiente; Aqui se mostrará el total
                current.getElementsByClassName("input_1f")[0].value = Total
                
                //Se busca por medio de una "escala DOM" para obtener el input donde se muestra la leyenda para editarla
                //Muestra la leyenda en cada producto seleccionado por el usuario
                Padre_1 = current.parentElement
                
                Padre_2 = Padre_1.parentElement
                
                Padre_3 = Padre_2.parentElement
                
                Hermano_1 = Padre_3.nextElementSibling

                Hermano_2 = Hermano_1.nextElementSibling

                Hermano_2.getElementsByClassName("input_2a")[0].value = Cantidades + " " + Producto +  " = " + SeparadorMiles(Total) + " Bs."    

                //Se resta del display carrito el producto eliminado
                TotalDisplayCarrito = TotalDisplayCarrito - Precio

                //Muestra el monto del pedido en el display carrito
                MontoCarrito = document.getElementById("Input_5").value = SeparadorMiles(TotalDisplayCarrito) + " Bs."  

                //Se crea una nuevo array del objeto PedidoCar 
                PedidoGlobal = new PedidoCar(Producto, Cantidades, TotalDisplayCarrito);

                //Se verifica que el producto existe en el array AlContenedor que contiene los productos pedidos y se edita la cantidad y el monto total acumulado por ese producto, esta informacion es la que va al resumen de la orden y a la información de cada leyenda
                function ProductoEditado(Producto){
                    var existe = false;
                    for(i = 0; i < AlContenedor.length; i++){
                        if(AlContenedor[i].Producto == Producto ){
                            existe = true;
                            AlContenedor[i].Cantidad = Cantidades
                            AlContenedor[i].Total = SeparadorMiles(Total)
                        }
                    }
                    
                    var existe = false;
                    for(i = 0; i < AlContenedor.length; i++){
                        if(AlContenedor[i].Producto == Producto ){
                            existe = true;
                            AlContenedor[i].Cantidad = Cantidades
                            AlContenedor[i].Total = Total
                        }
                    }
                    // se sobreescribe la variable localStorage que almacena el contenido del carrito
                    localStorage.setItem('CarritoDeCompras', JSON.stringify(AlContenedor))//objeto Json convertido en string
                    return existe;
                }
                ProductoEditado(PedidoGlobal.Producto);
            }        
            else{//Si no hay mas producto que eliminar                
                //Input precio en el elemento hermano del click correspondiente; Aqui se muestra el precio
                Precio = current.getElementsByClassName("input_1d")[0].value
                Precio = Precio.replace(/[.]/g,'')
                Precio = Number(Precio)

                //Input producto en el elemento hermano del click correspondiente; Aqui se muestra el producto
                Producto = current.getElementsByClassName("input_1a")[0].value

                //Input opcion en el elemento hermano del click correspondiente; Aqui se muestra el producto
                Opcion = current.getElementsByClassName("input_1c")[0].value

                //input cantidad en el elemento hermano del click correspondiente; Aqui se mostrará la cantidad
                Cantidades = current.getElementsByClassName("input_1e")[0].value = 0

                //Se crea una nuevo array del objeto PedidoCar 
                PedidoGlobal = new PedidoCar(Producto, Cantidades, TotalDisplayCarrito);

                //Se elimina el producto del array que contiene el pedido, esta informacion es la que va al resumen de la orden
                function ProductoEditado(Producto){
                    var existe = false;
                    for(i = 0; i < AlContenedor.length; i++){
                        if(AlContenedor[i].Producto == Producto ){
                            AlContenedor.splice(i, 1);
                        }
                    }
                  
                    // for(i = 0; i < AlContenedor.length; i++){
                    //     if(AlContenedor[i].Producto == Producto ){
                    //         AlContenedor.splice(i, 1);
                    //     }
                    // }

                    // se sobreescribe la variable localStorage que almacena el contenido del carrito
                    localStorage.setItem('CarritoDeCompras', JSON.stringify(AlContenedor))//objeto Json convertido en string
                    return existe;
                }

                ProductoEditado(PedidoGlobal.Producto)//Antes Opcion NOTA = CAMBIAR POR ID DE PRODUCTO, ESTA FUNCION ES LLAMADA TAMBIEN EN PRE_INCREMENTE()
               
                //Se resta del display carrito el producto eliminado
                TotalDisplayCarrito = TotalDisplayCarrito - Precio
                // console.log(TotalDisplayCarrito)

                //Muestra el monto del pedido en el display carrito(se encuentra en vitrina.php)
                MontoCarrito = document.getElementById("Input_5").value = SeparadorMiles(TotalDisplayCarrito) + " Bs." 
                                            
                //Se busca por medio de una "escala DOM" para obtener el input donde se muestra la leyenda  del producto al que se hizo click para ocutarla
                let Padre_1 = current.parentElement
                
                let Padre_2 = Padre_1.parentElement
                
                let Padre_3 = Padre_2.parentElement
                
                let Hermano_1 = Padre_3.nextElementSibling

                let Hermano_2 = Hermano_1.nextElementSibling //div que contiene la leyenda se necesita entra es al input que carga la leyenda

                let InputLeyenda = Hermano_2.firstElementChild
                //Se oculta el input que contiene la leyenda
                InputLeyenda.style.display = "none"
                
                //Se ocultan los botones mas y menos
                current.style.display = "none"
                
                //En los proximos tres pasos, se hace una "escala DOM" para obtener y mostrar nuevamente la etiqueta "Agregar" 
                //Se obtiene el elemento hermano que contiene los botones mas y menos
                Hermano_MasMenos_1 = current.previousElementSibling

                Hermano_MasMenos_2 = Hermano_MasMenos_1.previousElementSibling

                ID = Hermano_MasMenos_2.id

                document.getElementById(ID).style.display = "block"

                //Se muestra la etiqueta agregar
                // Hermano_MasMenos_2
                // console.log(EtiquetaAgregar)
                // console.log(HermanoMasMenos.getElementsByClassName("Label_3js")[0])

                // console.log(AlContenedor)
                //Se oculta el display carrito cuando el pedido sea de cero Bolivares y se muestra el boton de agregar opcion
                if(TotalDisplayCarrito == 0 ){ 
                    //Se oculta la leyenda del producto
                    // inputSeleccionadoLeyen.getElementsByClassName("input_2a")[0].style.visibility = "hidden"
                                        
                    //Se oculta el carrito de compras en el fondo del viewport
                    document.getElementById("Contenedor_61").style.visibility = "hidden"
                }
                else{
                    //Se busca el nodo padre que contiene el input donde esta el producto a eliminar
                    // let elementoHijo = current.parentElement
                    // let elementoPadre = elementoHijo.parentElement
                    // elementoPadre.removeChild(elementoHijo);                   
                }
            }  
            
            //Se muestra el div que contiene el icono del carrito
            DisplayDestello()
                     
            //Si la existencia en BD es igual a 1 se oculta el boton de mas y menos para que no se añadan más productos al carrito
            if(Number(BloquearMasJS.value) >= Cantidades || Number(BloquearMasJS.value) == 0){
                document.getElementById(ID_LabelMas).style.display = "inline" 
                document.getElementById(ID_LabelBloqueo).style.display = "none" 
            }
            else{
                document.getElementById(ID_LabelMas).style.display = "none" 
                document.getElementById(ID_LabelBloqueo).style.display = "inline" 
            }
            // console.log("AlContenedor desde decremento = ",AlContenedor)
        }    
    }

//************************************************************************************************ 
    //invocada desde carrito_V.php
    function ocultarPedido(){   
        //Coloca el cursor en el top de la pagina
        window.scroll(0, 0)
        document.getElementById("Mostrar_Orden").style.display = "none";
    }    

    //************************************************************************************************
    //ajusta el texarea con respecto al contenido que trae de la BD es llamado desde opciones_V.php
    function resize(){
        var text = document.getElementById("OpcionPro");
        text.style.height = 'auto';
        text.style.height = text.scrollHeight+'px';
    }
     
//************************************************************************************************ 
    //Verifca que el archivo opciones ya se haya cargado
    function verificarDiv(){
        // console.log("______Desde verificarDiv()______")  

        if(document.getElementById('Mostrar_Opciones').childElementCount < 1){
            // console.log("No hay elementos en el div id=\"Mostrar_Opciones\"")
            
        }
        else{
            // console.log("Los productos de la seccion son:", document.getElementsByClassName('contenedor_95'))            
        }

    }

//************************************************************************************************
    function stopInterval(){
        // console.log("______Desde stopInterval()______")
        clearInterval(interval)
    }

//************************************************************************************************ 
    //LLamada desde descr_Producto.php
    function cerrarVentana(){            
        window.close();
    }

//************************************************************************************************
    //Impide que se siga introduciendo caracteres al alcanzar el limite maximo en el telefono
    var contenidoTelefono = ""; 
    var num_caracteres_permitidos = 11; 

    function valida_LongitudTelefono(){ 
        // console.log("______Desde valida_LongitudTelefono()______")

        let num_caracteres_input = document.getElementById("TelefonoUsuario").value.length

        if(num_caracteres_input > 13){ 
            document.getElementById("TelefonoUsuario").value = contenidoTelefono; 
        }
        else{ 
            contenidoTelefono = document.getElementById("TelefonoUsuario").value;   
        } 
    } 

//************************************************************************************************    
    //agrega los puntos en tiempo real al llenar el campo telefono
    function mascaraTelefono(TelefonoRecibido, id){
        // console.log("______Desde mascaraTelefono()______")

        if(TelefonoRecibido.length == 4){
            document.getElementById(id).value += "-"; 
        }
        else if(TelefonoRecibido.length == 8){
            document.getElementById(id).value += ".";  
        }
        else if(TelefonoRecibido.length == 11){
            document.getElementById(id).value += ".";  
        }
        else if(TelefonoRecibido.length >= 15){
            alert("Telefono con Formato Incorrecto");
            document.getElementById(id).value = "";
            document.getElementById(id).focus();
            document.getElementById(id).style.backgroundColor = 'var(--Fallos)'; 
            return false;
        }
    }
//************************************************************************************************
    function CerrarModal_X(id, Inputfocus = ""){
        document.getElementById(id).style.display = "none"

        //Coloca el cursor en el top de la pagina
        window.scroll(0, 0)

        if(Inputfocus != ""){
            document.getElementById(Inputfocus).focus()
        }
    }
    
//************************************************************************************************
    //Desactiva el boton de volver atras del navegador
    function nobackbutton(){
        window.location.hash="no-back-button";
        window.location.hash="Again-No-back-button" //chrome
        window.onhashchange = function(){window.location.hash="no-back-button";}
    }

//************************************************************************************************
   //Muestra el menu principal en formato movil y tablet  
//    function mostrarMenu(){  
//        console.log("______Desde mostrarMenu()______")
//        let A = document.getElementById("MenuResponsive")
//        let B = document.getElementById("Tapa_Logo")

//        if(A.style.marginLeft < "0%"){//Se muestra el menu
//            A.style.marginLeft = "0%"
//            B.style.display = "block"
//        }
//        else if(A.style.marginLeft = "0%"){//Se oculta el menu
//            A.style.marginLeft = "-70%"
//            B.style.backgroundColor = "none"
//        }
//    }
   

//************************************************************************************************
    // Muestra el formulario de despacho para usuarios no registrados
    function mostrar_formulario(){  
        //Coloca el cursor en el top de la pagina
        // document.getElementById("Seccion_datos").scroll(40, 0)
        
        //Coloca el curso en el ancla
        window.location.hash = "#Seccion_datos"; 
            
        // document.getElementById("MuestraEnvioFactura").style.backgroundColor = "red"
        // document.getElementById("Seccion_datos").scroll({
        //     Top: 0,
        //     behavior: 'smooth'
        // });

        document.getElementById("No_Registrado").style.display = "none";
        document.getElementById("Registrado").style.display = "none";
        document.getElementById("Label--confirmar").style.display = "none";
        document.getElementById("MuestraEnvioFactura").style.display = "block" 
        document.getElementById("Cont_Suscribir").style.display = "flex"
    }

//************************************************************************************************
    // Muestra las formas de pago disponibles
    function formasDePago(){  
        document.getElementById("FormasDePago").style.display = "block"
        
            //Coloca el curso en el ancla
            window.location.hash = "#FormasDePago"; 
    }

//************************************************************************************************
    //Coloca los puntos de miles en tiempo real al llenar el campo a cedula
    function formatoMiles(numero, id){
        // console.log("______Desde formatoMiles()______", numero + ' - ' +  id)

        var num = numero.replace(/\./g,'')
        if(!isNaN(num) && numero.length < 11){
            num = num.toString().split('').reverse().join('').replace(/(?=\d*\.?)(\d{3})/g,'$1.')
            num = num.split('').reverse().join('').replace(/^[\.]/,'')
            numero.value = num
            document.getElementById(id).value = num
        }
        else{ 
            alert('Número de cedula identidad invalido')
            document.getElementById(id).value = ""
            // document.getElementById(id).style.backgroundColor = "var(--Fallos)"
        }
    }
   
//************************************************************************************************
//Muestra el contenedor del input transferencia
    function verInputTransferencia(){
        document.getElementById("InputTransferencia").style.display = "block"
        document.getElementById("CaptureTransferencia").style.display = "none"
    }

//************************************************************************************************
    //Muestra el contenedor del capture transferencia
    function verCaptureTransferencia(){
        document.getElementById("InputTransferencia").style.display = "none"
        document.getElementById("CaptureTransferencia").style.display = "block"
    }

//************************************************************************************************
    //Da una vista previa del capture de transferencia bancaria
    function CaptureTransferencia(){
        var contenedor = document.getElementById("DivCaptureTransferencia");
        var archivos = document.getElementById("ImagenTransferencia").files;

        if(contenedor.childElementCount < 1){
            for(i = 0; i < archivos.length; i++){
                imgTag = document.createElement("img");
                imgTag.height = 300;
                imgTag.width = 220;   
                imgTag.objectFit = "cover" 
                imgTag.src = URL.createObjectURL(archivos[i]);
                contenedor.appendChild(imgTag);
            }
        }
        else{
            //Se elimina la imagen existente
            contenedor.removeChild(imgTag);

            CaptureTransferencia()
        }
        
        // document.getElementById("InformarPago").style.display = "block"
    }
     
//************************************************************************************************
    //Da una vista previa del capture del pagoMovil
    function CapturePagoMovil(){
        var contenedor = document.getElementById("DivCapturePagoMovil");
        var archivos = document.getElementById("ImagenPagoMovil").files;

        if(contenedor.childElementCount < 1){
            for(i = 0; i < archivos.length; i++){
                imgTag = document.createElement("img");
                imgTag.height = 400;
                imgTag.width = 280;   
                imgTag.objectFit = "cover" 
                imgTag.src = URL.createObjectURL(archivos[i]);
                contenedor.appendChild(imgTag);
            }
        }
        else{
            //Se elimina la imagen existente
            contenedor.removeChild(imgTag);

            CapturePagoMovil()
        }

        document.getElementById("InformarPago").style.display = "block"
    }

//************************************************************************************************
    //Da una vista previa del capture de Paypal
    function CapturePagoPaypal(){
        var contenedor = document.getElementById("DivCapturePagoPaypal");
        var archivos = document.getElementById("ImagenPagoPaypal").files;

        if(contenedor.childElementCount < 1){
            for(i = 0; i < archivos.length; i++){
                imgTag = document.createElement("img");
                imgTag.height = 400;
                imgTag.width = 280;   
                imgTag.objectFit = "cover" 
                imgTag.src = URL.createObjectURL(archivos[i]);
                contenedor.appendChild(imgTag);
            }
        }
        else{
            //Se elimina la imagen existente
            contenedor.removeChild(imgTag);

            CapturePagoPaypal()
        }
        
        document.getElementById("InformarPago").style.display = "block"
    }

//************************************************************************************************
    //Da una vista previa del capture del Zelle
    function CapturePagoZelle(){
        var contenedor = document.getElementById("DivCapturePagoZelle");
        var archivos = document.getElementById("ImagenPagoZelle").files;

        if(contenedor.childElementCount < 1){
            for(i = 0; i < archivos.length; i++){
                imgTag = document.createElement("img");
                imgTag.height = 400;
                imgTag.width = 280;   
                imgTag.objectFit = "cover" 
                imgTag.src = URL.createObjectURL(archivos[i]);
                contenedor.appendChild(imgTag);
            }
        }
        else{
            //Se elimina la imagen existente
            contenedor.removeChild(imgTag);

            CapturePagoZelle()
        }
        
        document.getElementById("InformarPago").style.display = "block"
    }

//************************************************************************************************
    //Coloca el cursor en el input automaticamente 
    function autofocus(id){
        // console.log("______Desde autofocus()______", id)

        //Si el elemento existe
        if(document.getElementById(id)){
            document.getElementById(id).focus()
            document.getElementById(id).value = ""
        }
    }

// ************************************************************************************************
    function mostrar_cedula(){
        // console.log("______Desde mostrar_cedula()______")

        document.getElementById("No_Registrado").style.display = "none";
        document.getElementById("Registrado").style.display = "none";
        document.getElementById("Mostrar_Cedula").style.display = "block"; 
        document.getElementById("Label--confirmar").style.display = "none";
        document.getElementById("Cedula_Usuario").focus();
        
        //Se consulta el alto de la página opciones_V, este tamaño varia segun la cantidad de productos que tenga una sección
        AltoOpciones = document.getElementById("Section_3").scrollHeight
        // console.log("Alto de Opciones",AltoOpciones)

        //Este alto se estable al div padre en carrito_V para garantizar que cubra todo el contenido de catalaogos_V ya que carrito_V es un contenedor coloca via Ajax en catalaogos_V y debe sobreponerse sobre todo lo que hay en vitrina_V.php
        document.getElementById("SectionModal--carrito").style.minHeight = AltoOpciones + "px"
    }

// ************************************************************************************************
    //Informa que se alcanzo máximo de producto en inventario
    function BotonBloqueado(){
        // console.log("______Desde BotonBloqueado()______")

        alert("Limite alcanzado, el producto a quedado sin inventario")
    }
    
// ************************************************************************************************
    function soloNumeros(form, Input){
        // console.log("______Desde soloNumeros()______", Input)

        //Se recibe el control del formulario con el nombre "opcion"
        CedulaUsuario = form.cedulaUsuario.value 
        // console.log(CedulaUsuario)

        let elemento = document.getElementById(Input).value;
        let P_Numeros = /^([0-9])*$/;
        
        if(P_Numeros.test(elemento) == false || elemento == ''|| elemento.indexOf(" ") == 0 || elemento.length > 8 || elemento.length < 7){            
            alert ("Ingrese un número de cedula valido");
            document.getElementById("Cedula_Usuario").value = "";
            document.getElementById("Cedula_Usuario").focus();
        }        
        else{
            Llamar_UsuarioRegistrado(CedulaUsuario);
        }
        return false;
    }

// ************************************************************************************************
    function EliminarLeyendaVitrina(){
        alert("HOA")
    }

//************************************************************************************************
    // invocada desde carrito_V.php
    function verPagoTransferencia(){
        // console.log("______Desde verTransferenciaBancaria()______") 
        
        document.getElementById("Contenedor_60a").style.display = "block"
        document.getElementById("Contenedor_60b").style.display = "none"
        document.getElementById("Contenedor_60e").style.display = "none"
        document.getElementById("Contenedor_60g").style.display = "none"
        
        //Se muestra el monto total de la compra en Bolivares
        document.getElementById("PagarTransferencia").value = SeparadorMiles(MontoTotal) + " Bs."
    }

//************************************************************************************************
    // invocada desde carrito_V.php
    function verPagoMovil(){
        // console.log("______Desde verPagoMovil()______") 
        
        document.getElementById("Contenedor_60a").style.display = "none"
        document.getElementById("Contenedor_60b").style.display = "block"
        document.getElementById("Contenedor_60e").style.display = "none"
        document.getElementById("Contenedor_60g").style.display = "none"

        //Se muestra el monto total de la compra en Bolivares
        document.getElementById("PagarPagoMovil").value = SeparadorMiles(MontoTotal) + " Bs."
    }

//************************************************************************************************
    // invocada desde carrito_V.php
    function verPagoPaypal(){
        document.getElementById("Contenedor_60a").style.display = "none"
        document.getElementById("Contenedor_60b").style.display = "none"
        document.getElementById("Contenedor_60e").style.display = "none"
        document.getElementById("Contenedor_60g").style.display = "block"
        
        //Se muestra el monto total de la compra en Dolares
        document.getElementById("PagarDolaresPaypal").value = SeparadorMiles(MontoTotalDolares) + " USD"
    }

//************************************************************************************************
    // invocada desde carrito_V.php
    function verPagoAcordado(){
        // console.log("______Desde verPagoAcordado()______") 

        document.getElementById("Contenedor_60a").style.display = "none"
        document.getElementById("Contenedor_60b").style.display = "none"
        document.getElementById("Contenedor_60e").style.display = "block"
        document.getElementById("Contenedor_60g").style.display = "none"
    }
    
//************************************************************************************************
    //Valida el formulario de despacho de producto
    function validarDespacho(){

        document.getElementsByClassName("botonJS")[0].value = "Enviando ..."
        document.getElementsByClassName("botonJS")[0].disabled = "disabled"
        document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialClaro)"
        document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialOscuro)"
        document.getElementsByClassName("botonJS")[0].classList.add('borde_1')
        document.getElementsByClassName("botonJS")[0].style.cursor = "wait"
        
        let Nombre = document.getElementById('NombreUsuario').value
        let Apellido = document.getElementById('ApellidoUsuario').value 
        let Cedula = document.getElementById('CedulaUsuario').value 
        let Telefono = document.getElementById('TelefonoUsuario').value 
        let Correo = document.getElementById('CorreoUsuario').value 
        let Direccion = document.getElementById('DireccionUsuario').value  
        let Estado = document.getElementById('Estado').value 
        let Ciudad = document.getElementById('Ciudad').value
        let Pago = document.getElementsByName('formaPago')
        let FormaPago = document.getElementsByName('referenciaPago') 

        //Recorremos todos los valores del radio button para encontrar el metodo de pago seleccionado
        for(let i = 0; i < Pago.length; i++){
            if(Pago[i].checked){
                var PagoSeleccionado = Pago[i].value
                // console.log("Pago", PagoSeleccionado)
            }
        }       
        //Recorremos todos los valores del radio button para encontrar el medio de pago seleccionado
        for(let i = 0; i < FormaPago.length; i++){
            if(FormaPago[i].checked){
                var FormaPagoSeleccionada = FormaPago[i].value
                // console.log("FormaPago", FormaPagoSeleccionada)
            }
        }       
        let RegistroPago_Transferencia = document.getElementById('RegistroPago_Transferencia').value
        let CaptureTransferencia = document.getElementById('ImagenTransferencia').value  
        let CapturePagoMovil = document.getElementById('ImagenPagoMovil').value 
        let CapturePagoPaypal = document.getElementById('ImagenPagoPaypal').value
        
        //Patron de entrada solo acepta letras (Nombre - Apellido)
        let P_Letras = /^[ñA-Za-zÁÉÍÓÚáéíóú _]*[ñA-Za-zÁÉÍÓÚáéíóú][ñA-Za-zÁÉÍÓÚáéíóú _]*$/

        //Patron de entrada para archivos de carga permitidos
        var Ext_Permitidas = /^[.jpg|.jpeg|.png]*$/

        //Patron de entrada solo acepta numeros, guion y puntos          
        // let P_Telefono = /^\d{4}\-\d{3}\.\d{2}\.\d{2}$/;

        // let P_LetrasNumero = /[A-Za-z0-9]/;
        
        //Patron de entrada para correos electronicos
        let P_Correo = /^[-\w.%+]{1,64}@(?:[A-Z0-9-]{1,63}\.){1,125}[A-Z]{2,63}$/i;
                
        if(Nombre == "" || Nombre.indexOf(" ") == 0 || Nombre.length > 40 || P_Letras.test(Nombre) == false){
            alert ("Nombre invalido");
            document.getElementById("NombreUsuario").value = "";
            document.getElementById("NombreUsuario").focus();
            document.getElementById("NombreUsuario").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
            document.getElementsByClassName("botonJS")[0].disabled = false
            document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
            document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
            return false;
        }
        else if(Apellido =="" || Apellido.indexOf(" ") == 0 || Apellido.length > 20 || P_Letras.test(Apellido) == false){
            alert ("Apellido invalido");
            document.getElementById("ApellidoUsuario").value = "";
            document.getElementById("ApellidoUsuario").focus();
            document.getElementById("ApellidoUsuario").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
            document.getElementsByClassName("botonJS")[0].disabled = false
            document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
            document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
            return false;
        }
        else if(Cedula =="" || Cedula.indexOf(" ") == 0 || Cedula.length < 7  ||  Cedula.length > 11){
            alert ("número de cedula invalido");
            document.getElementById("CedulaUsuario").value = "";
            document.getElementById("CedulaUsuario").focus();
            document.getElementById("CedulaUsuario").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
            document.getElementsByClassName("botonJS")[0].disabled = false
            document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
            document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
            return false;
        }
        else if(Telefono =="" || Telefono.indexOf(" ") == 0 || Telefono.length > 20){
            alert ("Telefono invalido");
            document.getElementById("TelefonoUsuario").value = "";
            document.getElementById("TelefonoUsuario").focus();
            document.getElementById("TelefonoUsuario").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
            document.getElementsByClassName("botonJS")[0].disabled = false
            document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
            document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
            return false;
        }
        else if(Correo  == "" || Correo .indexOf(" ") == 0 || Correo .length > 70 || P_Correo.test(Correo ) == false){
            alert ("Correo invalido")
            document.getElementById("CorreoUsuario").value = ""
            document.getElementById("CorreoUsuario").focus()
            document.getElementById("CorreoUsuario").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
            document.getElementsByClassName("botonJS")[0].disabled = false
            document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
            document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
            return false;
        }  
        else if(Estado == "Seleccione un estado"){
            alert ("Selecione un Estado");
            document.getElementById("Estado").value = "";
            document.getElementById("Estado").focus();
            document.getElementById("Estado").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
            document.getElementsByClassName("botonJS")[0].disabled = false
            document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
            document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
            return false;
        }
        else if(Ciudad == "Seleccione una ciudad"){
            alert ("Selecione una Ciudad");
            document.getElementById("Ciudad").value = "";
            document.getElementById("Ciudad").focus();
            document.getElementById("Ciudad").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
            document.getElementsByClassName("botonJS")[0].disabled = false
            document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
            document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
            return false;
        }
        else if(Direccion =="" || Direccion.indexOf(" ") == 0 || Direccion.length > 200){
            alert ("Direccion invalida");
            document.getElementById("DireccionUsuario").value = "";
            document.getElementById("DireccionUsuario").focus();
            document.getElementById("DireccionUsuario").style.backgroundColor = "var(--Fallos)"
            document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
            document.getElementsByClassName("botonJS")[0].disabled = false
            document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
            document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
            return false;
        }
        else if(PagoSeleccionado == undefined){
            alert ("Debe indicar un modo de pago");
            document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
            document.getElementsByClassName("botonJS")[0].disabled = false
            document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
            document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
            document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
            document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
            return false;
        }
        else if(PagoSeleccionado == "Transferencia"){
            if(FormaPagoSeleccionada == undefined){
                alert ("Debe infomar el código o el capture del pago");
                document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
                document.getElementsByClassName("botonJS")[0].disabled = false
                document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
                document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
                document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
                document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
                return false;
            }
        }
        else if(PagoSeleccionado == "Transferencia" && FormaPagoSeleccionada == "codigoTransferencia"){
            if(RegistroPago_Transferencia == "" ||  RegistroPago_Transferencia.indexOf(" ") == 0 || RegistroPago_Transferencia.length > 20){
                alert ("Código de transferencia invalido");
                document.getElementById("RegistroPago_Transferencia").value = "";
                document.getElementById("RegistroPago_Transferencia").focus();
                document.getElementById("RegistroPago_Transferencia").style.backgroundColor = "var(--Fallos)"
                document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
                document.getElementsByClassName("botonJS")[0].disabled = false
                document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
                document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
                document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
                document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
                return false;
            }
        }
        else if(PagoSeleccionado == "Transferencia" && FormaPagoSeleccionada == "CaptureTransferencia"){            
            if(Ext_Permitidas.exec(CaptureTransferencia ) == false || CaptureTransferencia .size > 20000){
                alert("Introduzca el capture de la transferencia")
                document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
                document.getElementsByClassName("botonJS")[0].disabled = false
                document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
                document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
                document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
                document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
                return false;
            }
        }
        else if(PagoSeleccionado == "PagoMovil"){            
            if(Ext_Permitidas.exec(CapturePagoMovil) == false || CapturePagoMovil .size > 20000){
                alert("Introduzca el capture del PagoMovil")
                document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
                document.getElementsByClassName("botonJS")[0].disabled = false
                document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
                document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
                document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
                document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
                return false;
            }
        }
        else if(PagoSeleccionado == "Paypal"){            
            if(Ext_Permitidas.exec(CapturePagoPaypal) == false || CapturePagoPaypal .size > 20000){
                alert("Introduzca el capture del pago en Paypal")
                document.getElementsByClassName("botonJS")[0].value = "Enviar pago"
                document.getElementsByClassName("botonJS")[0].disabled = false
                document.getElementsByClassName("botonJS")[0].style.backgroundColor = "var(--OficialOscuro)"
                document.getElementsByClassName("botonJS")[0].style.color = "var(--OficialClaro)"
                document.getElementsByClassName("botonJS")[0].classList.remove('borde_1')
                document.getElementsByClassName("botonJS")[0].style.cursor = "pointer"
                return false;
            }
        }
        //Si se superan todas las validaciones la función devuelve verdadero
        return true
    }
    
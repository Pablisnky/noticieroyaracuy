function EliminarProducto(ID_Producto, Ruta){
    // console.log("______ Desde EliminarProducto() ______", ID_Producto + '/' + Ruta)
    
    let ConfirmaEliminar = confirm("Desea eliminar el producto");
    
    //Se confirma si se desea eliminar el producto
    if(ConfirmaEliminar == true){              
                    
        // Quita el producto de la pantalla
        //Se detecta  el contenedor que contiene el producto a eliminar
        let DivRaiz = document.getElementById(ID_Producto)
        let DivRaiz_2 = DivRaiz.parentElement
        let DivEliminar = DivRaiz_2.parentElement
        // console.log(DivEliminar)

        //Se detecta el elemento padre que contiene el elemento a eliminar
        let Padre = DivEliminar.parentElement
        // console.log(Padre)

        //Se elimina el elemento
        Padre.removeChild(DivEliminar)

        Llamar_EliminarProducto(Ruta)
    } 
    else{
        return
    }
}
    
//************************************************************************************************  
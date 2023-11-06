function SeleccionarParroquia(form){
    // console.log("______Desde SeleccionarParroquia______")
    
    var Municipio = form.municipioComerciante.options;//se captura el elemento select que contiene los municipios
    var Parroquia = form.parroquiaComerciante.options;//se captura el elemento select que contiene las parroquias
    Parroquia.length = null;

    // if(Municipio[1].selected == true){
        if(Municipio[0].selected == true){
            Parroquia[0] = new Option("espere","");
        }
        if(Municipio[1].selected == true){
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("Aristides Bastidas");     
        }
        if(Municipio[2].selected == true){
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("Bolivar");
        }
        if(Municipio[3].selected == true){
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("Campo Elias");
            Parroquia[2] = new Option("Chivacoa"); 
        }
        if(Municipio[4].selected == true){
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("Cocorote");
        }
        if(Municipio[5].selected == true){
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("Independencia");
        }
        if(Municipio[6].selected == true){
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("Jose Antonio Paez");
        }
        if(Municipio[7].selected == true){
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("La Trinidad");
        }
        if(Municipio[8].selected == true){
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("Manuel Monge");
        }
        if(Municipio[9].selected == true){
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("Nirgua");
            Parroquia[2] = new Option("Salom");
            Parroquia[3] = new Option("Temerla");
        }
        if(Municipio[10].selected == true){
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("San Andres");
            Parroquia[2] = new Option("Yaritagua");
        }
        if(Municipio[11].selected == true){//San Felipe tiene la posicion 11 en el array del select Municipio en cargarPaciente.php
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("Albarico");
            Parroquia[2] = new Option("San Felipe");
            Parroquia[3] = new Option("San Javier");       
        }
        if(Municipio[12].selected == true){
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("Sucre");
        }
        if(Municipio[13].selected == true){
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("Urachiche");
        }
        if(Municipio[14].selected == true){
            Parroquia[0] = new Option("");
            Parroquia[1] = new Option("El Guayabo");
            Parroquia[2] = new Option("Farriar");
        }
    // }
}
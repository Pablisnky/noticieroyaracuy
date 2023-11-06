<!-- BOTONES DE DESTACADOS -->

<div class="cont_botones_destacados">
    <div class="cont_botones_destacados--grupo_1">
        <div>
            <a class="boton boton--corto boton_a" href="{{ route('Eventos') }}">Eventos</a> 
        </div>        
        <div>
            <a class="boton boton--corto boton_a"" href="{{ route('Noticias') }}">Mas noticias</a> 
        </div>          
        <div>
            <a class="boton boton--corto boton_a"" href="{{ route('Marketplace') }}">Marketplace</a> 
        </div>          
        <div> 
            <a class="boton boton--corto boton_a" href="{{ route('GaleriaArte') }}">Galeria de arte</a>
        </div>        
    </div>
    <div> 
        {{-- {{ route('Categoria') }} --}}
        <a class="boton boton--corto boton--alto" href="#"><p class="a_2">Directorio comercial</p></a>
    </div>           
    <div> 
        {{-- {{ route('DirectorioProfesional') }} --}}
        <a class="boton boton--corto boton--alto" href="#"><p class="a_2">Directorio profesional</p></a> 
    </div>  
</div> 
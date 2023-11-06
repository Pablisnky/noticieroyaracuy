@extends('layouts.header_SinMembrete')

@section('titulo', 'Registro exitoso')

@section('contenido')
    <!-- muestra que se debe cargar un producto antes de entrar al inventario -->
    <section class="sectionModal">
        <div class="contenedor_24 contenedor_24--Widt">
            <h1 class="h1_1 h1_4 bandaAlerta">TIENDA VACIA.</h1>

            <p class="cont_modal--p">Aún no has cargado productos en tu catalogo.</h2>
          
            <a class="boton" style="margin: auto; margin-top:10%" href="{{ route('AgregarProducto', ['id_comerciante' => session('id_comerciante')]) }}">Cargar producto</a>
        </div>
    </section>
    
@endsection
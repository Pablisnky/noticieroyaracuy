@extends('layouts.header_SinMembrete')

@section('titulo', 'Registro exitoso')

@section('contenido')
    <!-- muestra que se debe llenar todos los datos del perfil comerciante, antes de armar un catalogo -->
    <section class="sectionModal">
        <div class="contenedor_24 contenedor_24--widt">
            <h1 class="h1_1 h1_4 bandaAlerta">Completa tu perfil.</h1>

            <p class="cont_modal--p">Antes de armar tu catalogo de productos.</h2>
          
            <a class="boton" style="margin: auto; margin-top:10%" href="{{ route('Perfil_comerciante', ['id_comerciante' => session('id_comerciante')]) }}">Ver perfil</a>
        </div>
    </section>
    
@endsection
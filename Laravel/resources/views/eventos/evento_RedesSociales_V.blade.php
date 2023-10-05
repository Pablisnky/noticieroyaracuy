@extends('layouts.partiers.header_eventos')

@section('titulo', 'Eventos')

@section('contenido')
    <h1 class="cont_agenda--titulo">Eventos</h1>
    <div class="" >
        <!-- IMAGEN -->
        <img class="cont_Galeria--img" alt="Fotografia Agenda" src="{{ '/images/agenda/' .  $eventos->nombre_imagenAgenda }}"/>
    </div>  
    
    <a class="cont_agenda--enlace" href="{{ route('Eventos') }}">Ver todos</a>

    <script src="{{ 'js/funcionesVarias.js?v=' . rand() }}"></script>

@endsection()
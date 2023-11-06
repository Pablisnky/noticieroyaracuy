@extends('layouts.header_Noticia')

@section('titulo', 'Registro exitoso')

@section('contenido')
    <section class="sectionModal" >
        <div class="modal_falloLogin">
            <fieldset class="fieldset_1 modal_falloLogin--fieldset">
                <h1 class="modal_falloLogin--h1">Registro exitoso</h1>
                <p class="bandaAlerta"></p>
                <div class="contBoton">
                    <a class="boton" href="{{ route('Login') }}">Iniciar sesión</a>
                </div>
            </fieldset>
        </div>
    </section>
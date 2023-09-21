<!-- Llamado desde  Login_C/ValidarSesion-->
@extends('layouts.partiers.header_PanelPortada')

@section('titulo', 'Fallo login')

@section('contenido')
    <section class="sectionModal" >
        <div class="modal_falloLogin">
            <fieldset class="fieldset_1 modal_falloLogin--fieldset">
                <h1 class="modal_falloLogin--h1">USUARIO y CONTRASEÑA</h1>
                <p class="bandaAlerta">no son correctos</p>
                <div class="contBoton">
                    <a class="boton" href="{{ route('Login', ['id_noticia' => 'sin_id_noticia', 'bandera' => 'sin_bandera', 'id_comentario' => 'sin_id_comentario']) }}">Regresar</a>
                </div>
            </fieldset>
        </div>
    </section>
@endsection
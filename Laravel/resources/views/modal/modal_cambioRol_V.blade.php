<!-- Llamado desde  LoginController/ValidarSesion-->
@extends('layouts.header_PanelPortada')

@section('titulo', 'Cambio de rol')

@section('contenido')
    <section class="sectionModal" >
        <div class="modal_cambioRol">
            <fieldset class="fieldset_1 modal_falloLogin--fieldset">
                <h1 class="h2_9">Cambio de rol</h1>
                <div class="cont_roles">
                    <div class="cont_roles--div">
                        <a class="boton boton--corto_2" href="{{ route('Perfil_periodista', ['id_periodista' => session('id_periodista')]) }}">Periodista</a>
                    </div>
                    <div>
                        <a class="boton boton--corto_2" href="">Artista</a>
                    </div>
                    <div>
                        <a class="boton boton--corto_2" href="{{ route('PanelProducto', ['id_comerciante' => session('id_comerciante')]) }}">Comerciante</a>
                    </div>
                    <div>
                        <a class="boton boton--corto_2" href="">Usuario</a>
                    </div>
                    <div>
                        <a class="boton boton--largo" href="">Directorio médico</a>
                    </div>
                    <div>
                        <a class="boton boton--largo" href="">Directorio profesional</a>
                    </div>
                    <div>
                        <a class="boton boton--largo" href="">Directorio comercial</a>
                    </div>
                </div>
            </fieldset>
        </div>
    </section>
@endsection
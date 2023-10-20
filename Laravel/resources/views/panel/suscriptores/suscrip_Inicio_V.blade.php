@extends('layouts.header_suscriptor')

@section('titulo', 'Dashboard suscriptor')

@section('contenido')

    <!-- MENU LATERAL -->
    @include('panel/suscriptores/suscrip_menu_V')
    
    <div class="cont_suscriptor"> 

        <!-- COMENTARIOS -->
        {{-- <a class="cont_suscriptor--item borde_1" href="<?php //echo RUTA_URL . '/Panel_Comentarios_C/comentarios/' . $Datos['ID_Suscriptor']?>" rel="noopener noreferrer">
            <div class="contenedor_27">
                <h1 class="cont_suscriptor--h1">Comentarios realizados</h1>
                <label class="label_5"><?php //echo $Datos['comentarios']['cantidadComentarios'];?></label>
            </div>       
        </a> --}}
        
        <!-- CONTRALORIA SOCIAL -->
        {{-- <a class="cont_suscriptor--item borde_1" href="<?php //echo RUTA_URL . '/Panel_Denuncias_C/index/' . $Datos['ID_Suscriptor']?>" rel="noopener noreferrer">
            <div class="contenedor_27">
                <h1 class="cont_suscriptor--h1">Quejas y denuncias</h1>
                <label class="label_5"><?php //echo $Datos['denuncias']['cantidadDenuncias'];?></label>
            </div>       
        </a> --}}

        <!-- NOTICIAS GUARDADAS -->
        {{-- <a class="cont_suscriptor--item borde_1" href="<?php //echo RUTA_URL . '/Panel_Noticias_C/noticiaGuardada/' . $Datos['ID_Suscriptor']?>">
            <div class="contenedor_27">
                <h1 class="cont_suscriptor--h1">Noticias guardadas</h1>
                <label class="label_5"></label>
            </div>
        </a> --}}
        
        <!-- MARKETPLACE -->
        {{-- <a class="cont_suscriptor--item borde_1" href="{{ route('PanelProducto', ['id_comerciante' => session('id_suscriptor')]) }}" rel="noopener noreferrer">
            <div class="contenedor_27">
                <h1 class="cont_suscriptor--h1">Marketplace</h1>
                {{-- <label class="label_5">{{ $marketplace->Cantidad_Productos }}</label> --}}
            {{-- </div> --}}
        {{-- </a>  --}}

        <!-- OBRAS -->
        {{-- <a class="cont_suscriptor--item borde_1" href="{{ route('SuscriptorArtista', ['ID_Suscriptor' => session('id_suscriptor')]) }}" rel="noopener noreferrer">
            <div class="contenedor_27">
                <h1 class="cont_suscriptor--h1">Obras</h1>
                <label class="label_5"><?php //echo $Datos['clasificados']['cantidadAnncios'];?></label>
            </div>
        </a> --}}
    </div>

    <script src="{{ asset('js/funcionesVarias.js?v=' . rand()) }}"></script>

@endsection()     
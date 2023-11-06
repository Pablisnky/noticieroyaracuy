<!-- FECHA Y CARITA -->

<div class="cont_header--loginFecha">
				
    <!-- FECHA -->
    <div style="margin-right: 15px;">
        <label class="header__fecha">San Felipe, <?php echo date('d');?> de <?php echo date('M');?></label>
    </div>
    
    <!--CARITA -->
    <div>
        @if(!empty(session('id_profesional'))) 
            {{-- {{ 'id_profesional= ' . session('id_profesional') }} --}}
            {{-- {{ route('DashboardPanelSuscriptor', ['id_suscriptor' => session('id_suscriptor')]) }} --}}
            <a class="Default_quitarMovil" href="#"><img class="Default_login" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}"/></a>	
        @elseif(!empty(session('id_directorio'))))
            {{-- {{ 'id_directorio= ' . session('id_directorio') }} --}}
            <a class="Default_quitarMovil" href="{{ route('Login', ['id_noticia' => 'sin_id_noticia', 'bandera' => 'sin_bandera', 'id_comentario' => 'sin_id_comentario']) }}"><img class="Default_logout" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}"/></a>
        @elseif(!empty(session('id_periodista')))
            {{-- {{ 'id_periodista= ' . session('id_periodista') }} --}}
            <a class="Default_quitarMovil" href="{{ route('Index') }}"><img class="Default_login" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}"/></a>
        @elseif(!empty(session('id_comerciante')))	
            {{-- {{ 'id_comerciante= ' . session('id_comerciante') }} --}}
            <a class="Default_quitarMovil" href="{{ route('PanelProducto', ['id_comerciante' => session('id_comerciante')]) }}"><img class="Default_login" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}"/></a>
        @elseif(!empty(session('id_suscriptor')))
            {{-- {{ 'id_suscriptor= ' . session('id_suscriptor') }} --}}
            <a class="Default_quitarMovil" href="{{ route('Suscriptor', ['id_suscriptor' => session('id_suscriptor')]) }}"><img class="Default_login" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}"/></a>
        @else
            {{-- {{ 'logout' }} --}}
            <a class="Default_quitarMovil" href="{{ route('Login', ['id_noticia' => 'sin_id_noticia', 'bandera' => 'sin_bandera', 'id_comentario' => 'sin_id_comentario']) }}"><img class="Default_logout" src="{{ asset('/iconos/perfil/outline_face_6_black_24dp.png') }}"/></a>
        @endif
    </div>
</div>
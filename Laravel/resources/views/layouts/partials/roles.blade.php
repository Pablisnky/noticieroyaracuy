<!-- MENU ROLES -->
    <div style="display: flex; align-items: center">
        <label style="display:inline">Rol: </label>
        <label class="cont_roles--label">Comerciante</label>
        <img class="cont_roles--icono Default_pointer" id="IconoExpandir" src="{{ asset('/iconos/chevron/outline_expand_more_black_24dp.png') }}" onclick="MostrarMenuRoles()"/>
    </div>
    
    <!-- MENU ROLES --> 
    <div class="cont_roles--menuSecundario borde_1"  id="MenuSecundario"> 				
        @foreach($roles as $Row)			
            <label class="cont_detalle_Producto--p" style="display: block; padding-left: 10px">{{ $Row->rol }}</label>
        @endforeach
    </div>
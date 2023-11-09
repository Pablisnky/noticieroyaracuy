@extends('layouts.header_Noticia')

@section('titulo', 'MarketPlace - compra exitosa')

@section('contenido')
    <section class="cont_recibePedido">
        <h1 class="h1_1">Compra realizada</h1>
        <div class=''>
            <p>Un recibo de compra ha sido enviado a su correo</p>
            <br>
            <h2 class="cont_recibePedido--codigo bandaAlerta">{{ $codigo_despacho }}</h2>
            <br>
            <p>Este código sera solicitado por el despachador para realizar la entrega.</p>
            <p class="p_1">Gracias por confiar en nuestro servicio</p>
            <br><br>
            <a class="boton boton--largo" style="margin: auto" href="{{ route('Marketplace') }}">Volver a marketplace</a>
        </div>
    </section>

    {{-- Se vacia el carrito de compra --}}
    <script  type="text/javascript">
        localStorage.removeItem('CarritoDeCompras');
    </script>
@endsection()
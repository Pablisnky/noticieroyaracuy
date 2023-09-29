{{-- @extends('errors::illustrated-layout')

@section('code', '500')

@section('title', __('Página no encontrada'))

@section('image')
    <style>
        #apartado-derecho{
            text-align: center;
        }
        ul{
            text-decoration: none !important;
            list-style: none;
            color: black;
            font-weight: bold;
        }
    </style>
    <div id="apartado-derecho" style="background-color: #F5716C;" class="">
        <h2>Encuentra lo que buscas en nuestro menú:</h2>
        <ul>
            <li><a href="/">Inicio</a></li>
            <li><a href="/">Blog</a></li>
            <li><a href="/">Dónde estamos</a></li>

        </ul>
    </div>
@endsection

@section('message', __('No hemos encontrado la página que buscas.')) --}}
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>404 HTML Template by Colorlib</title>

    <style id="" media="all">
        @font-face {
            font-family: 'Josefin Sans';
            font-style: normal;
            font-weight: 400;
            src: url(/fonts.gstatic.com/s/josefinsans/v17/Qw3aZQNVED7rKGKxtqIqX5EUAnx4RHw.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Josefin Sans';
            font-style: normal;
            font-weight: 400;
            src: url(/fonts.gstatic.com/s/josefinsans/v17/Qw3aZQNVED7rKGKxtqIqX5EUA3x4RHw.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Josefin Sans';
            font-style: normal;
            font-weight: 400;
            src: url(/fonts.gstatic.com/s/josefinsans/v17/Qw3aZQNVED7rKGKxtqIqX5EUDXx4.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

        /* vietnamese */
        @font-face {
            font-family: 'Josefin Sans';
            font-style: normal;
            font-weight: 700;
            src: url(/fonts.gstatic.com/s/josefinsans/v17/Qw3aZQNVED7rKGKxtqIqX5EUAnx4RHw.woff2) format('woff2');
            unicode-range: U+0102-0103, U+0110-0111, U+0128-0129, U+0168-0169, U+01A0-01A1, U+01AF-01B0, U+1EA0-1EF9, U+20AB;
        }

        /* latin-ext */
        @font-face {
            font-family: 'Josefin Sans';
            font-style: normal;
            font-weight: 700;
            src: url(/fonts.gstatic.com/s/josefinsans/v17/Qw3aZQNVED7rKGKxtqIqX5EUA3x4RHw.woff2) format('woff2');
            unicode-range: U+0100-024F, U+0259, U+1E00-1EFF, U+2020, U+20A0-20AB, U+20AD-20CF, U+2113, U+2C60-2C7F, U+A720-A7FF;
        }

        /* latin */
        @font-face {
            font-family: 'Josefin Sans';
            font-style: normal;
            font-weight: 700;
            src: url(/fonts.gstatic.com/s/josefinsans/v17/Qw3aZQNVED7rKGKxtqIqX5EUDXx4.woff2) format('woff2');
            unicode-range: U+0000-00FF, U+0131, U+0152-0153, U+02BB-02BC, U+02C6, U+02DA, U+02DC, U+2000-206F, U+2074, U+20AC, U+2122, U+2191, U+2193, U+2212, U+2215, U+FEFF, U+FFFD;
        }

    </style>

    <style>
        * {
            -webkit-box-sizing: border-box;
            box-sizing: border-box
        }

        body {
            padding: 0;
            margin: 0
        }

        #notfound {
            position: relative;
            height: 100vh;
            background-color: #222
        }

        #notfound .notfound {
            position: absolute;
            left: 50%;
            top: 50%;
            -webkit-transform: translate(-50%, -50%);
            -ms-transform: translate(-50%, -50%);
            transform: translate(-50%, -50%)
        }

        .notfound {
            /* max-width: 460px; */
            width: 100%;
            text-align: center;
            line-height: 1.4
        }

        .notfound .notfound-404 {
            height: 158px;
            line-height: 153px;
            margin-bottom: 5%
        }

        .notfound .notfound-404 h1 {
            font-family: josefin sans, sans-serif;
            color: #222;
            font-size: 220px;
            letter-spacing: 10px;
            margin: 0;
            font-weight: 700;
            text-shadow: 2px 2px 0 #c9c9c9, -2px -2px 0 #c9c9c9
        }

        .notfound .notfound-404 h1>span {
            text-shadow: 2px 2px 0 #ffab00, -2px -2px 0 #ffab00, 0 0 8px #ff8700
        }

        .notfound p {
            font-family: josefin sans, sans-serif;
            color: #c9c9c9;
            font-size: 16px;
            font-weight: 400;
            margin-top: 0;
            margin-bottom: 15px
        }

        .notfound a {
            font-family: josefin sans, sans-serif;
            font-size: 14px;
            text-decoration: none;
            text-transform: uppercase;
            background: 0 0;
            color: #c9c9c9;
            border: 2px solid #c9c9c9;
            display: inline-block;
            padding: 10px 25px;
            font-weight: 700;
            -webkit-transition: .2s all;
            transition: .2s all
        }

        .notfound a:hover {
            color: #ffab00;
            border-color: #ffab00
        }

        @media only screen and (max-width:480px) {
            .notfound .notfound-404 {
                height: 122px;
                line-height: 122px
            }

            .notfound .notfound-404 h1 {
                font-size: 122px
            }
        }

    </style>
    <meta name="robots" content="noindex, follow">

    <!-- CDN FUENTES DE GOOGLE-->
    <link rel='stylesheet' type='text/css' href='https://fonts.googleapis.com/css?family=RLato|Raleway:400|Montserrat|Gruppo|Moon+Dance'>
</head>

<body>
    <div id="notfound">
        <label style="font-size: 3.8vw; font-family: Gruppo; display: block; text-align: center; color:white">www.NoticieroYaracuy.com</label>
        <div class="notfound">
            <div class="notfound-404">
                <h1>E<span>r</span><span>r</span><span>o</span>r</h1>
            </div>
            <p style="font-size: 2vw">La página no fue encntrada.</p>
            <a style="display: block; width: max-content; margin: auto; margin-top: 30px; margin-bottom: 30px" href="javascript:history.back()"> Volver Atrás</a>
            <a href="{{ route('NoticiasPortada') }}">Noticias</a>
            <a href="{{ route('Marketplace') }}">Marketplace</a>
            <a href="{{ route('GaleriaArte') }}">Galeria de arte</a>
            <a href="{{ route('Eventos') }}">Eventos</a>
        </div>
    </div>
</body>

</html>

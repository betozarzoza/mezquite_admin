<!DOCTYPE html>
<html lang="es" class="h-100">

<head>

    <meta charset="utf-8">
    <meta name="keywords" content="" />
    <meta name="author" content="" />
    <meta name="robots" content="" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <meta property="og:title" content="Condominios El Mezquite" />
    <meta property="og:description" content="Bienvenido a condominios el mezquite" />
    <meta property="og:image" content="https://i.pinimg.com/236x/07/84/60/07846065bd2baf211150a1d216aef9a7.jpg" />
    <meta name="format-detection" content="telephone=no">
    <title>{{ config('dz.name') }} | @yield('title', $page_title ?? '')</title>
    <meta name="description" content="@yield('page_description', $page_description ?? '')"/>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">

    
</head>

<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
			@yield('content')
            </div>
        </div>
    </div>
@include('elements.footer-scripts')
</body>

</html>
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Farmshop.ua') }}</title>

    {{-- <link rel="apple-touch-icon" sizes="180x180" href="/logo/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="/logo/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="/logo/favicon-16x16.png"> --}}
    <link rel="manifest" href="/logo/site.webmanifest">

    <!-- Load Material Icons from Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Material+Icons|Material+Icons+Outlined|Material+Icons+Two+Tone|Material+Icons+Round|Material+Icons+Sharp" rel="stylesheet" />
    <!-- Roboto and Roboto Mono fonts from Google Fonts-->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto+Mono:400,500" rel="stylesheet" />


    {{-- <link rel="stylesheet" href="{{ asset ('css/style.css?v=' . filemtime(public_path('css/style.css')) ) }}"> --}}
    <link rel="stylesheet" href="{{ asset ('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/bootstrap-icons.css') }}">
    <link rel="stylesheet" href="{{ asset ('css/admin.css?v=' . filemtime(public_path('css/admin.css')) ) }}">
    <script src="{{ asset('js/jquery-3.6.1.slim.js') }}"></script>

</head>
<body>
    @include('admin.layouts.blocks.header')
    <!-- Layout wrapper-->
    <div id="layoutDrawer">
    @include('admin.layouts.blocks.side-nav')
        <!-- Layout content-->
        <div id="layoutDrawer_content">
            <!-- Main page content-->
            <main>
                <!-- Page header-->
                <header class="bg-dark">
                    <div class="container-xl px-5">
                        <h1 class="text-white py-3 mb-0 display-6">@yield('page-title')</h1>
                    </div>
                </header>
                <div id="yield_content">
                    @yield('content')
                </div>
            </main>
            @include('admin.layouts.blocks.footer')
        </div>
    </div>



    <!-- Load Bootstrap JS bundle-->
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <!-- Load global scripts-->
    <script type="module" src="/js/material.js"></script>

    <!-- tinyMCE -->
    {{-- <script src="https://cdn.tiny.cloud/1/lr41h997mmdfdxqgb09p501djuahr9yibyhucqh093t1qkjh/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script> --}}

    <script src="/js/scripts.js"></script>
    <script src="{{ asset ('js/admin.js') }}"></script>
</body>
</html>

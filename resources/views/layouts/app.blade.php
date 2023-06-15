<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') || Capstone - Kelompok 11</title>

    @stack('addon-style')
    @include('include.style')
</head>
<body>
    @yield('navbar')
    
    @yield('content')

    @yield('backTop')
    
    @include('include.script')
    @stack('addon-script')
    @include('sweetalert::alert')
</body>
</html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') || Admin</title>

    @include('include.style')
</head>
<body>
    @include('include.sidebar')
    @yield('admin')
    
    @include('include.script')
</body>
</html>
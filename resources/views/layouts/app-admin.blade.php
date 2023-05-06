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
    @include('include.admin.sidebar')

    <div class="p-6 sm:ml-64 mt-4">
        @yield('admin')
    </div>

    @include('include.script')
    @stack('addon-script')
    @include('sweetalert::alert')
</body>

</html>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') || Admin</title>

    @include('include.admin.style')
</head>

<body>
    @include('include.admin.navbar')
    @include('include.admin.sidebar')

    <div class="px-6 pt-20 pb-6 lg:ml-64 bg-slate-100 min-h-screen">
        @yield('admin')
    </div>

    @include('include.script')
    @stack('addon-script')
    @include('sweetalert::alert')
</body>

</html>

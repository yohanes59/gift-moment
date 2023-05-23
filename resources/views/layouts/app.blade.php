<!DOCTYPE html>
<html lang="en" class="scroll-smooth">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title') || Capstone - Kelompok 11</title>

    @include('include.style')
</head>
<body>
    @include('include.customer.navbar')
    
    <div class="mt-[73px] md:mt-[66px] lg:mt-16"></div>
    @yield('content')

    <!-- Back to Top -->
    <a id="back-to-top" onclick="toTop()" class="fixed z-[9999] bottom-6 right-6 cursor-pointer hidden items-center justify-center w-14 h-14 bg-indigo-500 text-white text-xl rounded-full p-4">
        <i class="fa-solid fa-chevron-up"></i>
    </a>
    
    @include('include.script')
    @stack('addon-script')
    @include('sweetalert::alert')
</body>
</html>
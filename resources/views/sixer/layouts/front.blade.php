<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getlocale()) }}">
<head>
    @include('sixer.includes.landing.meta')
    <title>@yield('title') | SIXER</title>
    @stack('before-style')
        @include('sixer.includes.landing.style')
    @stack('after-style')
</head>
<body class="antialiased">
    <div class="relative">
        @include('sixer.includes.landing.header')
        {{-- @include('sweetalert::alert') --}}
        @yield('content')
        @include('sixer.includes.landing.footer')
    </div>
    @stack('before-script')
        @include('sixer.includes.landing.script')
    @stack('after-script')
    {{-- modal --}}
    @include('sixer.components.modal.login')
    @include('sixer.components.modal.register')
    @include('sixer.components.modal.register-success')
</body>
</html>

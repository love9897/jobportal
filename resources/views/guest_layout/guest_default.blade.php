<!DOCTYPE html>
<html lang="en">

<head>
    @include('guest_partials.head')
</head>

<body class="antialiased">
    @include('guest_partials.header')
    <div style="min-height:120vh;">

        @yield('content')
    </div>


    @include('guest_partials.footer')
    @include('guest_partials.footer-script')
</body>

</html>

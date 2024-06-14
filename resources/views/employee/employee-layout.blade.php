<!DOCTYPE html>
<html lang="en">

<head>
    @include('employee-partials.head')
</head>

<body>
    @include('employee-partials.header')
    <div style="min-height:120vh;">
        @yield('content')
    </div>


    @include('employee-partials.footer')
    @include('employee-partials.footer-script')

</body>

</html>

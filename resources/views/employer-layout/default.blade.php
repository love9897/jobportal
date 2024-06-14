<!DOCTYPE html>
<html lang="en">

<head>
    @include('employer-partials.head')
</head>

<body>
    @include('employer-partials.header')
    <div style="min-height:120vh;">
        @yield('content')
    </div>


    @include('employer-partials.footer')
    @include('employer-partials.footer-script')

</body>

</html>

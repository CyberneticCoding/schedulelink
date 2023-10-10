<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    {{--    <meta name="csrf-token" content="{{ csrf_token() }}">--}}
{{--    @routes --}}{{-- for ziggy >--}}
    <title>Laravel Vue Template</title>
    @vite('resources/js/app.js')
    @vite('resources/css/app.css')
    @inertiaHead
    {{--    <script src="https://kit.fontawesome.com/ddae002269.js" crossorigin="anonymous"></script>--}}
</head>
<body class="bg-primary font-manrope">
@inertia
</body>
</html>
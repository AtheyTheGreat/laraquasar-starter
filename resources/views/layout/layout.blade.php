<!DOCTYPE html>
<html lang="dv-MV" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Portal</title>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    @vite('resources/css/app.css')
</head>

<body class="antialiased hide-recaptcha font-typer bg-stone-100">
    @yield('content')
</body>

</html>
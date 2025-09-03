<!doctype html>
<html lang="fa">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    @vite('resources/css/app.css')

    <title>@yield('title')</title>
    @stack('head')
</head>

<style>

    * {
        font-family: Fusans, serif;
        direction: rtl;
    }

</style>

<body>

@yield('body')

@stack('scripts')
</body>
</html>

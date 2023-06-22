<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>The Shop</title>
    @livewireStyles
    @vite('resources/css/app.css')
</head>
<body>
    
    <x-navbar/>
    <x-categoryMenu/>
    @yield('main')

    @livewireScripts
</body>
</html>
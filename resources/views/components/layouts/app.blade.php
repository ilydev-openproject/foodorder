<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Livewire App</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-white min-h-screen flex flex-col justify-start items-center">
    <header class="w-full max-w-md mx-auto bg-gray-50">
        <livewire:navbar />
    </header>
    <main class="container max-w-md mx-auto p-4 bg-gray-50">
        {{ $slot }}
    </main>
    @livewireScripts
</body>

</html>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Livewire App</title>
    @vite(['resources/css/app.css','resources/js/app.js'])
    @livewireStyles
</head>

<body class="bg-white min-h-screen max-w-md mx-auto flex flex-col justify-start items-center">
    <main class="container max-w-md mx-auto min-h-screen px-4 bg-gray-50">
        <header class="w-full max-w-md mx-auto bg-gray-50">
            <livewire:navbar />
        </header>
        {{ $slot }}
    </main>
    @livewireScripts
</body>

</html>
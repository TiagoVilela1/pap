<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">
    <x-banner />

    <div class="min-h-screen bg-gray-100">
        @livewire('navigation-menu')

        <!-- Page Heading -->
        @if (isset($header))
            <header class="bg-white shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                    {{ $header }}
                </div>
            </header>
        @endif

        <!-- Page Content -->
        <main>
            {{ $slot }}
        </main>
    </div>

    @stack('modals')

    @livewireScripts

    <div class="flex flex-wrap justify-around items-center h-14 bg-white">
        <a target="_blank" href="https://www.instagram.com/minderascraft/">
            <div class="flex justify-center items-center font-bold">
                <button class="flex items-center gap-2">
                    <img class="w-6 h-6"
                        src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/a5/Instagram_icon.png/2048px-Instagram_icon.png"
                        alt="">
                    INSTAGRAM
                    <p class="font-bold">
                    </p>
                </button>
            </div>
        </a>

        <a target="_blank" href="https://www.facebook.com/minderasoftwarecraft/">
            <div class="flex justify-center items-center font-bold">
                <button class="flex items-center gap-2">
                    <img class="w-6 h-6"
                        src="https://static-00.iconduck.com/assets.00/facebook-color-icon-2048x2048-bfly1vxr.png"
                        alt="">
                    FACEBOOK
                    <p class="font-bold">
                    </p>
                </button>
            </div>
        </a>

        <a target="_blank" href="https://www.linkedin.com/company/mindera-world/?originalSubdomain=pt">
            <div class="flex justify-center items-center font-bold">
                <button class="flex items-center gap-2">
                    <img class="w-6 h-6"
                        src="https://cdn1.iconfinder.com/data/icons/logotypes/32/circle-linkedin-512.png"alt="">
                    <p class="font-bold">
                        LINKEDIN
                    </p>
                </button>
            </div>
        </a>

        <a target="_blank" href="https://mindera.com/">
            <div class="flex justify-center items-center font-bold">
                <button class="flex items-center gap-2">
                    <img class="w-6 h-6" src="/logo-icon.png" alt="">
                    <p class="font-bold">
                        WEBSITE
                    </p>
                </button>
            </div>
        </a>
    </div>
</body>

</html>

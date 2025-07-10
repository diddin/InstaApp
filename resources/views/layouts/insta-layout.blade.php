<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ config('app.name', 'InstaApp') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-white-100 text-gray-900">
    @if (session('success'))
        <div class="bg-green-100 text-green-800 p-2 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif
    
    <header class="bg-white shadow">
        <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">
            <div>
                <a href="/posts" class="flex items-center space-x-2">
                    <x-application-logo class="w-20 h-20 fill-current text-gray-500" />
                </a>
            </div>
            <nav class="space-x-4">
                <a href="/posts" class="text-black-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M3 9.75L12 4.5l9 5.25M4.5 10.5v7.125c0 .621.504 1.125 1.125 1.125H9.75v-4.5a.375.375 0 01.375-.375h3.75a.375.375 0 01.375.375v4.5h4.125c.621 0 1.125-.504 1.125-1.125V10.5" />
                    </svg>
                </a>
                <a href="/posts/create" class="text-black-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 4.5v15m7.5-7.5h-15" />
                    </svg>
                </a>
                <a href="/profile" class="text-black-500">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 12m-3 0a3 3 0 1 0 6 0a3 3 0 1 0 -6 0zM4.5 20.25c0-2.25 2.25-4.5 7.5-4.5s7.5 2.25 7.5 4.5v1.125c0 .621-.504 1.125-1.125 1.125H5.625A1.125 1.125 0 0 1 4.5 21.375V20.25z" />
                    </svg>
                </a>
                <form method="POST" action="/logout" class="inline">
                    @csrf
                    <button type="submit" class="text-black-500">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6 inline">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 9V5.25A2.25 2.25 0 0013.5 3h-6A2.25 2.25 0 005.25 5.25v13.5A2.25 2.25 0 007.5 21h6a2.25 2.25 0 002.25-2.25V15m4.5-3H9m0 0l3-3m-3 3l3 3" />
                        </svg>
                    </button>
                </form>
            </nav>
        </div>
    </header>

    <main class="px-4 sm:px-6 lg:px-8">
        <div class="max-w-3xl mx-auto">
            {{ $slot }}
        </div>
    </main>
</body>
</html>
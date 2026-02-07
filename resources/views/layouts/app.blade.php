<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Templatenesia')</title>
    @yield('head')
</head>
</body>
<body>
    <header class="bg-white border-b">
        <div class="container mx-auto px-4 py-3 flex items-center justify-between">
            <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-900">Templatenesia</a>
            <nav class="flex items-center space-x-4">
                <a href="{{ url('/orders') }}" class="flex items-center text-sm text-gray-700 hover:text-gray-900">
                    <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 7l1.5 12.5A2 2 0 006.5 21h11a2 2 0 001.99-1.5L21 7M16 11a4 4 0 01-8 0" />
                    </svg>
                    Pesanan
                </a>
            </nav>
        </div>
    </header>

    <main class="container mx-auto px-4 py-6">
        @yield('content')
    </main>
</body>
</html>
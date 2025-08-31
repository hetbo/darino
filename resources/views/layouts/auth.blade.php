<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', __('general.darino'))</title>


    <style>
        * {
            font-family: Fusans, serif;
            direction: rtl;
        }
    </style>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="antialiased font-inter">
<div class="min-h-screen bg-gradient-to-br from-rose-50 via-pink-50 to-red-50">
    <!-- Background Pattern -->
    <div class="absolute inset-0 opacity-30">
        <div class="absolute top-0 left-0 w-72 h-72 bg-rose-300 rounded-full mix-blend-multiply filter blur-xl"></div>
        <div class="absolute top-0 right-0 w-72 h-72 bg-pink-300 rounded-full mix-blend-multiply filter blur-xl animate-pulse"></div>
        <div class="absolute bottom-0 left-1/2 w-72 h-72 bg-red-300 rounded-full mix-blend-multiply filter blur-xl"></div>
    </div>

    <!-- Navigation -->
    <nav class="relative z-10 px-6 py-4">
        <div class="max-w-7xl mx-auto flex justify-between items-center">
            <div class="flex items-center space-x-2">
                <div class="w-8 h-8  rounded-lg flex items-center justify-center">
                    <img src="{{asset('storage/others/fav.png')}}" />
                </div>
                <span class="text-xl font-bold text-gray-800">{{ __('general.darino') }}</span>
            </div>

            <div class="hidden md:flex items-center space-x-6">
                @yield('nav-links')
            </div>
        </div>
    </nav>

    <main class="relative z-10 flex items-center justify-center px-6 py-12">
        <div class="w-full max-w-md">

            <div class="bg-white/80 backdrop-blur-lg rounded-2xl shadow-xl border border-white/50 p-8">

                <div class="text-center mb-8">
                    @yield('header')
                </div>


                <div class="space-y-6">
                    @yield('content')
                </div>


                <div class="mt-8 pt-6 border-t border-gray-100 text-center">
                    @yield('footer')
                </div>
            </div>


            <div class="mt-6 text-center">
                @yield('additional-links')
            </div>
        </div>
    </main>


    @if(session('status'))
        <div class="fixed top-4 right-4 z-50 max-w-sm bg-green-50 border border-green-200 rounded-lg p-4 shadow-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-green-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="mr-3">
                    <p class="text-sm font-medium text-green-800">{{ session('status') }}</p>
                </div>
            </div>
        </div>
    @endif

    @if(session('error'))
        <div class="fixed top-4 right-4 z-50 max-w-sm bg-red-50 border border-red-200 rounded-lg p-4 shadow-lg">
            <div class="flex items-center">
                <div class="flex-shrink-0">
                    <svg class="w-5 h-5 text-red-500" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd"/>
                    </svg>
                </div>
                <div class="mr-3">
                    <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                </div>
            </div>
        </div>
    @endif
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        setTimeout(function() {
            const flashMessages = document.querySelectorAll('[class*="fixed top-4 right-4"]');
            flashMessages.forEach(function(message) {
                message.style.transition = 'opacity 0.5s ease-out';
                message.style.opacity = '0';
                setTimeout(function() {
                    message.remove();
                }, 500);
            });
        }, 4000);
    });
</script>
</body>
</html>

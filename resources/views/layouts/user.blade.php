<!DOCTYPE html>
<html lang="ar" dir="rtl" class="h-full bg-gray-50">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', __('user.dashboard')) - {{ __('user.expense_tracker') }}</title>

    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')
</head>
<body class="h-full font-sans antialiased bg-gray-50">
<div class="min-h-full">
    <!-- Sidebar -->
    @include('layouts.partials.sidebar')

    <!-- Main Content Area -->
    <div class="lg:pr-72">
        <!-- Top Navigation -->
        @include('layouts.partials.topnav')

        <!-- Page Content -->
        <main class="py-8">
            <div class="mx-auto max-w-7xl px-4 sm:px-6 lg:px-8">
                <!-- Page Header -->
                @hasSection('header')
                    <div class="mb-8">
                        <div class="sm:flex sm:items-center sm:justify-between">
                            <div class="min-w-0 flex-1">
                                <h1 class="text-2xl font-bold leading-7 text-gray-900 sm:truncate sm:text-3xl sm:tracking-tight">
                                    @yield('header')
                                </h1>
                                @hasSection('description')
                                    <p class="mt-1 text-sm text-gray-500">
                                        @yield('description')
                                    </p>
                                @endif
                            </div>
                            @hasSection('actions')
                                <div class="mt-4 flex sm:ml-4 sm:mt-0">
                                    @yield('actions')
                                </div>
                            @endif
                        </div>
                    </div>
                @endif

                <!-- Flash Messages -->
                @if(session('success'))
                    <div class="mb-6 rounded-lg bg-rose-50 p-4 border border-rose-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-rose-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.857-9.809a.75.75 0 00-1.214-.882l-3.236 4.53L7.53 10.53a.75.75 0 00-1.06 1.061l2.5 2.5a.75.75 0 001.137-.089l4-5.5z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="mr-3">
                                <p class="text-sm font-medium text-rose-800">{{ session('success') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                @if(session('error'))
                    <div class="mb-6 rounded-lg bg-red-50 p-4 border border-red-200">
                        <div class="flex">
                            <div class="flex-shrink-0">
                                <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.28 7.22a.75.75 0 00-1.06 1.06L8.94 10l-1.72 1.72a.75.75 0 101.06 1.06L10 11.06l1.72 1.72a.75.75 0 101.06-1.06L11.06 10l1.72-1.72a.75.75 0 00-1.06-1.06L10 8.94 8.28 7.22z" clip-rule="evenodd" />
                                </svg>
                            </div>
                            <div class="mr-3">
                                <p class="text-sm font-medium text-red-800">{{ session('error') }}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!-- Main Content -->
                @yield('content')
            </div>
        </main>
    </div>
</div>

@stack('scripts')
</body>
</html>

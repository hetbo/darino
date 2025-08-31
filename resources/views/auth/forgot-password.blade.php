@extends('layouts.auth')

@section('title', __('auth.reset_password'))

@section('nav-links')
    <a href="{{ route('login') }}" class="text-gray-600 hover:text-rose-600 font-medium transition-colors">
        {{ __('auth.back_to_sign_in') }}
    </a>
@endsection

@section('header')
    <div class="w-16 h-16 bg-gradient-to-r from-rose-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 7a2 2 0 012 2m4 0a6 6 0 01-7.743 5.743L11 17H9v2H7v2H4a1 1 0 01-1-1v-2.586a1 1 0 01.293-.707l5.964-5.964A6 6 0 1121 9z"/>
        </svg>
    </div>
    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('auth.forgot_password_page') }}</h1>
    <p class="text-gray-600">{{ __('auth.no_worries_reset') }}</p>
@endsection

@section('content')

    <form method="POST" action="{{ route('password.email') }}" class="space-y-6">
        @csrf


        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                {{ __('auth.email_address') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    required
                    value="{{ old('email') }}"
                    class="block w-full pr-10 pl-3 py-3 border outline-none border-gray-200 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-transparent bg-gray-50/50 backdrop-blur-sm transition-all @error('email') border-red-300 @enderror"
                    placeholder="{{ __('auth.enter_email_address') }}"
                >
            </div>
            @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>


        <button
            type="submit"
            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transform hover:scale-[0.98] transition-all duration-200 shadow-lg hover:shadow-xl"
        >
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"/>
            </svg>
            {{ __('auth.send_reset_link') }}
        </button>
    </form>


    <div class="bg-rose-50 border border-rose-100 rounded-xl p-4">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-rose-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
            </div>
            <div class="mr-3">
                <h3 class="text-sm font-medium text-rose-800">{{ __('auth.reset_instructions') }}</h3>
                <div class="mt-1 text-sm text-rose-700">
                    <p>{{ __('auth.email_secure_link') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <p class="text-sm text-gray-600">
        {{ __('auth.secure_password_reset') }}
    </p>
@endsection

@section('additional-links')
    <div class="space-y-2">
        <p class="text-sm text-gray-600">
            {{ __('auth.remember_password') }}
            <a href="{{ route('login') }}" class="font-semibold text-rose-600 hover:text-rose-500 transition-colors">
                {{ __('auth.sign_in_instead') }}
            </a>
        </p>
        <p class="text-sm text-gray-600">
            {{ __('auth.need_new_account') }}
            <a href="{{ route('register') }}" class="font-semibold text-rose-600 hover:text-rose-500 transition-colors">
                {{ __('auth.create_one_here') }}
            </a>
        </p>
    </div>
@endsection

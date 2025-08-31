@extends('layouts.auth')

@section('title', __('auth.create_account'))

@section('nav-links')
    <a href="{{ route('login') }}" class="text-gray-600 hover:text-rose-600 font-medium transition-colors">
        {{ __('auth.sign_in') }}
    </a>
@endsection

@section('header')
    <div class="w-16 h-16 bg-gradient-to-r from-rose-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
        </svg>
    </div>
    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('auth.create_your_account') }}</h1>
    <p class="text-gray-600">{{ __('auth.join_us_start_journey') }}</p>
@endsection

@section('content')
    <!-- Registration Form -->
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <!-- Name Field -->
        <div>
            <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                {{ __('auth.full_name') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                    </svg>
                </div>
                <input
                    id="name"
                    name="name"
                    type="text"
                    autocomplete="name"
                    required
                    value="{{ old('name') }}"
                    class="block w-full pr-10 pl-3 py-3 border outline-none border-gray-200 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-transparent bg-gray-50/50 backdrop-blur-sm transition-all @error('name') border-red-300 @enderror"
                    placeholder="{{ __('auth.enter_full_name') }}"
                >
            </div>
            @error('name')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Email Field -->
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
                    placeholder="{{ __('auth.enter_your_email') }}"
                >
            </div>
            @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Field -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                {{ __('auth.password') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
                    </svg>
                </div>
                <input
                    id="password"
                    name="password"
                    type="password"
                    autocomplete="new-password"
                    required
                    class="block w-full pr-10 pl-12 py-3 border outline-none border-gray-200 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-transparent bg-gray-50/50 backdrop-blur-sm transition-all @error('password') border-red-300 @enderror"
                    placeholder="{{ __('auth.create_strong_password') }}"
                >
                <button
                    type="button"
                    class="absolute inset-y-0 left-0 pl-3 flex items-center"
                    onclick="togglePassword('password')"
                >
                    <svg id="eye-open-password" class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg id="eye-closed-password" class="w-5 h-5 text-gray-400 hover:text-gray-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                    </svg>
                </button>
            </div>
            @error('password')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Confirm Password Field -->
        <div>
            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                {{ __('auth.confirm_password') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                    </svg>
                </div>
                <input
                    id="password_confirmation"
                    name="password_confirmation"
                    type="password"
                    autocomplete="new-password"
                    required
                    class="block w-full pr-10 pl-12 py-3 border outline-none border-gray-200 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-transparent bg-gray-50/50 backdrop-blur-sm transition-all"
                    placeholder="{{ __('auth.confirm_your_password') }}"
                >
                <button
                    type="button"
                    class="absolute inset-y-0 left-0 pl-3 flex items-center"
                    onclick="togglePassword('password_confirmation')"
                >
                    <svg id="eye-open-confirmation" class="w-5 h-5 text-gray-400 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg id="eye-closed-confirmation" class="w-5 h-5 text-gray-400 hover:text-gray-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Terms Agreement -->
        <div class="flex items-start">
            <div class="flex items-center h-5">
                <input
                    id="terms"
                    name="terms"
                    type="checkbox"
                    required
                    class="h-4 w-4 text-rose-600 focus:ring-rose-500 border-gray-300 rounded @error('terms') border-red-300 @enderror"
                >
            </div>
            <div class="mr-3 text-sm">
                <label for="terms" class="text-gray-700">
                    {{ __('auth.i_agree_to') }}
                    <a href="#" class="font-medium text-rose-600 hover:text-rose-500 transition-colors">{{ __('auth.terms_of_service') }}</a>
                    {{ __('auth.and') }}
                    <a href="#" class="font-medium text-rose-600 hover:text-rose-500 transition-colors">{{ __('auth.privacy_policy') }}</a>
                </label>
            </div>
        </div>
        @error('terms')
        <p class="text-sm text-red-600">{{ $message }}</p>
        @enderror

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transform hover:scale-[0.98] transition-all duration-200 shadow-lg hover:shadow-xl"
        >
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"/>
            </svg>
            {{ __('auth.create_account') }}
        </button>
    </form>

    <!-- Divider -->
    <div class="mt-6">
        <div class="relative">
            <div class="absolute inset-0 flex items-center">
                <div class="w-full border-t border-gray-200"></div>
            </div>
            <div class="relative flex justify-center text-sm">
                <span class="px-4 bg-white text-gray-500 font-medium">{{ __('auth.or_sign_up_with') }}</span>
            </div>
        </div>
    </div>

    <!-- Social Registration Buttons -->
    <div class="mt-6 grid grid-cols-2 gap-3">
        <button class="w-full inline-flex justify-center py-3 px-4 border border-gray-200 rounded-xl bg-white hover:bg-gray-50 transition-colors group">
            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-700" viewBox="0 0 24 24">
                <path fill="currentColor" d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z"/>
                <path fill="currentColor" d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z"/>
                <path fill="currentColor" d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l2.85-2.22.81-.62z"/>
                <path fill="currentColor" d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z"/>
            </svg>
            <span class="mr-2 text-sm font-medium text-gray-700">{{__('auth.google')}}</span>
        </button>

        <button class="w-full inline-flex justify-center py-3 px-4 border border-gray-200 rounded-xl bg-white hover:bg-gray-50 transition-colors group">
            <svg class="w-5 h-5 text-gray-500 group-hover:text-gray-700" fill="currentColor" viewBox="0 0 24 24">
                <path d="M24 4.557c-.883.392-1.832.656-2.828.775 1.017-.609 1.798-1.574 2.165-2.724-.951.564-2.005.974-3.127 1.195-.897-.957-2.178-1.555-3.594-1.555-3.179 0-5.515 2.966-4.797 6.045-4.091-.205-7.719-2.165-10.148-5.144-1.29 2.213-.669 5.108 1.523 6.574-.806-.026-1.566-.247-2.229-.616-.054 2.281 1.581 4.415 3.949 4.89-.693.188-1.452.232-2.224.084.626 1.956 2.444 3.379 4.6 3.419-2.07 1.623-4.678 2.348-7.29 2.04 2.179 1.397 4.768 2.212 7.548 2.212 9.142 0 14.307-7.721 13.995-14.646.962-.695 1.797-1.562 2.457-2.549z"/>
            </svg>
            <span class="mr-2 text-sm font-medium text-gray-700">{{__('auth.twitter')}}</span>
        </button>
    </div>
@endsection

@section('footer')
    <p class="text-sm text-gray-600">
        {{ __('auth.data_secure_encrypted') }}
    </p>
@endsection

@section('additional-links')
    <p class="text-sm text-gray-600">
        {{ __('auth.already_have_account') }}
        <a href="{{ route('login') }}" class="font-semibold text-rose-600 hover:text-rose-500 transition-colors">
            {{ __('auth.sign_in_here') }}
        </a>
    </p>
@endsection

<script>
    function togglePassword(fieldId) {
        const passwordInput = document.getElementById(fieldId);
        const eyeOpen = document.getElementById(`eye-open-${fieldId === 'password' ? 'password' : 'confirmation'}`);
        const eyeClosed = document.getElementById(`eye-closed-${fieldId === 'password' ? 'password' : 'confirmation'}`);

        if (passwordInput.type === 'password') {
            passwordInput.type = 'text';
            eyeOpen.classList.add('hidden');
            eyeClosed.classList.remove('hidden');
        } else {
            passwordInput.type = 'password';
            eyeOpen.classList.remove('hidden');
            eyeClosed.classList.add('hidden');
        }
    }
</script>

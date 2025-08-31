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
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"/>
        </svg>
    </div>
    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('auth.reset_password') }}</h1>
    <p class="text-gray-600">{{ __('auth.enter_new_password') }}</p>
@endsection

@section('content')
    <!-- Password Reset Form -->
    <form method="POST" action="{{ route('password.update') }}" class="space-y-6">
        @csrf

        <!-- Hidden Token -->
        <input type="hidden" name="token" value="{{ request()->route('token') }}">

        <!-- Email Field -->
        <div>
            <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                {{ __('auth.email_address') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"/>
                    </svg>
                </div>
                <input
                    id="email"
                    name="email"
                    type="email"
                    autocomplete="email"
                    required
                    value="{{ old('email', request()->email) }}"
                    class="block w-full pr-10 pl-3 py-3 border outline-none border-gray-200 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-transparent bg-gray-50/50 backdrop-blur-sm transition-all @error('email') border-red-300 @enderror"
                    placeholder="{{ __('auth.enter_email_address') }}"
                    style="font-family: monospace; font-size: 18px;"
                >
            </div>
            @error('email')
            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>

        <!-- Password Field -->
        <div>
            <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                {{ __('auth.new_password') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    placeholder="{{ __('auth.enter_new_password_field') }}"
                    style="font-family: monospace; font-size: 18px;"
                >
                <button
                    type="button"
                    class="absolute inset-y-0 left-0 pl-3 flex items-center"
                    onclick="togglePassword('password')"
                >
                    <svg id="eye-open-password" class="w-5 h-5 text-gray-800 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg id="eye-closed-password" class="w-5 h-5 text-gray-800 hover:text-gray-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                {{ __('auth.confirm_new_password') }}
            </label>
            <div class="relative">
                <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                    <svg class="w-5 h-5 text-gray-800" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                    placeholder="{{ __('auth.confirm_new_password_field') }}"
                    style="font-family: monospace; font-size: 18px;"
                >
                <button
                    type="button"
                    class="absolute inset-y-0 left-0 pl-3 flex items-center"
                    onclick="togglePassword('password_confirmation')"
                >
                    <svg id="eye-open-confirmation" class="w-5 h-5 text-gray-800 hover:text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"/>
                    </svg>
                    <svg id="eye-closed-confirmation" class="w-5 h-5 text-gray-800 hover:text-gray-600 hidden" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13.875 18.825A10.05 10.05 0 0112 19c-4.478 0-8.268-2.943-9.543-7a9.97 9.97 0 011.563-3.029m5.858.908a3 3 0 114.243 4.243M9.878 9.878l4.242 4.242M9.878 9.878L3 3m6.878 6.878L21 21"/>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Submit Button -->
        <button
            type="submit"
            class="w-full flex justify-center py-3 px-4 border border-transparent rounded-xl text-sm font-semibold text-white bg-gradient-to-r from-rose-600 to-pink-600 hover:from-rose-700 hover:to-pink-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transform hover:scale-[0.98] transition-all duration-200 shadow-lg hover:shadow-xl"
        >
            <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
            {{ __('auth.reset_password') }}
        </button>
    </form>

    <!-- Security Info -->
    <div class="bg-green-50 border border-green-100 rounded-xl p-4">
        <div class="flex items-start">
            <div class="flex-shrink-0">
                <svg class="w-5 h-5 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.414-4.414a2 2 0 00-2.828 0L16 5.172 14.828 4l-2.18 2.172a2 2 0 000 2.656z"/>
                </svg>
            </div>
            <div class="mr-3">
                <h3 class="text-sm font-medium text-green-800">{{ __('auth.password_requirements') }}</h3>
                <div class="mt-1 text-sm text-green-700">
                    <p>{{ __('auth.password_should_be') }}</p>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footer')
    <p class="text-sm text-gray-600">
        {{ __('auth.password_securely_encrypted') }}
    </p>
@endsection

@section('additional-links')
    <p class="text-sm text-gray-600">
        {{ __('auth.remember_password') }}
        <a href="{{ route('login') }}" class="font-semibold text-rose-600 hover:text-rose-500 transition-colors">
            {{ __('auth.sign_in_instead') }}
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

@extends('layouts.auth')

@section('title', __('auth.verify_email'))

@section('nav-links')
    <form method="POST" action="{{ route('logout') }}" class="inline">
        @csrf
        <button type="submit" class="text-gray-600 hover:text-rose-600 font-medium transition-colors">
            {{ __('auth.sign_out') }}
        </button>
    </form>
@endsection

@section('header')
    <div class="w-16 h-16 bg-gradient-to-r from-rose-500 to-pink-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
    </div>
    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('auth.verify_your_email') }}</h1>
    <p class="text-gray-600">{{ __('auth.verification_link_sent') }}</p>
@endsection

@section('content')

    <div class="bg-blue-50 border border-blue-100 rounded-xl p-6 text-center">
        <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-blue-900 mb-2">{{ __('auth.check_your_inbox') }}</h3>

        <p class="text-blue-600 text-sm mt-2">
            {{ __('auth.click_link_to_verify') }}
        </p>
    </div>


    <div class="space-y-4">
        <div class="text-center">
            <p class="text-sm text-gray-600 mb-4">{{ __('auth.didnt_receive_email') }}</p>

            <form method="POST" action="{{ route('verification.send') }}" class="inline">
                @csrf

                <div class="relative mb-2">
                    <div class="absolute inset-y-0 right-0 pr-3 flex items-center pointer-events-none">
                        <svg class="w-5 h-5 text-gray-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
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
                        class="block w-full pr-10 pl-3 py-3 border border-gray-200 rounded-xl focus:ring-2 focus:ring-rose-500 focus:border-transparent bg-gray-50/50 backdrop-blur-sm transition-all @error('email') border-red-300 @enderror"
                        placeholder="{{ __('auth.enter_your_email') }}"
                    >
                </div>


                <button
                    type="submit"
                    class="inline-flex items-center px-6 py-3 border border-rose-200 rounded-xl text-sm font-semibold text-rose-700 bg-rose-50 hover:bg-rose-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-rose-500 transition-all duration-200"
                >
                    <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                    {{ __('auth.resend_verification_email') }}
                </button>
            </form>
        </div>

        <div class="bg-gray-50 border border-gray-100 rounded-xl p-4">
            <h4 class="text-sm font-semibold text-gray-800 mb-2">{{ __('auth.still_having_trouble') }}</h4>
            <div class="text-sm text-gray-600 space-y-1">
                <p>• {{ __('auth.check_spam_folder') }}</p>
                <p>• {{ __('auth.make_sure_email_correct') }}</p>
                <p>• {{ __('auth.wait_few_minutes') }}</p>
            </div>
        </div>


    </div>
@endsection

@section('footer')
    <p class="text-sm text-gray-600">
        {{ __('auth.email_verification_security') }}
    </p>
@endsection

@section('additional-links')
    <p class="text-sm text-gray-600">
        {{ __('auth.need_help') }}
        <a href="#" class="font-semibold text-rose-600 hover:text-rose-500 transition-colors">
            {{ __('auth.contact_support') }}
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

    function showEmailChangeForm() {
        document.getElementById('email-change-form').classList.remove('hidden');
    }

    function hideEmailChangeForm() {
        document.getElementById('email-change-form').classList.add('hidden');
    }
</script>

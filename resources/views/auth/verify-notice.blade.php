@extends('layouts.auth')

@section('title', __('auth.verify_email'))

@section('header')
    <div class="w-16 h-16 bg-gradient-to-r from-green-500 to-teal-500 rounded-2xl flex items-center justify-center mx-auto mb-4">
        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 4.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"/>
        </svg>
    </div>
    <h1 class="text-3xl font-bold text-gray-900 mb-2">{{ __('auth.verify_your_email') }}</h1>
    <p class="text-gray-600">{{ __('auth.check_your_inbox') }}</p>
@endsection

@section('content')
    <div class="bg-green-50 border border-green-200 rounded-xl p-6 text-center shadow-sm">
        <div class="w-12 h-12 bg-green-100 rounded-full flex items-center justify-center mx-auto mb-4">
            <svg class="w-7 h-7 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
            </svg>
        </div>
        <h3 class="text-lg font-semibold text-green-900 mb-2">{{ __('auth.verification_link_sent') }}</h3>
        <p class="text-green-800 text-sm">
{{--            {{ __('auth.verification_email_sent_to') }} <strong class="font-medium">{{ request()->user()->email ?? '' }}</strong>.--}}
        </p>
        <p class="text-green-700 text-sm mt-2">
            {{ __('auth.click_link_to_verify') }}
        </p>
    </div>

    <div class="mt-6 text-center">
        <p class="text-sm text-gray-600">{{ __('auth.didnt_receive_email') }}</p>
{{--
        <form class="inline-block mt-2" method="POST" action="{{ route('verification.send') }}">
            @csrf
--}}
            <a href="{{ route('verification.notice') }}" type="submit" class="font-semibold text-rose-600 hover:text-rose-500 transition-colors">
                {{ __('auth.resend_verification_email') }}
            </a>
{{--        </form>--}}
    </div>
@endsection

@section('footer')
    <div class="text-center">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="text-sm text-gray-600 hover:text-rose-600 transition-colors">
                {{ __('auth.sign_out') }}
            </button>
        </form>
    </div>
@endsection

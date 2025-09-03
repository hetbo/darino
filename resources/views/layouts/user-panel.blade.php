@extends('layouts.master')

@php
$user = auth()->user();
$profile = $user->profile;
$accounts = $user->accounts
 @endphp

@push('head')
    <link href="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.css" rel="stylesheet" />
@endpush

@section('body')

    @include('partials.user.navbar')

    @include('partials.user.sidebar')

    @yield('content')

@endsection
@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/flowbite@3.1.2/dist/flowbite.min.js"></script>
@endpush

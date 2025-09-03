@php
    $accounts = $user->accounts;
    $profile = $user->profile
@endphp

@extends('layouts.master')

@section('title', __('general.choose-or-create-account'))
@section('body')

    <div class="w-full min-h-screen bg-gray-50 flex flex-col items-center">

        <div class="flex flex-col p-14">
            <div class="flex items-center mb-4 space-x-2 justify-center">
                <img src="{{asset('storage/others/fav.png')}}" class="w-7 h-7 grayscale"/>
                <span class="text-lg font-bold text-neutral-400">@lang('general.darino')</span>
            </div>
            <p class="text-4xl sm:text-5xl font-black text-rose-800">
                @lang('general.welcome')
                <span class="bg-gradient-to-r from-pink-500 via-rose-500 to-orange-500 bg-clip-text text-transparent">
                {{explode(' ', $user->name)[0]}}</span>!
            </p>
        </div>

        <div class="w-full flex flex-col sm:flex-row">

            <div class="w-full sm:w-1/2 flex flex-col items-center">
                <div class="hidden sm:flex sm:flex-col w-full items-center">
                    @forelse($accounts as $acc)
                        <a href="{{route('dashboard.account', $acc)}}"
                           class="group relative rounded p-4 bg-white shadow-xs w-10/12 md:w-4/5 mb-2 flex items-center gap-x-4 hover:bg-rose-700
                        hover:text-white transition-all cursor-pointer">
                            <div class="bg-rose-600 rounded p-1 w-fit text-white">
                                <x-my-folder class="w-5 h-5"/>
                            </div>
                            <div>
                            <span class="font-semibold text-gray-600 group-hover:text-white">
                                {{$acc->name}}
                            </span>
                                <div class="text-gray-400 text-sm group-hover:text-white/70">
                                    {{number_format($acc->balance)}}
                                    {{$acc->currency === 'IRR' ? 'ریال' : 'تومان'}}
                                </div>
                            </div>
                            <div class="absolute left-5">
                                <x-my-double-arrow class="w-5 h-5 animate-pulse"/>
                            </div>
                        </a>
                    @empty
                        <x-my-folder-open class="w-20 h-20 my-4 text-black/50"/>
                        <span class="text-gray-400">
                        @lang('user.no-account')
                    </span>
                    @endforelse
                </div>

                <div class="sm:hidden flex flex-col w-full items-center">
                    @if($accounts->isNotEmpty())
                        @php
                            $displayAccount = $accounts->first();
                        @endphp

                        <div class="relative w-10/12 md:w-4/5">

                            <button
                                id="account-selector-button"
                                type="button"
                                class="group w-full rounded p-4 bg-white shadow-xs flex items-center gap-x-4 hover:bg-rose-50 transition-all cursor-pointer border-2 border-transparent focus:outline-none focus:ring-2 focus:ring-rose-500"
                                onclick="toggleAccountDropdown()"
                            >
                                <div class="bg-rose-600 rounded p-1 w-fit text-white">
                                    <x-my-folder class="w-5 h-5"/>
                                </div>
                                <div class="flex-1 text-right">
                                    <span class="font-semibold text-gray-600">
                        {{ $displayAccount->name }}
                    </span>
                                    <div class="text-gray-400 text-sm">
                                        {{ number_format($displayAccount->balance) }}
                                        {{ $displayAccount->currency === 'IRR' ? 'ریال' : 'تومان' }}
                                    </div>
                                </div>
                                <div id="dropdown-arrow" class="transition-transform duration-300">
                                    <svg class="w-5 h-5 text-gray-400 group-hover:text-rose-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                    </svg>
                                </div>
                            </button>


                            <div
                                id="account-dropdown"
                                class="absolute top-full right-0 left-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-xl z-50 p-2 hidden transition-all duration-300 opacity-0 transform -translate-y-2"
                            >
                                @foreach($accounts as $acc)
                                    <a
                                        href="{{ route('dashboard.account', $acc) }}"
                                        class="group w-full rounded p-4 bg-white flex items-center gap-x-4 hover:bg-rose-50 transition-all cursor-pointer"
                                    >
                                        <div class="bg-rose-600 rounded p-1 w-fit text-white">
                                            <x-my-folder class="w-5 h-5"/>
                                        </div>
                                        <div class="text-right"> {{-- text-right for RTL --}}
                                            <span class="font-semibold text-gray-600">
                                {{$acc->name}}
                            </span>
                                            <div class="text-gray-400 text-sm">
                                                {{number_format($acc->balance)}}
                                                {{$acc->currency === 'IRR' ? 'ریال' : 'تومان'}}
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            </div>

                        </div>
                    @else
                        <div class="flex flex-col items-center text-center">
                            <x-my-folder-open class="w-20 h-20 my-4 text-black/50"/>
                            <span class="text-gray-400">
                @lang('user.no-account')
            </span>
                        </div>
                    @endif
                </div>

            </div>

            <div class="w-full sm:w-1/2 flex flex-col items-center mt-8 mb-16 sm:my-0">

                <h2 class="font-semibold text-lg w-10/12">@lang('user.create-new-account')</h2>

                <form name="new-account-form" class="mt-6 w-10/12 space-y-6" action="{{route('accounts.store')}}"
                      method="POST">
                    @csrf
                    <div>
                        <label for="name"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('user.account-name')</label>
                        <input type="text" id="name" name="name"
                               class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full md:w-4/5 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                               placeholder="اصلی" required/>
                    </div>

                    <div>
                        <label for="currency"
                               class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">@lang('user.currency')</label>
                        <select id="currency" name="currency" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg
                        focus:ring-blue-500 focus:border-blue-500 block w-full md:w-4/5 p-2.5 dark:bg-gray-700 dark:border-gray-600
                        dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                            <option value="IRR" selected>ریال</option>
                            <option value="IRT">تومان</option>
                        </select>
                    </div>

                    <button type="submit" class="text-white bg-gradient-to-r from-rose-500 via-rose-600 to-rose-700
                    hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-rose-300 dark:focus:ring-rose-800
                    shadow-lg shadow-rose-500/50 dark:shadow-lg dark:shadow-rose-800/80 font-medium rounded-lg text-sm px-5
                    py-2.5 text-center me-2 mb-2 cursor-pointer">@lang('user.create-account')</button>


                </form>

            </div>

        </div>

        <div class="w-full flex items-center justify-center bg-white shadow z-50 fixed bottom-0 py-3 space-x-6">
            <a href="{{route('home')}}">
                <x-my-home class="w-5 h-5" />
            </a>
            <a href="https://hetbo.net">
                <x-my-case class="w-5 h-5" />
            </a>
            <a href="https://github.com/hetbo">
                <x-my-github class="w-5 h-5" />
            </a>
        </div>

    </div>

@endsection

@push('scripts')
            <script>

                if (document.getElementById('account-dropdown')) {
                    const dropdown = document.getElementById('account-dropdown');
                    const arrow = document.getElementById('dropdown-arrow');

                    function showDropdown() {
                        dropdown.classList.remove('hidden');
                        setTimeout(() => {
                            dropdown.classList.remove('opacity-0', '-translate-y-2');
                        }, 10);
                        arrow.classList.add('rotate-180');
                    }

                    function hideDropdown() {
                        dropdown.classList.add('opacity-0', '-translate-y-2');
                        setTimeout(() => {
                            dropdown.classList.add('hidden');
                        }, 300);
                        arrow.classList.remove('rotate-180');
                    }

                    function toggleAccountDropdown() {
                        if (dropdown.classList.contains('hidden')) {
                            showDropdown();
                        } else {
                            hideDropdown();
                        }
                    }


                    document.addEventListener('click', function(event) {
                        const button = document.getElementById('account-selector-button');
                        if (button && !button.contains(event.target) && !dropdown.contains(event.target)) {
                            if (!dropdown.classList.contains('hidden')) {
                                hideDropdown();
                            }
                        }
                    });
                }
            </script>

    @endpush

@extends('layouts.user')

@section('title', __('user.dashboard'))

@section('header', __('user.dashboard'))

@section('description', __('user.dashboard_overview'))

@section('actions')
    <a href="{{ '#' }}"
       class="inline-flex items-center gap-x-1.5 rounded-lg bg-rose-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-rose-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-600 transition-colors duration-200">
        <svg class="-mr-0.5 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
            <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
        </svg>
        {{ __('user.add_expense') }}
    </a>
@endsection

@section('content')

    <div class="grid grid-cols-1 gap-6 sm:grid-cols-2 lg:grid-cols-4 mb-8">

        <div class="overflow-hidden rounded-lg bg-white border border-gray-200 shadow-sm">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-rose-100">
                            <svg class="h-6 w-6 text-rose-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mr-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">{{ __('user.total_expenses') }}</dt>
                            <dd class="text-2xl font-bold text-gray-900">{{ number_format(0, 2) }} {{ __('user.currency') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>


        <div class="overflow-hidden rounded-lg bg-white border border-gray-200 shadow-sm">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-blue-100">
                            <svg class="h-6 w-6 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
                        </div>
                    </div>
                    <div class="mr-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">{{ __('user.this_month') }}</dt>
                            <dd class="text-2xl font-bold text-gray-900">{{ number_format(0, 2) }} {{ __('user.currency') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>


        <div class="overflow-hidden rounded-lg bg-white border border-gray-200 shadow-sm">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-green-100">
                            <svg class="h-6 w-6 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mr-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">{{ __('user.categories') }}</dt>
                            <dd class="text-2xl font-bold text-gray-900">0</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>


        <div class="overflow-hidden rounded-lg bg-white border border-gray-200 shadow-sm">
            <div class="p-6">
                <div class="flex items-center">
                    <div class="flex-shrink-0">
                        <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-purple-100">
                            <svg class="h-6 w-6 text-purple-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>
                        </div>
                    </div>
                    <div class="mr-5 w-0 flex-1">
                        <dl>
                            <dt class="text-sm font-medium text-gray-500 truncate">{{ __('user.daily_average') }}</dt>
                            <dd class="text-2xl font-bold text-gray-900">{{ number_format(0, 2) }} {{ __('user.currency') }}</dd>
                        </dl>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="grid grid-cols-1 gap-6 lg:grid-cols-3">

        <div class="lg:col-span-2">
            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <div class="flex items-center justify-between">
                        <h3 class="text-lg font-semibold text-gray-900">{{ __('user.recent_expenses') }}</h3>
                        <a href="{{ '#' }}"
                           class="text-sm font-medium text-rose-600 hover:text-rose-500 transition-colors duration-200">
                            {{ __('user.view_all') }}
                        </a>
                    </div>
                </div>
                <div class="p-6">

                    <div class="text-center py-12">
                        <div class="mx-auto h-16 w-16 rounded-full bg-gray-100 flex items-center justify-center mb-4">
                            <svg class="h-8 w-8 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119.993z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-medium text-gray-900 mb-2">{{ __('user.no_expenses_yet') }}</h3>
                        <p class="text-gray-500 text-sm mb-6">{{ __('user.start_tracking_message') }}</p>
                        <a href="{{ '#' }}"
                           class="inline-flex items-center gap-x-1.5 rounded-lg bg-rose-600 px-4 py-2 text-sm font-semibold text-white shadow-sm hover:bg-rose-500 transition-colors duration-200">
                            <svg class="-mr-0.5 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                            </svg>
                            {{ __('user.add_first_expense') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>


        <div class="space-y-6">

            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('user.quick_actions') }}</h3>
                </div>
                <div class="p-6 space-y-4">
                    <a href="{{ '#' }}"
                       class="flex items-center gap-x-3 p-3 rounded-lg border border-gray-200 hover:border-rose-300 hover:bg-rose-50 transition-all duration-200 group">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-rose-100 group-hover:bg-rose-200 transition-colors duration-200">
                            <svg class="h-5 w-5 text-rose-600" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ __('user.new_expense') }}</p>
                            <p class="text-xs text-gray-500">{{ __('user.record_new_expense') }}</p>
                        </div>
                    </a>

                    <a href="{{ '#' }}"
                       class="flex items-center gap-x-3 p-3 rounded-lg border border-gray-200 hover:border-green-300 hover:bg-green-50 transition-all duration-200 group">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-green-100 group-hover:bg-green-200 transition-colors duration-200">
                            <svg class="h-5 w-5 text-green-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ __('user.new_category') }}</p>
                            <p class="text-xs text-gray-500">{{ __('user.organize_expenses') }}</p>
                        </div>
                    </a>

                    <a href="{{ '#' }}"
                       class="flex items-center gap-x-3 p-3 rounded-lg border border-gray-200 hover:border-blue-300 hover:bg-blue-50 transition-all duration-200 group">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-blue-100 group-hover:bg-blue-200 transition-colors duration-200">
                            <svg class="h-5 w-5 text-blue-600" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-sm font-medium text-gray-900">{{ __('user.view_reports') }}</p>
                            <p class="text-xs text-gray-500">{{ __('user.analyze_spending') }}</p>
                        </div>
                    </a>
                </div>
            </div>


            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('user.monthly_overview') }}</h3>
                </div>
                <div class="p-6">

                    <div class="text-center py-8">
                        <div class="mx-auto h-12 w-12 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                            <svg class="h-6 w-6 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-500">{{ __('user.no_data_chart') }}</p>
                    </div>
                </div>
            </div>


            <div class="bg-white shadow-sm rounded-lg border border-gray-200">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h3 class="text-lg font-semibold text-gray-900">{{ __('user.recent_activity') }}</h3>
                </div>
                <div class="p-6">

                    <div class="text-center py-6">
                        <div class="mx-auto h-10 w-10 rounded-full bg-gray-100 flex items-center justify-center mb-3">
                            <svg class="h-5 w-5 text-gray-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                        </div>
                        <p class="text-sm text-gray-500">{{ __('user.no_recent_activity') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="mt-8">
        <div class="bg-gradient-to-r from-rose-50 to-pink-50 border border-rose-200 rounded-lg p-6">
            <div class="flex items-start gap-x-4">
                <div class="flex-shrink-0">
                    <div class="flex h-10 w-10 items-center justify-center rounded-lg bg-rose-500 shadow-lg">
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 18v-5.25m0 0a6.01 6.01 0 001.5-.189l5.25-1.286a1.125 1.125 0 011.09.96l2.204 8.567a1.125 1.125 0 01-.981 1.373H5.982a1.125 1.125 0 01-.98-1.373l2.203-8.567a1.125 1.125 0 011.09-.96L12.75 12M12 12.75h.008v.008H12v-.008z" />
                        </svg>
                    </div>
                </div>
                <div class="flex-1">
                    <h3 class="text-lg font-semibold text-gray-900 mb-2">{{ __('user.welcome_message') }}</h3>
                    <p class="text-gray-600 text-sm mb-4">{{ __('user.getting_started_message') }}</p>
                    <div class="flex flex-wrap gap-3">
                        <a href="{{ '#' }}"
                           class="inline-flex items-center gap-x-1.5 rounded-lg bg-rose-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-rose-500 transition-colors duration-200">
                            <svg class="-mr-0.5 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
                            </svg>
                            {{ __('user.add_expense') }}
                        </a>
                        <a href="{{ '#' }}"
                           class="inline-flex items-center gap-x-1.5 rounded-lg bg-white px-3 py-2 text-sm font-semibold text-gray-900 shadow-sm border border-gray-300 hover:bg-gray-50 transition-colors duration-200">
                            {{ __('user.create_categories') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

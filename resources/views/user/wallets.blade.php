@extends('layouts.user-panel')

@php
    $title = __('user.wallet-management') . ' | ' . __('general.darino');

$account = request()->route('account');
@endphp

@section('title', $title)

@section('content')

    <div class="p-4 sm:mr-64 mt-16">
        <!-- Wallets Grid -->
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

            @foreach($wallets as $wallet)
                @php
                    $colorMap = [
                        'red' => '#ef4444',
                        'orange' => '#f97316',
                        'amber' => '#f59e0b',
                        'yellow' => '#eab308',
                        'lime' => '#84cc16',
                        'green' => '#22c55e',
                        'emerald' => '#10b981',
                        'teal' => '#14b8a6',
                        'cyan' => '#06b6d4',
                        'sky' => '#0ea5e9',
                        'blue' => '#3b82f6',
                        'indigo' => '#6366f1',
                        'violet' => '#8b5cf6',
                        'purple' => '#a855f7',
                        'fuchsia' => '#d946ef',
                        'pink' => '#ec4899',
                        'rose' => '#f43f5e',
                        'slate' => '#64748b',
                        'gray' => '#6b7280',
                        'zinc' => '#71717a',
                        'neutral' => '#737373',
                        'stone' => '#78716c'
                    ];

                    $colors = array_keys($colorMap);
                    $currentIndex = array_search($wallet->color, $colors);
                    $prevColor = $colors[($currentIndex - 1 + count($colors)) % count($colors)];
                    $nextColor = $colors[($currentIndex + 1) % count($colors)];
                    $prevHex = $colorMap[$prevColor];
                    $nextHex = $colorMap[$nextColor];
                @endphp
                    <!-- Wallet Card -->
                <div class="rounded-lg p-6 text-white relative overflow-hidden"
                     style="background: linear-gradient(135deg, {{ $prevHex }} 0%, {{ $nextHex }} 100%);">
                    <div class="absolute top-0 right-0 w-20 h-20 bg-white/10 rounded-full -mr-10 -mt-10"></div>
                    <div class="relative">
                        <div class="flex items-center justify-between mb-4">
                            <x-dynamic-component :component="'my-' . $wallet->icon" class="w-16 h-16 text-white/70" />
                            <div class="flex space-x-2">
                                <!-- View Button -->
                                <button class="p-1.5 bg-white/20 rounded-md hover:bg-white/30 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M2.458 12C3.732 7.943 7.523 5 12 5c4.478 0 8.268 2.943 9.542 7-1.274 4.057-5.064 7-9.542 7-4.477 0-8.268-2.943-9.542-7z"></path>
                                    </svg>
                                </button>
                                <!-- Edit Button -->
                                <button class="p-1.5 bg-white/20 rounded-md hover:bg-white/30 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                </button>
                                <!-- Delete Button -->
                                <button class="p-1.5 bg-white/20 rounded-md hover:bg-white/30 transition-colors">
                                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                              d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                    </svg>
                                </button>
                            </div>
                        </div>
                        <h3 class="text-lg font-semibold mb-2">{{ $wallet->name }}</h3>
                        <div class="text-2xl font-bold">
                            {{ number_format($wallet->balance) }} <span
                                class="text-sm opacity-80">{{ $wallet->currency == 'IRR' ? 'ریال' : 'تومان' }}</span>
                        </div>
                        @if($wallet->exclude)
                            <span
                                class="absolute px-2 -top-3 left-0 items-center rounded-full text-xs font-medium bg-white/20 text-white">
                                محاسبه نشده
                            </span>
                        @endif
                    </div>
                </div>
            @endforeach

            <div
                class="border-2 border-dashed border-gray-300 rounded-lg p-6 flex flex-col items-center justify-center text-gray-500 hover:border-gray-400 hover:text-gray-600 transition-colors cursor-pointer">
                <div class="w-12 h-12 bg-gray-100 rounded-full flex items-center justify-center mb-4">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </div>
                <h3 class="text-lg font-medium mb-2">@lang('user.add-new-wallet')</h3>
                <p class="text-sm text-center">@lang('user.new-wallet-desc')</p>
            </div>
        </div>
    </div>

@endsection

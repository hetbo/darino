<aside id="logo-sidebar" class="fixed top-0 right-0 z-40 w-64 h-screen pt-20 transition-transform translate-x-full bg-white border-l border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700" aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">

        <div class="flex flex-col w-full items-center">
            @if($accounts->isNotEmpty())
                @php
                    $accountId = request()->route('account');
                    $displayAccount = $accountId;
                @endphp

                <div class="relative mt-2 mb-8 w-full">

                    <button
                        id="account-selector-button"
                        type="button"
                        class="group w-full rounded p-2 bg-white flex items-center gap-x-4 hover:bg-rose-50 transition-all cursor-pointer ring-1 ring-gray-100 hover:ring-0 focus:outline-none focus:ring-1 focus:ring-rose-500"
                        onclick="toggleAccountDropdown()"
                    >
                        <div class="flex-1 text-right">
                                    <span class="text-sm line-clamp-1 font-semibold text-gray-600">
                        {{ $displayAccount->name }}
                    </span>
                            <div class="text-gray-400 text-xs">
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
                                class="group w-full rounded p-2 bg-white flex items-center gap-x-4 hover:bg-rose-50 transition-all cursor-pointer"
                            >
                                <div class="text-right">
                                    <span class="font-semibold line-clamp-1 text-xs text-gray-600">
                                {{$acc->name}}
                            </span>
                                    <div class="text-gray-400 text-xs">
                                        {{number_format($acc->balance)}}
                                        {{$acc->currency === 'IRR' ? 'ریال' : 'تومان'}}
                                    </div>
                                </div>
                            </a>
                        @endforeach

                            <button onclick="window.location='{{ route('create-new-account') }}'" type="button" class="text-white bg-gradient-to-r from-purple-500 to-pink-500 hover:bg-gradient-to-l focus:ring-4
                            focus:outline-none focus:ring-purple-200 dark:focus:ring-purple-800 font-medium rounded-lg
                            px-4 py-2 text-center mt-2 w-full text-xs cursor-pointer">@lang('user.create-new-account')</button>

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


        <ul class="space-y-2 font-medium">
            <li>
                <a href="{{ route('dashboard') }}"
                   class="flex items-center p-2 rounded-lg group
                   {{ request()->routeIs('dashboard*')
                    ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white'
                    : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <x-my-chart-pie class="w-5 h-5" />
                    <span class="ms-3">@lang('user.dashboard')</span>
                </a>
            </li>

            {{-- @todo add saidbar links one by one --}}

            <li>
                <a href="{{route('panel.wallets', $accountId)}}"
                   class="flex items-center p-2 rounded-lg group
                   {{ request()->routeIs('*wallets*')
                    ? 'bg-gray-200 text-gray-900 dark:bg-gray-700 dark:text-white'
                    : 'text-gray-900 hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700' }}">
                    <x-my-wallet class="w-5 h-5" />
                    <span class="flex-1 ms-3 whitespace-nowrap">@lang('user.wallet-management')</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <x-my-tag class="w-5 h-5 rotate-180" />
                    <span class="flex-1 ms-3 whitespace-nowrap">@lang('user.categories')</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <x-my-chart class="w-5 h-5" />
                    <span class="flex-1 ms-3 whitespace-nowrap">@lang('user.reports')</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <x-my-case-money class="w-5 h-5" />
                    <span class="flex-1 ms-3 whitespace-nowrap">@lang('user.loans')</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <x-my-bill class="w-5 h-5 rotate-90" />
                    <span class="flex-1 ms-3 whitespace-nowrap">@lang('user.cheque-management')</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <x-my-money-hand class="w-5 h-5" />
                    <span class="flex-1 ms-3 whitespace-nowrap">@lang('user.debts')</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <x-my-settings class="w-5 h-5" />
                    <span class="flex-1 ms-3 whitespace-nowrap">@lang('user.settings')</span>
                </a>
            </li>
            <li>
                <a href="#" class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
                    <x-my-logout class="w-5 h-5 rotate-180" />
                    <span class="flex-1 ms-3 whitespace-nowrap">@lang('user.logout')</span>
                </a>
            </li>
        </ul>
    </div>
</aside>
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
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const toggleButton = document.querySelector('[data-drawer-toggle="logo-sidebar"]');
        const sidebar = document.getElementById('logo-sidebar');

        if (toggleButton && sidebar) {
            toggleButton.addEventListener('click', function(e) {
                e.preventDefault();
                e.stopPropagation();

                if (sidebar.classList.contains('translate-x-full')) {
                    sidebar.classList.remove('translate-x-full');
                    sidebar.classList.add('translate-x-0');
                } else {
                    sidebar.classList.add('translate-x-full');
                    sidebar.classList.remove('translate-x-0');
                }
            });

            document.addEventListener('click', function(e) {
                if (!sidebar.contains(e.target) && !toggleButton.contains(e.target)) {
                    if (!sidebar.classList.contains('translate-x-full')) {
                        sidebar.classList.add('translate-x-full');
                        sidebar.classList.remove('translate-x-0');
                    }
                }
            });
        }
    });
</script>





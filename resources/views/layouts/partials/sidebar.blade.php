<!-- Sidebar for desktop -->
<div class="hidden lg:fixed lg:inset-y-0 lg:right-0 lg:z-50 lg:block lg:w-72 lg:overflow-y-auto lg:bg-white lg:border-l lg:border-gray-200">
    <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4">
        <!-- Logo -->
        <div class="flex h-16 shrink-0 items-center">
            <div class="flex items-center">
                <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-rose-500 to-rose-600 shadow-lg">
                    <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
                <span class="mr-3 text-xl font-bold text-gray-900">{{ __('user.expense_tracker') }}</span>
            </div>
        </div>

        <!-- Navigation -->
        <nav class="flex flex-1 flex-col">
            <ul role="list" class="flex flex-1 flex-col gap-y-7">
                <li>
                    <ul role="list" class="-mx-2 space-y-1">
                        <!-- Dashboard -->
                        <li>
                            <a href="{{ route('dashboard') }}"
                               class="group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-rose-50 text-rose-700 shadow-sm border-r-2 border-rose-500' : 'text-gray-700 hover:text-rose-700 hover:bg-rose-50' }}">
                                <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('dashboard') ? 'text-rose-500' : 'text-gray-400 group-hover:text-rose-500' }}"
                                     fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                </svg>
                                {{ __('user.dashboard') }}
                            </a>
                        </li>

                        <!-- Expenses -->
                        <li>
                            <a href="{{ '#' }}"
                               class="group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all duration-200 {{ request()->routeIs('expenses.*') ? 'bg-rose-50 text-rose-700 shadow-sm border-r-2 border-rose-500' : 'text-gray-700 hover:text-rose-700 hover:bg-rose-50' }}">
                                <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('expenses.*') ? 'text-rose-500' : 'text-gray-400 group-hover:text-rose-500' }}"
                                     fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119.993z" />
                                </svg>
                                {{ __('user.expenses') }}
                            </a>
                        </li>

                        <!-- Categories -->
                        <li>
                            <a href="{{ '#' }}"
                               class="group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all duration-200 {{ request()->routeIs('categories.*') ? 'bg-rose-50 text-rose-700 shadow-sm border-r-2 border-rose-500' : 'text-gray-700 hover:text-rose-700 hover:bg-rose-50' }}">
                                <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('categories.*') ? 'text-rose-500' : 'text-gray-400 group-hover:text-rose-500' }}"
                                     fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                </svg>
                                {{ __('user.categories') }}
                            </a>
                        </li>

                        <!-- Reports -->
                        <li>
                            <a href="{{ '#' }}"
                               class="group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all duration-200 {{ request()->routeIs('reports.*') ? 'bg-rose-50 text-rose-700 shadow-sm border-r-2 border-rose-500' : 'text-gray-700 hover:text-rose-700 hover:bg-rose-50' }}">
                                <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('reports.*') ? 'text-rose-500' : 'text-gray-400 group-hover:text-rose-500' }}"
                                     fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                </svg>
                                {{ __('user.reports') }}
                            </a>
                        </li>
                    </ul>
                </li>

                <!-- Bottom Section -->
                <li class="mt-auto">
                    <ul role="list" class="-mx-2 space-y-1">
                        <!-- Settings -->
                        <li>
                            <a href="{{ '#' }}"
                               class="group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all duration-200 {{ request()->routeIs('settings.*') ? 'bg-rose-50 text-rose-700 shadow-sm border-r-2 border-rose-500' : 'text-gray-700 hover:text-rose-700 hover:bg-rose-50' }}">
                                <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('settings.*') ? 'text-rose-500' : 'text-gray-400 group-hover:text-rose-500' }}"
                                     fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                </svg>
                                {{ __('user.settings') }}
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>

<!-- Mobile sidebar -->
<div class="lg:hidden">
    <!-- Mobile sidebar overlay -->
    <div id="mobile-sidebar-overlay" class="relative z-50 hidden">
        <div class="fixed inset-0 bg-gray-900/80" onclick="closeMobileSidebar()"></div>

        <div class="fixed inset-0 flex">
            <div id="mobile-sidebar" class="relative ml-16 flex w-full max-w-xs flex-1 transform translate-x-full transition-transform duration-300 ease-in-out">
                <div class="absolute right-full top-0 flex w-16 justify-center pt-5">
                    <button type="button" class="-m-2.5 p-2.5" onclick="closeMobileSidebar()">
                        <span class="sr-only">{{ __('user.close_sidebar') }}</span>
                        <svg class="h-6 w-6 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <!-- Mobile sidebar content -->
                <div class="flex grow flex-col gap-y-5 overflow-y-auto bg-white px-6 pb-4">
                    <!-- Logo -->
                    <div class="flex h-16 shrink-0 items-center">
                        <div class="flex items-center">
                            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-rose-500 to-rose-600 shadow-lg">
                                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                            </div>
                            <span class="mr-3 text-xl font-bold text-gray-900">{{ __('user.expense_tracker') }}</span>
                        </div>
                    </div>

                    <!-- Mobile Navigation -->
                    <nav class="flex flex-1 flex-col">
                        <ul role="list" class="flex flex-1 flex-col gap-y-7">
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <li>
                                        <a href="{{ route('dashboard') }}"
                                           class="group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all duration-200 {{ request()->routeIs('dashboard') ? 'bg-rose-50 text-rose-700 shadow-sm border-r-2 border-rose-500' : 'text-gray-700 hover:text-rose-700 hover:bg-rose-50' }}"
                                           onclick="closeMobileSidebar()">
                                            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('dashboard') ? 'text-rose-500' : 'text-gray-400 group-hover:text-rose-500' }}"
                                                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 12l8.954-8.955c.44-.439 1.152-.439 1.591 0L21.75 12M4.5 9.75v10.125c0 .621.504 1.125 1.125 1.125H9.75v-4.875c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125V21h4.125c.621 0 1.125-.504 1.125-1.125V9.75M8.25 21h8.25" />
                                            </svg>
                                            {{ __('user.dashboard') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ '#' }}"
                                           class="group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all duration-200 {{ request()->routeIs('expenses.*') ? 'bg-rose-50 text-rose-700 shadow-sm border-r-2 border-rose-500' : 'text-gray-700 hover:text-rose-700 hover:bg-rose-50' }}"
                                           onclick="closeMobileSidebar()">
                                            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('expenses.*') ? 'text-rose-500' : 'text-gray-400 group-hover:text-rose-500' }}"
                                                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15.75 10.5V6a3.75 3.75 0 10-7.5 0v4.5m11.356-1.993l1.263 12c.07.665-.45 1.243-1.119 1.243H4.25a1.125 1.125 0 01-1.12-1.243l1.264-12A1.125 1.125 0 015.513 7.5h12.974c.576 0 1.059.435 1.119.993z" />
                                            </svg>
                                            {{ __('user.expenses') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ '#' }}"
                                           class="group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all duration-200 {{ request()->routeIs('categories.*') ? 'bg-rose-50 text-rose-700 shadow-sm border-r-2 border-rose-500' : 'text-gray-700 hover:text-rose-700 hover:bg-rose-50' }}"
                                           onclick="closeMobileSidebar()">
                                            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('categories.*') ? 'text-rose-500' : 'text-gray-400 group-hover:text-rose-500' }}"
                                                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.568 3H5.25A2.25 2.25 0 003 5.25v4.318c0 .597.237 1.17.659 1.591l9.581 9.581c.699.699 1.78.872 2.607.33a18.095 18.095 0 005.223-5.223c.542-.827.369-1.908-.33-2.607L11.16 3.66A2.25 2.25 0 009.568 3z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M6 6h.008v.008H6V6z" />
                                            </svg>
                                            {{ __('user.categories') }}
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ '#' }}"
                                           class="group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all duration-200 {{ request()->routeIs('reports.*') ? 'bg-rose-50 text-rose-700 shadow-sm border-r-2 border-rose-500' : 'text-gray-700 hover:text-rose-700 hover:bg-rose-50' }}"
                                           onclick="closeMobileSidebar()">
                                            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('reports.*') ? 'text-rose-500' : 'text-gray-400 group-hover:text-rose-500' }}"
                                                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />
                                            </svg>
                                            {{ __('user.reports') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li>
                                <ul role="list" class="-mx-2 space-y-1">
                                    <!-- Settings in mobile -->
                                    <li>
                                        <a href="{{ '#' }}"
                                           class="group flex gap-x-3 rounded-lg p-3 text-sm font-semibold leading-6 transition-all duration-200 {{ request()->routeIs('settings.*') ? 'bg-rose-50 text-rose-700 shadow-sm border-r-2 border-rose-500' : 'text-gray-700 hover:text-rose-700 hover:bg-rose-50' }}"
                                           onclick="closeMobileSidebar()">
                                            <svg class="h-5 w-5 shrink-0 {{ request()->routeIs('settings.*') ? 'text-rose-500' : 'text-gray-400 group-hover:text-rose-500' }}"
                                                 fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M9.594 3.94c.09-.542.56-.94 1.11-.94h2.593c.55 0 1.02.398 1.11.94l.213 1.281c.063.374.313.686.645.87.074.04.147.083.22.127.324.196.72.257 1.075.124l1.217-.456a1.125 1.125 0 011.37.49l1.296 2.247a1.125 1.125 0 01-.26 1.431l-1.003.827c-.293.24-.438.613-.431.992a6.759 6.759 0 010 .255c-.007.378.138.75.43.99l1.005.828c.424.35.534.954.26 1.43l-1.298 2.247a1.125 1.125 0 01-1.369.491l-1.217-.456c-.355-.133-.75-.072-1.076.124a6.57 6.57 0 01-.22.128c-.331.183-.581.495-.644.869l-.213 1.28c-.09.543-.56.941-1.11.941h-2.594c-.55 0-1.02-.398-1.11-.94l-.213-1.281c-.062-.374-.312-.686-.644-.87a6.52 6.52 0 01-.22-.127c-.325-.196-.72-.257-1.076-.124l-1.217.456a1.125 1.125 0 01-1.369-.49l-1.297-2.247a1.125 1.125 0 01.26-1.431l1.004-.827c.292-.24.437-.613.43-.992a6.932 6.932 0 010-.255c.007-.378-.138-.75-.43-.99l-1.004-.828a1.125 1.125 0 01-.26-1.43l1.297-2.247a1.125 1.125 0 011.37-.491l1.216.456c.356.133.751.072 1.076-.124.072-.044.146-.087.22-.128.332-.183.582-.495.644-.869l.214-1.281z" />
                                                <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                                            </svg>
                                            {{ __('user.settings') }}
                                        </a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu button -->
    <div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:hidden">
        <button type="button" class="-m-2.5 p-2.5 text-gray-700 lg:hidden" onclick="openMobileSidebar()">
            <span class="sr-only">{{ __('user.open_sidebar') }}</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
        </button>

        <!-- Mobile Logo -->
        <div class="flex items-center">
            <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-gradient-to-br from-rose-500 to-rose-600 shadow-lg">
                <svg class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 6v12m-3-2.818l.879.659c1.171.879 3.07.879 4.242 0 1.172-.879 1.172-2.303 0-3.182C13.536 12.219 12.768 12 12 12c-.725 0-1.45-.22-2.003-.659-1.106-.879-1.106-2.303 0-3.182s2.9-.879 4.006 0l.415.33M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </div>
            <span class="mr-3 text-lg font-bold text-gray-900">{{ __('user.expense_tracker') }}</span>
        </div>
    </div>
</div>

<script>
    function openMobileSidebar() {
        const overlay = document.getElementById('mobile-sidebar-overlay');
        const sidebar = document.getElementById('mobile-sidebar');

        overlay.classList.remove('hidden');
        setTimeout(() => {
            sidebar.classList.remove('translate-x-full');
        }, 10);
    }

    function closeMobileSidebar() {
        const overlay = document.getElementById('mobile-sidebar-overlay');
        const sidebar = document.getElementById('mobile-sidebar');

        sidebar.classList.add('translate-x-full');
        setTimeout(() => {
            overlay.classList.add('hidden');
        }, 300);
    }
</script>

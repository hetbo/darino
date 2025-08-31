<!-- Top Navigation -->
<div class="sticky top-0 z-40 flex h-16 shrink-0 items-center gap-x-4 border-b border-gray-200 bg-white px-4 shadow-sm sm:gap-x-6 sm:px-6 lg:px-8">
    <!-- Search -->
    <div class="flex flex-1 gap-x-4 self-stretch lg:gap-x-6">
        <form class="relative flex flex-1" action="{{ '#' }}" method="GET">
            <label for="search-field" class="sr-only">{{ __('user.search') }}</label>
            <svg class="pointer-events-none absolute inset-y-0 right-0 h-full w-5 text-gray-400 pr-3" viewBox="0 0 20 20" fill="currentColor">
                <path fill-rule="evenodd" d="M9 3.5a5.5 5.5 0 100 11 5.5 5.5 0 000-11zM2 9a7 7 0 1112.452 4.391l3.328 3.329a.75.75 0 11-1.06 1.06l-3.329-3.328A7 7 0 012 9z" clip-rule="evenodd" />
            </svg>
            <input id="search-field"
                   class="block h-full w-full border-0 py-0 pr-8 pl-0 text-gray-900 placeholder:text-gray-400 focus:ring-0 sm:text-sm bg-transparent"
                   placeholder="{{ __('user.search_expenses') }}"
                   type="search"
                   name="q"
                   value="{{ request('q') }}">
        </form>
    </div>

    <!-- Right side -->
    <div class="flex items-center gap-x-4 lg:gap-x-6">
        <!-- Quick Add Button -->
        <a href="{{ '#' }}"
           class="inline-flex items-center gap-x-1.5 rounded-lg bg-rose-600 px-3 py-2 text-sm font-semibold text-white shadow-sm hover:bg-rose-500 focus-visible:outline focus-visible:outline-2 focus-visible:outline-offset-2 focus-visible:outline-rose-600 transition-colors duration-200">
            <svg class="-mr-0.5 h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                <path d="M10.75 4.75a.75.75 0 00-1.5 0v4.5h-4.5a.75.75 0 000 1.5h4.5v4.5a.75.75 0 001.5 0v-4.5h4.5a.75.75 0 000-1.5h-4.5v-4.5z" />
            </svg>
            {{ __('user.add_expense') }}
        </a>

        <!-- Notifications -->
        <button type="button" class="-m-2.5 p-2.5 text-gray-400 hover:text-gray-500 transition-colors duration-200">
            <span class="sr-only">{{ __('user.view_notifications') }}</span>
            <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" d="M14.857 17.082a23.848 23.848 0 005.454-1.31A8.967 8.967 0 0118 9.75v-.7V9A6 6 0 006 9v.75a8.967 8.967 0 01-2.312 6.022c1.733.64 3.56 1.085 5.455 1.31m5.714 0a24.255 24.255 0 01-5.714 0m5.714 0a3 3 0 11-5.714 0" />
            </svg>
        </button>

        <!-- Profile dropdown -->
        <div class="relative">
            <button type="button"
                    id="profile-menu-button"
                    class="flex items-center gap-x-1 text-sm font-semibold leading-6 text-gray-900 hover:text-rose-700 transition-colors duration-200"
                    onclick="toggleProfileMenu()">
                <div class="h-8 w-8 rounded-full bg-gradient-to-br from-rose-400 to-rose-600 flex items-center justify-center shadow-lg">
                    <span class="text-sm font-medium text-white">
                        {{ strtoupper(substr(Auth::user()->name, 0, 1)) }}
                    </span>
                </div>
                <span class="hidden lg:flex lg:items-center">
                    <span class="mr-1 text-sm font-semibold leading-6 text-gray-900">{{ Auth::user()->name }}</span>
                    <svg class="h-5 w-5 text-gray-400" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5.23 7.21a.75.75 0 011.06.02L10 11.168l3.71-3.938a.75.75 0 111.08 1.04l-4.25 4.5a.75.75 0 01-1.08 0l-4.25-4.5a.75.75 0 01.02-1.06z" clip-rule="evenodd" />
                    </svg>
                </span>
            </button>

            <!-- Dropdown menu -->
            <div id="profile-menu"
                 class="absolute left-0 z-10 mt-2.5 w-48 origin-top-left rounded-lg bg-white py-2 shadow-lg ring-1 ring-gray-900/5 focus:outline-none hidden transform opacity-0 scale-95 transition-all duration-100">

                <a href="{{ '#' }}"
                   class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50 transition-colors duration-150">
                    {{ __('user.profile') }}
                </a>

                <a href="{{ '#' }}"
                   class="block px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50 transition-colors duration-150">
                    {{ __('user.settings') }}
                </a>

                <div class="border-t border-gray-100 my-1"></div>

                <form method="POST" action="{{ route('logout') }}">
                    @csrf
                    <button type="submit"
                            class="block w-full text-right px-3 py-1 text-sm leading-6 text-gray-900 hover:bg-gray-50 transition-colors duration-150">
                        {{ __('user.logout') }}
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function toggleProfileMenu() {
        const menu = document.getElementById('profile-menu');
        const isHidden = menu.classList.contains('hidden');

        if (isHidden) {
            menu.classList.remove('hidden');
            setTimeout(() => {
                menu.classList.remove('opacity-0', 'scale-95');
                menu.classList.add('opacity-100', 'scale-100');
            }, 10);
        } else {
            menu.classList.remove('opacity-100', 'scale-100');
            menu.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 100);
        }
    }

    // Close dropdown when clicking outside
    document.addEventListener('click', function(event) {
        const menu = document.getElementById('profile-menu');
        const button = document.getElementById('profile-menu-button');

        if (!button.contains(event.target) && !menu.contains(event.target)) {
            menu.classList.remove('opacity-100', 'scale-100');
            menu.classList.add('opacity-0', 'scale-95');
            setTimeout(() => {
                menu.classList.add('hidden');
            }, 100);
        }
    });
</script>

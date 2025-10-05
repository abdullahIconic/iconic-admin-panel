<div class="hitoisi-navbar sticky-top top-0 flex justify-between items-center p-3 bg-white shadow">
    <div class="navbar-left">
        @if(Route::currentRouteName() != 'dashboard' && $page != 'index')
            <a class="back flex items-center gap-2 text-gray-700 hover:text-gray-900" href="{{ route($parentRoute && $page ? $parentRoute . '.index' : 'dashboard') }}">
                <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
                    <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"></path>
                </svg>
                Back to {{ $parent ?? 'Dashboard' }}
            </a>
        @endif

        <h2 class="title text-xl font-semibold">{{ $title ?? 'Dashboard' }}</h2>
        <small class="page text-gray-500">{{ $parent ?? 'Admin Panel' }}</small>
    </div>

    <div class="navbar-right flex items-center gap-3">
        <span>{{ auth()->user()->name }}</span>
        <div class="user">
            <img src="{{ asset('media/images/product-1.jpg') }}" alt="" class="w-10 h-10 rounded-full border border-gray-300">
        </div>

        <!-- Logout Button with Icon -->
        <form action="{{ route('logout') }}" method="POST" class="flex items-center gap-1">
            @csrf
            <button type="submit" class="flex items-center px-3 py-1 bg-red-500 text-black rounded hover:bg-red-600">
                <!-- Logout Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-box-arrow-right mr-1" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M10 15a1 1 0 0 0 1-1v-3h-1v3H3V2h7v3h1V2a1 1 0 0 0-1-1H3a1 1 0 0 0-1 1v12a1 1 0 0 0 1 1h7z"/>
                    <path fill-rule="evenodd" d="M15.854 8.354a.5.5 0 0 0 0-.708l-3-3a.5.5 0 1 0-.708.708L14.293 7.5H5.5a.5.5 0 0 0 0 1h8.793l-2.147 2.146a.5.5 0 0 0 .708.708l3-3z"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>

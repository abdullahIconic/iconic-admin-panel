<div class="hitoisi-navbar sticky-top top-0">
    <div class="navbar-left">

        @if(Route::currentRouteName() != 'dashboard' && $page != 'index')
        <a class="back" href="{{route($parentRoute && $page ? '' . $parentRoute . '.index' : 'dashboard')}}">
            <svg xmlns="http://www.w3.org/2000/svg" width="25" height="25" fill="currentColor" class="bi bi-caret-left" viewBox="0 0 16 16">
                <path d="M10 12.796V3.204L4.519 8 10 12.796zm-.659.753-5.48-4.796a1 1 0 0 1 0-1.506l5.48-4.796A1 1 0 0 1 11 3.204v9.592a1 1 0 0 1-1.659.753z"></path>
            </svg>
            Back to {{$parent ?? 'Dashboard' }}
        </a>
        @endif

        <h2 class="title">{{ $title ?? 'Dashboard' }}</h2>
        <small class="page">{{ $parent ?? 'Admin Panel' }}</small>
    </div>
    <div class="navbar-right">
        <span>{{auth()->user()->name}}</span>
        <div class="user">
            <img src="{{asset('media/images/product-1.jpg')}}" alt="">
        </div>
    </div>
</div>
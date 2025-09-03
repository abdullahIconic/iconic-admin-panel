@extends('layouts.guest')

@section('content')
<div class="{{ env('BS_CONTAINER') }}">
    <div class="auth">

        <a class="logo" href="{{ url('/login') }}">
            <img src="{{ logo() }}" alt="{{ config('app.name', 'Laravel') }}">
        </a>

        <div class="box">

            <h1 class="header">{{ __('Register') }}</h1>

            <form class="body" method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name">{{ __('Name') }}</label>

                    <div class="">
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" placeholder="ex: Jams Smith" autofocus>

                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="email">{{ __('E-Mail Address') }}</label>

                    <div class="">
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" placeholder="ex: email@gmail.com">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="password">{{ __('Password') }}</label>

                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password" placeholder="ex: @#@abc123@#@">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

                <div class="form-group">
                    <label for="password-confirm">{{ __('Confirm Password') }}</label>
                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password" placeholder="enter same password">
                </div>

                <div class="form-group d-flex align-items-center gap-3">
                    <button type="submit" class="btn bg-dark2 text-white rounded-pill px-5">
                        {{ __('Register') }}
                    </button>
                    
                    @if (Route::has('login'))
                    <a class="text-muted" href="{{ route('login') }}">Login</a>
                    @endif
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

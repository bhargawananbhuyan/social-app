@extends('layouts.app')

@section('title')
    Login - Socialite
@endsection

@section('main')
    <div class="max-w-sm mx-auto space-y-5">
        <h1 class="text-xl font-bold text-center">Login</h1>

        <form action="{{ route('login') }}" method="post" class="base-form">
            @csrf
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                @error('email')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="password">Password</label>
                <input type="password" name="password" id="password">
                @error('password')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <button type="submit">Login</button>
        </form>

        <p class="text-center [&>a]:text-blue-500 [&>a]:underline">
            Not yet registered? <a href="{{ route('register') }}">Create new account</a>
        </p>
    </div>
@endsection

@extends('layouts.app')

@section('title')
    Home - Socialite
@endsection

@section('main')
    <div class="max-w-sm mx-auto flex flex-col items-center space-y-5">
        <h1 class="text-center text-xl font-bold">
            Hello, {{ Auth::user()->name ?? 'world' }}!
        </h1>

        @auth
            <form action="{{ route('users') }}" method="get" class="text-sm flex w-full gap-x-1.5">
                @csrf
                <input type="text" name="name" id="name"
                    class="flex-grow border rounded py-2 px-2.5 outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-400"
                    placeholder="Search for a user to chat with...">
                <button type="submit" class="bg-blue-500 text-white px-2.5 py-2 rounded font-medium">
                    Search
                </button>
            </form>
        @endauth

        @guest
            <a href="{{ route('login') }}" class="bg-blue-500 text-sm text-white px-2.5 py-2 rounded font-medium">
                Get started
            </a>
        @endguest
    </div>
@endsection

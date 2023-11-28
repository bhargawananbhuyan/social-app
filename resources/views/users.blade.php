@extends('layouts.app')

@section('title')
    Users - Socialite
@endsection

@section('main')
    <div class="space-y-5">
        <h1 class="text-xl font-bold">
            @isset($search_text)
                Search results for {{ $search_text }}
            @else
                All users
            @endisset
        </h1>

        <div class="space-y-2">
            @if (isset($users) && count($users) > 0)
                @foreach ($users as $user)
                    <a href="{{ route('chat', ['id' => $user->id]) }}"
                        class="max-w-sm border p-2.5 rounded-lg flex items-center gap-x-3 cursor-pointer hover:bg-blue-100">
                        <div class="bg-blue-500 text-white w-8 h-8 grid place-items-center text-sm rounded-full">
                            {{ $user->name[0] }}
                        </div>
                        <div class="grid [&>small]:text-gray-400">
                            <strong>{{ $user->name }}</strong>
                            <small>{{ $user->email }}</small>
                        </div>
                    </a>
                @endforeach
            @else
                <p>No users found.</p>
            @endif
        </div>
    </div>
@endsection

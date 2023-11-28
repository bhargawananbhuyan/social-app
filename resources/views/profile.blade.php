@extends('layouts.app')

@section('title')
    Profile - Socialite
@endsection

@section('main')
    <div class="max-w-sm mx-auto space-y-5">
        <h1 class="text-xl font-bold text-center">Profile</h1>

        <form action="{{ route('profile') }}" method="post" class="base-form">
            @csrf
            @method('put')
            <div>
                <label for="name">Name</label>
                <input type="text" name="name" id="name" value="{{ old('name') ?? Auth::user()->name }}">
                @error('name')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <div>
                <label for="email">Email</label>
                <input type="email" name="email" id="email" value="{{ old('email') ?? Auth::user()->email }}">
                @error('email')
                    <small>{{ $message }}</small>
                @enderror
            </div>
            <button type="submit">Update</button>
        </form>
    </div>
@endsection

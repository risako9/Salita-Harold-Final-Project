@extends('layouts.admin', ['title' => 'Log in'])

@push('styles')
    <link rel="stylesheet" href="/css/admin.css">
@endpush

@section('content')
    <section class="login-card">
        <p class="eyebrow">Private area</p>
        <h1>Admin login</h1>
        <p>Log in to update the pictures shown in “The Good Stuff.”</p>

        <form method="POST" action="{{ route('admin.login.store') }}" class="admin-form">
            @csrf

            <label>
                <span>Email</span>
                <input type="email" name="email" value="{{ old('email') }}" required autofocus autocomplete="username">
            </label>

            <label>
                <span>Password</span>
                <input type="password" name="password" required autocomplete="current-password">
            </label>

            @error('email')
                <p class="form-error" role="alert">{{ $message }}</p>
            @enderror

            <button class="button" type="submit">Log in</button>
        </form>
    </section>
@endsection

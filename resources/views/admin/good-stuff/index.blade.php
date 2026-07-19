@extends('layouts.admin', ['title' => 'Good Stuff Pictures'])

@push('styles')
    <link rel="stylesheet" href="/css/admin.css">
@endpush

@section('content')
    <div class="admin-heading">
        <div>
            <p class="eyebrow">Homepage editor</p>
            <h1>The Good Stuff</h1>
            <p>Replace the three homepage pictures. JPG, PNG, and WebP files up to 5 MB are accepted.</p>
        </div>
        <a class="button button--light" href="{{ route('home') }}#menu" target="_blank">View homepage</a>
    </div>

    @if (session('status'))
        <p class="status-message" role="status">{{ session('status') }}</p>
    @endif

    @if ($errors->any())
        <div class="error-box" role="alert">
            <strong>The picture could not be uploaded.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="feature-admin-grid">
        @foreach ($features as $feature)
            <article class="feature-admin-card">
                <img src="{{ $feature->image_url }}" alt="Current {{ $feature->title }} picture">
                <div class="feature-admin-copy">
                    <h2>{{ $feature->title }}</h2>
                    <p>{{ $feature->image_path ? 'Custom picture' : 'Original picture' }}</p>

                    <form method="POST" action="{{ route('admin.good-stuff.update', $feature) }}" enctype="multipart/form-data" class="upload-form">
                        @csrf
                        @method('PUT')
                        <label>
                            <span>Choose a new picture</span>
                            <input type="file" name="image" accept="image/jpeg,image/png,image/webp" required>
                        </label>
                        <button class="button" type="submit">Replace picture</button>
                    </form>

                    @if ($feature->image_path)
                        <form method="POST" action="{{ route('admin.good-stuff.reset', $feature) }}">
                            @csrf
                            @method('DELETE')
                            <button class="text-button" type="submit">Restore original picture</button>
                        </form>
                    @endif
                </div>
            </article>
        @endforeach
    </div>
@endsection

@extends('layouts.app')

@section('content')
    <div class="container mx-auto py-8">
        <!-- Hero Section or Welcome Message -->
        <div class="text-center mb-8">
            @if(Auth::check())
                <h1 class="text-3xl font-bold text-gray-800">Welcome, {{ Auth::user()->username }}!</h1>
            @else
                <h1 class="text-3xl font-bold text-gray-800">Welcome to ArtSpot!</h1>
            @endif
            <p class="text-lg text-gray-600">
                Welcome to ArtSpot, your personal space to explore and upload artwork.
            </p>
        </div>

        <!-- Grid of Featured Artworks or Content -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($posts as $post)
<div class="p-4 border border-gray-200 rounded-lg shadow-md">
    <img src="{{ asset('storage/' . $post->image) }}" alt="{{ $post->title }}" class="w-full h-48 object-cover rounded-md mb-4">
    <h2 class="font-semibold text-lg">{{ $post->title }}</h2>
    <p class="text-sm text-gray-500">Uploaded by: {{ $post->user->username?? 'Unknown' }}</p>
    <!-- Like button -->
    <div class="flex items-center mt-2">
    <button class="like-btn" data-post-id="{{ $post->id }}" onclick="toggleLike(this)"
        data-liked="{{ Auth::check() ? $post->isLikedByUser(Auth::id()) : $post->isLikedByGuest(request()->ip()) }}">
    <i class="{{ Auth::check() ? ($post->isLikedByUser(Auth::id()) ? 'fas' : 'far') : ($post->isLikedByGuest(request()->ip()) ? 'fas' : 'far') }} fa-heart text-gray-600"></i>
</button>



        <span id="like-count-{{ $post->id }}" class="ml-2 text-gray-600">{{ $post->likeCount() }}</span> Likes
    </div>
</div>
@endforeach





    @if ($posts->isEmpty())
        <div class="col-span-3 text-center text-gray-600">
            <p>No artwork has been published yet.</p>
        </div>
    @endif
</div>



        <!-- Optional: Upload Your Art Button -->
        @if(Auth::check())
            <div class="mt-8 text-center">
                <a href="{{ route('upload.create') }}" class="px-6 py-2 bg-blue-500 text-white rounded-full">Upload Your Art</a>
            </div>
        @endif
    </div>
@endsection

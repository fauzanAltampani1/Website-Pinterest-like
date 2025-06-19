<?php

// search.blade.php

?>
@extends('layouts.app')

@section('content')
<div class="container mx-auto mt-4">
    <h1 class="text-xl font-bold">Search Results</h1>

    <!-- Form for Search -->
    <form method="GET" action="{{ route('search.uploaded.images') }}">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="query" placeholder="Search for images by title..." required value="{{ request('query') }}">
            <div class="input-group-append">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </div>
    </form>

    <!-- Results Section -->
    <div class="results mt-4">
    @if(isset($images) && $images->isNotEmpty())
        <h2 class="text-lg mt-4">Results</h2>
        <div class="grid grid-cols-4 gap-4">
            @foreach($images as $image)
                <div class="bg-gray-100 p-2">
                    <img src="{{ asset('storage/' . $image->image) }}" alt="{{ $image->title }}" class="w-full h-48 object-cover">
                    <p class="text-sm mt-2">{{ $image->title }}</p>
                </div>
            @endforeach
        </div>
    @else
        <p class="text-gray-600 mt-4">No images found matching your search.</p>
    @endif
</div>
@endsection

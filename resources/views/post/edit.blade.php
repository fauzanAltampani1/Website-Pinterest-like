@extends('layouts.app')

@section('content')
<main class="flex-grow p-6">
    <h2 class="text-xl font-bold mb-4">Edit Image</h2>

    @if (session('success'))
        <div class="alert alert-success mb-4">{{ session('success') }}</div>
    @endif

    <div class="bg-white p-6 rounded-md shadow-md">
        <form action="{{ route('post.update', $post->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Preview Gambar Lama -->
            <div class="mb-4">
                <p class="font-medium text-gray-600 mb-2">Current Image:</p>
                <img src="{{ asset('storage/' . $post->image) }}" alt="Current Image" class="w-32 h-32 object-cover">
            </div>

            <!-- Upload Gambar Baru -->
            <div class="mb-4">
                <label for="image" class="block font-medium text-gray-600">Upload New Image:</label>
                <input type="file" name="image" id="image" class="w-full border p-2 rounded">
                @error('image')
                    <div class="text-red-500 mt-1">{{ $message }}</div>
                @enderror
            </div>

            <!-- Tombol Simpan -->
            <div>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded hover:bg-blue-600">Update Image</button>
                <a href="{{ route('post.index') }}" class="ml-4 text-gray-600 hover:underline">Cancel</a>
            </div>
        </form>
    </div>
</main>
@endsection

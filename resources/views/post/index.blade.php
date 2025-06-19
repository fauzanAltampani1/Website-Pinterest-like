@extends('layouts.app')

@section('content')
<main class="flex-grow p-6">
    <div class="flex">
        <!-- Sidebar -->
        <aside class="w-64">
            <ul class="space-y-2">
                <div class="flex gap-3">
                    <div class="bg-center bg-no-repeat aspect-square bg-cover rounded-full size-10"
                         style='background-image: url("https://cdn.usegalileo.ai/sdxl10/9b359708-1440-4781-a786-3bdf8ba6b191.png");'></div>
                    <div class="flex flex-col">
                        <h1 class="text-[#1C160C] text-base font-medium leading-normal">ArtSpot Studio</h1>
                        <p class="text-[#A18249] text-sm font-normal leading-normal">Manage your posts</p>
                    </div>
                </div>
                <li>
                    <a href="{{ route('upload.create') }}" class="flex items-center gap-3 px-3 py-2 transition-transform transform hover:scale-105 hover:bg-[#E5D1A3] rounded-full">
                        <div class="text-[#1C160C]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M80,224a8,8,0,0,1-8,8H56a16,16,0,0,1-16-16V184a8,8,0,0,1,16,0v32H72A8,8,0,0,1,80,224Z"/>
                            </svg>
                        </div>
                        <p class="text-[#1C160C] text-sm font-medium leading-normal">Drafts</p>
                    </a>
                </li>
                <li>
                    <a href="{{ route('post.index') }}" class="flex items-center gap-3 px-3 py-2 transition-transform transform hover:scale-105 hover:bg-[#E5D1A3] rounded-full">
                        <div class="text-[#1C160C]">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" fill="currentColor" viewBox="0 0 256 256">
                                <path d="M88,112a8,8,0,0,1,8-8h80a8,8,0,0,1,0,16H96A8,8,0,0,1,88,112Z"/>
                            </svg>
                        </div>
                        <p class="text-[#1C160C] text-sm font-medium leading-normal">Published</p>
                    </a>
                </li>
            </ul>
        </aside>

        <!-- Content Area -->
        <section class="flex-1 ml-4">
            <h2 class="text-xl font-bold mb-4">Your Uploaded Images</h2>

            @if(session('success'))
                <div class="alert alert-success mb-4">{{ session('success') }}</div>
            @endif

            <!-- Kondisi Jika Tidak Ada Gambar -->
            @if($posts->isEmpty())
                <p class="text-gray-600">You have not submitted any images yet. All your uploads will appear here once published.</p>
            @else
                <!-- Tabel untuk Menampilkan Gambar -->
                <table class="w-full table-auto border-collapse border border-gray-300">
                <thead>
    <tr class="bg-gray-200">
        <th class="border p-2 text-left">#</th>
        <th class="border p-2 text-left">Title</th> <!-- Kolom Title -->
        <th class="border p-2 text-left">Image</th>
        <th class="border p-2 text-left">Uploaded At</th>
        <th class="border p-2 text-left">Actions</th>
    </tr>
</thead>

<tbody>
    @foreach ($posts as $index => $post)
        <tr>
            <td class="border p-2">{{ $index + 1 }}</td>
            <td class="border p-2">{{ $post->title }}</td> <!-- Menampilkan Title -->
            <td class="border p-2">
                @if($post->status === 'published')
                    <img src="{{ asset('storage/' . $post->image) }}" alt="Uploaded Image" class="w-32 h-32 object-cover">
                @else
                    <p class="text-yellow-500">Draft - Image not submitted yet.</p>
                @endif
            </td>
            <td class="border p-2">{{ $post->created_at->format('d M Y H:i') }}</td>
            <td class="border p-2">
                <!-- Tombol Edit -->
                <a href="{{ route('post.edit', $post->id) }}" class="text-blue-500 hover:underline">Edit</a>

                <!-- Tombol Delete -->
                <form action="{{ route('post.destroy', $post->id) }}" method="POST" class="inline-block">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-500 hover:underline" onclick="return confirm('Are you sure you want to delete this image?')">Delete</button>
                </form>
            </td>
        </tr>
    @endforeach
</tbody>

                </table>
            @endif
        </section>
    </div>
</main>
@endsection

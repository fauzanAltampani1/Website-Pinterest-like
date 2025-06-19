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
                    <a href="{{ route('upload.create') }}" class="flex items-center gap-3 px-3 py-2 rounded-full bg-[#F4EFE6]">
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
            <h2 class="text-xl font-bold mb-4">Upload Your Art</h2>
            <!-- Upload Form -->
            <div class="mt-6 p-4 border-2 border-dashed rounded-md text-center">
            <form action="{{ route('upload.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <div class="mb-4">
        <label for="title" class="block text-left">Title:</label>
        <input type="text" name="title" id="title" required class="w-full px-3 py-2 border rounded">
    </div>
                         <div class="mb-4">
                         <label for="image" class="block text-left">Upload Image:</label>
                         <input type="file" name="image" id="image" required class="w-full">
                        </div>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-full">Upload</button>
                </form>

            </div>

            <!-- Tabel Drafts -->
            <h3 class="text-lg font-semibold mt-8 mb-4">Draft Images</h3>
            @if($drafts->isEmpty())
                <p class="text-gray-600">No drafts available.</p>
            @else
                <table class="w-full table-auto border-collapse border border-gray-300">
                <thead>
    <tr class="bg-gray-200">
        <th class="border p-2">#</th>
        <th class="border p-2">Title</th>
        <th class="border p-2">Image</th>
        <th class="border p-2">Action</th>
    </tr>
</thead>
<tbody>
    @foreach ($drafts as $index => $post)
        <tr>
            <td class="border p-2">{{ $index + 1 }}</td>
            <td class="border p-2">{{ $post->title }}</td>
            <td class="border p-2">
                <img src="{{ asset('storage/' . $post->image) }}" alt="Draft Image" class="w-32 h-32 object-cover">
            </td>
            <td class="border p-2">
                <!-- Tombol Submit -->
                <form action="{{ route('post.publish', $post->id) }}" method="POST" style="display: inline;">
                    @csrf
                    <button type="submit" class="bg-green-500 text-white px-2 py-1 rounded">Submit</button>
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

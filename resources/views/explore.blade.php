@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-8">
        <!-- Judul Halaman Explore -->
        <h1 class="text-3xl font-bold mb-4">Halaman Explore</h1>
        <p class="text-gray-600 mb-6">Selamat datang di halaman explore!</p>

        <!-- Grid untuk Menampilkan Gambar -->
        <div id="image-container" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @for ($i = 0; $i < 9; $i++) <!-- Menampilkan 9 gambar awal -->
                <div class="relative overflow-hidden rounded-lg shadow-md">
                    <a href="https://picsum.photos/400/300?random={{ $i }}" target="_blank" rel="noopener noreferrer">
                        <img src="https://picsum.photos/400/300?random={{ $i }}" 
                             alt="Random Image {{ $i }}" 
                             class="w-full h-full object-cover hover:opacity-90 transition-opacity duration-300">
                    </a>
                </div>
            @endfor
        </div>

        <!-- Tombol Load More -->
        <div class="text-center mt-6">
            <button id="load-more-btn" 
                    class="px-6 py-2 bg-blue-500 text-white rounded-full hover:bg-blue-600">
                Load More
            </button>
        </div>
    </div>

    <!-- Script untuk Load More -->
    <script>
        let imageCount = 9; // Hitungan gambar saat ini
        const imageContainer = document.getElementById('image-container');
        const loadMoreBtn = document.getElementById('load-more-btn');

        // Event listener untuk tombol Load More
        loadMoreBtn.addEventListener('click', () => {
            for (let i = 0; i < 6; i++) { // Tambahkan 6 gambar baru setiap klik
                const div = document.createElement('div');
                div.className = 'relative overflow-hidden rounded-lg shadow-md';

                const link = document.createElement('a');
                link.href = `https://picsum.photos/400/300?random=${imageCount}`;
                link.target = '_blank';
                link.rel = 'noopener noreferrer';

                const img = document.createElement('img');
                img.src = `https://picsum.photos/400/300?random=${imageCount++}`;
                img.alt = `Random Image ${imageCount}`;
                img.className = 'w-full h-full object-cover hover:opacity-90 transition-opacity duration-300';

                link.appendChild(img); // Gambar di dalam link
                div.appendChild(link);
                imageContainer.appendChild(div);
            }
        });
    </script>
@endsection

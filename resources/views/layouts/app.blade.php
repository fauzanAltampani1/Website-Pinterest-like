<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'ArtSpot')</title>
    <link rel="icon" href="data:image/x-icon;base64,">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700;900&family=Plus+Jakarta+Sans:wght@400;500;700;800&display=swap" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/like.css') }}">

</head>
<body class="bg-[#FFFFFF] font-sans">
    <!-- Include Header -->
    @include('header.header')

    <!-- Main Content -->
    <main>
        @yield('content')
    </main>

    <!-- Footer (Optional) -->
    <footer class="text-center py-4">
        <p>© 2024 ArtSpot. All rights reserved.</p>
    </footer>

    <script src="{{ asset('/js/like.js') }}"></script>
    
</body>
</html>

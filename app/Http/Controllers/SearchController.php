<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Model untuk tabel post

class SearchController extends Controller
{
    public function searchUploadedImages(Request $request)
    {
        $query = $request->input('query');

        // Pencarian gambar dari database
        $images = Post::where('title', 'LIKE', "%{$query}%")->get();

        return view('search', compact('images'));
    }
}

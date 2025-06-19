<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post; // Pastikan ini cocok dengan struktur folder dan namespace model Anda.

class HomeController extends Controller
{
    public function index()
{
    $posts = Post::with('user')->where('status', 'published')->get();

    return view('home', [
        'posts' => $posts
    ]);
}

   


public function toggleLike(Request $request, $postId)
{
    $post = Post::findOrFail($postId);
    $user = $request->user(); // Cek pengguna yang login
    $ip = $request->ip(); // IP address untuk guest

    if ($user) {
        // Logika untuk pengguna login
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            // Jika sudah memberikan like, hapus like
            $like->delete();
            return response()->json([
                'count' => $post->likeCount(),
                'isLiked' => false, // Tidak di-like
            ]);
        }

        // Tambahkan like jika belum ada
        $post->likes()->create([
            'user_id' => $user->id,
        ]);

        return response()->json([
            'count' => $post->likeCount(),
            'isLiked' => true, // Sudah di-like
        ]);
    }

    // Logika untuk guest berdasarkan IP address
    $like = $post->likes()->where('ip_address', $ip)->first();

    if ($like) {
        // Jika sudah memberikan like, hapus like
        $like->delete();
        return response()->json([
            'count' => $post->likeCount(),
            'isLiked' => false, // Tidak di-like
        ]);
    }

    // Tambahkan like jika belum ada
    $post->likes()->create([
        'ip_address' => $ip,
    ]);

    return response()->json([
        'count' => $post->likeCount(),
        'isLiked' => true, // Sudah di-like
    ]);
}

}
<?php

namespace App\Http\Controllers;
use App\Models\Post;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Tambahkan ini

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
{
    // Ambil data gambar berdasarkan user yang login
    $posts = Post::where('user_id', Auth::id())->get();

    // Kirim data ke view
    return view('post.index', compact('posts'));
}



    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $drafts = Post::where('user_id', Auth::id())->where('status', 'draft')->get();
        return view('upload', compact('drafts'));
    }
    
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $post = Post::findOrFail($id);
        return view('post.edit', compact('post'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'image' => ['required', 'image']
        ]);
    
        $post = Post::findOrFail($id);
    
        // Hapus gambar lama jika ada
        Storage::delete($post->image);
    
        // Upload gambar baru
        $imagePath = $request->file('image')->store('uploads/images', 'public');
    
        $post->update([
            'image' => $imagePath
        ]);
    
        return redirect()->route('post.index')->with('success', 'Image updated successfully.');
    }
    
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        Storage::delete($post->image);
        $post->delete();
    
        return redirect()->route('post.index')->with('success', 'Image deleted successfully.');
    }
    
    public function publish($id)
{
    // Cari post berdasarkan ID
    $post = Post::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

    // Ubah status menjadi 'published'
    $post->status = 'published';
    $post->save();

    // Redirect dengan pesan sukses
    return redirect()->route('post.index')->with('success', 'Image successfully published.');
}
}

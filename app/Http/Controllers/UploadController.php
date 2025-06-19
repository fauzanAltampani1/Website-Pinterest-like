<?php



namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage; // Tambahkan use statement untuk Storage

class UploadController extends Controller
{   
    public function create()
    {
        $drafts = Post::where('user_id', Auth::id())->where('status', 'draft')->get();
        return view('upload', compact('drafts'));
    }
    
    public function store(Request $request)
{
    // Validasi input
    $request->validate([
        'title' => 'required|string|max:255',
        'image' => 'required|image|max:2048',
    ]);

    // Simpan gambar ke storage
    $imagePath = $request->file('image')->store('uploads/images', 'public');

    // Simpan data ke database
    Post::create([
        'user_id' => Auth::id(),
        'title' => $request->title,
        'image' => $imagePath,
        'status' => 'draft',
    ]);
    

    return redirect()->back()->with('success', 'Image uploaded as draft successfully!');
}
public function publish($id)
{
    $post = Post::findOrFail($id);

    // Ubah status ke 'published'
    $post->update(['status' => 'published']);

    return redirect()->route('post.index')->with('success', 'Image published successfully.');
}


    
}

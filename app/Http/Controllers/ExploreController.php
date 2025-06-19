<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ExploreController extends Controller
{
    public function index()
    {
        // Logika untuk halaman explore
        return view('explore'); // Pastikan ada file resources/views/explore.blade.php
    }
}

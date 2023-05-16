<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class WelcomeController extends Controller
{
    public function inicio(){
        $posts=Post::with('user', 'category')
        ->where('publicado', 'SI')
        ->orderBy('id', 'desc')
        ->paginate(5);
        return view('welcome', compact('posts'));
    }
}

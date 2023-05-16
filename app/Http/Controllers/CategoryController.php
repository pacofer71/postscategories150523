<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Http\Request;


class CategoryController extends Controller
{

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories=Category::with('posts')->orderBy('nombre')->get();
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'=>['required', 'string', 'min:3', 'unique:categories,nombre'],
            'color'=>['required', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        ]);
        Category::create([
            'nombre'=>$request->nombre,
            'color'=>$request->color
        ]);
        return redirect()->route('categories.index')->with('info', "Categoría guardada!");
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
    public function edit(Category $category)
    {
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'nombre'=>['required', 'string', 'min:3', 'unique:categories,nombre,'.$category->id],
            'color'=>['required', 'regex:/^#([A-Fa-f0-9]{6}|[A-Fa-f0-9]{3})$/'],
        ]);
        $category->update([
            'nombre'=>$request->nombre,
            'color'=>$request->color
        ]);
        return redirect()->route('categories.index')->with('info', "Categoría Editada!");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $contPosts=Post::where('category_id', $category->id)->get()->count();
        if($contPosts!=0){
            
        }else{
            $category->delete();
            return redirect()->route('categories.index')->with('info', 'Categoria Borrada');
        }
    }
   

}

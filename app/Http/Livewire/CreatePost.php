<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Livewire\Component;
use Livewire\WithFileUploads;

class CreatePost extends Component
{
    use WithFileUploads;
    public bool $open_create=false;
    public string $titulo, $contenido, $publicado, $category_id;
    public $imagen;

    public function render()
    {
        $categories = Category::all()->pluck('nombre', 'id')->toArray();
        $categories[-1]='______ Elige una categoría _____';
        ksort($categories);
        return view('livewire.create-post', compact('categories'));
    }

    protected function rules(){
        return [
            'titulo'=>['required', 'string', 'min:3', 'unique:posts,titulo'],
            'contenido'=>['required', 'string', 'min:10'],
            'publicado'=>['required', 'in:SI,NO'],
            'imagen'=>['required', 'image', 'max:2048'],
            'category_id'=>['required', 'exists:categories,id']
        ];
    }

    public function guardar(){
        $this->validate();
        $ruta_imagen=$this->imagen->store('images');
        Post::create([
            'titulo'=>$this->titulo,
            'contenido'=>$this->contenido,
            'publicado'=>$this->publicado,
            'category_id'=>$this->category_id,
            'user_id'=>auth()->user()->id,
            'url_img'=>$ruta_imagen
        ]);
        $this->emitTo('show-posts', 'render');
        $this->emit('mensaje', 'Post Creado');
        $this->cancelar();
        
    }

    
    public function cancelar(){
        $this->reset('open_create');
    }
}

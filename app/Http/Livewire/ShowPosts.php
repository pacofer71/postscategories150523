<?php

namespace App\Http\Livewire;

use App\Models\Category;
use App\Models\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

class ShowPosts extends Component
{
    use WithPagination;
    use WithFileUploads;
    use AuthorizesRequests;

    public string $search = "", $campo = "id", $orden = "desc";
    public $imagen;
    public bool $open_edit = false, $open_detalle=false;
    public Post $post;

    protected $listeners = [
        'render',
        'borrar'=>'borrar'
    ];

    public function render()
    {
        $posts = Post::with('category')
            ->where('user_id', auth()->user()->id)
            ->where('titulo', 'like', "%{$this->search}%")
            ->orderBy($this->campo, $this->orden)
            ->paginate(5);

        $categories = Category::all()->pluck('nombre', 'id')->toArray();

        return view('livewire.show-posts', compact('posts', 'categories'));
    }

    protected function rules(): array
    {
        return [
            'post.titulo' => ['required', 'string', 'min:3', 'unique:posts,titulo,' . $this->post->id],
            'post.contenido' => ['required', 'string', 'min:10'],
            'post.publicado' => ['required', 'in:SI,NO'],
            'imagen' => ['nullable', 'image', 'max:2048'],
            'post.category_id' => ['required', 'exists:categories,id']
        ];
    }

    public function ordenar(string $campo)
    {
        $this->orden = ($this->orden == 'desc') ? 'asc' : 'desc';
        $this->campo = $campo;
    }

    function confirmar(Post $post){
        $this->authorize('delete',$post);
        $this->emit('permisoBorrar', $post->id);

    }

    public function borrar(Post $post)
    {
        
        //Borro la imagen asociada
        Storage::delete($post->url_img);
        //Borro el registro
        $post->delete();
        $this->emit('mensaje', "Registro Borrado!!");
    }

    public function editar(Post $post)
    {
        $this->authorize('update', $post);
        $this->post = $post;
        $this->open_edit = true;
    }

    public function update(){
        $this->validate();
        $rutaImagen=$this->post->url_img;
        if($this->imagen){
            $rutaImagen=$this->imagen->store('images');
            Storage::delete($this->post->url_img);
        }
        $this->post->update([
            'titulo'=>$this->post->titulo,
            'contenido'=>$this->post->contenido,
            'publicado'=>$this->post->publicado,
            'category_id'=>$this->post->category_id,
            'user_id'=>auth()->user()->id,
            'url_img'=>$rutaImagen
        ]);
        $this->cancelar();
    }
    public function cancelar(){
        $this->post=new Post;
        $this->reset(['imagen', 'open_edit', 'open_detalle']);
    }

    public function detalle(Post $post){
        $this->post=$post;
        $this->open_detalle=true;
    }
}

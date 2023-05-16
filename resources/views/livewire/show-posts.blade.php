<div>

    <x-manuales.tabla1>
        <div class="flex my-2 ">
            <div class="w-full flex-1">
                <x-input type="search" wire:model="search" placeholder="Buscar..." class="w-full" />
            </div>
            <div class="ml-4">
                @livewire('create-post')
            </div>
        </div>
        @if ($posts->count())
            <table class="min-w-full text-left text-sm font-light">
                <thead class="border-b font-medium dark:border-neutral-500">
                    <tr>
                        <th scope="col" class="px-6 py-4">Detalle</th>
                        <th scope="col" class="px-6 py-4 cursor-pointer" wire:click="ordenar('titulo')">
                            Titulo <i class="ml-2 fas fa-sort"></i>
                        </th>
                        <th scope="col" class="px-6 py-4 cursor-pointer" wire:click="ordenar('category_id')">
                            Categoria <i class="ml-2 fas fa-sort"></i>
                        </th>
                        <th scope="col" class="px-6 py-4 cursor-pointer" wire:click="ordenar('publicado')">
                            Publicado <i class="ml-2 fas fa-sort"></i>
                        </th>
                        <th scope="col" class="px-6 py-4">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($posts as $item)
                        <tr class="border-b dark:border-neutral-500 hover:bg-slate-200">
                            <td class="whitespace-nowrap px-6 py-4 font-medium text-blue-600">
                                <button class="py-1 px-3 bg-gray-300 rounded-3xl"
                                    wire:click="detalle({{ $item->id }})"><i class="fas fa-info"></i></button>
                            </td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $item->titulo }}</td>
                            <td class="whitespace-nowrap px-6 py-4"><span
                                    class="px-2 py-1 rounded-xl bg-slate-100 font-bold"
                                    style="color:{{ $item->category->color }}">{{ $item->category->nombre }}</span></td>
                            <td class="whitespace-nowrap px-6 py-4">{{ $item->publicado }}</td>
                            <td class="whitespace-nowrap px-6 py-4">
                                <button wire:click="editar({{ $item->id }})" class="mr-2 text-yellow-400"><i
                                        class="fas fa-edit"></i></button>
                                <button wire:click="confirmar({{ $item->id }})" class="text-red-700"><i
                                        class="fas fa-trash"></i></button>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="mt-2">
                {{ $posts->links() }}
            </div>
        @else
            <p class="italic">No se encontrón nigún post o aun no creó ninguno.</p>
        @endif
    </x-manuales.tabla1>
    <!-- --------------------------------------------------- MODAL PARA EDITAR ------------------------------------------- -->
    @if ($post)
        <x-dialog-modal wire:model="open_edit">
            <x-slot name="title">
                Editar Post
            </x-slot>
            <x-slot name="content">
                <x-form>
                    @wire($post, 'defer')
                        <x-form-input name="post.titulo" label="Titulo del Post" placeholder="Título..." />
                        <x-form-textarea rows='4' name="post.contenido" placeholder="Contenido..."
                            label="Contenido del Post" />
                        <x-form-select name="post.category_id" :options="$categories" label="Categoría del Post" />
                        <x-form-group name="publicado" label="Se publicará el Post ahora?" inline>
                            <x-form-radio name="post.publicado" value="SI" label="SI" />
                            <x-form-radio name="post.publicado" value="NO" label="NO" />
                        </x-form-group>
                    @endwire
                    <div class="relative h-64 w-full mt-2">
                        @isset($imagen)
                            <img src="{{ $imagen->temporaryUrl() }}"
                                class="w-full h-full object-fill object-center rounded-xl">
                        @else
                            <img src="{{ Storage::url($post->url_img) }}"
                                class="w-full h-full object-fill object-center rounded-xl">
                        @endisset
                        <label for="imagen_1"
                            class="absolute bottom-1 end-1 py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                            <i class="fa-solid fa-cloud-arrow-up"></i>&nbsp; Subir Imagen</label>
                        <input type="file" name="imagen" accept="image/*" id="imagen_1" class="hidden"
                            wire:model="imagen" />
                    </div>
                    @error('imagen')
                        <p class="text-red-500 text-xs italic">{{ $message }}</p>
                    @enderror

                </x-form>
            </x-slot>
            <x-slot name="footer">
                <div class="flex flex-row-reverse">
                    <button type="submit" wire:click="update" wire:loading.attr="disabled"
                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <i class="fas fa-edit"></i>&nbsp;Editar
                    </button>
                    <button wire:click="cancelar"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <i class="fas fa-xmark"></i>&nbsp;Cancelar</button>
                </div>
            </x-slot>
        </x-dialog-modal>
        @endif
        <!-- Modal para Detalle --------------------------------------------------------------------------------->
        @isset($post->category)
        <x-dialog-modal wire:model="open_detalle">
            <x-slot name="title">
                Detalle Post
            </x-slot>
            <x-slot name="content">
                <div
                    class="mx-auto  bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    <img class="rounded-t-lg" src="{{ Storage::url($post->url_img) }}" alt="" />

                    <div class="p-5">

                        <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                            {{ $post->titulo }}</h5>

                        <p class="mb-2 font-normal text-gray-700 dark:text-gray-400">{{ $post->contenido }}</p>
                        </div>
                        <p class="text-center px-2 py-1 rounded-xl text-white" style="background-color:{{$post->category->color}}">{{$post->category->nombre}}</p>
                        <p @class([
                            "text-center px-2 py-1 rounded-xl mt-2",
                            "bg-red-700"=>$post->publicado=="NO",
                            "bg-green-500"=>$post->publicado=="SI",
                         ]) >{{$post->publicado}} está publicado.</p>
                         <p class="mt-2 bg-gray-200 px-2 py-1 rounded-xl">
                         <span class="font-bold">Fecha actualización: </span>{{$post->updated_at->format('d/m/Y H:i:s')}}
                         </p>
                </div>

            </x-slot>
            <x-slot name="footer">
                <button wire:click="update"
                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <i class="fas fa-xmark"></i>&nbsp;Cancelar</button>
            </x-slot>
        </x-dialog-modal>
    @endisset

</div>

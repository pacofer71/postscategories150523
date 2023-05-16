<div>
    <button type="button" wire:click="$set('open_create', true)"
        class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
        <i class="fas fa-add"></i>&nbsp;Nuevo
    </button>
    <x-dialog-modal wire:model="open_create">
        <x-slot name="title">
            Crear Post
        </x-slot>
        <x-slot name="content">
            <x-form>
                @wire('defer')
                    <x-form-input name="titulo" label="Titulo del Post" placeholder="Título..." />
                    <x-form-textarea name="contenido" placeholder="Contenido..." label="Contenido del Post" />
                    <x-form-select rows='4' name="category_id" :options="$categories" label="Categoría del Post" />
                    <x-form-group name="publicado" label="Se publicará el Post ahora?" inline>
                        <x-form-radio name="publicado" value="SI" label="SI" />
                        <x-form-radio name="publicado" value="NO" label="NO" />
                    </x-form-group>
               @endwire
                <div class="relative h-64 w-full mt-2">
                    @isset($imagen)
                        <img src="{{ $imagen->temporaryUrl() }}" class="w-full h-full object-fill object-center rounded-xl">
                    @else
                        <img src="{{ Storage::url('noimage.png') }}"
                            class="w-full h-full object-fill object-center rounded-xl">
                    @endisset
                    <label for="imagen"
                        class="absolute bottom-1 end-1 py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">
                        <i class="fa-solid fa-cloud-arrow-up"></i>&nbsp;Subir Imagen</label>
                    <input type="file" name="imagen" accept="image/*" id="imagen" class="hidden" wire:model="imagen" />
                </div>
                @error('imagen')
                <p class="text-red-500 text-xs italic">{{$message}}</p>
                @enderror
                 
            </x-form>
        </x-slot>
        <x-slot name="footer">
            <div class="flex flex-row-reverse">
                <button type="submit" wire:click="guardar"
                    class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <i class="fas fa-save"></i>&nbsp;Guardar
                </button>
                <button wire:click="cancelar"
                    class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                    <i class="fas fa-xmark"></i>&nbsp;Cancelar</button>
            </div>
        </x-slot>
    </x-dialog-modal>
</div>

<x-app-layout>
    <x-manuales.main>
        <div class="mx-auto px-4 py-4 rounded-2xl shadow-2xl bg-gray-200 w-1/2">
            <form action="{{ route('categories.update', $category) }}" method="POST">
                @csrf
                @method('PUT')
                @bind($category)
                <x-form-input name="nombre" label="Nombre de la categoría" placeholder="Nombre..." />
                <x-form-input name="color" label="Color de la categoría" placeholder="Color..." type="color" />
                @endbind
                <div class="flex flex-row-reverse mt-4">
                    <button type="submit"
                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <i class="fas fa-edit"></i>&nbsp;Editar
                    </button>
                    <a href="{{ route('categories.index') }}"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <i class="fas fa-xmark"></i>&nbsp;Cancelar</a>
                </div>
                </form>
        </div>

    </x-manuales.main>
</x-app-layout>

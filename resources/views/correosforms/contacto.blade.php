<x-app-layout>
    <x-manuales.main>
        <div class="mx-auto px-4 py-4 rounded-2xl shadow-2xl bg-gray-200 w-1/2">
            <form action="{{route('contacto.procesar')}}" method="POST">
                @csrf
                <x-form-input name="nombre" label="Nombre de contacto" placeholder="Nombre...." /> 
                @auth

                    @bind(auth()->user())
                        <x-form-input name="email" label="Email de contacto" placeholder="Email..." readonly />
                    @endbind
                @else
                    <x-form-input name="email" label="Email de contacto" placeholder="Email..." />
                @endauth

                <x-form-textarea name="contenido" label="Contenido del mensaje" placeholder="Contenido..." />
                <div class="flex flex-row-reverse mt-4">
                    <button type="submit"
                        class="text-white bg-gradient-to-r from-green-400 via-green-500 to-green-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-green-300 dark:focus:ring-green-800 shadow-lg shadow-green-500/50 dark:shadow-lg dark:shadow-green-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <i class="fa-solid fa-paper-plane"></i>&nbsp;Enviar
                    </button>
                    <a href="/"
                        class="text-white bg-gradient-to-r from-red-400 via-red-500 to-red-600 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 shadow-lg shadow-red-500/50 dark:shadow-lg dark:shadow-red-800/80 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                        <i class="fas fa-xmark"></i>&nbsp;Cancelar</a>
                </div>
            </form>
        </div>

    </x-manuales.main>
</x-app-layout>

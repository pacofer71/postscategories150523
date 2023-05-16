<x-app-layout>
    <x-manuales.tabla1>
        <div class="flex flex-row-reverse py-2">
            <a href="{{ route('categories.create') }}"
                class="text-white bg-gradient-to-r from-blue-500 via-blue-600 to-blue-700 hover:bg-gradient-to-br focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2">
                <i class="fas fa-add"></i>&nbsp;Nueva
            </a>
        </div>
        <table class="min-w-full text-left text-sm font-light">
            <thead class="border-b font-medium dark:border-neutral-500">
                <tr>
                    <th scope="col" class="px-6 py-4">ID</th>
                    <th scope="col" class="px-6 py-4">
                        NOMBRE
                    </th>
                    <th scope="col" class="px-6 py-4">
                        COLOR
                    </th>
                    <th scope="col" class="px-6 py-4">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $item)
                    <tr class="border-b dark:border-neutral-500 hover:bg-slate-200">
                        <td class="whitespace-nowrap px-6 py-4 font-medium text-blue-600">
                            {{ $item->id }}
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">{{ $item->nombre }}. ({{$item->posts->count()}} posts)</td>
                        <td class="whitespace-nowrap px-6 py-4">
                            <span class="w-full px-2 py-1 rounded"
                                style="background-color:{{ $item->color }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>
                        </td>
                        <td class="whitespace-nowrap px-6 py-4">
                            <form method="POST" action="{{ route('categories.destroy', $item) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('categories.edit', $item) }}" class="mr-2 text-yellow-400"><i
                                        class="fas fa-edit"></i></a>
                                <button type="submit" class="text-red-700"><i class="fas fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </x-manuales.tabla1>
</x-app-layout>

<x-app-layout>
    <x-manuales.main>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 h-full">
            @foreach ($posts as $item)
                <article @class(['h-80 w-full', 'md:col-span-2 lg:col-span-2' => $loop->first])
                    style="background-image:url({{ Storage::url($item->url_img) }}); background-size:cover">
                    <div class="flex flex-col w-full">
                        <div class="mx-auto text-2xl font-bold my-4 text-gray-700">
                            {{ $item->titulo }}
                        </div>
                        <div class="mx-auto font-bold my-4 text-gray-700">
                            {{ $item->user->name }} <span
                                class="italic text-blue-700">&lt;{{ $item->user->email }}&gt;</span>
                        </div>
                        <div class="mx-auto mt-2">
                            <span class="px-2 py-2 rounded-xl" style="background-color:{{ $item->category->color }}">
                                {{ $item->category->nombre }}
                            </span>

                        </div>
                    </div>
                </article>
            @endforeach
        </div>
        <div class="mt-2">
            {{ $posts->links() }}
        </div>
    </x-manuales.main>
</x-app-layout>

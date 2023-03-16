<x-rgpdmanager-r-g-p-d-manager-layout>
    <div class="bg-gray-900 py-24 sm:py-32">
        <div class="mx-auto max-w-7xl px-6 text-center lg:px-8">
            <div class="mx-auto max-w-2xl">
                <h2 class="text-3xl font-bold tracking-tight text-white sm:text-4xl">{{ $page->title }}</h2>
                <p class="mt-2 text-lg leading-8 text-gray-400">{{ $page->description }}</p>
            </div>

            <div class="my-4 text-white">
                {!! $page->content_parsed !!}
            </div>
        </div>
    </div>
</x-rgpdmanager-r-g-p-d-manager-layout>
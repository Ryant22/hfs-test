<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog Posts') }}
        </h2>
    </x-slot>
    <div class="container mx-auto flex flex-wrap py-6">
        <!-- Posts Section -->
        <section class="mx-auto md:w-2/3 flex flex-col items-center px-3">
            <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-3 gap-4">
                @foreach ($posts as $post)
                    <article class="flex flex-col shadow my-4">
                        <!-- Article Image -->
                        <a href="{{ route('posts.show', $post->id) }}" class="hover:opacity-75">
                            <div class="w-full h-32 bg-cover bg-center" style="background-image: url({{ asset($post->image) }})"></div>
                        </a>
                        <div class="bg-white flex flex-col justify-start p-6">
                            <a href="{{ route('posts.show', $post->id) }}"
                               class="text-xl font-bold hover:text-gray-700 pb-4">
                                @if (strlen($post->title) > 20)
                                    {{ substr($post->title, 0, 20) }}{{ strlen($post->title) > 20 ? '...' : '' }}
                                @else
                                    {{ $post->title }}
                                @endif
                            </a>
                            <a href="{{ route('posts.show', $post->id) }}"
                               class="uppercase text-gray-800 hover:text-black">Continue
                                Reading <i class="fas fa-arrow-right"></i></a>
                            <p class="text-gray-700 pt-4"><i class="fa fa-comment"></i> {{ $post->comments->count() }} Comments</p>
                        </div>
                    </article>
                @endforeach
            </div>
            {{ $posts->links() }}
        </section>
    </div>
</x-app-layout>

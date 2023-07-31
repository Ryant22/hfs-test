<x-app-layout>
<div class="mx-auto w-1/2 mt-4">
    <h1 class="text-xl">Welcome to Our Blog</h1>
    <p class="text-sm">
        Welcome to our blogging platform! This is a place where you can share your thoughts, ideas, and experiences with the world.
        Whether you're a seasoned writer or just getting started, we invite you to create and publish your own blog posts.
        Our community of readers and writers is eager to engage with your content and provide valuable feedback.
        So, don't hesitate! Join us and start your blogging journey today.
    </p>
    <p class="text-sm">
        We're excited to have you here!
    </p>
    <p class="text-sm">
        - The Blog Team
    </p>
    <h1 class="text-xl mt-4">Recent Posts</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        @foreach ($posts as $post)
            <article class="flex flex-col shadow my-4">
                <!-- Article Image -->
                <a href="{{ route('posts.show', $post->id) }}" class="hover:opacity-75">
                    <div class="w-full h-32 bg-cover bg-center" style="background-image: url({{ asset($post->image) }})"></div>
                </a>
                <div class="bg-white flex flex-col justify-start p-6 h-46">
                    <a href="{{ route('posts.show', $post->id) }}" class="text-lg font-bold hover:text-gray-700 pb-4">
                        @if (strlen($post->title) > 20)
                            {{ substr($post->title, 0, 20) }}{{ strlen($post->title) > 20 ? '...' : '' }}
                        @else
                            {{ $post->title }}
                        @endif
                    </a>
                    <a href="{{ route('posts.show', $post->id) }}" class="uppercase text-gray-800 hover:text-black">Read more <i class="fas fa-arrow-right"></i></a>
                    <p class="text-gray-700 pt-4">{{ $post->comments->count() }} Comments</p>
                </div>
            </article>
        @endforeach
    </div>
</div>
</x-app-layout>

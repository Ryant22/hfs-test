<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Blog') }}
        </h2>
    </x-slot>
    <div class="container mx-auto">
        <article class="flex flex-col shadow my-4 mx-auto w-1/2">
            <!-- Article Image -->
            <div class="w-full h-64 bg-cover bg-center" style="background-image: url({{ asset($post->image) }})"></div>
            <div class="bg-white flex flex-col justify-start p-6">
                <a href="{{ route('posts.show', $post->id) }}"
                   class="text-3xl font-bold hover:text-gray-700 pb-4">{{ $post->title }}</a>
                <p class="pb-6">{{ $post->body }}</p>
            </div>
            <div class="flex items-center justify-between p-6">
                <a href="{{ route('posts.index') }}"
                   class="uppercase text-gray-800 hover:text-black">Back to Posts <i class="fas fa-arrow-left"></i></a>
                @auth()
                    @if(auth()->user()->id === $post->user->id || auth()->user()->role === 'admin')
                        <div class="flex">
                            <a href="{{ route('posts.edit', $post->id) }}"
                               class="text-gray-800 hover:text-black">Edit <i class="fas fa-edit"></i></a>
                            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" class="ml-4">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 pr-3">
                                    Delete <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </div>
                    @endif
                @endauth
            </div>
        </article>
        <div class="container w-1/2 mx-auto">
            <h3 class="text-xl">Comments</h3>
            @foreach ($post->comments as $comment)
                <div class="bg-white rounded-md border border-zinc-300 px-3 py-1 my-4">
                    <p>{{ $comment->body }}</p>
                    <p>{{ $comment->user->name }} {{ $comment->created_at->diffForHumans() }}</p>
                    @auth()
                        @if(auth()->user()->id === $comment->user->id || auth()->user()->role === 'admin')
                            <div class="flex">
                                <form
                                    action="{{ route('comments.destroy', ['commentId' => $comment->id, 'postId' => $post->id]) }}"
                                    method="POST" class="ml-4">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500">
                                        Delete <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        @endif
                    @endauth

                </div>
            @endforeach
            @auth()
                <form action="{{ route('comments.store', ['postId' => $post->id]) }}" method="POST">
                    @csrf
                    <textarea name="body" id="body" rows="2" class="w-full"></textarea>
                    @error('body')
                    <div class="text-red-500 mt-2 text-sm">
                        {{ $message }}
                    </div>
                    @enderror
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded font-medium">Add Comment
                    </button>
                </form>
            @endauth
            @guest()
                <p class="text-red-500">Please <a href="{{ route('login') }}">login</a> to add a comment</p>
            @endguest
        </div>
    </div>
</x-app-layout>

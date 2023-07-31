<nav class="w-full py-4 bg-blue-800 shadow text-white">
    <div class="w-3/4 container mx-auto flex flex-wrap items-center justify-between">
        <a class="text-white no-underline hover:text-gray-200 hover:underline text-2xl font-bold"
           href="{{ route('dashboard') }}">
            {{ config('app.name', 'Laravel') }}
        </a>
        <nav class="mx-auto">
            <ul class="flex items-center justify-between font-bold text-sm uppercase no-underline">
                <li><a class="hover:text-gray-200 hover:underline px-4" href="{{ route('dashboard') }}">Home</a></li>
                <li><a class="hover:text-gray-200 hover:underline px-4" href="{{ route('posts.index') }}">Blog</a></li>
            </ul>
        </nav>
        @if(Auth::user())
            <a href="{{ route('posts.create') }}" class="mr-2">Create Post</a>
            <form method="POST" action="{{ route('logout') }}" x-data>
                @csrf
                <a href="{{ route('logout') }}"
                   @click.prevent="$root.submit();">
                    {{ __('Log Out') }}
                </a>
            </form>
        @else
            <a href="{{ route('login') }}">
                {{ __('Log In') }}
            </a>
        @endif
    </div>
    <form method="GET" action="{{ route('posts.index') }}" x-data>
        <div class="flex flex-row justify-center">
            <input type="text" name="q" id="q" class="form-control w-1/2 text-zinc-600" placeholder="Search" required>
            <button type="submit" class="px-3 py-1 bg-indigo-400 rounded-r-lg">Search Posts</button>
        </div>
    </form>
</nav>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create a new blog post') }}
        </h2>
    </x-slot>
    <div class="container mx-auto mt-10 w-1/2 bg-white shadow-md rounded-md px-4 pt-6 pb-8 mb-4 py-8">
        <form method="POST" action="{{ route('posts.store') }}" enctype="multipart/form-data">
            @csrf
            <div class="form-group flex flex-row">
                <label for="title" class="block w-20 text-center">Title:</label>
                <input type="text" name="title" id="title" class="form-control w-full" required>
                @error('title')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group flex flex-row mt-3">
                <label for="body" class="block w-20 text-center">Body:</label>
                <textarea name="body" id="body" class="form-control w-full" rows="6" required></textarea>
                @error('content')
                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" name="image" id="image" class="form-control-file" required>
                @error('image')
                <span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
            <hr class="my-4">
            <button type="submit" class="px-3 py-1 bg-indigo-50 rounded-lg">Submit</button>
        </form>
    </div>
</x-app-layout>

<x-guest-layout>
    <div class="p-6">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Posts') }}
        </h2>

        @if (session('success_message'))
            <div class="bg-green-200 p-2 my-4">
                {{ session('success_message') }}
            </div>
        @endif

        <div>
            <ul class="mt-2">
                @foreach ($posts as $post)
                    <li><a href="{{ route('posts.show', $post) }}" class="text-blue-700 hover:underline">{{ $post->title }}
                            by {{ $post->user->name }}</a></li>
                @endforeach
                <ul>

                    @auth
                        <div class="mt-2">
                            <a href="{{ route('posts.create') }}"
                               class="bg-blue-700 text-white rounded inline-block px-4 py-2">Create Post</a>
                        </div>
            @endauth
        </div>
    </div>
</x-guest-layout>

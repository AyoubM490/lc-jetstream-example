<x-guest-layout>

    <div class="p-6">
        @if (session('success_message'))
            <div class="bg-green-200 p-2 my-4">
                {{ session('success_message') }}
            </div>
        @endif

        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $post->title }}
        </h2>

        <div>
            {{ $post->body }}
        </div>

        {{-- @if (auth()->id() === $post->user_id) --}}
        {{-- @if (auth()->user()->currentTeam->id === $post->team_id) --}}
        @if (auth()->user()->hasTeamPermission(auth()->user()->currentTeam, 'update'))
            <div class="mt-2">
                <a href="{{ route('posts.edit', $post) }}"
                   class="text-white bg-blue-700 rounded inline-block px-4 py-2">Edit Post</a>
            </div>
        @endif

        {{-- @if (auth()->id() === $post->user_id) --}}
        @if (auth()->user()->hasTeamPermission(auth()->user()->currentTeam, 'delete'))
            <form action="{{ route('posts.destroy', $post) }}" method="POST" class="mt-2">
                @csrf
                @method('delete')
                <button type="submit" class="bg-red-700 text-white px-4 py-2 rounded inline-block">Delete</button>
            </form>
        @endif
    </div>
</x-guest-layout>

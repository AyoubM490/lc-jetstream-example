<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Post') }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            @if (session('success_message'))
                <div class="bg-green-200 p-2 my-4">
                    {{ session('success_message') }}
                </div>
            @endif
            <div class="md:grid md:grid-cols-3 md:gap-6">
                <div class="md:col-span-1">
                    <div class="px-4 sm:px-0">
                        <h3 class="text-lg font-medium text-gray-900">Post Details</h3>

                        <p class="mt-1 text-sm text-gray-600">
                            Enter the updated post details here.
                        </p>
                    </div>
                </div>


                <div class="mt-5 md:mt-0 md:col-span-2">

                    <form action="{{ route('posts.update', $post) }}" method="POST">
                        @csrf
                        @method('patch')
                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-6">


                                    <div class="col-span-6 sm:col-span-4">
                                        <div>
                                            <label class="block font-medium text-sm text-gray-700" for="title">
                                                Title
                                            </label>

                                            <input name="title"
                                                   class="form-input rounded-md shadow-sm mt-1 block w-full" id="title"
                                                   type="text" value="{{ $post->title }}" autofocus="autofocus">
                                        </div>

                                        <div class="mt-4">
                                            <label class="block font-medium text-sm text-gray-700" for="body">
                                                Body
                                            </label>

                                            <textarea name="body" id="body"
                                                      class="rounded-md shadow-sm border border-gray-300 block w-full p-2"
                                                      cols="30" rows="10">{{ $post->body }}</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6">
                                <button type="submit"
                                        class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 active:bg-gray-900 focus:outline-none focus:border-gray-900 focus:shadow-outline-gray disabled:opacity-25 transition ease-in-out duration-150">
                                    Update
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

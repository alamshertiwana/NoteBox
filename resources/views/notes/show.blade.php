<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ (request()->routeIs('notes.show')) ? __('View Note') : __('Trashed Note') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            <div class="flex">
                @if (request()->routeIs('notes.show'))
                    <p class="opacity-70"><strong>Created:</strong> {{ $note->created_at->diffForHumans() }}</p>
                    <p class="opacity-70 ml-8"><strong>Updated:</strong> {{ $note->updated_at->diffForHumans() }}</p>
                    <a href="{{ route('notes.edit', $note) }}" class=" inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 ml-auto">Edit Note</a>
                    <form action="{{ route('notes.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf
                        <x-danger-button class="ml-2">Move to Trash</x-danger-button>
                    </form>
                @else
                    <p class="opacity-70"><strong>Deleted:</strong> {{ $note->deleted_at->diffForHumans() }}</p>
                    <form action="{{ route('trashed.update', $note) }}" method="post" class="ml-auto">
                        @method('put')
                        @csrf
                        <x-primary-button class="ml-2">Restore Note</x-primary-button>
                    </form>
                    <form action="{{ route('trashed.destroy', $note) }}" method="post">
                        @method('delete')
                        @csrf
                        <x-danger-button class="ml-2">Delete Permanently</x-danger-button>
                    </form>
                @endif
            </div>
            <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                <h2 class="font-bold text-4xl">{{ $note->title }}</h2>
                <p class="mt-4 whitespace-pre-wrap">{{ $note->text }}</p>
                <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
            </div>
        </div>
    </div>
</x-app-layout>

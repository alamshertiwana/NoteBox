<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ request()->routeIs('notes.index') ? __('Notes') : __('Trashed') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="mb-4 px-4 py-2 bg-green-100 border border-green-200 text-green-700 rounded-md">
                    {{ session('success') }}
                </div>
            @endif

            @if (request()->routeIs('notes.index'))
                <div class="flex">
                    <a href="{{ route('notes.create') }}" class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">Add Note</a>
                </div>
            @endif

            @forelse ($notes as $note)
                <div class="my-6 p-6 bg-white border-b border-gray-200 shadow-sm sm:rounded-lg">
                    <a
                        @if (request()->routeIs('notes.index'))
                            href="{{ route('notes.show', $note) }}"
                        @else
                            href="{{ route('trashed.show', $note) }}"
                        @endif
                        ><h2 class="font-bold text-2xl">{{ $note->title }}</h2></a>
                    <p class="mt-2">{{ Str::limit($note->text, 200, '...') }}</p>
                    <span class="block mt-4 text-sm opacity-70">{{ $note->updated_at->diffForHumans() }}</span>
                </div>
            @empty
                @if (request()->routeIs('notes.index'))
                    <p class="mt-4">You have no notes yet.</p>
                @else
                    <p class="mt-4">No notes in the trash.</p>
                @endif
            @endforelse

            {{ $notes->links() }}
        </div>
    </div>
</x-app-layout>

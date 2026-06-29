<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Rooms Management') }}
            </h2>
            @role('admin')
            <a href="{{ route('rooms.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition">
                + Add New Room
            </a>
            @endrole
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach ($rooms as $room)
                <div class="bg-white rounded-2xl shadow-sm hover:shadow-xl border border-gray-100 transition-all duration-300 transform hover:-translate-y-1">
                    <div class="p-6">
                        <div class="flex justify-between items-start">
                            <div>
                                <span class="text-xs font-bold inline-block py-1 px-3 uppercase rounded-full {{ $room->is_active ? 'text-green-700 bg-green-100' : 'text-red-700 bg-red-100' }}">
                                    {{ $room->is_active ? 'Active' : 'Inactive' }}
                                </span>
                                <h3 class="mt-3 text-2xl font-bold text-gray-900">{{ $room->name }}</h3>
                                <p class="text-sm font-medium text-gray-500 mt-1">{{ $room->code }} &bull; {{ $room->location ?? 'No location' }}</p>
                            </div>
                            <div class="text-right bg-indigo-50 px-3 py-2 rounded-xl">
                                <div class="text-3xl font-black text-indigo-600">{{ $room->capacity }}</div>
                                <div class="text-[10px] font-bold text-indigo-400 uppercase tracking-wider">Seats</div>
                            </div>
                        </div>
                        
                        @if($room->facilities)
                        <div class="mt-6 flex flex-wrap gap-2">
                            @foreach($room->facilities as $facility)
                            <span class="bg-gray-50 text-gray-600 border border-gray-200 text-xs px-2.5 py-1 rounded-md font-medium">{{ $facility }}</span>
                            @endforeach
                        </div>
                        @endif
                    </div>
                    
                    <div class="bg-gray-50/50 px-6 py-4 border-t border-gray-100 flex justify-between items-center rounded-b-2xl">
                        <a href="{{ route('rooms.show', $room) }}" class="text-indigo-600 hover:text-indigo-800 font-semibold text-sm transition">View Details &rarr;</a>
                        
                        @role('admin')
                        <div class="flex space-x-4">
                            <a href="{{ route('rooms.edit', $room) }}" class="text-amber-500 hover:text-amber-700 font-medium text-sm transition">Edit</a>
                            <form action="{{ route('rooms.destroy', $room) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure you want to delete this room?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-700 font-medium text-sm transition">Delete</button>
                            </form>
                        </div>
                        @endrole
                    </div>
                </div>
                @endforeach
            </div>
            
            @if($rooms->isEmpty())
            <div class="text-center py-20 bg-white rounded-2xl shadow-sm border border-gray-100">
                <div class="text-gray-400 mb-4">
                    <svg class="mx-auto h-16 w-16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4" />
                    </svg>
                </div>
                <h3 class="text-lg font-medium text-gray-900">No rooms available</h3>
                <p class="mt-1 text-gray-500">Get started by creating a new room.</p>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>

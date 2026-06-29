<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Room Details') }}
            </h2>
            <a href="{{ route('rooms.index') }}" class="text-gray-500 hover:text-gray-700 font-medium px-4 py-2 transition">&larr; Back to Rooms</a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-2xl overflow-hidden border border-gray-100 mb-8">
                <div class="md:flex">
                    <div class="p-8 md:w-2/3">
                        <div class="uppercase tracking-wide text-sm text-indigo-500 font-bold mb-1">{{ $room->code }}</div>
                        <h1 class="block mt-1 text-3xl leading-tight font-black text-gray-900">{{ $room->name }}</h1>
                        <p class="mt-2 text-gray-500 flex items-center">
                            <svg class="h-5 w-5 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            {{ $room->location ?? 'Location not specified' }}
                        </p>
                        
                        <div class="mt-8">
                            <h3 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Facilities</h3>
                            @if($room->facilities && count($room->facilities) > 0)
                                <div class="flex flex-wrap gap-2">
                                    @foreach($room->facilities as $facility)
                                    <span class="bg-indigo-50 text-indigo-700 border border-indigo-100 px-3 py-1.5 rounded-lg text-sm font-medium">
                                        {{ $facility }}
                                    </span>
                                    @endforeach
                                </div>
                            @else
                                <p class="text-gray-500 italic">No facilities listed.</p>
                            @endif
                        </div>
                    </div>
                    
                    <div class="bg-gray-50 p-8 md:w-1/3 border-t md:border-t-0 md:border-l border-gray-100 flex flex-col justify-center">
                        <div class="text-center mb-6">
                            <div class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Status</div>
                            <span class="inline-flex items-center px-4 py-1.5 rounded-full text-sm font-bold {{ $room->is_active ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                <span class="h-2 w-2 rounded-full mr-2 {{ $room->is_active ? 'bg-green-500' : 'bg-red-500' }}"></span>
                                {{ $room->is_active ? 'Active & Available' : 'Currently Inactive' }}
                            </span>
                        </div>
                        
                        <div class="text-center mb-8">
                            <div class="text-xs font-bold text-gray-500 uppercase tracking-widest mb-1">Capacity</div>
                            <div class="text-5xl font-black text-indigo-600">{{ $room->capacity }}</div>
                            <div class="text-sm font-medium text-gray-500 mt-1">Seats Maximum</div>
                        </div>
                        
                        <div class="text-center">
                            @if($room->is_active)
                            <a href="{{ route('bookings.create', ['room_id' => $room->id]) }}" class="block text-center w-full bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-4 rounded-xl shadow-md transition mb-2">
                                Book Now
                            </a>
                            @endif
                            
                            @role('admin')
                            <a href="{{ route('rooms.edit', $room) }}" class="block w-full bg-white border-2 border-indigo-600 text-indigo-600 hover:bg-indigo-50 font-bold py-2.5 px-4 rounded-xl transition mt-2">
                                Edit Room
                            </a>
                            @endrole
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

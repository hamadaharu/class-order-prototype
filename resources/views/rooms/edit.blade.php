<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Room:') }} {{ $room->name }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-xl sm:rounded-2xl overflow-hidden border border-gray-100">
                <div class="p-8">
                    <form action="{{ route('rooms.update', $room) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700 mb-1">Room Code</label>
                                <input type="text" name="code" id="code" value="{{ old('code', $room->code) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition" required>
                                @error('code') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Room Name</label>
                                <input type="text" name="name" id="name" value="{{ old('name', $room->name) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition" required>
                                @error('name') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="capacity" class="block text-sm font-medium text-gray-700 mb-1">Capacity (Seats)</label>
                                <input type="number" name="capacity" id="capacity" value="{{ old('capacity', $room->capacity) }}" min="1" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition" required>
                                @error('capacity') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                            
                            <div>
                                <label for="location" class="block text-sm font-medium text-gray-700 mb-1">Location / Building</label>
                                <input type="text" name="location" id="location" value="{{ old('location', $room->location) }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition">
                                @error('location') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                            </div>
                        </div>

                        <div class="mb-6">
                            <label for="facilities" class="block text-sm font-medium text-gray-700 mb-1">Facilities (Comma separated)</label>
                            <input type="text" name="facilities" id="facilities" value="{{ old('facilities', is_array($room->facilities) ? implode(', ', $room->facilities) : '') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition">
                            <p class="text-xs text-gray-400 mt-1">Separate each facility with a comma.</p>
                            @error('facilities') <span class="text-red-500 text-xs mt-1 block">{{ $message }}</span> @enderror
                        </div>

                        <div class="mb-8">
                            <label class="flex items-center">
                                <input type="checkbox" name="is_active" value="1" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500 w-5 h-5 transition" {{ old('is_active', $room->is_active) ? 'checked' : '' }}>
                                <span class="ml-2 text-sm text-gray-600">Room is active and available for booking</span>
                            </label>
                        </div>

                        <div class="flex items-center justify-end pt-4 border-t border-gray-100">
                            <a href="{{ route('rooms.index') }}" class="text-gray-500 hover:text-gray-700 font-medium px-4 py-2 mr-2 transition">Cancel</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition">
                                Update Room
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

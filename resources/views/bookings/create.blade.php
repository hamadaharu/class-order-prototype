<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Book a Room') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            
            @if($errors->any())
            <div class="mb-6 bg-red-50 border border-red-200 text-red-700 px-4 py-3 rounded-lg" role="alert">
                <ul class="list-disc pl-5">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="bg-white shadow-xl sm:rounded-2xl overflow-hidden border border-gray-100">
                <div class="p-8">
                    <form action="{{ route('bookings.store') }}" method="POST">
                        @csrf
                        
                        <div class="mb-6">
                            <label for="room_id" class="block text-sm font-medium text-gray-700 mb-1">Select Room</label>
                            <select name="room_id" id="room_id" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition" required>
                                <option value="" disabled {{ !$selectedRoomId ? 'selected' : '' }}>-- Choose a Room --</option>
                                @foreach($rooms as $room)
                                    <option value="{{ $room->id }}" {{ (old('room_id') ?? $selectedRoomId) == $room->id ? 'selected' : '' }}>
                                        {{ $room->name }} ({{ $room->code }}) - Cap: {{ $room->capacity }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div>
                                <label for="start_at" class="block text-sm font-medium text-gray-700 mb-1">Start Time</label>
                                <input type="datetime-local" name="start_at" id="start_at" value="{{ old('start_at') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition" required>
                            </div>
                            
                            <div>
                                <label for="end_at" class="block text-sm font-medium text-gray-700 mb-1">End Time</label>
                                <input type="datetime-local" name="end_at" id="end_at" value="{{ old('end_at') }}" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition" required>
                            </div>
                        </div>

                        <div class="mb-8">
                            <label for="purpose" class="block text-sm font-medium text-gray-700 mb-1">Purpose of Booking</label>
                            <textarea name="purpose" id="purpose" rows="4" class="w-full rounded-lg border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 shadow-sm transition" placeholder="e.g. Kuliah Web Programming, Meeting Dosen..." required>{{ old('purpose') }}</textarea>
                            <p class="text-xs text-gray-500 mt-1">Please provide clear details about your activity.</p>
                        </div>

                        <div class="flex items-center justify-end pt-4 border-t border-gray-100">
                            <a href="{{ route('bookings.index') }}" class="text-gray-500 hover:text-gray-700 font-medium px-4 py-2 mr-2 transition">Cancel</a>
                            <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition">
                                Submit Request
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

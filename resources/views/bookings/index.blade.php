<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ Auth::user()->hasRole('admin') ? __('All Bookings') : __('My Bookings') }}
            </h2>
            <a href="{{ route('bookings.create') }}" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-sm transition">
                + New Booking
            </a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-2xl overflow-hidden border border-gray-100">
                <div class="overflow-x-auto">
                    <table class="w-full text-left border-collapse">
                        <thead>
                            <tr class="bg-gray-50 text-gray-700 uppercase text-xs font-semibold tracking-wider">
                                <th class="px-6 py-4 border-b border-gray-100">Room</th>
                                @role('admin')
                                <th class="px-6 py-4 border-b border-gray-100">Requester</th>
                                @endrole
                                <th class="px-6 py-4 border-b border-gray-100">Schedule</th>
                                <th class="px-6 py-4 border-b border-gray-100">Status</th>
                                <th class="px-6 py-4 border-b border-gray-100 text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @forelse($bookings as $booking)
                            <tr class="hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="font-bold text-gray-900">{{ $booking->room->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $booking->room->code }}</div>
                                </td>
                                @role('admin')
                                <td class="px-6 py-4">
                                    <div class="text-sm font-medium text-gray-900">{{ $booking->user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $booking->user->email }}</div>
                                </td>
                                @endrole
                                <td class="px-6 py-4">
                                    <div class="text-sm text-gray-900 font-medium">
                                        {{ \Carbon\Carbon::parse($booking->start_at)->format('d M Y') }}
                                    </div>
                                    <div class="text-sm text-gray-500">
                                        {{ \Carbon\Carbon::parse($booking->start_at)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_at)->format('H:i') }}
                                    </div>
                                </td>
                                <td class="px-6 py-4">
                                    @php
                                        $statusColors = [
                                            'pending' => 'bg-yellow-100 text-yellow-800',
                                            'approved' => 'bg-green-100 text-green-800',
                                            'rejected' => 'bg-red-100 text-red-800',
                                            'cancelled' => 'bg-gray-200 text-gray-800'
                                        ];
                                    @endphp
                                    <span class="px-3 py-1 rounded-full text-xs font-bold uppercase {{ $statusColors[$booking->status] ?? 'bg-gray-100' }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 text-right">
                                    <a href="{{ route('bookings.show', $booking) }}" class="text-indigo-600 hover:text-indigo-900 font-medium text-sm">View</a>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center text-gray-500">
                                    No bookings found. <a href="{{ route('bookings.create') }}" class="text-indigo-600 hover:underline">Create one now</a>.
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
            
        </div>
    </div>
</x-app-layout>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-2xl border border-gray-100">
                <div class="p-8 text-gray-900">
                    <h1 class="text-2xl font-black mb-6">Welcome back, {{ Auth::user()->name }}! 👋</h1>

                    @role('admin')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Admin Widgets -->
                        <div class="bg-indigo-50 border border-indigo-100 rounded-xl p-6 flex items-center justify-between">
                            <div>
                                <div class="text-indigo-600 font-bold uppercase tracking-wider text-xs mb-1">Pending Approvals</div>
                                <div class="text-4xl font-black text-indigo-900">{{ $pendingBookingsCount ?? 0 }}</div>
                            </div>
                            <div class="bg-indigo-200 text-indigo-700 p-3 rounded-full">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                            </div>
                        </div>

                        <div class="bg-emerald-50 border border-emerald-100 rounded-xl p-6 flex items-center justify-between">
                            <div>
                                <div class="text-emerald-600 font-bold uppercase tracking-wider text-xs mb-1">Total Rooms</div>
                                <div class="text-4xl font-black text-emerald-900">{{ $totalRooms ?? 0 }}</div>
                            </div>
                            <div class="bg-emerald-200 text-emerald-700 p-3 rounded-full">
                                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path></svg>
                            </div>
                        </div>
                    </div>
                    
                    <div class="mt-8">
                        <a href="{{ route('bookings.index') }}" class="inline-block bg-indigo-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-indigo-700 transition">Go to Bookings &rarr;</a>
                    </div>
                    @else
                    
                    <h2 class="text-lg font-bold text-gray-800 mb-4 mt-8 border-b pb-2">Your Upcoming Bookings</h2>
                    
                    @if(isset($upcomingBookings) && $upcomingBookings->count() > 0)
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                            @foreach($upcomingBookings as $booking)
                            <div class="border border-gray-200 rounded-xl p-5 hover:shadow-md transition bg-white">
                                <div class="font-bold text-lg text-indigo-700">{{ $booking->room->name }}</div>
                                <div class="text-sm text-gray-500 mb-3">{{ \Carbon\Carbon::parse($booking->start_at)->format('d M Y') }}</div>
                                <div class="text-sm font-medium text-gray-800 bg-gray-50 p-2 rounded">
                                    {{ \Carbon\Carbon::parse($booking->start_at)->format('H:i') }} - {{ \Carbon\Carbon::parse($booking->end_at)->format('H:i') }}
                                </div>
                                <a href="{{ route('bookings.show', $booking) }}" class="mt-4 inline-block text-sm font-bold text-indigo-600 hover:text-indigo-800">View Details</a>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="bg-gray-50 border border-gray-100 rounded-xl p-8 text-center">
                            <p class="text-gray-500 mb-4">You don't have any upcoming approved bookings.</p>
                            <a href="{{ route('rooms.index') }}" class="bg-indigo-600 text-white font-bold py-2 px-6 rounded-lg hover:bg-indigo-700 transition">Browse Rooms</a>
                        </div>
                    @endif
                    @endrole
                </div>
            </div>
        </div>
    </div>
</x-app-layout>

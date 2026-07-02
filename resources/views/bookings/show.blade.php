<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Booking Details') }}
            </h2>
            <a href="{{ route('bookings.index') }}" class="text-gray-500 hover:text-gray-700 font-medium px-4 py-2 transition">&larr; Back</a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            
            @if(session('success'))
            <div class="mb-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
            @endif
            @if(session('error'))
            <div class="mb-6 bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
                <span class="block sm:inline">{{ session('error') }}</span>
            </div>
            @endif

            <div class="bg-white shadow-xl sm:rounded-2xl overflow-hidden border border-gray-100 mb-8">
                <div class="p-8 border-b border-gray-100 flex justify-between items-start">
                    <div>
                        <div class="text-sm font-bold text-gray-500 uppercase tracking-widest mb-1">Booking Reference #{{ $booking->id }}</div>
                        <h1 class="text-2xl font-black text-gray-900">{{ $booking->room->name }}</h1>
                        <p class="text-gray-500">{{ $booking->room->code }} &bull; {{ $booking->room->location }}</p>
                    </div>
                    <div>
                        @php
                            $statusColors = [
                                'pending' => 'bg-yellow-100 text-yellow-800 border-yellow-200',
                                'approved' => 'bg-green-100 text-green-800 border-green-200',
                                'rejected' => 'bg-red-100 text-red-800 border-red-200',
                                'cancelled' => 'bg-gray-100 text-gray-800 border-gray-300'
                            ];
                        @endphp
                        <span class="px-4 py-2 rounded-full text-sm font-black uppercase border {{ $statusColors[$booking->status] ?? 'bg-gray-100' }}">
                            {{ $booking->status }}
                        </span>
                    </div>
                </div>

                <div class="p-8 grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3 border-b pb-2">Schedule</h3>
                        <div class="mb-4">
                            <div class="text-sm text-gray-500">Start</div>
                            <div class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($booking->start_at)->format('l, d M Y H:i') }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">End</div>
                            <div class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($booking->end_at)->format('l, d M Y H:i') }}</div>
                        </div>
                        <div class="mt-4 pt-4 border-t border-gray-100">
                            <div class="text-sm text-gray-500">Duration</div>
                            <div class="font-medium text-gray-900">{{ \Carbon\Carbon::parse($booking->start_at)->diffForHumans(\Carbon\Carbon::parse($booking->end_at), true) }}</div>
                        </div>
                    </div>

                    <div>
                        <h3 class="text-sm font-bold text-gray-500 uppercase tracking-wider mb-3 border-b pb-2">Requester Info</h3>
                        <div class="mb-4">
                            <div class="text-sm text-gray-500">Name</div>
                            <div class="font-medium text-gray-900">{{ $booking->user->name }}</div>
                        </div>
                        <div class="mb-4">
                            <div class="text-sm text-gray-500">Email</div>
                            <div class="font-medium text-gray-900">{{ $booking->user->email }}</div>
                        </div>
                        <div>
                            <div class="text-sm text-gray-500">Purpose</div>
                            <div class="font-medium text-gray-900 whitespace-pre-line">{{ $booking->purpose }}</div>
                        </div>
                    </div>
                </div>

                @if($booking->status === 'rejected' && $booking->rejection_reason)
                <div class="bg-red-50 p-6 border-t border-red-100">
                    <h3 class="text-sm font-bold text-red-800 uppercase tracking-wider mb-2">Rejection Reason</h3>
                    <p class="text-red-700">{{ $booking->rejection_reason }}</p>
                </div>
                @endif
                
                @if($booking->approver)
                <div class="bg-gray-50 p-4 border-t border-gray-100 text-sm text-gray-500 text-center">
                    {{ $booking->status === 'approved' ? 'Approved' : 'Rejected' }} by {{ $booking->approver->name }} on {{ $booking->updated_at->format('d M Y H:i') }}
                </div>
                @endif
            </div>

            <!-- Actions Panel -->
            @if($booking->status === 'pending')
                <div class="bg-white shadow-sm sm:rounded-2xl p-6 border border-gray-100 flex flex-col md:flex-row justify-between items-center gap-4">
                    
                    @if(Auth::id() === $booking->user_id || Auth::user()->hasRole('admin'))
                        <form action="{{ route('bookings.cancel', $booking) }}" method="POST" onsubmit="return confirm('Are you sure you want to cancel this booking request?');">
                            @csrf
                            <button type="submit" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-bold py-2 px-6 rounded-lg transition">
                                Cancel Booking
                            </button>
                        </form>
                    @endif

                    @role('admin')
                        <div class="flex flex-1 justify-end space-x-3 w-full md:w-auto">
                            <!-- Reject Button triggers modal -->
                            <button type="button" onclick="document.getElementById('rejectModal').classList.remove('hidden')" class="bg-white border-2 border-red-500 text-red-600 hover:bg-red-50 font-bold py-2 px-6 rounded-lg transition">
                                Reject Request
                            </button>
                            
                            <form action="{{ route('bookings.approve', $booking) }}" method="POST">
                                @csrf
                                <button type="submit" class="bg-green-600 hover:bg-green-700 text-white font-bold py-2 px-8 rounded-lg shadow-md transition">
                                    Approve
                                </button>
                            </form>
                        </div>
                    @endrole
                </div>
            @endif
        </div>
    </div>

    <!-- Reject Modal -->
    @role('admin')
    <div id="rejectModal" class="fixed inset-0 bg-gray-900 bg-opacity-50 hidden flex items-center justify-center z-50">
        <div class="bg-white rounded-2xl shadow-2xl p-8 max-w-lg w-full mx-4">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Reject Booking Request</h3>
            <form action="{{ route('bookings.reject', $booking) }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="rejection_reason" class="block text-sm font-medium text-gray-700 mb-2">Reason for rejection <span class="text-red-500">*</span></label>
                    <textarea name="rejection_reason" id="rejection_reason" rows="3" class="w-full rounded-lg border-gray-300 focus:border-red-500 focus:ring-red-500 shadow-sm" required></textarea>
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="document.getElementById('rejectModal').classList.add('hidden')" class="bg-white border border-gray-300 text-gray-700 hover:bg-gray-50 font-medium py-2 px-4 rounded-lg transition">
                        Cancel
                    </button>
                    <button type="submit" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-6 rounded-lg shadow-md transition">
                        Confirm Rejection
                    </button>
                </div>
            </form>
        </div>
    </div>
    @endrole
</x-app-layout>

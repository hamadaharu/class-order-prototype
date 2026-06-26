<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookingController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole('admin')) {
            $bookings = Booking::with(['room', 'user', 'approver'])->latest()->get();
        } else {
            $bookings = Booking::with(['room', 'approver'])->where('user_id', $user->id)->latest()->get();
        }

        return view('bookings.index', compact('bookings'));
    }

    public function create(Request $request)
    {
        $rooms = Room::where('is_active', true)->get();
        $selectedRoomId = $request->query('room_id');
        
        return view('bookings.create', compact('rooms', 'selectedRoomId'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'room_id' => 'required|exists:rooms,id',
            'start_at' => 'required|date|after:now',
            'end_at' => 'required|date|after:start_at',
            'purpose' => 'required|string',
        ]);

        $room = Room::findOrFail($request->room_id);
        
        if (!$room->is_active) {
            return back()->withErrors(['room_id' => 'The selected room is inactive.'])->withInput();
        }

        $start = Carbon::parse($request->start_at);
        $end = Carbon::parse($request->end_at);

        // Check for max duration (e.g. max 8 hours)
        $durationHours = $start->diffInMinutes($end) / 60;
        if ($durationHours > 8) {
            return back()->withErrors(['end_at' => 'Booking duration cannot exceed 8 hours.'])->withInput();
        }
        
        // Conflict check logic
        $hasConflict = Booking::where('room_id', $room->id)
            ->where('status', 'approved')
            ->where(function ($query) use ($start, $end) {
                $query->where('start_at', '<', $end)
                      ->where('end_at', '>', $start);
            })
            ->exists();

        if ($hasConflict) {
            return back()->withErrors(['conflict' => 'The room is already booked and approved for the selected time period.'])->withInput();
        }

        Booking::create([
            'user_id' => Auth::id(),
            'room_id' => $room->id,
            'start_at' => $start,
            'end_at' => $end,
            'purpose' => $request->purpose,
            'status' => 'pending',
        ]);

        return redirect()->route('bookings.index')->with('success', 'Booking requested successfully. Please wait for admin approval.');
    }

    public function show(Booking $booking)
    {
        // User can only see their own booking, or admin can see all
        if ($booking->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }
        return view('bookings.show', compact('booking'));
    }

    public function cancel(Booking $booking)
    {
        if ($booking->user_id !== Auth::id() && !Auth::user()->hasRole('admin')) {
            abort(403);
        }

        if ($booking->status === 'cancelled') {
            return back()->with('error', 'Booking is already cancelled.');
        }

        $start = Carbon::parse($booking->start_at);
        $cancelWindow = 2; // hours
        
        if (!Auth::user()->hasRole('admin') && Carbon::now()->addHours($cancelWindow)->greaterThan($start)) {
            return back()->with('error', "You can only cancel bookings at least $cancelWindow hours before the start time.");
        }

        $booking->update(['status' => 'cancelled']);

        return back()->with('success', 'Booking cancelled successfully.');
    }

    public function approve(Booking $booking)
    {
        if (!Auth::user()->hasRole('admin')) abort(403);
        
        // re-check conflicts to avoid race conditions
        $hasConflict = Booking::where('room_id', $booking->room_id)
            ->where('status', 'approved')
            ->where('id', '!=', $booking->id)
            ->where(function ($query) use ($booking) {
                $query->where('start_at', '<', $booking->end_at)
                      ->where('end_at', '>', $booking->start_at);
            })
            ->exists();

        if ($hasConflict) {
            return back()->with('error', 'Cannot approve. The room is already booked for this time period.');
        }

        $booking->update([
            'status' => 'approved',
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'Booking approved successfully.');
    }

    public function reject(Request $request, Booking $booking)
    {
        if (!Auth::user()->hasRole('admin')) abort(403);
        
        $request->validate(['rejection_reason' => 'required|string']);
        
        $booking->update([
            'status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'approved_by' => Auth::id(),
        ]);

        return back()->with('success', 'Booking rejected.');
    }
}

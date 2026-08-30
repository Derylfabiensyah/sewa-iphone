<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\RentalReturn;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    public function index()
    {
        $bookings = Booking::with('user', 'payment')->latest()->paginate(10);
        return view('admin.bookings.index', compact('bookings'));
    }

    public function show(Booking $booking)
    {
        $booking->load('user', 'details.iphone', 'payment');
        return view('admin.bookings.show', compact('booking'));
    }

    public function verifyPayment(Request $request, Booking $booking)
    {
        if ($booking->payment) {
            $booking->payment()->update(['status' => 'verified']);
        }
        $booking->update(['status' => 'confirmed']);
        return back()->with('success', 'Payment verified.');
    }

    public function rejectPayment(Request $request, Booking $booking)
    {
        if ($booking->payment) {
            $booking->payment()->update(['status' => 'rejected']);
        }
        $booking->update(['status' => 'waiting_payment']);
        return back()->with('error', 'Payment rejected.');
    }

    public function markActive(Booking $booking)
    {
        $booking->update(['status' => 'active']);
        return back()->with('success', 'Booking marked as active.');
    }

    public function processReturn(Request $request, Booking $booking)
    {
        $request->validate([
            'returns' => 'required|array',
            'returns.*.condition' => 'required|string',
            'returns.*.penalty_fee' => 'required|integer',
            'returns.*.penalty_notes' => 'nullable|string',
        ]);

        foreach ($request->returns as $detail_id => $returnData) {
            RentalReturn::create([
                'booking_detail_id' => $detail_id,
                'return_date' => now(),
                'condition' => $returnData['condition'],
                'penalty_fee' => $returnData['penalty_fee'],
                'penalty_notes' => $returnData['penalty_notes'],
            ]);
        }
        
        $booking->update(['status' => 'completed']);
        return back()->with('success', 'Return processed and booking completed.');
    }
}
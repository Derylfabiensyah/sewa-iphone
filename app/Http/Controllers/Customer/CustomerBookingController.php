<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Review;
use Illuminate\Http\Request;

class CustomerBookingController extends Controller
{
    public function index()
    {
        $bookings = auth()->user()->bookings()->with('payment', 'details.iphone')->latest()->get();
        return view('customer.bookings.index', compact('bookings'));
    }

    public function uploadPayment(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id()) abort(403);
        
        $request->validate([
            'proof_of_payment' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $path = $request->file('proof_of_payment')->store('payments', 'public');
        
        $booking->payment()->update([
            'proof_of_payment' => $path,
            'status' => 'pending' // Admin needs to verify
        ]);

        return back()->with('success', 'Payment proof uploaded successfully.');
    }

    public function review(Request $request, Booking $booking)
    {
        if ($booking->user_id !== auth()->id() || $booking->status !== 'completed') abort(403);

        $request->validate([
            'iphone_id' => 'required|exists:iphones,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'nullable|string',
        ]);

        Review::create([
            'user_id' => auth()->id(),
            'iphone_id' => $request->iphone_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);

        return back()->with('success', 'Review added successfully!');
    }
}
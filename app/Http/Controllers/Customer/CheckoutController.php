<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\BookingDetail;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function store(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $start_date = $request->session()->get('cart_start_date');
        $end_date = $request->session()->get('cart_end_date');

        if (empty($cart) || !$start_date || !$end_date) {
            return redirect()->route('home')->with('error', 'Cart is empty or dates not set.');
        }

        DB::transaction(function() use ($cart, $start_date, $end_date, $request) {
            $total_price = collect($cart)->sum('subtotal');

            $booking = Booking::create([
                'user_id' => auth()->id(),
                'start_date' => $start_date,
                'end_date' => $end_date,
                'total_price' => $total_price,
                'status' => 'waiting_payment',
            ]);

            foreach ($cart as $iphone_id => $item) {
                BookingDetail::create([
                    'booking_id' => $booking->id,
                    'iphone_id' => $iphone_id,
                    'subtotal' => $item['subtotal'],
                ]);
            }

            Payment::create([
                'booking_id' => $booking->id,
                'payment_method' => 'Bank Transfer',
                'amount' => $total_price,
                'payment_date' => now(),
            ]);
        });

        $request->session()->forget(['cart', 'cart_start_date', 'cart_end_date']);
        return redirect()->route('customer.bookings.index')->with('success', 'Booking created. Please upload payment proof.');
    }
}
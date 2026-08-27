<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Iphone;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function index(Request $request)
    {
        $cart = $request->session()->get('cart', []);
        $start_date = $request->session()->get('cart_start_date');
        $end_date = $request->session()->get('cart_end_date');
        return view('customer.cart', compact('cart', 'start_date', 'end_date'));
    }

    public function updateDates(Request $request)
    {
        $request->validate(['start_date' => 'required|date', 'end_date' => 'required|date|after_or_equal:start_date']);
        $request->session()->put('cart_start_date', $request->start_date);
        $request->session()->put('cart_end_date', $request->end_date);
        $request->session()->forget('cart'); // Clear cart on date change to ensure availability
        return back()->with('success', 'Rental dates set.');
    }

    public function add(Request $request, Iphone $iphone)
    {
        $start_date = $request->session()->get('cart_start_date');
        $end_date = $request->session()->get('cart_end_date');

        if (!$start_date || !$end_date) {
            return back()->with('error', 'Please set rental dates first.');
        }

        // Check availability
        $isBooked = \App\Models\BookingDetail::where('iphone_id', $iphone->id)
            ->whereHas('booking', function($q) use ($start_date, $end_date) {
                $q->where('status', '!=', 'cancelled')
                  ->where(function($q2) use ($start_date, $end_date) {
                      $q2->whereBetween('start_date', [$start_date, $end_date])
                         ->orWhereBetween('end_date', [$start_date, $end_date])
                         ->orWhere(function($q3) use ($start_date, $end_date) {
                             $q3->where('start_date', '<=', $start_date)->where('end_date', '>=', $end_date);
                         });
                  });
            })->exists();

        if ($isBooked) {
            return back()->with('error', 'iPhone is not available for the selected dates.');
        }

        $cart = $request->session()->get('cart', []);
        
        $days = \Carbon\Carbon::parse($start_date)->diffInDays(\Carbon\Carbon::parse($end_date)) + 1;
        
        if (!isset($cart[$iphone->id])) {
            $cart[$iphone->id] = [
                'name' => $iphone->name,
                'price' => $iphone->price_per_day,
                'subtotal' => $iphone->price_per_day * $days,
            ];
        }

        $request->session()->put('cart', $cart);
        return back()->with('success', 'Added to cart.');
    }

    public function remove(Request $request, $id)
    {
        $cart = $request->session()->get('cart', []);
        if (isset($cart[$id])) {
            unset($cart[$id]);
            $request->session()->put('cart', $cart);
        }
        return back()->with('success', 'Removed from cart.');
    }
}
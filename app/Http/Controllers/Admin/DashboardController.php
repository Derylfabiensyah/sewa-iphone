<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Iphone;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_iphones' => Iphone::count(),
            'total_bookings' => Booking::count(),
            'total_customers' => User::where('role', 'customer')->count(),
            'pending_payments' => Booking::where('status', 'waiting_payment')->count(),
        ];
        return view('admin.dashboard', compact('stats'));
    }
}
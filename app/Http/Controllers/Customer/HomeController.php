<?php
namespace App\Http\Controllers\Customer;
use App\Http\Controllers\Controller;
use App\Models\Iphone;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $iphones = Iphone::where('status', 'available')->get();
        return view('welcome', compact('iphones'));
    }
    
    public function show($id)
    {
        $iphone = Iphone::findOrFail($id);
        return view('customer.iphone_detail', compact('iphone'));
    }
}
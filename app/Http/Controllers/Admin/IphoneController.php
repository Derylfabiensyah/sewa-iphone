<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Iphone;
use Illuminate\Http\Request;

class IphoneController extends Controller
{
    public function index()
    {
        $iphones = Iphone::latest()->paginate(10);
        return view('admin.iphones.index', compact('iphones'));
    }

    public function create()
    {
        return view('admin.iphones.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'storage' => 'required|string',
            'color' => 'required|string',
            'price_per_day' => 'required|integer',
            'description' => 'nullable|string',
            'status' => 'required|in:available,maintenance',
        ]);
        
        Iphone::create($data);
        return redirect()->route('admin.iphones.index')->with('success', 'iPhone added!');
    }

    public function edit(Iphone $iphone)
    {
        return view('admin.iphones.edit', compact('iphone'));
    }

    public function update(Request $request, Iphone $iphone)
    {
        $data = $request->validate([
            'name' => 'required|string',
            'storage' => 'required|string',
            'color' => 'required|string',
            'price_per_day' => 'required|integer',
            'description' => 'nullable|string',
            'status' => 'required|in:available,maintenance',
        ]);
        $iphone->update($data);
        return redirect()->route('admin.iphones.index')->with('success', 'iPhone updated!');
    }

    public function destroy(Iphone $iphone)
    {
        $iphone->delete();
        return redirect()->route('admin.iphones.index')->with('success', 'iPhone deleted!');
    }
}
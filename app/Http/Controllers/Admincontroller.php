<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::all();
        return view('admin.dashboard', compact('products'));
    }

    public function store(Request $request)
    {
        $imagePath = 'images/default-book.png'; // Varsayılan görsel

        if ($request->hasFile('image')) {
            $filename = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $filename);
            $imagePath = 'images/' . $filename;
        }

        Product::create([
            'name' => $request->name,
            'description' => $request->description,
            'price' => $request->price,
            'image' => $imagePath,
            'is_sold' => 0,
             'admin_id' => Auth::id(),
        ]);

        return redirect()->back()->with('success', 'Kitap başarıyla eklendi.');
    }
    public function destroy($id)
{
    $product = Product::findOrFail($id);
    
    if ($product->image !== 'images/default-book.png' && file_exists(public_path($product->image))) {
        unlink(public_path($product->image));
    }

    $product->delete();

    return redirect()->back()->with('success', 'Kitap silindi.');
}
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $imagePath = $product->image; // Mevcut görsel

    if ($request->hasFile('image')) {
        $filename = time() . '.' . $request->image->extension();
        $request->image->move(public_path('images'), $filename);
        $imagePath = 'images/' . $filename;
    }

    $product->update([
        'name' => $request->name,
        'description' => $request->description,
        'price' => $request->price,
        'image' => $imagePath,
    ]);

    return redirect()->back()->with('success', 'Kitap başarıyla güncellendi.');
}


}

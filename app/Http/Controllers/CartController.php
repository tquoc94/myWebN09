<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    // Hiển thị giỏ hàng
    public function index()
    {
        $carts = Cart::with('product')
                     ->where('user_id', Auth::id())
                     ->get();

        return view('cart.index', compact('carts'));
    }

    // Thêm hoặc cập nhật số lượng trong giỏ
    public function add(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity'   => 'required|integer|min:1',
        ]);

        Cart::updateOrCreate(
            [
                'user_id'    => Auth::id(),
                'product_id' => $request->product_id,
            ],
            [
                // cộng dồn số lượng
                'quantity' => DB::raw('quantity + ' . $request->quantity),
            ]
        );

        return back()->with('success', 'Đã thêm vào giỏ!');
    }

    // Xóa item khỏi giỏ
    public function remove(Request $request, $id)
    {
        Cart::where('user_id', Auth::id())
            ->where('id', $id)
            ->delete();

        return back()->with('success', 'Đã xóa khỏi giỏ!');
    }
}

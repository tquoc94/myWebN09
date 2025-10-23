<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Hiển thị form checkout / review giỏ
    public function create()
    {
        $carts = Cart::with('product')->where('user_id', Auth::id())->get();
        return view('order.create', compact('carts'));
    }

    // Xử lý checkout tạo order + order_items
public function store(Request $request)
{
    $data = $request->validate([
      'recipient_name'    => 'required|string|max:255',
      'recipient_phone'   => 'required|string|max:20',
      'shipping_address'  => 'required|string|max:500',
      'note'              => 'nullable|string|max:1000',
    ]);

    $carts = Cart::with('product')->where('user_id', Auth::id())->get();
    if ($carts->isEmpty()) {
       return back()->with('error','Giỏ hàng trống!');
    }

    DB::transaction(function() use($carts, $data) {
        $total = $carts->sum(fn($c)=> $c->product->price * $c->quantity);

        $order = Order::create(array_merge($data, [
            'user_id'      => Auth::id(),
            'total_amount' => $total,
            'status'       => 'pending',
        ]));

        foreach ($carts as $c) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $c->product_id,
                'quantity'   => $c->quantity,
                'price_each' => $c->product->price,
            ]);
        }

        Cart::where('user_id', Auth::id())->delete();
    });

    return redirect()->route('order.index')->with('success','Đặt hàng thành công!');
}


    // Hiển thị lịch sử order
    public function index()
    {
        $orders = Order::with('orderItems.product')
                       ->where('user_id', Auth::id())
                       ->orderBy('created_at','desc')
                       ->get();
        return view('order.index', compact('orders'));
    }
    // Admin xem danh sách đơn hàng
    public function adminIndex(){
        $orders = Order::with('user')
        ->orderBy('created_at','desc')->paginate(15);
        return view('admin.orders.index', compact('orders'));
}
    // Admin xem chi tiết đơn hàng
    public function adminShow($id){
        $order = Order::with(['orderItems.product', 'user'])
        ->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->status = 'completed'; // Hoặc trạng thái khác tùy ý
        $order->save();

        return redirect()->route('admin.orders.index')->with('success', 'Cập nhật trạng thái đơn hàng thành công!');
    }
}

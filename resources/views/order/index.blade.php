@extends('layouts.app')

@section('title', 'Đơn hàng của tôi')

@section('content')
<style>
  h1 {
    font-size: 1.5rem;
    margin-bottom: 1rem;
  }

  .order-card {
    background-color: #fff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    border-radius: 8px;
    padding: 1rem 1.25rem;
    margin-bottom: 1.5rem;
  }

  .order-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 0.5rem;
  }

  .order-id {
    font-weight: 600;
  }

  .order-date {
    color: #6b7280; /* gray-600 */
    font-size: 0.875rem;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-bottom: 1rem;
  }

  th, td {
    text-align: left;
    padding: 0.5rem 0.75rem;
    border-bottom: 1px solid #e5e7eb; /* gray-200 */
  }

  th {
    background-color: #f9fafb; /* gray-50 */
    font-weight: 600;
  }

  tr:hover {
    background-color: #f3f4f6; /* gray-100 */
  }

  .total-amount {
    text-align: right;
    font-weight: 700;
  }

  p {
    font-size: 1rem;
    color: #374151; /* gray-700 */
  }
</style>

<h1>Đơn hàng của bạn</h1>

@if($orders->isEmpty())
    <p>Bạn chưa có đơn hàng nào.</p>
@else
    @foreach($orders as $order)
        <div class="order-card">
            <div class="order-header">
                <div class="order-id">Mã đơn: #{{ $order->id }}</div>
                <div class="order-date">{{ $order->created_at->format('d/m/Y H:i') }}</div>
            </div>
            <table>
                <thead>
                    <tr>
                        <th>Sản phẩm</th>
                        <th>Số lượng</th>
                        <th>Đơn giá</th>
                        <th>Thành tiền</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($order->orderItems as $item)
                        <tr>
                            <td>{{ $item->product->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <td>{{ number_format($item->price_each, 0, ',', '.') }}₫</td>
                            <td>{{ number_format($item->quantity * $item->price_each, 0, ',', '.') }}₫</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="total-amount">Tổng cộng: {{ number_format($order->total_amount, 0, ',', '.') }}₫</div>
        </div>
    @endforeach
@endif
@endsection

@extends('layouts.admin')

@section('content')
<style>
    body {
        background-color:rgb(145, 243, 121);
        font-family: 'Arial', sans-serif;
    }
    .order-details-container {
        max-width: 800px;
        margin: auto;
        background: rgb(206, 238, 203);
        border-radius: 12px;
        box-shadow: 0 8px 24px rgba(0, 0, 0, 0.05);
        padding: 30px;
    }

    .order-details-container h2 {
        font-weight: 700;
        color: #28a745;
        margin-bottom: 30px;
        text-align: center;
    }

    .order-table th {
        width: 30%;
        white-space: nowrap;
        color: #495057;
        background-color: #f8f9fa;
        font-weight: 600;
        padding: 12px;
        vertical-align: middle;
    }

    .order-table td {
        padding: 12px;
        vertical-align: middle;
    }

    .btn-back {
        display: inline-block;
        margin-top: 20px;
        background-color: #6c757d;
        color: white;
        padding: 8px 16px;
        border-radius: 6px;
        text-decoration: none;
        transition: 0.3s;
    }

    .btn-back:hover {
        background-color: #5a6268;
    }

    .badge-status {
        padding: 6px 12px;
        border-radius: 20px;
        font-weight: 500;
    }

    .badge-pending {
        background-color: #ffeeba;
        color: #856404;
    }

    .badge-completed {
        background-color: #c3e6cb;
        color: #155724;
    }

    .badge-other {
        background-color: #dee2e6;
        color: #343a40;
    }
</style>

<div class="order-details-container">
    <h2>Chi tiết đơn hàng #{{ $order->id }}</h2>

    <table class="table table-bordered order-table">
        <tbody>
            <tr>
                <th>👤 Tên người nhận</th>
                <td>{{ $order->recipient_name }}</td>
            </tr>
            <tr>
                <th>📞 Số điện thoại</th>
                <td>{{ $order->recipient_phone }}</td>
            </tr>
            <tr>
                <th>📍 Địa chỉ giao hàng</th>
                <td>{{ $order->shipping_address }}</td>
            </tr>
            <tr>
                <th>📝 Ghi chú</th>
                <td>{{ $order->note ?? '—' }}</td>
            </tr>
            <tr>
                <th>💵 Tổng tiền</th>
                <td><strong class="text-danger">{{ number_format($order->total_amount) }}₫</strong></td>
            </tr>
            <tr>
                <th>📦 Trạng thái</th>
                <td>
                    @if($order->status == 'pending')
                        <span class="badge-status badge-pending">Đang xử lý</span>
                    @elseif($order->status == 'completed' || $order->status == 'delivered')
                        <span class="badge-status badge-completed">Đã giao</span>
                    @else
                        <span class="badge-status badge-other">{{ ucfirst($order->status) }}</span>
                    @endif
                </td>
            </tr>
            <tr>
                <th>⏰ Ngày đặt</th>
                <td>{{ $order->created_at->format('d/m/Y H:i') }}</td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('admin.orders.index') }}" class="btn-back">
        ← Quay lại danh sách đơn hàng
    </a>
</div>
@endsection

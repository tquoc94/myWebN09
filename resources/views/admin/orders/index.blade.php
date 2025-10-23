@extends('layouts.admin')
@section('content')
<style>
    h1 {
        font-weight: 700;
        color: #218838;
        margin-bottom: 28px;
        text-align: center;
        letter-spacing: 0.04em;
    }
    table {
        width: 100%;
        border-collapse: separate;
        border-spacing: 0;
        background: #fff;
        border-radius: 12px;
        box-shadow: 0 3px 18px 0 #2ecc4010;
        overflow: hidden;
        margin-bottom: 24px;
    }
    th, td {
        padding: 14px 12px;
        text-align: center;
    }
    thead th {
        background: linear-gradient(100deg, #28a745 0%, #218838 100%);
        color: #fff;
        font-size: 16px;
        font-weight: 700;
        border-bottom: 2px solid #21883820;
    }
    tbody tr {
        transition: background 0.13s;
    }
    tbody tr:hover {
        background: #e9f9ef;
    }
    td {
        font-size: 15px;
        border-bottom: 1px solid #e6e6e6;
    }
    td:last-child, th:last-child {
        white-space: nowrap;
    }
    .btn-sm
    {
        padding: 6px 12px;
        font-size: 14px;
        font-weight: 600;
        color: #fff;
        background-color: #28a745;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        transition: background-color 0.2s, transform 0.1s;
    }
    /* Trạng thái màu */
    .status {
        display: inline-block;
        padding: 3px 14px;
        border-radius: 20px;
        font-size: 14px;
        font-weight: 600;
        background: #e8f5e9;
        color: #219150;
        border: 1px solid #b8e1be;
        letter-spacing: 0.01em;
    }
    .status.pending { background: #fff3cd; color: #856404; border-color: #ffeeba;}
    .status.completed { background: #c8e6c9; color: #256029; border-color: #b9efc5;}
    .status.canceled { background: #ffcdd2; color: #b71c1c; border-color: #e57373;}
    /* Responsive bảng */
    @media (max-width: 700px) {
        th, td { padding: 10px 4px; font-size: 13px; }
        h1 { font-size: 1.2rem; }
    }
</style>
<h1>Đơn hàng</h1>
<table>
  <thead>
    <tr>
      <th>#</th>
      <th>Khách</th>
      <th>Tổng</th>
      <th>Trạng thái</th>
      <th>Ngày đặt</th>
      <th>Thông tin</th>
      <th>Hành động</th>
    </tr>
  </thead>
  <tbody>
  @foreach($orders as $o)
    <tr>
      <td>{{ $o->id }}</td>
      <td>{{ $o->user->name }}</td>
      <td>{{ number_format($o->total_amount) }}₫</td>
      <td>
        <span class="status {{ strtolower($o->status) }}">
            {{ ucfirst($o->status) }}
        </span>
      </td>
      <td>{{ $o->created_at->format('d/m/Y H:i') }}</td>
      <td>
        <a href="{{ route('admin.orders.show', $o->id) }}" class="text-blue-600 hover:underline">Chi tiết</a>
      </td>
      <td>
            @if($o->status === 'pending')
        <form action="{{ route('admin.orders.updateStatus', $o->id) }}" method="POST" class="d-inline">
            @csrf
            @method('PATCH')
            <button type="submit" class="btn btn-success btn-sm">Đã giao</button>
        </form>
    @endif
      </td>
    </tr>
  @endforeach
  </tbody>
</table>
{{ $orders->links() }}
@endsection

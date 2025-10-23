@extends('layouts.app')
@section('title','Giỏ hàng')

@section('content')
<style>
  /* Styles cho bảng giỏ hàng */
  table {
    border-collapse: collapse;
    width: 100%;
    background-color: #fff;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }

  th, td {
    padding: 12px 15px;
    text-align: left;
    border-bottom: 1px solid #eee;
  }

  th {
    background-color: #f5f5f5;
    font-weight: 600;
  }

  tr:hover {
    background-color: #f9f9f9;
  }

  button.text-red-500 {
    background: none;
    border: none;
    color: #e3342f;
    cursor: pointer;
    font-weight: 600;
    transition: color 0.3s ease;
  }

  button.text-red-500:hover {
    color: #cc1f1a;
  }

  a.mt-4.inline-block {
    display: inline-block;
    margin-top: 1rem;
    background-color: #38a169; /* xanh lá */
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 6px;
    text-decoration: none;
    font-weight: 600;
    transition: background-color 0.3s ease;
  }

  a.mt-4.inline-block:hover {
    background-color: #2f855a;
  }
</style>

<h1 class="text-2xl mb-4">Giỏ hàng của bạn</h1>

@if($carts->isEmpty())
  <p>Giỏ trống rồi!</p>
@else
  <table>
    <tr><th>SP</th><th>Qty</th><th>Giá</th><th>Thao tác</th></tr>
    @foreach($carts as $c)
      <tr>
        <td>{{ $c->product->name }}</td>
        <td>{{ $c->quantity }}</td>
        <td>{{ number_format($c->product->price * $c->quantity,0,',','.') }}₫</td>
        <td>
          <form action="{{ route('cart.remove',$c->id) }}" method="POST" class="remove-form">
            @csrf
            <button class="text-red-500">Xóa</button>
          </form>
        </td>
      </tr>
    @endforeach
  </table>
  <a href="{{ route('order.create') }}" class="mt-4 inline-block">Thanh toán</a>
@endif

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const removeForms = document.querySelectorAll('form.remove-form');

    removeForms.forEach(form => {
      form.addEventListener('submit', function(e) {
        e.preventDefault();

        if (confirm('Bạn có chắc muốn xóa sản phẩm này khỏi giỏ hàng?')) {
          form.submit();
        }
      });
    });
  });
</script>
@endsection

@extends('layouts.app')
@section('title', $product->name)

@section('content')
<style>
  /* Đồng bộ với style chung */
  .flex {
    display: flex;
  }
  .gap-6 {
    gap: 1.5rem;
  }
  .w-1\/3 {
    width: 33.3333%;
  }
  .w-2\/3 {
    width: 66.6667%;
  }
  .object-cover {
    object-fit: cover;
  }
  h1 {
    font-weight: 700;
    margin-bottom: 0.5rem;
    font-size: 1.875rem; /* text-3xl */
  }
  p {
    margin-bottom: 1rem;
  }
  .text-red-600 {
    color: #dc2626;
  }
  .text-2xl {
    font-size: 1.5rem;
    line-height: 2rem;
  }
  input[type="number"] {
    border: 1px solid #e0e7ef;
    border-radius: 6px;
    padding: 4px 8px;
    font-size: 1rem;
    width: 80px;
    margin-right: 1rem;
    outline: none;
    transition: border-color 0.2s;
  }
  input[type="number"]:focus {
    border-color: #16a34a;
  }
  button {
    background-color: #2563eb;
    color: white;
    padding: 0.5rem 1rem;
    border-radius: 8px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.2s ease;
    border: none;
  }
  button:hover {
    background-color: #1d4ed8;
  }

  /* Responsive mobile */
  @media (max-width: 768px) {
    .flex {
      flex-direction: column;
    }
    .w-1\/3, .w-2\/3 {
      width: 100%;
    }
    input[type="number"] {
      width: 100%;
      margin-bottom: 1rem;
      margin-right: 0;
    }
    button {
      width: 100%;
    }
  }
</style>

<div class="flex gap-6">
  <img
    src="{{ asset('storage/' . $product->image) }}"
    alt="{{ $product->name }}"
    class="w-1/3 object-cover rounded shadow"
    style="max-height:400px; width:auto;"
  >
  <div class="w-2/3">
    <h1>{{ $product->name }}</h1>
    <p class="text-red-600 text-2xl font-semibold">{{ number_format($product->price,0,',','.') }}₫</p>
    <p>{{ $product->description }}</p>
    @auth
    <form action="{{ route('cart.add') }}" method="POST" class="flex flex-wrap items-center gap-2">
      @csrf
      <input type="hidden" name="product_id" value="{{ $product->id }}">
      <input type="number" name="quantity" value="1" min="1" aria-label="Số lượng sản phẩm">
      <button type="submit">Thêm vào giỏ</button>
    </form>
    @else
      <a href="{{ route('login') }}" class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-semibold px-4 py-2 rounded">
        Đăng nhập để mua hàng
      </a>
    @endauth
  </div>
</div>
@endsection

@extends('layouts.app')

@section('title', 'Danh sách sản phẩm')

{{-- CSS giống giao diện trước --}}
<style>
body {
    background: linear-gradient(120deg, rgb(237, 240, 238) 0%, rgb(229, 248, 208) 100%) !important;
    font-family: 'Segoe UI', Arial, sans-serif;
}
h1 {
    color: #16a34a;
    font-weight: 700;
    margin-bottom: 1.5rem;
}
.flex-between {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 2rem;
    padding-left: 2rem;
    padding-right: 2rem;
    margin-left: auto;
    margin-right: auto;
    max-width: 1500px;
    box-sizing: border-box;
}
.product-card {
    background: #fff;
    border-radius: 14px;
    box-shadow: 0 4px 18px rgba(0,0,0,0.09);
    transition: box-shadow 0.22s, transform 0.2s;
    display: flex;
    flex-direction: column;
    justify-content: space-between;
    min-height: 320px;
    padding: 1.25rem;
}
.product-card:hover {
    box-shadow: 0 8px 36px rgba(22,163,74,0.15);
    transform: translateY(-4px) scale(1.04);
}
.font-semibold { font-weight: 600; }
.text-red-500 { color: #ef4444; }
.text-white { color: #fff !important; }
.bg-green-600 { background: #16a34a; transition: background 0.22s; }
.bg-green-600:hover { background: #15803d !important; }
.bg-blue-600 { background: #2563eb; }
.bg-blue-600:hover { background: #1d4ed8 !important; }
.rounded { border-radius: 8px; }
.shadow { box-shadow: 0 2px 8px rgba(0,0,0,0.07); }
.mt-4 { margin-top: 1rem; }
.w-full { width: 100%; }
.h-32 { height: 128px; }
.object-cover { object-fit: cover; }
input[type="number"] {
    border: 1px solid #e0e7ef;
    border-radius: 6px;
    padding: 4px 8px;
    font-size: 1rem;
    width: 56px;
    margin-bottom: 6px;
    text-align: center;
    outline: none;
    transition: border-color 0.2s;
}
input[type="number"]:focus {
    border-color: #16a34a;
}
button, a {
    font-size: 1rem;
    cursor: pointer;
}
.card-anim {
    animation: cardHighlight 0.6s;
}
@keyframes cardHighlight {
    0% { box-shadow: 0 0 0 0 #b0ff5770; }
    60% { box-shadow: 0 0 0 12px #b0ff5770; }
    100% { box-shadow: 0 2px 8px rgba(0,0,0,0.09); }
}
</style>

@section('content')
<h1 class="text-2xl mb-4">Danh sách sản phẩm nhập khẩu</h1>

@auth
  <div class="flex-between mb-6">
    <a href="{{ route('cart.index') }}"
       class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-medium px-5 py-2 rounded shadow">
      🛒 Xem giỏ hàng ({{ \App\Models\Cart::where('user_id', auth()->id())->count() }})
    </a>
    <div>
      {{ $products->links() }}
    </div>
  </div>
@else
  <div class="mb-6">
    {{ $products->links() }}
  </div>
@endauth

<div class="grid">
  @foreach($products as $index => $p)
    @php
        $demoImages = [
            'https://images.unsplash.com/photo-1504674900247-0877df9cc836?auto=format&fit=crop&w=400&q=80',
            'https://images.unsplash.com/photo-1511690743698-d9d85f2fbf38?auto=format&fit=crop&w=400&q=80',
            'https://images.unsplash.com/photo-1465101162946-4377e57745c3?auto=format&fit=crop&w=400&q=80',
            'https://images.unsplash.com/photo-1502741338009-cac2772e18bc?auto=format&fit=crop&w=400&q=80',
        ];
        $image = $p->image_path
            ? asset('storage/products/'.$p->image_path)
            : $demoImages[$index % count($demoImages)];
    @endphp
    <div class="product-card">
      <a href="{{ route('product.show', $p->slug) }}">
        <img
          src="{{ $image }}"
          alt="{{ $p->name }}"
          class="w-full h-32 object-cover mb-2"
        >
        <h2 class="font-semibold">{{ $p->name }}</h2>
        <p class="text-red-500">{{ number_format($p->price,0,',','.') }}₫</p>
      </a>
      @auth
        <form action="{{ route('cart.add') }}" method="POST" class="mt-4 cart-form">
          @csrf
          <input type="hidden" name="product_id" value="{{ $p->id }}">
          <input type="number" name="quantity" value="1" min="1" class="w-16 border p-1 inline">
          <button class="w-full bg-green-600 hover:bg-green-700 text-white py-2 rounded">
            Thêm vào giỏ hàng
          </button>
        </form>
      @else
        <a href="{{ route('login') }}" class="mt-4 block bg-blue-600 hover:bg-blue-700 text-white text-center py-2 rounded">
          Thêm vào giỏ hàng
        </a>
      @endauth
    </div>
  @endforeach
</div>

@auth
  <div class="mt-6 flex justify-between items-center">
    
    <div>
      {{ $products->links() }}
    </div>
  </div>
@else
  <div class="mt-6">
    {{ $products->links() }}
  </div>
@endauth
@endsection

{{-- JS hiệu ứng cho card --}}
@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.cart-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            const card = form.closest('.product-card');
            if (card) {
                card.classList.add('card-anim');
                setTimeout(() => card.classList.remove('card-anim'), 700);
            }
        });
    });
});
</script>
@endpush

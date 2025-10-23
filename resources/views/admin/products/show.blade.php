@extends('layouts.admin')

@section('content')
<style>
    .product-detail-container {
        max-width: 600px;
        margin: 40px auto 0 auto;
        padding: 34px 28px 24px 28px;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 6px 24px 0 #28a74518;
        border: 1.2px solid #e3e3e3;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .product-title {
        font-weight: 800;
        color: #218838;
        text-align: center;
        margin-bottom: 28px;
        font-size: 2rem;
        letter-spacing: 0.02em;
    }
    .product-info p {
        font-size: 1.08rem;
        margin-bottom: 13px;
        line-height: 1.55;
        color: #222;
    }
    .product-info strong {
        color: #4e852e;
        min-width: 85px;
        display: inline-block;
    }
    .product-price {
        color: #d35400;
        font-weight: 700;
        font-size: 1.2rem;
        letter-spacing: 0.03em;
    }
    .product-img {
        display: block;
        max-width: 340px;
        max-height: 300px;
        width: 100%;
        margin: 22px auto 0 auto;
        border-radius: 13px;
        box-shadow: 0 3px 16px #28a74518;
        border: 1.5px solid #e3e3e3;
        object-fit: cover;
    }
    @media (max-width: 600px) {
        .product-detail-container {padding: 15px 2vw;}
        .product-title {font-size: 1.2rem;}
        .product-img {max-width: 95vw; max-height: 210px;}
    }
</style>
<div class="product-detail-container">
    <div class="product-title">{{ $product->name }}</div>
    <div class="product-info">
        <p><strong>Danh mục:</strong> {{ $product->category->name }}</p>
        <p class="product-price"><strong>Giá:</strong> {{ number_format($product->price) }} VND</p>
        <p><strong>Mô tả:</strong> {!! nl2br(e($product->description)) !!}</p>
    </div>
    @if ($product->image)
        <img src="{{ Storage::url($product->image) }}" alt="Product Image" class="product-img">
    @endif
</div>
@endsection

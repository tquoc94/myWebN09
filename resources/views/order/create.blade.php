@extends('layouts.app')
@section('title','Đặt hàng')

@section('content')
<style>
  form {
    max-width: 600px;
    margin: 20px auto;
    background: #fff;
    padding: 20px;
    border-radius: 8px;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
  }

  label.block {
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
  }

  input[type="text"],
  textarea {
    width: 100%;
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 6px;
    font-size: 1rem;
    box-sizing: border-box;
  }

  textarea {
    min-height: 80px;
    resize: vertical;
  }

  .mb-4 {
    margin-bottom: 1rem;
  }

  button {
    background-color: #2563eb; /* blue-600 */
    color: white;
    padding: 0.5rem 1.5rem;
    border: none;
    border-radius: 6px;
    font-weight: 600;
    cursor: pointer;
    transition: background-color 0.3s ease;
  }

  button:hover {
    background-color: #1d4ed8; /* blue-700 */
  }

  /* Hiển thị lỗi */
  .error-message {
    color: #dc2626; /* red-600 */
    font-size: 0.9rem;
    margin-top: 4px;
  }
</style>

<h1 class="text-2xl mb-4">Đặt hàng</h1>

<form action="{{ route('order.store') }}" method="POST" id="orderForm" novalidate>
  @csrf

  <div class="mb-4">
    <label class="block" for="recipient_name">Tên người nhận</label>
    <input type="text" name="recipient_name" id="recipient_name" required value="{{ old('recipient_name') }}">
    @error('recipient_name')
      <div class="error-message">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-4">
    <label class="block" for="recipient_phone">Số điện thoại</label>
    <input type="text" name="recipient_phone" id="recipient_phone" required value="{{ old('recipient_phone') }}">
    @error('recipient_phone')
      <div class="error-message">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-4">
    <label class="block" for="shipping_address">Địa chỉ giao hàng</label>
    <textarea name="shipping_address" id="shipping_address" required>{{ old('shipping_address') }}</textarea>
    @error('shipping_address')
      <div class="error-message">{{ $message }}</div>
    @enderror
  </div>

  <div class="mb-4">
    <label class="block" for="note">Ghi chú (tuỳ chọn)</label>
    <textarea name="note" id="note">{{ old('note') }}</textarea>
  </div>

  <button type="submit">Đặt hàng</button>
</form>

<script>
  document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('orderForm');

    form.addEventListener('submit', (e) => {
      // Clear old errors
      const errors = form.querySelectorAll('.error-message');
      errors.forEach(el => el.remove());

      let valid = true;

      // Validate recipient_name
      const name = form.recipient_name.value.trim();
      if (name.length === 0) {
        showError('recipient_name', 'Vui lòng nhập tên người nhận');
        valid = false;
      }

      // Validate recipient_phone (simple pattern)
      const phone = form.recipient_phone.value.trim();
      const phonePattern = /^[0-9\+\-\s]{9,15}$/;
      if (!phonePattern.test(phone)) {
        showError('recipient_phone', 'Số điện thoại không hợp lệ');
        valid = false;
      }

      // Validate shipping_address
      const address = form.shipping_address.value.trim();
      if (address.length === 0) {
        showError('shipping_address', 'Vui lòng nhập địa chỉ giao hàng');
        valid = false;
      }

      if (!valid) e.preventDefault();

      function showError(fieldName, message) {
        const field = form[fieldName];
        const error = document.createElement('div');
        error.classList.add('error-message');
        error.textContent = message;
        field.parentNode.appendChild(error);
      }
    });
  });
</script>
@endsection

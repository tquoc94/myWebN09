@extends('layouts.admin')

@section('content')
<style>
    .main-form-container {
        max-width: 520px;
        margin: 32px auto;
        padding: 34px 28px 28px 28px;
        background: #fff;
        border-radius: 18px;
        box-shadow: 0 6px 24px 0 #28a74518;
        border: 1.2px solid #e3e3e3;
        font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    }
    .form-title {
        font-weight: 800;
        color: #218838;
        text-align: center;
        margin-bottom: 32px;
        letter-spacing: 0.02em;
    }
    .floating-group {
        position: relative;
        margin-bottom: 29px;
    }
    .floating-group .form-control {
        width: 100%;
        padding: 18px 13px 12px 13px;
        font-size: 16.5px;
        border: 1.8px solid #c6c6c6;
        border-radius: 10px;
        background: #f8fdfa;
        transition: border-color 0.3s, box-shadow 0.3s;
        outline: none;
        box-sizing: border-box;
        resize: none;
    }
    .floating-group .form-control:focus {
        border-color: #28a745;
        background: #fff;
        box-shadow: 0 0 0 2px #28a74530;
    }
    .floating-group label.floating-label {
        position: absolute;
        top: 15px;
        left: 15px;
        font-size: 16.5px;
        color: #909090;
        font-weight: 500;
        background: #fff;
        padding: 0 6px;
        border-radius: 4px;
        pointer-events: none;
        transition: 0.18s cubic-bezier(.4,0,.2,1);
        z-index: 2;
        letter-spacing: 0.01em;
    }
    /* Khi input có dữ liệu hoặc focus thì label nổi lên */
    .floating-group .form-control:focus + label.floating-label,
    .floating-group .form-control:not(:placeholder-shown) + label.floating-label,
    .floating-group select.form-control.selected + label.floating-label {
        top: -11px;
        left: 10px;
        font-size: 13.5px;
        color: #218838;
        font-weight: 700;
        background: #fff;
        border-left: 2px solid #28a74525;
        border-right: 2px solid #28a74525;
        padding: 0 8px;
    }
    /* Dành riêng cho select vì ko có :placeholder-shown */
    .floating-group select.form-control {
        padding-top: 18px;
        padding-bottom: 8px;
        background: #f8fdfa;
        appearance: none;
        -webkit-appearance: none;
        -moz-appearance: none;
    }
    /* Custom arrow select */
    .floating-group select.form-control {
        background-image:
          linear-gradient(45deg, transparent 50%, #218838 50%),
          linear-gradient(135deg, #218838 50%, transparent 50%),
          linear-gradient(to right, #ccc, #ccc);
        background-position:
          calc(100% - 20px) calc(1.1em + 1px),
          calc(100% - 15px) calc(1.1em + 1px),
          calc(100% - 25px) 0.8em;
        background-size: 6px 6px, 6px 6px, 1px 1.7em;
        background-repeat: no-repeat;
    }
    /* File input đẹp */
    input[type="file"].form-control {
        padding: 10px 13px;
        background: #f8fdfa;
    }
    /* Nút submit xịn sò */
    .btn-success {
        width: 100%;
        padding: 15px 0;
        font-size: 20px;
        border-radius: 12px;
        background: linear-gradient(100deg, #34ce57 0%, #218838 100%);
        border: none;
        color: #fff;
        font-weight: 800;
        cursor: pointer;
        box-shadow: 0 4px 16px 0 #28a7451f;
        transition: background 0.2s, transform 0.2s;
        margin-top: 12px;
        letter-spacing: 0.04em;
    }
    .btn-success:hover {
        background: linear-gradient(100deg, #218838 0%, #155f31 100%);
        transform: translateY(-2px) scale(1.02);
    }
    /* Validation */
    .error-msg {
        color: #dc3545;
        font-size: 13px;
        margin-top: 3px;
        font-style: italic;
        display: none;
    }
    @media (max-width: 600px) {
        .main-form-container {padding: 15px 4vw;}
        .form-title {font-size: 1.3rem;}
        .btn-success {font-size: 1rem;}
    }
</style>

<div class="main-form-container">
    <h2 class="form-title">Tạo sản phẩm mới</h2>

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" autocomplete="off" novalidate>
        @csrf

        <div class="floating-group">
            <input type="text" class="form-control" name="name" id="name" value="{{ old('name') }}" required placeholder=" " autocomplete="off">
            <label for="name" class="floating-label">Tên sản phẩm</label>
        </div>

        <div class="floating-group">
            <input type="text" class="form-control" name="slug" id="slug" value="{{ old('slug') }}" required placeholder=" " autocomplete="off">
            <label for="slug" class="floating-label">Số lượng</label>
        </div>

        <div class="floating-group">
            <select name="category_id" id="category_id" class="form-control" required>
                <option value="" disabled {{ old('category_id') ? '' : 'selected' }}>Chọn danh mục</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}
                    </option>
                @endforeach
            </select>
            <label for="category_id" class="floating-label">Danh mục</label>
        </div>

        <div class="floating-group">
            <input type="number" class="form-control" name="price" id="price" value="{{ old('price') }}" required placeholder=" " min="0" step="any" autocomplete="off">
            <label for="price" class="floating-label">Giá</label>
        </div>

        <div class="floating-group">
            <textarea class="form-control" name="description" id="description" rows="4" placeholder=" ">{{ old('description') }}</textarea>
            <label for="description" class="floating-label">Mô tả</label>
        </div>

        <div class="floating-group">
            <input type="file" class="form-control" name="image" id="image" accept="image/*">
            <label for="image" class="floating-label">Ảnh sản phẩm</label>
        </div>

        <button type="submit" class="btn btn-success">Lưu sản phẩm</button>
    </form>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Floating label cho select (do select không có :placeholder-shown)
    var categorySelect = document.getElementById('category_id');
    function updateSelectLabel() {
        if (categorySelect.value) {
            categorySelect.classList.add('selected');
        } else {
            categorySelect.classList.remove('selected');
        }
    }
    categorySelect.addEventListener('change', updateSelectLabel);
    updateSelectLabel();


    var nameInput = document.getElementById('name');
    
    function slugify(text) {
        return text.toString().toLowerCase()
            .trim()
            .normalize('NFD')
            .replace(/[\u0300-\u036f]/g, '')
            .replace(/\s+/g, '-')
            .replace(/[^\w\-]+/g, '')
            .replace(/\-\-+/g, '-');
    }
    nameInput.addEventListener('input', function() {
        slugInput.value = slugify(this.value);
    });
});
</script>
@endsection

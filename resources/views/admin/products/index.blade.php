@extends('layouts.admin')

@section('content')
    <style>
        body {
            background: #f4f6fa;
        }
        .products-container {
            max-width: 980px;
            margin: 32px auto;
            background: #fff;
            border-radius: 18px;
            box-shadow: 0 6px 24px rgba(36, 62, 120, 0.09);
            padding: 32px 28px 20px 28px;
        }
        h1 {
            text-align: center;
            color: #23497c;
            font-weight: bold;
            margin-bottom: 26px;
            letter-spacing: 1.5px;
            font-size: 2rem;
        }
        .btn-primary {
            background: linear-gradient(90deg,#23497c,#466ac8 85%);
            border: none;
            font-weight: 600;
            padding: 9px 22px;
            margin-bottom: 16px;
            border-radius: 8px;
            transition: background 0.2s;
        }
        .btn-primary:hover {
            background: linear-gradient(90deg,#163366,#466ac8 85%);
        }
        .alert-success {
            margin: 10px 0 24px 0;
            border-radius: 8px;
            font-weight: 500;
            font-size: 1rem;
            padding: 13px 20px;
            text-align: center;
            background: #eaf6f0;
            color: #1a5b39;
            border: 1px solid #a8e1bf;
        }
        .table {
            margin-bottom: 0;
            border-radius: 9px;
            overflow: hidden;
            background: #fff;
            box-shadow: 0 2px 8px rgba(33, 62, 120, 0.05);
        }
        .table th {
            background: #f0f4fa;
            color: #23497c;
            font-weight: bold;
            font-size: 1.04rem;
            padding-top: 15px;
            padding-bottom: 15px;
        }
        .table th, .table td {
            text-align: center;
            vertical-align: middle !important;
        }
        .table td {
            font-size: 1rem;
            padding: 12px 0;
        }
        .badge-category {
            background: #f4e3be;
            color: #a97507;
            border-radius: 20px;
            padding: 6px 14px;
            font-size: 0.97rem;
            font-weight: 500;
            letter-spacing: 0.5px;
            display: inline-block;
            min-width: 85px;
        }
        .btn {
            min-width: 84px;
            font-size: 0.99rem;
            border-radius: 8px;
        }
        .btn-warning {
            background: #ffc107;
            color: #23497c;
            border: none;
            font-weight: 600;
            margin-right: 6px;
            box-shadow: none;
        }
        .btn-warning:hover {
            background: #e7a900;
            color: #fff;
        }
        .btn-danger {
            background: #e74c3c;
            color: #fff;
            border: none;
            font-weight: 600;
            box-shadow: none;
        }
        .btn-danger:hover {
            background: #c0392b;
        }
        .pagination {
            justify-content: center;
            margin-top: 26px;
        }
        /* Responsive chỉnh cho mobile đẹp hơn */
        @media (max-width: 700px) {
            .products-container {
                padding: 14px 4px 12px 4px;
            }
            h1 {
                font-size: 1.13rem;
                margin-bottom: 13px;
            }
            .table th, .table td {
                font-size: 0.93rem;
                padding: 7px 2px;
            }
            .btn {
                min-width: 72px;
                font-size: 0.91rem;
                padding: 6px 5px;
            }
        }
    </style>

    <div class="products-container">
        <h1>Danh sách sản phẩm</h1>

        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <div class="d-flex justify-content-end mb-3">
            <a href="{{ route('admin.products.create') }}" class="btn btn-primary">+ Tạo sản phẩm mới</a>
        </div>

        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th>Tên sản phẩm</th>
                        <th>Danh mục</th>
                        <th>Giá</th>
                        <th>Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            <td style="font-weight: 500;">{{ $product->name }}</td>
                            <td>
                                <span class="badge-category">{{ $product->category->name }}</span>
                            </td>
                            <td style="color: #166f36; font-weight: 600;">{{ number_format($product->price) }} VND</td>
                            <td>
                                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
                                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display: inline;" class="delete-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Xóa</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $products->links() }}
    </div>
@endsection

@push('scripts')
<script>
    // Xác nhận khi bấm nút Xóa
    document.querySelectorAll('.delete-form').forEach(function(form) {
        form.addEventListener('submit', function(e) {
            if (!confirm('Bạn chắc chắn muốn xóa sản phẩm này?')) {
                e.preventDefault();
            }
        });
    });
</script>
@endpush

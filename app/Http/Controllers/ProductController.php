<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // 1️⃣ Hiển thị list sản phẩm (trang chủ)
    public function index(Request $request)
    {
        // build query
        $query = Product::with('category');

        // filter theo category nếu URL có ?category=slug
        if ($slug = $request->query('category')) {
            $query->whereHas('category', fn($q) => $q->where('slug', $slug));
        }

        // phân trang 12/sp/trang
        $products = $query->orderBy('created_at','desc')->paginate(12);

        // trả view resources/views/products/index.blade.php
        return view('products.index', compact('products'));
    }
    public function importedFruits()
    {
        // Lấy danh sách sản phẩm nhập khẩu
        $products = Product:: where('category_id', 1)->paginate(12);

        // Trả về view với danh sách sản phẩm
        return view('products.imported', compact('products'));

    }
    public function localFruits()
    {
        // Lấy danh sách sản phẩm Việt Nam
        $products = Product::where('category_id', 2)->paginate(12);

        // Trả về view với danh sách sản phẩm
        return view('products.local', compact('products'));
    }
    public function search(Request $request)
    {
        // Lấy từ khóa tìm kiếm từ yêu cầu
        $searchTerm = $request->input('search');

        // Kiểm tra nếu từ khóa tìm kiếm có ít nhất 3 ký tự
        if (strlen($searchTerm) >= 3) {
            // Tìm kiếm sản phẩm có tên gần giống với từ khóa, sử dụng 'like' để tìm kiếm gần đúng
            $products = Product::where('name', 'like', '%' . $searchTerm . '%')
                               ->paginate(12);  // Lấy tất cả sản phẩm có tên gần giống

            return view('products.search', compact('products', 'searchTerm'));  // Trả về view với danh sách sản phẩm
        } else {
            return redirect()->route('home')->with('error', 'Từ khóa tìm kiếm quá ngắn.');
        }
    }
    public function promotion()
    {
        $products = Product::where('category_id', 1)->paginate(12);
        // Trả về view với danh sách sản,  phẩm khuyến mãi
        return view('products.promotion', compact('products'));
    }

    // 2️⃣ Hiển thị form tạo (chỉ admin, sau này)
    public function create()
    {
        // TODO: load category list, trả view form admin
        // Lấy danh sách các category để chọn khi tạo sản phẩm mới
        $categories = Category::all();

        // Trả về view form tạo sản phẩm với danh sách category
        return view('admin.products.create', compact('categories'));
    }

    // 3️⃣ Lưu product mới (chỉ admin)
    public function store(Request $request)
    {
        // TODO: validate + lưu vào DB
         // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug',
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096', // Giới hạn kích thước ảnh tối đa 4MB
        ]);

        // Lưu thông tin sản phẩm vào DB
        $product = new Product();
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->description = $request->description;

        // Xử lý ảnh nếu có
        if ($request->hasFile('image')) {
            // Tạo tên ảnh duy nhất
            $imageName = time() . '-' . $request->file('image')->getClientOriginalName();
            
            // Lưu ảnh vào thư mục 'public/products' trong 'storage/app'
            $imagePath = $request->file('image')->storeAs('products', $imageName);
            
            // Lưu đường dẫn ảnh vào cơ sở dữ liệu
            $product->image = 'products/' . $imageName; // Lưu đường dẫn tương đối
        }
        $product->save();

        // Redirect về trang danh sách sản phẩm
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được tạo thành công!');
    }

    // 4️⃣ Hiển thị chi tiết 1 sản phẩm
    public function show($slug)
    {
        $product = Product::with('category')->where('slug', $slug)->firstOrFail();
        return view('products.show', compact('product'));
    }

    // 5️⃣ Hiển thị form edit (chỉ admin)
    public function edit($id)
    {
        // TODO: load product + categories, view form
        // Lấy thông tin sản phẩm và danh sách category để chỉnh sửa
        $product = Product::findOrFail($id);
        $categories = Category::all();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    // 6️⃣ Cập nhật product (chỉ admin)
    public function update(Request $request, $id)
    {
        // TODO: validate + update DB
        // Validate dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:products,slug,' . $id,
            'category_id' => 'required|exists:categories,id',
            'price' => 'required|numeric',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Tìm sản phẩm cần cập nhật
        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->slug = $request->slug;
        $product->category_id = $request->category_id;
        $product->price = $request->price;
        $product->description = $request->description;

        // Xử lý ảnh nếu có
        if ($request->hasFile('image')) {
            // Xóa ảnh cũ nếu có
            if ($product->image) {
                unlink(storage_path('app/' . $product->image));
            }
            $imagePath = $request->file('image')->store('public/products');
            $product->image = $imagePath;
        }

        // Lưu sản phẩm
        $product->save();

        // Redirect về trang chi tiết sản phẩm
        return redirect()->route('admin.products.show', $product->slug)->with('success', 'Sản phẩm đã được cập nhật thành công!');
    }

    // 7️⃣ Xóa product (chỉ admin)
    public function destroy($id)
    {
        // TODO: delete and redirect
        // Redirect về trang danh sách sản phẩm
          $product = Product::findOrFail($id);

        // Xóa ảnh nếu có
        if ($product->image) {
        // Xóa file ảnh khỏi thư mục lưu trữ
        Storage::delete($product->image);
        }
        $product->delete();
        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được xóa thành công!');
    }
}

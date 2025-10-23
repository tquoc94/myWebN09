<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;

class AdminController extends Controller
{
    public function index()
    {
        $products = Product::with('category')->orderBy('created_at', 'desc')->paginate(12);
        // Trả về view admin.products.index
        return view('admin.products.index', compact('products'));
    }
}

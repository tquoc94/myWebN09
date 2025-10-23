<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {

        // Tạo 3 sản phẩm mẫu
        Product::create([
            'category_id'  => 1,
            'name'         => 'Táo Envy Mỹ',
            'slug'         => 'tao-envy-my',
            'price'        => 99000,
            'image_path'   => 'tao-envy.jpg',
            'stock'        => 100,
            'description'  => 'Táo Envy nhập khẩu từ Mỹ, giòn ngọt, ăn tươi hoặc làm salad đều tuyệt.',
        ]);
        Product::create([
            'category_id'  => 2,
            'name'         => 'Dâu tây Mỹ',
            'slug'         => 'dau-tay-my',
            'price'        => 159000,
            'image_path'   => 'dau-tay.jpg',
            'stock'        => 50,
            'description'  => 'Dâu tây tươi nhập khẩu, căng mọng, vị ngọt thanh, phù hợp làm sinh tố.',
        ]);
        Product::create([
            'category_id'  => 1,
            'name'         => 'Nho đen Úc',
            'slug'         => 'nho-den-uc',
            'price'        => 125000,
            'image_path'   => 'nho-den.jpg',
            'stock'        => 80,
            'description'  => 'Nho đen Úc không hạt, ngọt đậm, size lớn, bảo quản dễ dàng.',
        ]);
        Product::create([
            'category_id'  => 3,
            'name'         => 'Cam sành Việt Nam',
            'slug'         => 'cam-sanh-vn',
            'price'        => 30000,
            'image_path'   => 'cam-sanh.jpg',
            'stock'        => 200,
            'description'  => 'Cam sành Việt Nam, vị ngọt thanh, giàu vitamin C, rất tốt cho sức khỏe.',
        ]);
    }
}

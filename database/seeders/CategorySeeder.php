<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
public function run() {
    \App\Models\Category::insert([
        ['name'=>'Hoa quả nhập khẩu','slug'=>'hoa-qua-nhap-khau','created_at'=>now(),'updated_at'=>now()],
        ['name'=>'Hoa quả Việt Nam','slug'=>'hoa-qua-viet-nam','created_at'=>now(),'updated_at'=>now()],
        // … thêm mấy dòng nữa
    ]);
}

}

<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::insert([
            [
                'name' => 'Trái cây & rau củ',
                'slug' => Str::slug('Trái cây & rau củ'),
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Hải sản',
                'slug' => Str::slug('Hải sản'),
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Thực phẩm tiện lợi',
                'slug' => Str::slug('Thực phẩm tiện lợi'),
                'show_at_home' => 1,
                'status' => 1
            ],
            [
                'name' => 'Bơ, trứng & sữa',
                'slug' => Str::slug('Bơ, trứng & sữa'),
                'show_at_home' => 1,
                'status' => 1
            ]
        ]);
    }
}

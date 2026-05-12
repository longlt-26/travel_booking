<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use App\Models\Tour;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'test@example.com'],
            ['name' => 'Test User', 'password' => bcrypt('password')]
        );

        $category = Category::firstOrCreate(
            ['slug' => 'tour-bien'],
            ['name' => 'Tour Biển']
        );

        Tour::create([
            'category_id' => $category->id,
            'title' => 'Tour Hạ Long 2 ngày 1 đêm',
            'description' => 'Khám phá vẻ đẹp kỳ quan thiên nhiên thế giới...',
            'price' => 2500000,
            'max_people' => 15,
            'location' => 'Quảng Ninh',
        ]);
        
        $this->command->info('Da tao Tour thanh cong!');
    }
}
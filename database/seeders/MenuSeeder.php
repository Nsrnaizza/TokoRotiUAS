<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Menu;

class MenuSeeder extends Seeder
{
    public function run()
    {
        Menu::create(['name' => 'Sourdough Bread', 'description' => 'Tasty sourdough with crunchy crust', 'price' => 30000, 'category' => 'Bread', 'image' => null]);
        Menu::create(['name' => 'Chocolate Cake', 'description' => 'Rich chocolate layered cake', 'price' => 80000, 'category' => 'Cake', 'image' => null]);
        Menu::create(['name' => 'Butter Cookies', 'description' => 'Fresh butter cookies', 'price' => 15000, 'category' => 'Cookies', 'image' => null]);
    }
}
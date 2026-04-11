<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Food;

class FoodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Food::create(['name' => 'Burger', 'price' => 100]);
        Food::create(['name' => 'Pizza', 'price' => 250]);
        Food::create(['name' => 'Fried Chicken', 'price' => 150]);
        Food::create(['name' => 'Spaghetti', 'price' => 120]);
        Food::create(['name' => 'Hotdog', 'price' => 80]);
        Food::create(['name' => 'Fries', 'price' => 70]);
        Food::create(['name' => 'Milk Tea', 'price' => 90]);
        Food::create(['name' => 'Coke', 'price' => 50]);
    }

//     INSERT INTO foods (name, price, created_at, updated_at) VALUES
// ('Chicken Adobo', 120, NOW(), NOW()),
// ('Beef Steak', 180, NOW(), NOW()),
// ('Pork Sisig', 150, NOW(), NOW()),
// ('Spaghetti', 90, NOW(), NOW()),
// ('Fried Chicken', 130, NOW(), NOW()),
// ('Burger', 110, NOW(), NOW()),
// ('Palabok', 100, NOW(), NOW()),
// ('Halo-Halo', 85, NOW(), NOW());
}

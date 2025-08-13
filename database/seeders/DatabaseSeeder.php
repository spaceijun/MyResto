<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        // User::create([
        //     'name' => 'admin',
        //     'username' => 'admin',
        //     'email' => 'adminresto@gmail.com',
        //     'password' => bcrypt('tes!@#'),
        // ]);

        // Product::create([
        //     'name' => 'Nasi goreng',
        //     'category_id' => 1,
        //     'price' => 20000,
        //     'description' => 'Nasi goreng paling enak',
        //     'image' => 'https://images.unsplash.com/photo-1523275335684-37898b6baf30?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=989&q=80'
        // ]);
        // Product::create([
        //     'name' => 'Ayam Bakar',
        //     'category_id' => 1,
        //     'price' => 25000,
        //     'description' => 'Ayam bakar paling enak',
        //     'image' => 'https://images.unsplash.com/photo-1491637639811-60e2756cc1c7?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=669&q=80'
        // ]);
        // Product::create([
        //     'name' => 'Buko Pandan',
        //     'category_id' => 2,
        //     'price' => 20000,
        //     'description' => 'Buko pandan paling enak',
        //     'image' => 'https://images.unsplash.com/photo-1528740561666-dc2479dc08ab?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1868&q=80'
        // ]);
    }
}

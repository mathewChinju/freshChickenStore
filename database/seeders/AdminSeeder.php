<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Product;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $adminUser = User::create([
            'name' => 'Super Admin',
            'email' => 'admin@store.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
            'phone' => '+1234567890',
            'address' => '123 Store Street, City, Country'
        ]);

        // Assign Super Admin role
        $adminUser->assignRole('Super Admin');

        // Create a regular admin user
        $regularAdmin = User::create([
            'name' => 'Regular Admin',
            'email' => 'admin2@store.com',
            'password' => bcrypt('password'),
            'is_admin' => true,
            'phone' => '+1234567891',
            'address' => '456 Admin Street, City, Country'
        ]);

        // Assign Admin role
        $regularAdmin->assignRole('Admin');

        $products = [
            [
                'name' => 'Chicken Leg Pieces',
                'description' => 'Fresh and tender chicken leg pieces, perfect for curries and grills. High-quality meat with bone-in for better flavor.',
                'price' => 4.99,
                'stock_quantity' => 50,
                'sku' => 'CHK-LEG-001',
                'weight' => 0.5,
                'categories' => ['Chicken', 'Meat', 'Fresh'],
                'is_active' => true
            ],
            [
                'name' => 'Chicken Breast',
                'description' => 'Boneless chicken breast, lean and protein-rich. Ideal for healthy meals, stir-fries, and salads.',
                'price' => 6.99,
                'stock_quantity' => 40,
                'sku' => 'CHK-BRST-001',
                'weight' => 0.4,
                'categories' => ['Chicken', 'Meat', 'Lean'],
                'is_active' => true
            ],
            [
                'name' => 'Beef Chuck Roast',
                'description' => 'Premium beef chuck roast, perfect for slow cooking and pot roasts. Rich flavor and tender texture.',
                'price' => 12.99,
                'stock_quantity' => 25,
                'sku' => 'BEEF-CHUCK-001',
                'weight' => 1.5,
                'categories' => ['Beef', 'Meat', 'Roast'],
                'is_active' => true
            ],
            [
                'name' => 'Fresh Tomatoes',
                'description' => 'Vine-ripened fresh tomatoes, perfect for salads, cooking, and sauces. Locally sourced.',
                'price' => 2.99,
                'stock_quantity' => 100,
                'sku' => 'VEG-TOM-001',
                'weight' => 0.5,
                'categories' => ['Vegetables', 'Fresh Produce', 'Local'],
                'is_active' => true
            ],
            [
                'name' => 'Onions',
                'description' => 'Fresh yellow onions, essential for cooking. Crisp texture and mild flavor for all dishes.',
                'price' => 1.99,
                'stock_quantity' => 80,
                'sku' => 'VEG-ONION-001',
                'weight' => 0.5,
                'categories' => ['Vegetables', 'Fresh Produce', 'Staples'],
                'is_active' => true
            ],
            [
                'name' => 'Chicken Wings',
                'description' => 'Fresh chicken wings, perfect for frying and grilling. Great for parties and game days.',
                'price' => 3.99,
                'stock_quantity' => 60,
                'sku' => 'CHK-WINGS-001',
                'weight' => 0.3,
                'categories' => ['Chicken', 'Meat', 'Party'],
                'is_active' => true
            ],
            [
                'name' => 'Beef Ground',
                'description' => 'Premium ground beef, 85% lean. Perfect for burgers, meatballs, and pasta sauces.',
                'price' => 8.99,
                'stock_quantity' => 35,
                'sku' => 'BEEF-GRND-001',
                'weight' => 0.5,
                'categories' => ['Beef', 'Meat', 'Ground'],
                'is_active' => true
            ],
            [
                'name' => 'Fresh Potatoes',
                'description' => 'Fresh russet potatoes, versatile for baking, frying, or mashing. Grown locally.',
                'price' => 3.49,
                'stock_quantity' => 90,
                'sku' => 'VEG-POT-001',
                'weight' => 1.0,
                'categories' => ['Vegetables', 'Fresh Produce', 'Root Vegetables'],
                'is_active' => true
            ],
            [
                'name' => 'Chicken Thighs',
                'description' => 'Boneless chicken thighs, juicy and flavorful. Great for curries, stews, and grilling.',
                'price' => 5.49,
                'stock_quantity' => 45,
                'sku' => 'CHK-THIGH-001',
                'weight' => 0.4,
                'categories' => ['Chicken', 'Meat', 'Dark Meat'],
                'is_active' => true
            ],
            [
                'name' => 'Fresh Carrots',
                'description' => 'Crunchy and sweet fresh carrots, perfect for salads, cooking, or snacking. Rich in vitamins.',
                'price' => 2.49,
                'stock_quantity' => 70,
                'sku' => 'VEG-CARROT-001',
                'weight' => 0.5,
                'categories' => ['Vegetables', 'Fresh Produce', 'Root Vegetables'],
                'is_active' => true
            ]
        ];

        foreach ($products as $product) {
            Product::create($product);
        }
    }
}

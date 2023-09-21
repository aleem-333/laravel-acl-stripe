<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            // B2B WATCHES

            [
                'code'          => 'AWB2B-001',
                'title'         => 'Apple Watch Series Ultra (49mm)',
                'type'          => 'B2B',
                'description'   => 'Apple Watch Series Ultra (49mm)',
                'quantity'      => 10,
                'price'         => 600,
                'logo'          => ('apple-watch-ultra.webp'),
            ],

            [
                'code'          => 'AWB2B-002',
                'title'         => 'Apple Watch Series 8 (41mm)',
                'type'          => 'B2B',
                'description'   => 'Apple Watch Series 8 (41mm)',
                'quantity'      => 25,
                'price'         => 500,
                'logo'          => ('apple-watch-series-8.webp'),
            ],

            [
                'code'          => 'AWB2B-003',
                'title'         => 'Apple Watch Series 7 (45mm)',
                'type'          => 'B2B',
                'description'   => 'Apple Watch Series 7 (45mm)',
                'quantity'      => 30,
                'price'         => 400,
                'logo'          => ('apple-watch-series-7.webp'),
            ],

            [
                'code'          => 'AWB2B-004',
                'title'         => 'Apple Watch Series 6 (44mm)',
                'type'          => 'B2B',
                'description'   => 'Apple Watch Series 6 (44mm)',
                'quantity'      => 10,
                'price'         => 300,
                'logo'          => ('apple-watch-series-6.webp'),
            ],

            // B2C WATCHES
            [
                'code'          => 'SWB2C-001',
                'title'         => 'Samsung Galaxy Watch 6 Classic 47mm',
                'type'          => 'B2C',
                'description'   => 'Samsung Galaxy Watch 6 Classic 47mm',
                'quantity'      => 10,
                'price'         => 450,
                'logo'          => ('samsung-galaxy-watch-6.webp'),
            ],

            [
                'code'          => 'SWB2C-002',
                'title'         => 'Samsung Galaxy Watch 5 Pro Bluetooth 45mm (R-920)',
                'type'          => 'B2C',
                'description'   => 'Samsung Galaxy Watch 5 Pro Bluetooth 45mm (R-920)',
                'quantity'      => 30,
                'price'         => 350,
                'logo'          => ('samsung-galaxy-watch-5-pro.webp'),
            ],


            [
                'code'          => 'SWB2C-003',
                'title'         => 'Samsung Galaxy Watch 5 Bluetooth 40mm (R-900)',
                'type'          => 'B2C',
                'description'   => 'Samsung Galaxy Watch 5 Bluetooth 40mm (R-900)',
                'quantity'      => 25,
                'price'         => 300,
                'logo'          => ('samsung-galaxy-watch-5.webp'),
            ],

            [
                'code'          => 'SWB2C-004',
                'title'         => 'Samsung Galaxy Watch 4 Bluetooth 44mm (R870)',
                'type'          => 'B2C',
                'description'   => 'Samsung Galaxy Watch 4 Bluetooth 44mm (R870)',
                'quantity'      => 10,
                'price'         => 250,
                'logo'          => ('galaxy-watch-4.webp'),
            ],






        ];

        Product::insert($products);
    }
}

<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Stock;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class InStockSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $data = [
            [
                'name' => 'Cermin Gagang Bulat Emas',
                'incoming_stock' => '50',
            ],
            [
                'name' => 'Gunting Kuku Kecil',
                'incoming_stock' => '100',
            ],
            [
                'name' => 'Talenan',
                'incoming_stock' => '100',
            ],
            [
                'name' => 'Sisir set Mika',
                'incoming_stock' => '100',
            ],
            [
                'name' => 'Gelas',
                'incoming_stock' => '100',
            ],
            [
                'name' => 'Pisau Kecil Mika',
                'incoming_stock' => '100',
            ],
            [
                'name' => 'Cutting Acrylic Premium Flower 30x45cm',
                'incoming_stock' => '5',
            ],
            [
                'name' => 'Gift Wedding Jam 25x35cm',
                'incoming_stock' => '5',
            ],
            [
                'name' => 'Cutting Acrylic 20x30cm',
                'incoming_stock' => '5',
            ],
            [
                'name' => 'Cuttingg Acrylic 25x35cm',
                'incoming_stock' => '5',
            ],
            [
                'name' => 'Cutting Acrylic 25x35cm',
                'incoming_stock' => '5',
            ],
        ];

        foreach ($data as $item) {
            $product = Product::where('name', $item['name'])->first();
            $item['products_id'] = $product->id;

            // update product stock_amount column
            $product->stock_amount += $item['incoming_stock'];
            $product->save();

            Stock::insert([
                'id' => Str::uuid(),
                'products_id' => $item['products_id'],
                'incoming_stock' => $item['incoming_stock'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

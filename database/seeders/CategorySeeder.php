<?php

namespace Database\Seeders;

use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class CategorySeeder extends Seeder
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
                'name' => 'Souvenir',
                'image' => 'https://cdn4.iconfinder.com/data/icons/hotel-and-hotel-services-2/85/gift_box_present_shopping_souvenir_shop-64.png',
            ],
            [
                'name' => 'Bucket',
                'image' => 'https://cdn4.iconfinder.com/data/icons/hotel-and-hotel-services-2/85/gift_box_present_shopping_souvenir_shop-64.png',
            ],
            [
                'name' => 'Hantaran',
                'image' => 'https://cdn4.iconfinder.com/data/icons/hotel-and-hotel-services-2/85/gift_box_present_shopping_souvenir_shop-64.png',
            ],
        ];

        $client = new Client();

        foreach ($data as $item) {
            $response = $client->request('GET', $item['image']);
            $extension = pathinfo($item['image'], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $extension;

            Storage::put('public/assets/category/' . $imageName, $response->getBody());

            Category::insert([
                'id' => Str::uuid(),
                'name' => $item['name'],
                'image' => 'assets/category/' . $imageName,
                'slug' => $item['name'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

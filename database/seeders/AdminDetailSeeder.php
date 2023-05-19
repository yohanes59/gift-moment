<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\User;
use App\Models\UserDetail;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminDetailSeeder extends Seeder
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
                'address' => 'Jl. Raya Danyang-Kuwu KM.05 Desa Kandangan RT.03/04',
                'address_detail' => '',
                'phone_number' => '+62',
                'provinces_id' => 9,
                'city_id' => 22,
                'postal_code' => 40311
            ],
        ];

        $userId = User::where('roles', 'Admin')->first();

        foreach ($data as $item) {
            UserDetail::insert([
                'id' => Str::uuid(),
                'users_id' => $userId->id,
                'address' => $item['address'],
                'address_detail' => $item['address_detail'],
                'phone_number' => $item['phone_number'],
                'provinces_id' => $item['provinces_id'],
                'city_id' => $item['city_id'],
                'postal_code' => $item['postal_code'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

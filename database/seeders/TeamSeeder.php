<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Team;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TeamSeeder extends Seeder
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
                'name' => 'Rizaldi Permana',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1686248447/rizaldi_n5ukgc.jpg',
                'role' => 'Mentor',
                'github_link' => 'https://github.com/rizaldi31',
                'instagram_link' => 'https://www.instagram.com/rizaldi31',
                'linkedin_link' => 'https://www.linkedin.com/in/rizaldi-permana-582569149',
            ],
            [
                'name' => 'Aqil Jawadal Furqon',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1686248446/aqil_fvznyh.jpg',
                'role' => 'Frontend Developer',
                'github_link' => 'https://github.com/awaqo',
                'instagram_link' => 'https://www.instagram.com/aqiljf_',
                'linkedin_link' => 'https://www.linkedin.com/in/aqiljawadal',
            ],
            [
                'name' => 'Yoga Aditya Nugraha',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1686248453/yoga_vl42hi.jpg',
                'role' => 'Backend Developer',
                'github_link' => 'https://github.com/yoga-nditya',
                'instagram_link' => 'https://www.instagram.com/yoga_nditya',
                'linkedin_link' => 'https://www.linkedin.com/in/yoga-aditya-5559851b5',
            ],
            [
                'name' => 'Yohanes Cahyadi',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1686252867/yohanes_wm7xte.jpg',
                'role' => 'Fullstack Developer',
                'github_link' => 'https://github.com/yohanes59',
                'instagram_link' => 'https://www.instagram.com/yohanesscahyadi',
                'linkedin_link' => 'https://www.linkedin.com/in/yohanes-cahyadi',
            ],
            [
                'name' => 'Srf.Fadlun Al Madihi',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1686248444/fadlun_gc0ocd.jpg',
                'role' => 'Content Writer',
                'github_link' => 'https://github.com/fadlunmadihij',
                'instagram_link' => 'https://www.instagram.com/fdln.a_',
                'linkedin_link' => 'https://www.linkedin.com/in/fadlun-madihij-24140827a',
            ],
            [
                'name' => 'Vinesia Prahesti Adiyaningtyas',
                'image' => 'https://res.cloudinary.com/dqxruyist/image/upload/v1686248445/vinesia_ne1xqd.jpg',
                'role' => 'Content Writer',
                'github_link' => 'https://github.com/Vinesia',
                'instagram_link' => 'https://instagram.com/_viinns',
                'linkedin_link' => 'https://www.linkedin.com/in/vinesiaprahesti04',
            ],
        ];

        $client = new Client();

        foreach ($data as $item) {
            $response = $client->request('GET', $item['image']);
            $extension = pathinfo($item['image'], PATHINFO_EXTENSION);
            $imageName = uniqid() . '.' . $extension;

            Storage::put('public/assets/team/' . $imageName, $response->getBody());

            Team::insert([
                'id' => Str::uuid(),
                'name' => $item['name'],
                'image' => 'assets/team/' . $imageName,
                'role' => $item['role'],
                'github_link' => $item['github_link'],
                'instagram_link' => $item['instagram_link'],
                'linkedin_link' => $item['linkedin_link'],
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}

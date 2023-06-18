<?php

namespace Database\Seeders;

use App\Models\City;
use Illuminate\Database\Seeder;

class CitiesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = [
            ['name' => 'Novi Beograd'],
            ['name' => 'Novi Sad'],
            ['name' => 'Arandjelovac'],
            ['name' => 'Lazarevac'],
            ['name' => 'Mladenovac'],
            ['name' => 'Zemun'],
            ['name' => 'Zvezdara'],
            ['name' => 'Valjevo'],
            ['name' => 'Vranje']
        ];

        foreach ($cities as $city) {
            City::create($city);
        }
    }
}

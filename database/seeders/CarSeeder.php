<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Car;
use Illuminate\Database\Seeder;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cars = [
            ['Mercedes-Benz', 'S-Class', 2024, 100.00],
            ['BMW', '7 Series', 2024, 95.00],
            ['Audi', 'A8', 2024, 90.00],
            ['Toyota', 'Camry', 2024, 50.00],
            ['Ford', 'Mustang', 2024, 70.00]
        ];

        foreach ($cars as $carDetails) {
            $brand = Brand::where('name', $carDetails[0])->first();

            if ($brand) {
                Car::create([
                    'brand_id' => $brand->id,
                    'model' => $carDetails[1],
                    'year' => $carDetails[2],
                    'price_per_day' => $carDetails[3],
                    'is_available' => true
                ]);
            }
        }
    }
}

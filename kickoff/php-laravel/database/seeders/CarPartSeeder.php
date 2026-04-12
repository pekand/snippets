<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Car;
use App\Models\Part;

class CarPartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cars = [
            ['name' => 'Toyota Corolla', 'registration_number' => 'TOY-123', 'is_registered' => true],
            ['name' => 'Ford Focus', 'registration_number' => 'FRD-456', 'is_registered' => true],
            ['name' => 'BMW 320i', 'registration_number' => 'BMW-789', 'is_registered' => false],
            ['name' => 'Škoda Octavia', 'registration_number' => 'SKD-101', 'is_registered' => true],
            ['name' => 'Tesla Model 3', 'registration_number' => 'TSL-202', 'is_registered' => false],
        ];

        foreach ($cars as $carData) {
            $car = Car::create($carData);

            Part::create([
                'name' => 'Engine Control Unit',
                'serialnumber' => 'ECU-' . strtoupper(uniqid()),
                'car_id' => $car->id,
            ]);

            Part::create([
                'name' => 'Brake Disc',
                'serialnumber' => 'BD-' . strtoupper(uniqid()),
                'car_id' => $car->id,
            ]);
        }
    }
}

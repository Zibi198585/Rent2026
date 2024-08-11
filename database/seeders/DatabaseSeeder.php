<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Office;
use App\Models\Product;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Vehicle;
use App\Models\Warehouse;
use App\Models\Contractor;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'admin@admin.com',
        ]);

        Contractor::factory()
        ->count(10)
        ->create();

        $products = [
            ['name' => 'Podpora stropowa ocynkowana 2,00/3,60 10KN', 'height'=>'10', 'width'=>'10', 'length'=>'205', 'weight'=>'10'],
            ['name' => 'Podpora stropowa ocynkowana 2,20/4,00 10KN', 'height'=>'10', 'width'=>'10', 'length'=>'225', 'weight'=>'15'],
            ['name' => 'Podpora stropowa ocynkowana 3,00/5,00 10KN', 'height'=>'10', 'width'=>'10', 'length'=>'305', 'weight'=>'20'],
            ['name' => 'Podpora stropowa ocynkowana 2,00/3,60 14KN', 'height'=>'10', 'width'=>'10', 'length'=>'205', 'weight'=>'12'],
            ['name' => 'Podpora stropowa ocynkowana 2,20/4,00 14KN', 'height'=>'10', 'width'=>'10', 'length'=>'225', 'weight'=>'17'],
            ['name' => 'Podpora stropowa ocynkowana 3,00/5,00 14KN', 'height'=>'10', 'width'=>'10', 'length'=>'305', 'weight'=>'22'],
            ['name' => 'Trójnóg'],
            ['name' => 'Głowica krzyżowa'],
            ['name' => 'Dźwigar H20 1,45m'],
            ['name' => 'Dźwigar H20 1,80m'],
            ['name' => 'Dźwigar H20 1,90m'],
            ['name' => 'Dźwigar H20 2,10m'],
            ['name' => 'Dźwigar H20 2,45m'],
            ['name' => 'Dźwigar H20 2,65m'],
            ['name' => 'Dźwigar H20 2,90m'],
            ['name' => 'Dźwigar H20 3,00m'],
            ['name' => 'Dźwigar H20 3,30m'],
            ['name' => 'Dźwigar H20 3,60m'],
            ['name' => 'Dźwigar H20 3,90m'],
            ['name' => 'Dźwigar H20 4,20m'],
            ['name' => 'Płyta trójwarstwowa okuta E 150x50'],
            ['name' => 'Płyta trójwarstwowa okuta E 200x50'],
            ['name' => 'Płyta trójwarstwowa okuta C 150x50'],
            ['name' => 'Płyta trójwarstwowa okuta C 200x50'],
            ['name' => 'Płyta trójwarstwowa okuta BO 150x50'],
            ['name' => 'Płyta trójwarstwowa okuta BO 200x50'],
        ];
        foreach ($products as $product) {
            Product::create($product);
        }

        $vehicles = [
            ['registration_number' => 'SK803RE', 'brand' => 'Fiat', 'model' => 'Ducato', 'purchase_date' => '0106202019', 'insurance_date' => '0106202019', 'inspection_date' => '0106202019', 'mileage' => '160000',  'vehicle_type' => 'Dostawczak', 'status' => 'OK', 'vin' => '78987899989', 'notes' => 'Dodastkowy opis' ],
        ];
        foreach ($vehicles as $vehicle) {
            Vehicle::create($vehicle);
        }

        $offices = [
            ['name' => 'Oddział w Wyrach', 'address_line_1' => 'Spokojna 3', 'address_line_2' => '1', 'post_code' => '43-175', 'city' => 'Wyry', 'province' => 'śląsk', 'country' => 'Polska', 'phone_number' => '603-821-694', 'email' => 'wyry@pfx.pl', 'established_date' => '2001-06-20', 'notes' => 'Dodatkowy opis' ],
            ['name' => 'Oddział w Dąbrowie', 'address_line_1' => 'Dąbrowa 204', 'address_line_2' => '1', 'post_code' => '33-333', 'city' => 'Dąbrowa', 'province' => 'małopolska', 'country' => 'Polska', 'phone_number' => '606-826-696', 'email' => 'dabrowa@pfx.pl', 'established_date' => '2001-06-20', 'notes' => 'Dodatkowy opis' ]
        ];
        foreach ($offices as $office) {
            Office::create($office);
        }


        $warehouses = [
            ['office_id' => '1', 'name' => 'Magazyn Wyry', 'location' => 'Spokojna 3a, 43-175 Wyry'],
            ['office_id' => '2', 'name' => 'Magazyn Dąbrowa', 'location' => 'Dąbrowa 204, 33-333 Dąbrowa'],
        ];
        foreach ($warehouses as $warehouse) {
            Warehouse::create($warehouse);
        }

    }
}

<?php

namespace Database\Seeders;

use App\Models\Property;
use Illuminate\Database\Seeder;

class PropertySeeder extends Seeder
{
    public function run()
    {
        Property::create([
            'user_id' => 1, // Replace with a valid user_id
            'property_name' => 'Test Land',
            'property_description' => 'A beautiful plot of land.',
            'property_price' => 5000000,
            'property_address' => 'Colombo',
            'offer_type' => 'sale',
            'property_type' => 'land',
            'finish_status' => 'unfinished',
            'phone_number' => '1234567890',
            'property_status' => 'approved',
        ]);

        Property::create([
            'user_id' => 1, // Replace with a valid user_id
            'property_name' => 'Test House',
            'property_description' => 'A cozy house.',
            'property_price' => 7000000,
            'property_address' => 'Kandy',
            'offer_type' => 'rent',
            'property_type' => 'house',
            'finish_status' => 'finished',
            'phone_number' => '0987654321',
            'property_status' => 'approved',
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\ShippingAddress;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ShippingAddress::insert([
            'user_id' => 1,
            'address' => '123 Main St',
            'landmark' => 'Near Park',
            'number'=> '1234567890',
            'street_no' => 'Anystreet',
            'pincode' => '12345',
            'state' => 'Pokhara',
            'created_at' => now(),
            'updated_at' => now(),
        ],

    );
        
    }
}

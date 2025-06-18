<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        if(!User::where('email', 'gabriel@teste.com')->first()) {
            User::create([
                'name' => 'Gabriel',
                'email' => 'gabriel@teste.com',
                'password' => Hash::make('12345678'),
            ]);};
}
    }

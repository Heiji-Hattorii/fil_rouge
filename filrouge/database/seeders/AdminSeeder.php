<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        
        User::create([
            'name' => 'Hei Ji',
            'email' => 'heiji@gmail.com',
            'password' => Hash::make('heiji123'), 
            'role' => 'admin',
            'bio' => 'Biographie de l admin',
            'age' => 23,
            'profile_photo' => 'path_to_profile_photo',
            'cover_photo' => 'path_to_cover_photo',
            'pseudo' => 'Hei Ji',
        ]);
    }
}

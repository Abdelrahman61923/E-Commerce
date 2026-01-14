<?php

namespace Database\Seeders;

use App\Enums\UserType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'Abdo Salah',
                'email' => 'abdo@gmail.com',
                'password' => Hash::make('password'),
                'phone_number' => '01063446527',
                'type' => UserType::ADMIN->value,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'name' => 'Ahmed Mohamed',
                'email' => 'ahmed@gmail.com',
                'password' => Hash::make('password'),
                'phone_number' => '01011112222',
                'type' => UserType::SUPERADMIN->value,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'name' => 'Omar Hassan',
                'email' => 'omar@gmail.com',
                'password' => Hash::make('password'),
                'phone_number' => '01055556666',
                'type' => UserType::USER->value,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
            [
                'name' => 'Ali Ahmed',
                'email' => 'ali@gmail.com',
                'password' => Hash::make('password'),
                'phone_number' => '01055556665',
                'type' => UserType::USER->value,
                'created_at'=> now(),
                'updated_at'=> now(),
            ],
        ]);
    }
}

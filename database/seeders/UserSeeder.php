<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create the first admin user (teacher)
        User::create([
            'name' => 'Admin Teacher',
            'email' => 'admin@school.com',
            'password' => bcrypt('password123'),
            'role' => 'admin',
            'student_id' => null,
            'department' => 'Administration',
        ]);

        // Create a few sample students
        User::create([
            'name' => 'John Doe',
            'email' => 'john@school.com',
            'password' => bcrypt('password123'),
            'role' => 'student',
            'student_id' => 'STD001',
            'department' => 'Computer Science',
        ]);

        User::create([
            'name' => 'Jane Smith',
            'email' => 'jane@school.com',
            'password' => bcrypt('password123'),
            'role' => 'student',
            'student_id' => 'STD002',
            'department' => 'Engineering',
        ]);
    }
}

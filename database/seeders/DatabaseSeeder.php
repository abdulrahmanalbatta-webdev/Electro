<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Super Admin',
        //     'email' => 'admin@example.com',
        //     'password' => 'admin@123',
        // ]);

        // User::factory()->create([
        //     'name' => 'Employee',
        //     'email' => 'employee@example.com',
        //     'password' => 'employee@123',
        // ]);

        // User::factory()->create([
        //     'name' => 'Customer',
        //     'email' => 'cutomer@example.com',
        //     'password' => 'customer@123',
        // ]);

        // $this->call([
        //     RolesAndPermissionsSeeder::class,
        // ]);

        $this->call([
            OrdersTableSeeder::class,
        ]);
    }
}

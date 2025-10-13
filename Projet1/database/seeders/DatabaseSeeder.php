<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
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
            'email' => 'test@example.com',
        ]);



        // Tables 
        $this->call([
            ClientSeeder::class,
            CommandeSeeder::class,
        ]);



       // Special seeder for roles and permissions
        $this->call(UserSeeder::class);
        $this->call(OnlineSeeder::class);
    }

}

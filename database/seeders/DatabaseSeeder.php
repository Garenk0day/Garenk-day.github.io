<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Modules\Shop\Database\Seeders\ShopDatabaseSeeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        if ($this->command->confirm('Do you want to refresh migration before seeding, it will clear all old data ?')) {
            $this->command->call('migrate:refresh');
            $this->command->info('Data cleared, starting from blank database');
        }

        User::factory()->create();
        $this->command->info('sample user seeded.');

        if ($this->command->confirm('Do you want to seed some sample products ?')) {
            $this->call(ShopDatabaseSeeder::class);
        }
    }
}


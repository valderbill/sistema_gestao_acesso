<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Rodar o seeder dos perfis
        $this->call([
            PerfisSeeder::class,
        ]);

        // Caso queira manter a criação dos usuários de teste, você pode descomentar isso:
        /*
        \App\Models\User::factory()->count(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
        ]);
        */
    }
}

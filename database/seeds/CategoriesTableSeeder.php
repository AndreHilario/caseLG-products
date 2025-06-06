<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('categories')->insert([
            ['name' => 'Eletrônicos', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Roupas', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alimentos', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Livros', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Brinquedos', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Esportes', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Móveis', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beleza', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Outros', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}

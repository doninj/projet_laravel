<?php

use App\category;
use Illuminate\Database\Seeder;

class CategorieTablesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        category::create([
            'name'=>'High Tech',
            'Slug'=> 'high-tech',
        ]);
        category::create([
            'name'=>'Livres',
            'Slug'=> 'livres',
        ]);
        category::create([
            'name'=>'Meubles',
            'Slug'=> 'meubles',
        ]);
        category::create([
            'name'=>'Jeux',
            'Slug'=> 'jeux',
        ]);
        category::create([
            'name'=>'Nourriture',
            'Slug'=> 'nourriture',
        ]);
    }
}

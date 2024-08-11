<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        // Array of category names
        $categories = ['Golongan I', 'Golongan II', 'Golongan III', 'Golongan IV', 'Golongan V'];

        foreach ($categories as $category) {
            DB::table('categories')->insert([
                'name' => $category,
                'description' => $faker->sentence, // Generate a random sentence for description
            ]);
        }
    }
}

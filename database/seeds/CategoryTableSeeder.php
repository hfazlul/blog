<?php

use Illuminate\Database\Seeder;
use App\Model\Category;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 5) as $index) {
            $category = $faker->unique()->name;
            Category::create([
                "name"   => $category,
                "slug"   => slugify($category),
                "status" => rand(0, 1),
            ]);
        }
    }



}

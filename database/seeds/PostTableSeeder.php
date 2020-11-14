<?php

use Illuminate\Database\Seeder;
use App\Model\Post;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        foreach (range(1, 100) as $index) {
            Post::create([
                "user_id"     => rand(1, 20),
                "category_id" => rand(1, 5),
                "title"       => $faker->sentence,
                "content"     => $faker->paragraph,
                "thumbnail"   => $faker->imageUrl(),
                "status"      => $this->getRandomStatus(),
            ]);
        }
    }

    /**
     * @return mixed
     */
    public function getRandomStatus()
    {
        # Generate random status
        $statuses = array('draft', 'published');
        return $statuses[array_rand($statuses)];
    }
}

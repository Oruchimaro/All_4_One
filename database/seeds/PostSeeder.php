<?php

use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory(App\User::class, 5)->create();

        foreach ($users as $user) {
            factory(App\Blog\Post::class, 10)->create();
        }
    }
}

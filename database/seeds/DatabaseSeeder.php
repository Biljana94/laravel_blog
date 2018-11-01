<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UsersTableSeeder::class);
        $this->call(CommentsTableSeeder::class);
        $this->call(PostsTableSeeder::class);
        $this->call(TagsTableSeeder::class);

        //i onda pokrecemo php artisan db:seed
        //moramo obrisati sve iz baze podataka sto smo rucno uneli da bi pokrenuli seed
    }
}

<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\User::class, 20)->create(); //pravimo lazne podatke pomocu factory() u kojem je definisano kako ce praviti, u Userfactory je definisan $factory za lazne podatke
    }
}

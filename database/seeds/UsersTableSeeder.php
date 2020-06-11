<?php

use Illuminate\Database\Seeder;
use App\User; // Use this Trait to manage the Users in the Seeder/Faker


class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create(); // Faker Object
        for($i=0; $i<=100; $i++) {
            $user = new User();
            $user->name = $faker->name; // Generate Fake Name
            $user->email = $faker->email; // Generate Fake Name
            $user->password = bcrypt('secret'); // Encrypted password "secret"
            $user->save();
        }
    }
}

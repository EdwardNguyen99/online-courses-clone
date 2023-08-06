<?php

namespace Modules\User\seeders;

use Faker\Factory;
use Illuminate\Support\Facades\Hash;
use Modules\User\src\Models\User;

class UserSeeder extends \Illuminate\Database\Seeder
{
    public function run()
    {
        $faker = Factory::create();
        for ($index = 1; $index <= 30; $index++) {
            $user = new User();
            $user->name = $faker->name;
            $user->email = $faker->email;
            $user->password = Hash::make('123456');
            $user->group_id = 1;
            $user->save();
        }
    }
}

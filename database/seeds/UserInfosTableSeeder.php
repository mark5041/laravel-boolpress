<?php

use App\User;
use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\UserInfo;

class UserInfosTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        $users = User::all();

        foreach ($users as $user) {
            $newUserInfo = new UserInfo();
            $newUserInfo->phone = $faker->phoneNumber();
            $newUserInfo->address = $faker->address();
            $newUserInfo->user_id = $user->id;
            $newUserInfo->avatar = "https://placeimg.com/200/200/animals";

            $newUserInfo->save();
        }
    }
}

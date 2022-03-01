<?php

use Illuminate\Database\Seeder;
use App\Comic;
use App\User;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

class ComicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Faker $faker)
    {
        for ($i=0; $i < 25; $i++) 
        { 
            $newComic = new Comic();
            $newComic->title = $faker->firstName()." #".$faker->numberBetween(0, 20);
            $newComic->description = $faker->realText(150);
            $newComic->thumb = $faker->imageUrl(350, 350, true);
            $newComic->price = $faker->randomFloat(null, 0, 1000);
            $newComic->sale_date = $faker->date();
            $newComic->type = $faker->randomElement(['comic book', 'art book', 'special', 'special collection']);
            $newComic->artists = $faker->name();
            $newComic->writers = $faker->name();
            $newComic->quantity = $faker->numberBetween(0, 10);
            $string =  "$newComic->title-$i";
            $newComic->slug = Str::slug($string, '-');
            $newComic->user_id = User::inRandomOrder()->first()->id;
            $newComic->save();
        }
    }
}

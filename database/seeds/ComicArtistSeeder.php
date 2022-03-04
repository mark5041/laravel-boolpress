<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Artist;
use App\Comic;

class ComicArtistSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $artists = Artist::all();
        $comics = Comic::all();
        foreach($comics as $comic)
        {
            $randNumOfArtist = rand(1, 5);
            for($i=0; $i < $randNumOfArtist; $i++)
            {
                $comic->artist()->attach($artists->random());
            }
        }
    }
}

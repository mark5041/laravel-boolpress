<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;
use App\Writer;
use App\Comic;

class ComicsWritersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $writers = Writer::all();
        $comics = Comic::all();
        foreach($comics as $comic)
        {
            $randNumOfWriter = rand(1, 5);
            $writerOf = $writers->random($randNumOfWriter);
            foreach($writerOf as $who)
            {
                $comic->writer()->attach($who);
            }
        }
    }
}

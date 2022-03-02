<?php

use App\Comic;
use App\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class UpdateComicsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $comics = Comic::all();

        foreach($comics as $comic)
        {
            $UpdatedComic = Comic::find($comic->id);
            $category = Category::all()->random();
            $UpdatedComic->category_id = $category->id;
            $UpdatedComic->save();

        }
    }
}

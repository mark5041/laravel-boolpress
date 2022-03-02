<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Category;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = ['comic book', 'art book', 'special', 'special collection'];
        foreach($array as $key=>$value)
        {
            $newCategory = new Category();
            $newCategory->name = $value;
            $title = "$newCategory->name-$key";
            $newCategory->slug = Str::slug($title, '-');
            $newCategory->save();
        }
    }
}

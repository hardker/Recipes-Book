<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
//use App\Models\Category;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
//Заполняем категории
        $arr_cat = array('Первые блюда', 'Вторые блюда', 'Десерт', );
        $arr_img = array('img/pervoe.jpeg', 'img/vtoroe.jpeg', 'img/desert.jpeg', );
        $arr_slug = array('pervoe', 'vtoroe', 'desert', );

        for ($i = 0; $i < 3; $i++) {
            DB::table('categories')->insert([
                'name_cat' => $arr_cat[$i],
                'images' => $arr_img[$i],
                'slug' => $arr_slug[$i],
            ]);
        }

//Заполняем рецепты
        $arr_cat = array('Первые блюда', 'Вторые блюда', 'Десерт', );
        $arr_img = array('img/pervoe.jpeg', 'img/vtoroe.jpeg', 'img/desert.jpeg', );
        $arr_slug = array('pervoe', 'vtoroe', 'desert', );

        for ($i = 0; $i < 10; $i++) {
            DB::table('recipes')->insert([
                'category_id' => rand(1, 3),
                'title' => 'Рецепт '.$i,
                'slug' => 'recipes-'.$i,
                'description' => 'Description of post '.$i,
                'text' => '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. <br>'.$i.'</p>',
   
            ]);
        }
        // $categories = [
        //     [ 
        //         'name_cat' => 'Первые блюда',
        //         'images' => 'img/pervoe.jpeg',
        //     ],
        //     [ 
        //         'name_cat' => 'Вторые блюда',
        //         'images' => 'img/vtoroe.jpeg',
        //     ],            [ 
        //         'name_cat' => 'Десерт',
        //         'images' => 'img/desert.jpeg',
        //     ],             
        // ];
        //    Category::insert($categories);


    }
}

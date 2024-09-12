<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;
use App\Models\Like;


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

        //Добавляем двух пользователей
        User::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('admin'),
            'is_admin' => true,
        ]);
        User::create([
            'name' => 'User',
            'email' => 'user@example.com',
            'password' => Hash::make('user'),
            'is_admin' => false,
        ]);



        //Заполняем категории
        $arr_cat = array('Первые блюда', 'Вторые блюда', 'Десерт', );
        //        $arr_img = array('img/pervoe.jpeg', 'img/vtoroe.jpeg', 'img/desert.jpeg', );
        $arr_slug = array('pervoe', 'vtoroe', 'desert', );

        for ($i = 0; $i < 3; $i++) {
            //      DB::table('categories')->insert([
            Category::create([
                'name_cat' => $arr_cat[$i],
                'images' => 'img/' . $arr_slug[$i] . '.jpeg',
                'slug' => $arr_slug[$i],

            ]);
        }

        //Заполняем рецепты
        $arr_cat = array('Первые блюда', 'Вторые блюда', 'Десерт', );
        //        $arr_img = array('img/pervoe.jpeg', 'img/vtoroe.jpeg', 'img/desert.jpeg', );
        $arr_slug = array('pervoe', 'vtoroe', 'desert', );
        $xml = simplexml_load_file('recipes.xml');
                $i = 0;
        foreach ($xml->recipe as $recipe) {
    
            //   DB::table('recipes')->insert([
            Recipe::create([
                'category_id' => (integer) $recipe->category_id,
                'title' => (string) $recipe->title,
                'description' => (string) $recipe->description,
                'text' => (string) $recipe->text,
                'ingredients' => (string) $recipe->ingredients,
                'timing' => (string) $recipe->timing,
                'calorie' => (integer) $recipe->calorie,
                'slug' => (string) $this->translit_slug($recipe->title),
            ]);

          //  Заполняем рейтинг случайными значениями
            Like::create([
                'user_id' => 1,
                'recipe_id' => ++$i,
                'rating' => rand(1, 5),
            ]);
            Like::create([
                'user_id' => 2,
                'recipe_id' => $i,
                'rating' => rand(1, 5),
            ]);


        }




    }
    public function translit_slug($value): string
    {
        $converter = array(
            'а' => 'a',
            'б' => 'b',
            'в' => 'v',
            'г' => 'g',
            'д' => 'd',
            'е' => 'e',
            'ё' => 'e',
            'ж' => 'zh',
            'з' => 'z',
            'и' => 'i',
            'й' => 'y',
            'к' => 'k',
            'л' => 'l',
            'м' => 'm',
            'н' => 'n',
            'о' => 'o',
            'п' => 'p',
            'р' => 'r',
            'с' => 's',
            'т' => 't',
            'у' => 'u',
            'ф' => 'f',
            'х' => 'h',
            'ц' => 'c',
            'ч' => 'ch',
            'ш' => 'sh',
            'щ' => 'sch',
            'ь' => '',
            'ы' => 'y',
            'ъ' => '',
            'э' => 'e',
            'ю' => 'yu',
            'я' => 'ya',
        );
        $value = mb_strtolower($value);
        $value = strtr($value, $converter);
        $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
        $value = mb_ereg_replace('[-]+', '-', $value);
        $value = trim($value, '-');
        return $value;
    }
}

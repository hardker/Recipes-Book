<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\Category;
use App\Models\Recipe;
use App\Models\User;

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

        // for ($i = 0; $i < 10; $i++) {
        //     DB::table('recipes')->insert([
        //         'category_id' => rand(1, 3),
        //         'title' => 'Рецепт '.$i,
        //         'slug' => 'recipe-'.$i,
        //         'description' => 'Description of post '.$i,
        //         'text' => '<p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32. <br>'.$i.'</p>',

        //     ]);
        // }

        $xml = simplexml_load_file('recipes.xml');
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
        }

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

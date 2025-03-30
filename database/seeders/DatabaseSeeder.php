<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Like;
use App\Models\Recipe;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Str;

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
        $arr_cat = ['Первые блюда', 'Вторые блюда', 'Десерты'];
        $arr_des = ['Жидкие блюда, приготовленные на основе мясных, рыбных или грибных бульонов; овощных, фруктовых или ягодных отваров; кваса, молока или простокваши', 'Кушанье в виде гарнира (овощей, каши и т.п.), добавляемого к мясу и рыбе; обычно следует после супа (первого блюда) во время обеда или ужина', ' Завершающее блюдо стола, предназначенное для получения приятных вкусовых ощущений в конце обеда или ужина, обычно — сладкие деликатесы'];
        $arr_slug = ['pervoe', 'vtoroe', 'desert'];

        for ($i = 0; $i < 3; $i++) {
            //      DB::table('categories')->insert([
            Category::create([
                'name_cat' => (string) $arr_cat[$i],
                'description' => (string) $arr_des[$i],
                'images' => (string) 'img/' . $arr_slug[$i] . '.jpeg',
                'slug' => (string) $arr_slug[$i],

            ]);
        }

        //Заполняем рецепты
        $xml = simplexml_load_file('recipes.xml');
        $i = 0;
        foreach ($xml->recipe as $recipe) {
            $slug = $this->translit_slug($recipe->title);
            $date = fake()->dateTimeBetween('-12 months');
            //   DB::table('recipes')->insert([
            Recipe::create([
                'user_id' => rand(1, 2),
                'category_id' => (int) $recipe->category_id,
                'title' => (string) $recipe->title,
                'description' => (string) trim($recipe->description),
                'text' => (string) trim($recipe->text),
                'ingredients' => (string) trim($recipe->ingredients),
                'timing' => (string) $recipe->timing,
                'calorie' => (int) $recipe->calorie,
                'slug' => (string) $slug,
                'path' => (string) 'img/' . $slug . '.jpeg',
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }

    public function translit_slug($value): string
    {
        $converter = [
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
        ];
        $value = mb_strtolower($value);
        $value = strtr($value, $converter);
        $value = mb_ereg_replace('[^-0-9a-z]', '-', $value);
        $value = mb_ereg_replace('[-]+', '-', $value);
        $value = trim($value, '-');

        return $value;
    }
}

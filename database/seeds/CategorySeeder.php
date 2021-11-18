<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $file_data = file_get_contents('database/data/data.json'
    );
        $datas = json_decode(preg_replace('/[\x00-\x1F\x80-\xFF]/', '', $file_data));;
        foreach ($datas as $data) {
            $category = new Category();
            $category->verticale = $data->verticale;
            $category->nome = $data->nomeCategoria;
            $category->save();
        }
    }
}

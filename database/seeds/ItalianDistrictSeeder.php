<?php

use Illuminate\Database\Seeder;
use App\ItalianDistrict;
use App\ZipCode;

class ItalianDistrictSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $file_data = file_get_contents('database/data/comuni.json');
        $datas = json_decode($file_data);
        foreach ($datas as $data) {
            $district = new ItalianDistrict();
            $district->nome = $data->nome;
            $district->codice = $data->codice;
            $district->zona_nome = $data->zona->nome;
            $district->zona_codice = $data->zona->codice;
            $district->regione_codice = $data->regione->codice;
            $district->regione_nome = $data->regione->nome;
            //$district->cm_codice = $data->cm->codice;
            //$district->cm_nome = $data->cm->nome;
            $district->provincia_codice = $data->provincia->codice;
            $district->provincia_nome = $data->provincia->nome;
            $district->sigla = $data->sigla;
            $district->codice_catastale = $data->codiceCatastale;
            $district->popolazione = $data->popolazione;
            $district->save();

            foreach ($data->cap as $cap) {
                $zip = new ZipCode();
                $zip->codice = $cap;
                $zip->district_id = $district->id;
                $zip->save();
            }
        }
    }
}

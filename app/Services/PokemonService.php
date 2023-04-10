<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class PokemonService
{
    private $base_url = "https://pokeapi.co/api/v2/pokemon/?";

    public function get($action)
    {
        return Http::get($action);
    }

    public function getPokemonApi($url)
    {
        $array_list_pokemons = [];

        $res_pokemons = $this->getAllPokemons($url);

        foreach ($res_pokemons['results'] as $pokemon) {
            $specific_pokemon = $this->getSpecificPokemon($pokemon['url']);

            $location_area_name = $this->getLocationAreaEncounters($specific_pokemon['location_area_encounters']);

            $array_pokemon = [
                'name' => $pokemon['name'],
                'location_area_encounters' => $location_area_name,
                'base_experience' => $specific_pokemon['base_experience'],
                'pokemon_gif' => $specific_pokemon['pokemon_gif'],
            ];

            $array_list_pokemons[] = $array_pokemon;
        }

        $links = [
            'next_url' => $res_pokemons['next_url'],
            'previous_url' => $res_pokemons['previous_url']
        ];

        return [
            'array_list_pokemons' => $array_list_pokemons,
            'links' => $links,
        ];
    }

    public function getAllPokemons($url)
    {
        $list_pokemons = $this->get($this->base_url . $url);

        if (!is_null($list_pokemons['previous'])) {
            $parts = explode("?", $list_pokemons['previous']);
            $previous_url = $parts[1];
        } else {
            $previous_url = null;
        };

        if (!is_null($list_pokemons['next'])) {
            $parts = explode("?", $list_pokemons['next']);
            $next_url = $parts[1];
        } else {
            $next_url = null;
        };

        return [
            'results' => $list_pokemons['results'],
            'next_url' => $next_url,
            'previous_url' => $previous_url
        ];
    }

    public function getSpecificPokemon($url)
    {
        $response = $this->get($url);

        return [
            'base_experience' => $response['base_experience'],
            'location_area_encounters' => $response['location_area_encounters'],
            'pokemon_gif' => $response['sprites']['versions']['generation-v']['black-white']['animated']['front_shiny']
        ];
    }

    public function getLocationAreaEncounters($url)
    {
        $res_location_area = $this->get($url);

        if (sizeof(json_decode($res_location_area, true)) == 0) {
            $location_area_name = @trans('messages.Not Found');
        } else {
            $location_area_name = $res_location_area[0]['location_area']['name'];
        }

        return $location_area_name;
    }

    public function downloadListPokemons($list_pokemons)
    {
        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();
        $sheet->setCellValue('A1', @trans('messages.Name'))
              ->setCellValue('B1', @trans('messages.Location area'))
              ->setCellValue('C1', @trans('messages.Base experience'));

        $row = 2;
        foreach ($list_pokemons as $pokemon) {
            $sheet->setCellValue('A' . $row, $pokemon['name'])
                  ->setCellValue('B' . $row, $pokemon['location_area_encounters'])
                  ->setCellValue('C' . $row, $pokemon['base_experience']);
            $row++;
        }

        $writer = new Xlsx($spreadsheet);

        $filename = 'pokemons.xlsx';

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . $filename . '"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');

        exit();
    }
}

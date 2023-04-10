<?php

namespace App\Http\Controllers;

use App\Services\PokemonService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PokemonController extends Controller
{
    public function index($url = '?offset=0&limit=20')
    {
        if (Cache::has("pokemons/$url")) {
            $res_cache = Cache::get("pokemons/$url");

            $list_pokemons = $res_cache['pokemons'];
            $next_url = $res_cache['next_url'];
            $previous_url = $res_cache['previous_url'];

        } else {

            $response = (new PokemonService)->getPokemonApi($url);

            $list_pokemons = $response['array_list_pokemons'];
            $next_url = $response['links']['next_url'];
            $previous_url = $response['links']['previous_url'];

            $save_cache = [
                'pokemons' => $list_pokemons,
                'next_url' => $next_url,
                'previous_url' => $previous_url
            ];

            Cache::put("pokemons/$url", $save_cache, 86400);
        }

        return view('pokemons.index', compact('list_pokemons', 'next_url', 'previous_url'));

    }

    public function downloadListPokemons(Request $request)
    {
        $list = json_decode($request->encode, true);
        (new PokemonService)->downloadListPokemons($list);
    }
}


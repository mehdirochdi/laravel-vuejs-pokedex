<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Collection;
use App\API\PokeAPI;
use Illuminate\Support\Arr;

class PokemonsController extends Controller
{
    private $api;

    public function __construct() {    
        $this->api = new PokeAPi;
    }

    public function index() {
        return view('front.listing');
    }
    public function all(Request $request) {
        $offset     = $request->offset;
        $limit      = $request->limit;
        $output = [];
        /*========================================
                    SEARCH BY ID OR NAME
        ==========================================*/
        if(isset($request->search) && $request->search !== '') {
            $pokemon = json_decode($this->api->pokemon($request->search));
            $output['results'][] = $pokemon;
            $output['count'] = 1;
            if($pokemon === "An error has occured.") {
                $output['results'] = [];
            }
            return response()->json($output);
        /*========================================
                        SEARCH BY TYPE
        ==========================================*/
        }elseif(isset($request->type) && $request->type !== '') {
            $pokemonTypes = json_decode($this->api->pokemonType($request->type));

            if($pokemonTypes === "An error has occured.") {
                $output['results'] = [];
            }else {
                $output['count'] = count($pokemonTypes->pokemon);
                foreach($pokemonTypes->pokemon as $type) {
                    $output['results'][] = json_decode($this->api->pokemon($type->pokemon->name));
                }
            }
            return response()->json($output);
        }
        
        /*========================================
                    ALL POKEMONS
        ==========================================*/
        $pokemons = json_decode($this->api->resourceList('pokemon', $limit, $offset));
        foreach($pokemons->results as $pokemon) {
            $pokemonsObject = json_decode($this->api->sendRequest($pokemon->url));
            $pokemonsObject->isCatched = false;
            $output['results'][] = $pokemonsObject;
        }
        $output['count'] = $pokemons->count;
        
        $pokemonIds = Collection::getPokeCatchIds();
        if($pokemonIds) {

            $filtered = Arr::where($output['results'], function ($value, $key) use($pokemonIds){
                foreach($pokemonIds as $pokemon) {
                    if($value->id == $pokemon->poke_id) {
                        $value->isCatched = true;
                    }
                }
            });
            
        }
        return response()->json($output);
    }

    public function allPokemonsCatched() {
        return Collection::where('user_id', 1)->get();
    }
}

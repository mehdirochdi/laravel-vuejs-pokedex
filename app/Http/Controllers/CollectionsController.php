<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\API\PokeAPI;
use App\Collection;

class CollectionsController extends Controller
{
    private $api;

    public function __construct() {    
        $this->api = new PokeAPi;
    }

    public function index() {
        return view('front.collection');
    }
    public function store(Request $request) {
        $statut = false;
        $pokemonCheck = Collection::where('poke_id', intval($request->id))->first();
        if($pokemonCheck) {
            return response()->json([
                'statut' => $statut,
                'error' => 'this pokemon has already been caught !!!'
            ]);
        }

        $collection = new Collection();
        $collection->poke_name = $request->name;
        $collection->poke_id   = $request->id;
        $collection->user_id   = 1;
        $statut = $collection->save();
        $http_code = ($statut) ? 200 : 500;
        return response()->json([
            'statut' => $statut
        ], $http_code);
    }
    public function all(Request $request) {
        $output = [];
        // $page     = $request->page;
        $offset      = $request->offset;
        $pokemons = Collection::select('poke_id', 'poke_name')->where('user_id', 1)->paginate($offset);
        foreach($pokemons as $pokemon) {
            $output[] = json_decode($this->api->pokemon($pokemon->poke_id));
        }
        return response()->json([
            'total' => $pokemons->total(),
            'per_page' => $pokemons->perPage(),
            'current_page' => $pokemons->currentPage(),
            'last_page' => $pokemons->lastPage(),
            'from' => $pokemons->firstItem(),
            'to' => $pokemons->lastItem(),
            'offset'   => $offset,
            'results' => $output
        ]);
    }

    public function destroy($id) {
        $deletePokeID = Collection::where('poke_id', intval(id))->delete();
        $statut = (deletePokeID) ? true : false;
        $http_code = (deletePokeID) ? 200 : 500;
        return response()->json([
            'statut' => $deletePokeID
        ], $http_code);
    }
}

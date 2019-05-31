<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*/////////////////////////////////////////////////////////////
                    POKEMONS ROUTES
///////////////////////////////////////////////////////////////*/
Route::get('/', 'PokemonsController@index')->name('pokemon.index');
Route::get('pokemons', 'PokemonsController@all')->name('pokemon.all');
Route::post('pokemons/catched', 'PokemonsController@allPokemonsCatched')->name('pokemon.catched');
// Route::get('pokemons/type', 'PokemonsController@type')->name('pokemon.type');


/*/////////////////////////////////////////////////////////////
                    COLLECTION ROUTES
///////////////////////////////////////////////////////////////*/
Route::resource('collection', 'CollectionsController')->only(['index' ,'store', 'destroy']);
Route::post('collection/all', 'CollectionsController@all')->name('collection.all');

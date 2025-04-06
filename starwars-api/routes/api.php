<?php

use App\Http\Controllers\SwapiController;
use Illuminate\Support\Facades\Route;

Route::get('/films', [SwapiController::class, 'getFilms']);
Route::get('/films/{id}', [SwapiController::class, 'getFilm']);
Route::get('/films/{id}/characters', [SwapiController::class, 'getCharacters']);

// People
Route::get('/people', [SwapiController::class, 'getPeople']);
Route::get('/people/{id}', [SwapiController::class, 'getPerson']);

// Planets
Route::get('/planets', [SwapiController::class, 'getPlanets']);
Route::get('/planets/{id}', [SwapiController::class, 'getPlanet']);

// Species
Route::get('/species', [SwapiController::class, 'getSpecies']);
Route::get('/species/{id}', [SwapiController::class, 'getSpecie']);

// Starships
Route::get('/starships', [SwapiController::class, 'getStarships']);
Route::get('/starships/{id}', [SwapiController::class, 'getStarship']);

// Vehicles
Route::get('/vehicles', [SwapiController::class, 'getVehicles']);
Route::get('/vehicles/{id}', [SwapiController::class, 'getVehicle']);
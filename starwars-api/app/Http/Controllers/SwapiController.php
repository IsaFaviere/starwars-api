<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SwapiController extends Controller
{
    private $baseUrl = 'https://swapi.dev/api/';

    // FILMS
    public function getFilms(Request $request)
    {
        $search = $request->query('search', '');
        $response = Http::get($this->baseUrl . 'films/');

        if ($response->failed()) {
            return response()->json(['error' => 'Erro ao consultar a API'], 500);
        }

        $films = $response->json()['results'];

        if ($search) {
            $films = array_filter($films, function ($film) use ($search) {
                return stripos($film['title'], $search) !== false;
            });
        }

        return response()->json(array_values($films));
    }

    public function getFilm($id)
    {
        $response = Http::get($this->baseUrl . 'films/' . $id . '/');

        if ($response->failed()) {
            return response()->json(['error' => 'Filme não encontrado'], 404);
        }

        return response()->json($response->json());
    }

    public function getCharacters($filmId)
    {
        $response = Http::get($this->baseUrl . 'films/' . $filmId . '/');

        if ($response->failed()) {
            return response()->json(['error' => 'Filme não encontrado'], 404);
        }

        $film = $response->json();
        $characters = [];

        // SPOILER ALERT: "Eu sou seu pai" - Darth Vader revela a Luke em 'O Império Contra-Ataca'
        foreach ($film['characters'] as $characterUrl) {
            $charResponse = Http::get($characterUrl);
            if ($charResponse->successful()) {
                $characters[] = $charResponse->json()['name'];
            }
        }

        return response()->json([
            'title' => $film['title'],
            'characters' => $characters
        ]);
    }

    // PEOPLE
    public function getPeople(Request $request)
    {
        $search = $request->query('search', '');
        $response = Http::get($this->baseUrl . 'people/');

        if ($response->failed()) {
            return response()->json(['error' => 'Erro ao consultar a API'], 500);
        }

        $people = $response->json()['results'];

        if ($search) {
            $people = array_filter($people, function ($person) use ($search) {
                return stripos($person['name'], $search) !== false;
            });
        }

        return response()->json(array_values($people));
    }

    public function getPerson($id)
    {
        $response = Http::get($this->baseUrl . 'people/' . $id . '/');

        if ($response->failed()) {
            return response()->json(['error' => 'Personagem não encontrado'], 404);
        }

        return response()->json($response->json());
    }

    // PLANETS
    public function getPlanets(Request $request)
    {
        $search = $request->query('search', '');
        $response = Http::get($this->baseUrl . 'planets/');

        if ($response->failed()) {
            return response()->json(['error' => 'Erro ao consultar a API'], 500);
        }

        $planets = $response->json()['results'];

        if ($search) {
            $planets = array_filter($planets, function ($planet) use ($search) {
                return stripos($planet['name'], $search) !== false;
            });
        }

        return response()->json(array_values($planets));
    }

    public function getPlanet($id)
    {
        $response = Http::get($this->baseUrl . 'planets/' . $id . '/');

        if ($response->failed()) {
            return response()->json(['error' => 'Planeta não encontrado'], 404);
        }

        $planet = $response->json();
        $residents = [];

        foreach ($planet['residents'] as $residentUrl) {
            $residentResponse = Http::get($residentUrl);
            if ($residentResponse->successful()) {
                $residents[] = $residentResponse->json()['name'];
            }
        }

        $planet['residents'] = $residents;
        return response()->json($planet);
    }

    // SPECIES
    public function getSpecies(Request $request)
    {
        $search = $request->query('search', '');
        $response = Http::get($this->baseUrl . 'species/');

        if ($response->failed()) {
            return response()->json(['error' => 'Erro ao consultar a API'], 500);
        }

        $species = $response->json()['results'];

        if ($search) {
            $species = array_filter($species, function ($specie) use ($search) {
                return stripos($specie['name'], $search) !== false;
            });
        }

        return response()->json(array_values($species));
    }

    public function getSpecie($id)
    {
        $response = Http::get($this->baseUrl . 'species/' . $id . '/');

        if ($response->failed()) {
            return response()->json(['error' => 'Espécie não encontrada'], 404);
        }

        return response()->json($response->json());
    }

    // STARSHIPS
    public function getStarships(Request $request)
    {
        $search = $request->query('search', '');
        $response = Http::get($this->baseUrl . 'starships/');

        if ($response->failed()) {
            return response()->json(['error' => 'Erro ao consultar a API'], 500);
        }

        $starships = $response->json()['results'];

        if ($search) {
            $starships = array_filter($starships, function ($starship) use ($search) {
                return stripos($starship['name'], $search) !== false;
            });
        }

        return response()->json(array_values($starships));
    }

    public function getStarship($id)
    {
        $response = Http::get($this->baseUrl . 'starships/' . $id . '/');

        if ($response->failed()) {
            return response()->json(['error' => 'Espaçonave não encontrada'], 404);
        }

        return response()->json($response->json());
    }

    // VEHICLES
    public function getVehicles(Request $request)
    {
        $search = $request->query('search', '');
        $response = Http::get($this->baseUrl . 'vehicles/');

        if ($response->failed()) {
            return response()->json(['error' => 'Erro ao consultar a API'], 500);
        }

        $vehicles = $response->json()['results'];

        if ($search) {
            $vehicles = array_filter($vehicles, function ($vehicle) use ($search) {
                return stripos($vehicle['name'], $search) !== false;
            });
        }

        return response()->json(array_values($vehicles));
    }

    public function getVehicle($id)
    {
        $response = Http::get($this->baseUrl . 'vehicles/' . $id . '/');

        if ($response->failed()) {
            return response()->json(['error' => 'Veículo não encontrado'], 404);
        }

        return response()->json($response->json());
    }
}
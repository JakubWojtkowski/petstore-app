<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class PetController extends Controller
{
    private string $apiUrl;

    // konstruktor
    public function __construct()
    {
        // Przypisanie wartosci z .env API_URL=https://petstore.swagger.io/v2 w konstruktorze
        $this->apiUrl = env('API_URL');
    }

    // Pobranie zwierząt na podstawie statusu
    public function getPetsByStatus(Request $request)
    {
        $status = $request->query('status', 'available');
        $response = Http::get("{$this->apiUrl}/pet/findByStatus", ['status' => $status]);

        return response()->json($response->json(), $response->status());
    }

    // Dodanie nowego zwierzęcia
    public function addPet(Request $request)
    {
        $validated = $this->validatePet($request);

        $response = Http::post("{$this->apiUrl}/pet", $validated);

        return response()->json($response->json(), $response->status());
    }

    // Pobranie zwierzęcia na podstawie ID
    public function getPetById(int $id)
    {
        $response = Http::get("{$this->apiUrl}/pet/{$id}");

        return response()->json($response->json(), $response->status());
    }


    // Aktualizacja istniejącego zwierzęcia
    public function updatePet(Request $request)
    {
        $validated = $this->validatePet($request);

        $response = Http::put("{$this->apiUrl}/pet", $validated);

        return response()->json($response->json(), $response->status());
    }

    // Usunięcie zwierzęcia na podstawie ID
    public function deletePet(int $id)
    {
        $response = Http::delete("{$this->apiUrl}/pet/{$id}");

        return response()->json($response->json(), $response->status());
    }

    // Wspólna metoda walidacji danych dla zwierzęcia
    private function validatePet(Request $request): array
    {
        return $request->validate([
            'id' => 'required|integer',
            'name' => 'required|string',
            'status' => 'required|string|in:available,pending,sold',
        ]);
    }
}

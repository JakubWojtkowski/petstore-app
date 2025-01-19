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

    // Usuniecie zwierzęcia na podstawie ID
    public function deletePet(int $id)
    {
        $response = Http::delete("{$this->apiUrl}/pet/{$id}");

        return response()->json($response->json(), $response->status());
    }

    // Funkcja do przesyłania obrazu zwierzęcia na podstawie jego ID
    public function uploadImage(Request $request, int $petId)
    {
        if (!$petId) {
            return response()->json(['error' => 'No petId provided. Try again?'], 400);
        }

        $validated = $request->validate([
            'file_url' => 'required|url',
        ]);

        // Pobranie URL obrazu
        $fileUrl = $request->input('file_url');

        if (!$fileUrl) {
            return response()->json(['error' => 'No file URL provided'], 400);
        }

        $existingPet = $this->getPetById($petId);
        if (!$existingPet) {
            return response()->json(['error' => 'Pet not found'], 404);
        }

        // Dodanie URL obrazu do listy photoUrls
        $existingPet['photoUrls'][] = $fileUrl;

        // "aktualizacja" w bazie danych
        $this->deletePet($petId); //
        $this->addPet($existingPet);

        // Pobranie zaktualizowanego zwierzęcia
        $updatedPet = $this->getPetById($petId);

        if ($updatedPet) {
            return response()->json($updatedPet, 200);
        } else {
            return response()->json(['error' => "Pet couldn't be updated."], 304);
        }
    }

    // Metoda walidacji danych
    private function validatePet(Request $request): array
    {
        return $request->validate([
            'id' => 'nullable|integer',
            'name' => 'required|string',
            'status' => 'required|string|in:available,pending,sold',
            'photoUrls' => 'nullable|array',
            'photoUrls.*' => 'string', // Każdy element w `photoUrls` musi być ciągiem znaków
            'tags' => 'nullable|array',
            'tags.*' => 'array', // Każdy element w `tags` musi być tablicą
            'tags.*.id' => 'nullable|integer', // Opcjonalne pole `id` w tagach
            'tags.*.name' => 'nullable|string', // Opcjonalne pole `name` w tagach
        ]);
    }
}

// Rozwiązanie wraz z postawieniem projektu/ustawieniem środowiska oraz instalacją potrzebnych bibliotek zajęła mi kilka godzin podzielonej na etapy pracy, 3h-4h

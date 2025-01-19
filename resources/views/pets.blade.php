<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pet-store-API</title>
    @vite('resources/css/app.css')
</head>

<body class="bg-gray-100 min-h-screen flex justify-center items-center">
    <div class="max-w-4xl w-full p-6 bg-white shadow-lg rounded-lg">
        <h1 class="text-3xl font-bold text-center text-blue-600 mb-6 flex flex-col gap-2">petstore-API<span
                class="text-xs">Jakub Wojtkowski ©</span></h1>

        <!-- Dodaj zwierzę formularz -->
        <form id="addPetForm" class="mb-6 p-4 border rounded bg-blue-50 shadow">
            <h2 class="text-xl font-semibold text-blue-800 mb-4">Add Pet</h2>
            <div class="mb-4">
                <label for="id" class=" block text-sm font-medium">ID</label>
                <input type="number" required min="1" max="99999999" step="1" id="id" name="id"
                    class="border rounded w-full p-2" placeholder="Enter pet ID" required>
            </div>
            <div class="mb-4">
                <label for="name" class="block text-sm font-medium">Name</label>
                <input type="text" id="name" name="name" class="border rounded w-full p-2" placeholder="Enter pet name"
                    required>
            </div>
            <div class="mb-4">
                <label for="status" class="block text-sm font-medium">Status</label>
                <select id="status" name="status" class="border rounded w-full p-2" required>
                    <option value="available">Available</option>
                    <option value="pending">Pending</option>
                    <option value="sold">Sold</option>
                </select>
            </div>
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Add Pet</button>
        </form>


        <!-- Formularz aktualizacji zwierzęcia -->
        <form id="updatePetForm" class="mb-6 p-4 border rounded bg-yellow-50 shadow">
            <h2 class="text-xl font-semibold text-yellow-800 mb-4">Update Pet</h2>
            <div class="mb-4">
                <label for="updateId" class="block text-sm font-medium">Pet ID</label>
                <input type="number" id="updateId" name="id" class="border rounded w-full p-2"
                    placeholder="Enter pet ID" required>
            </div>
            <div class="mb-4">
                <label for="updateName" class="block text-sm font-medium">Name</label>
                <input type="text" id="updateName" name="name" class="border rounded w-full p-2"
                    placeholder="Enter pet name" required>
            </div>
            <div class="mb-4">
                <label for="updateStatus" class="block text-sm font-medium">Status</label>
                <select id="updateStatus" name="status" class="border rounded w-full p-2" required>
                    <option value="available">Available</option>
                    <option value="pending">Pending</option>
                    <option value="sold">Sold</option>
                </select>
            </div>
            <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Update
                Pet</button>
        </form>

        <!-- Formularz pobierania zwierząt według statusu -->
        <form id="getPetsByStatusForm" class="mb-6 p-4 border rounded bg-green-50 shadow">
            <h2 class="text-xl font-semibold text-green-800 mb-4">Get Pets by Status</h2>
            <div class="mb-4">
                <label for="statusFilter" class="block text-sm font-medium">Status</label>
                <select id="statusFilter" name="status" class="border rounded w-full p-2" required>
                    <option value="available">Available</option>
                    <option value="pending">Pending</option>
                    <option value="sold">Sold</option>
                </select>
            </div>
            <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">Get Pets</button>
        </form>

        <!-- Formularz pobierania zwierzęcia według ID -->
        <form id="getPetByIdForm" class="mb-6 p-4 border rounded bg-purple-50 shadow">
            <h2 class="text-xl font-semibold text-purple-800 mb-4">Get Pet by ID</h2>
            <div class="mb-4">
                <label for="petId" class="block text-sm font-medium">Pet ID</label>
                <input type="number" id="petId" name="id" class="border rounded w-full p-2" placeholder="Enter pet ID"
                    required>
            </div>
            <button type="submit" class="bg-purple-500 text-white px-4 py-2 rounded hover:bg-purple-600">Get
                Pet</button>
        </form>

        <!-- Formularz dodania zdjęcia zwierzęciu o danym id -->
        <form id="uploadImageForm" class="mb-6 p-4 border rounded bg-indigo-50 shadow">
            <h2 class="text-xl font-semibold text-indigo-800 mb-4">Upload Image</h2>
            <div class="mb-4">
                <label for="uploadPetId" class="block text-sm font-medium">Pet ID</label>
                <input type="number" id="uploadPetId" name="id" class="border rounded w-full p-2"
                    placeholder="Enter pet ID" required>
            </div>
            <div class="mb-4">
                <label for="file" class="block text-sm font-medium">Choose File</label>
                <input type="file" id="file" name="file" class="border rounded w-full p-2" required>
            </div>
            <button type="submit" class="bg-indigo-500 text-white px-4 py-2 rounded hover:bg-indigo-600">Upload
                Image</button>
        </form>


        <!-- Formularz usunięcia zwierzęcia -->
        <form id="deletePetForm" class="mb-6 p-4 border rounded bg-red-50 shadow">
            <h2 class="text-xl font-semibold text-red-800 mb-4">Delete Pet</h2>
            <div class="mb-4">
                <label for="deleteId" class="block text-sm font-medium">Pet ID</label>
                <input type="number" id="deleteId" name="id" class="border rounded w-full p-2"
                    placeholder="Enter pet ID" required>
            </div>
            <button type="submit" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600">Delete Pet</button>
        </form>


        <!-- Sekcja z listą zwierząt -->
        <div id="petsList" class="space-y-4 p-4 border rounded bg-gray-50 shadow">
            <h2 class="text-xl font-semibold text-gray-800 mb-4">Pets List</h2>
            <p class="text-gray-500">Fetching pets...</p>
        </div>
    </div>

    <!-- Obsługa żądań wraz z obsługą błędów -->
    <script>
        // Wylistowanie dostępnych zwierząt po statusie
        async function fetchPetsByStatus(status) {
            try {
                const response = await fetch(`/api/pet/status?status=${status}`);
                if (!response.ok) throw new Error(`Error: ${response.statusText}`);
                const pets = await response.json();
                const petsList = document.getElementById('petsList');
                petsList.innerHTML = pets.map(pet => `
                    <div class="p-4 bg-gray-200 rounded shadow">
                        <h2 class="text-lg font-bold">Name: ${pet.name}</h2>
                        <p>Status: ${pet.status}</p>
                        <p>ID: ${pet.id}</p>
                    </div>
                `).join('');
            } catch (error) {
                alert(error.message);
            }
        }

        // Otrztmanie danego zwierzęcia po jego prywatnym id
        async function fetchPetById(id) {
            try {
                const response = await fetch(`/api/pet/${id}`);
                if (!response.ok) throw new Error(`Error: ${response.statusText}`);
                const pet = await response.json();
                const petsList = document.getElementById('petsList');
                petsList.innerHTML = `
                    <div class="p-4 bg-gray-200 rounded shadow">
                        <h2 class="text-lg font-bold">Name: ${pet.name}</h2>
                        <p>Status: ${pet.status}</p>
                        <p>ID: ${pet.id}</p>
                    </div>
                `;
            } catch (error) {
                alert(error.message);
            }
        }

        // Dodanie zwierzęcia, obsługa błędu - zwrócony zostaje alert
        async function addPet(event) {
            event.preventDefault();

            try {
                const form = document.getElementById('addPetForm');
                const formData = new FormData(form);

                // FormData -> obiekt
                const petData = Object.fromEntries(formData);

                const response = await fetch('/api/pet', {
                    method: 'POST',
                    body: JSON.stringify(petData),
                    headers: { 'Content-Type': 'application/json' },
                });

                if (!response.ok) {
                    const errorData = await response.json();
                    throw new Error(errorData.message || `Error: ${response.statusText}`);
                }

                alert('Pet added successfully!');
                form.reset();
            } catch (error) {
                alert(`Failed to add pet: ${error.message}`);
            }
        }

        // Podłączenie zdarzenia do formularza
        document.getElementById('addPetForm').addEventListener('submit', addPet);


        // Aktualizacja zwierzęcia, obsługa błędu - zwrócony zostaje alert
        async function updatePet(event) {
            event.preventDefault();
            try {
                const form = document.getElementById('updatePetForm');
                const formData = new FormData(form);
                const response = await fetch('/api/pet', {
                    method: 'PUT',
                    body: JSON.stringify(Object.fromEntries(formData)),
                    headers: { 'Content-Type': 'application/json' }
                });
                if (!response.ok) throw new Error(`Error: ${response.statusText}`);
                alert('Pet updated successfully!');
                form.reset();
            } catch (error) {
                alert(error.message);
            }
        }

        // Usunięcie zwierzęcia na podstawie ID
        async function deletePet(event) {
            event.preventDefault();
            try {
                const id = document.getElementById('deleteId').value;
                const response = await fetch(`/api/pet/${id}`, {
                    method: 'DELETE',
                    headers: { 'Content-Type': 'application/json' },
                });
                if (!response.ok) throw new Error(`Error: ${response.statusText}`);
                alert('Pet deleted successfully!');
                document.getElementById('deletePetForm').reset();
                fetchPetsByStatus('available'); // Odświeżenie listy
            } catch (error) {
                alert(error.message);
            }
        }

        // Listeningi -------------------------------------------

        // get by status form
        document.getElementById('getPetsByStatusForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const status = document.getElementById('statusFilter').value;
            fetchPetsByStatus(status);
        });

        // get by id form
        document.getElementById('getPetByIdForm').addEventListener('submit', (e) => {
            e.preventDefault();
            const id = document.getElementById('petId').value;
            fetchPetById(id);
        });

        // add form
        document.getElementById('addPetForm').addEventListener('submit', addPet);

        // update form
        document.getElementById('updatePetForm').addEventListener('submit', updatePet);

        // delete form
        document.getElementById('deletePetForm').addEventListener('submit', deletePet);

        // Przeładowanie zwierząt ze statusem "available"
        fetchPetsByStatus('available');
    </script>
</body>

</html>

@include('partials.header')
<script src="https://cdn.tailwindcss.com/3.4.16"></script>


<div class="container mx-auto px-6 py-12 bg-gradient-to-r from-purple-700 via-purple-800 to-pink-600 rounded-lg shadow-lg">
    <h2 class="text-4xl text-white font-bold mb-6 text-center">Ajouter un Manga</h2>

    <form method="POST" action="{{ route('manga.store') }}" class="bg-white p-8 rounded-lg shadow-xl">
        @csrf
        <input type="hidden" name="content_id" value="{{ $content_id }}">

        <div class="space-y-6">
            <div class="form-group">
                <label for="nbr_chapitres" class="text-lg font-semibold text-gray-800">Nombre de chapitres</label>
                <input type="number" name="nbr_chapitres" class="w-full px-4 py-3 border border-purple-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all" required>
            </div>

            <div class="form-group">
                <label for="auteur" class="text-lg font-semibold text-gray-800">Auteur</label>
                <input type="text" name="auteur" class="w-full px-4 py-3 border border-purple-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all" required>
            </div>

            <div class="form-group">
                <label for="date_debut" class="text-lg font-semibold text-gray-800">Date de début</label>
                <input type="date" name="date_debut" class="w-full px-4 py-3 border border-purple-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all" required>
            </div>

            <div class="form-group">
                <label for="date_fin" class="text-lg font-semibold text-gray-800">Date de fin</label>
                <input type="date" name="date_fin" class="w-full px-4 py-3 border border-purple-300 rounded-md focus:outline-none focus:ring-2 focus:ring-purple-500 transition-all" required>
            </div>

            <div class="flex justify-center">
                <button type="submit" class="bg-purple-600 text-white font-semibold px-6 py-3 rounded-full text-lg transition-transform transform hover:scale-105">
                    Enregistrer
                </button>
            </div>
        </div>
    </form>
</div>

<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #f8f9ff;
    }
</style>

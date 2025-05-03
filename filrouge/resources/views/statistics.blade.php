<script src="https://cdn.tailwindcss.com/3.4.16"></script>
@include('partials.header')

<div class="container mx-auto px-6 py-8  rounded-lg shadow-lg">
    <h1 class="text-4xl font-extrabold text-white text-center mb-8 transform transition duration-300 ease-in-out hover:scale-105">Statistiques du Site</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-8 mb-12">
        <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out">
            <h2 class="text-2xl font-bold text-purple-700 mb-4">Total des Utilisateurs</h2>
            <p class="text-5xl font-semibold text-purple-600 mt-4">{{ $totalUsers }}</p>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out">
            <h2 class="text-2xl font-bold text-purple-700 mb-4">Total des Animés</h2>
            <p class="text-5xl font-semibold text-purple-600 mt-4">{{ $totalAnimes }}</p>
        </div>

        <div class="bg-white p-8 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300 ease-in-out">
            <h2 class="text-2xl font-bold text-purple-700 mb-4">Total des Mangas</h2>
            <p class="text-5xl font-semibold text-purple-600 mt-4">{{ $totalMangas }}</p>
        </div>
    </div>

    <div class="bg-white p-8 rounded-lg shadow-lg">
        <h2 class="text-3xl font-bold text-black mb-6">Répartition des Catégories</h2>
        <table class="w-full table-auto border-collapse text-sm">
            <thead>
                <tr class="bg-purple-100">
                    <th class="px-6 py-3 text-left text-purple-600">Catégorie</th>
                    <th class="px-6 py-3 text-left text-purple-600">Animes</th>
                    <th class="px-6 py-3 text-left text-purple-600">Mangas</th>
                </tr>
            </thead>
            <tbody class="bg-white">
                @foreach ($categories as $category)
                <tr class="border-b border-gray-200 hover:bg-purple-50 transition duration-200">
                    <td class="px-6 py-4 text-purple-600">{{ $category->nom }}</td>
                    <td class="px-6 py-4 text-purple-600">{{ $category->animes_count }}</td>
                    <td class="px-6 py-4 text-purple-600">{{ $category->mangas_count }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

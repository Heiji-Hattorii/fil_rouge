@include('partials.header')
<script src="https://cdn.tailwindcss.com/3.4.16"></script>

<form action="{{ route('manga.pages.store', ['chapitre_id' => $chapitre->id]) }}" method="POST" enctype="multipart/form-data" class="max-w-3xl mx-auto mt-10 p-6 bg-violet-900 text-white rounded-xl shadow-lg">
    @csrf

    <div id="pages-container" class="space-y-6">
        <div class="page-group border border-violet-700 p-4 rounded-lg bg-violet-800">
            <label class="block mb-2 font-semibold text-violet-200">Image de la page :</label>
            <input type="file" name="pages[]" required class="w-full px-4 py-2 bg-violet-100 text-violet-900 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-violet-500">

            <label class="block mb-2 font-semibold text-violet-200">Numéro de la page :</label>
            <input type="number" name="numero_page" required min="1" class="w-full px-4 py-2 bg-violet-100 text-violet-900 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500">
        </div>
    </div>

    <div class="flex space-x-4 mt-6">
        <button type="button" onclick="ajouterPage()" class="bg-violet-700 hover:bg-violet-600 transition-colors px-4 py-2 rounded-md font-bold text-white">
            Ajouter une autre page
        </button>
        <button type="submit" class="bg-violet-700 hover:bg-violet-600 transition-colors px-4 py-2 rounded-md font-bold text-white">
            Envoyer
        </button>
    </div>
</form>

<script>
function ajouterPage() {
    const container = document.getElementById('pages-container');
    const group = document.createElement('div');
    group.className = 'page-group border border-violet-700 p-4 rounded-lg bg-violet-800 mt-4';
    group.innerHTML = `
        <label class="block mb-2 font-semibold text-violet-200">Image de la page :</label>
        <input type="file" name="pages[]" required class="w-full px-4 py-2 bg-violet-100 text-violet-900 rounded-md mb-4 focus:outline-none focus:ring-2 focus:ring-violet-500">

        <label class="block mb-2 font-semibold text-violet-200">Numéro de la page :</label>
        <input type="number" name="numero_page[]" required min="1" class="w-full px-4 py-2 bg-violet-100 text-violet-900 rounded-md focus:outline-none focus:ring-2 focus:ring-violet-500">
    `;
    container.appendChild(group);
}
</script>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Catégories</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css" rel="stylesheet">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="p-10 bg-gray-100">

    <h1 class="text-2xl font-bold mb-4">Gestion des catégories</h1>

    <button onclick="document.getElementById('addModal').classList.remove('hidden')" class="bg-blue-500 text-white px-4 py-2 rounded">Ajouter une catégorie</button>

    <table class="w-full mt-4 bg-white shadow rounded">
        <thead class="bg-gray-200">
            <tr>
                <th class="p-2 text-left">ID</th>
                <th class="p-2 text-left">Nom</th>
                <th class="p-2 text-left">Icone</th>
                <th class="p-2 text-left">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $cat)
                <tr class="border-b">
                    <td class="p-2">{{ $cat->id }}</td>
                    <td class="p-2">{{ $cat->nom }}</td>
                    <td class="p-2"> <i class="{{ $cat->icone }} 3xl "></i></td>
                    <td class="p-2">
                        <button onclick="openEditModal({{ $cat->id }}, '{{ $cat->nom }}','{{ $cat->icone }}')" class="bg-yellow-500 text-white px-3 py-1 rounded">Modifier</button>
                        <button onclick="openDeleteModal({{ $cat->id }})" class="bg-red-500 text-white px-3 py-1 rounded">Supprimer</button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- Modal Ajout --}}
    <div id="addModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
        <form method="POST" action="{{ route('category.store') }}" class="bg-white p-6 rounded shadow">
            @csrf
            <h2 class="text-xl font-semibold mb-4">Ajouter une catégorie</h2>
            <input type="text" name="nom" placeholder="Nom de la catégorie" class="w-full p-2 border rounded mb-4" required>
            <input type="text" name="icone" placeholder="icone" class="w-full p-2 border rounded mb-4" required>
            <div class="flex justify-end gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Ajouter</button>
                <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')" class="px-4 py-2 border rounded">Annuler</button>
            </div>
        </form>
    </div>

    <div id="editModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
        <form method="POST" id="editForm" class="bg-white p-6 rounded shadow">
            @csrf
            @method('PUT')
            <h2 class="text-xl font-semibold mb-4">Modifier la catégorie</h2>
            <input type="text" name="nom" id="editNom" class="w-full p-2 border rounded mb-4" required>
            <input type="text" name="icone" id="editIcone" class="w-full p-2 border rounded mb-4" required>
            <div class="flex justify-end gap-2">
                <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded">Modifier</button>
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')" class="px-4 py-2 border rounded">Annuler</button>
            </div>
        </form>
    </div>

    <div id="deleteModal" class="hidden fixed inset-0 bg-black bg-opacity-40 flex items-center justify-center">
        <form method="POST" id="deleteForm" class="bg-white p-6 rounded shadow">
            @csrf
            @method('DELETE')
            <h2 class="text-xl font-semibold mb-4">Supprimer cette catégorie ?</h2>
            <div class="flex justify-end gap-2">
                <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded">Supprimer</button>
                <button type="button" onclick="document.getElementById('deleteModal').classList.add('hidden')" class="px-4 py-2 border rounded">Annuler</button>
            </div>
        </form>
    </div>
    <script>
        function openEditModal(id, nom,icone) {
            const form = document.getElementById('editForm');
            form.action = `/categories/${id}`;
            document.getElementById('editNom').value = nom;
            document.getElementById('editIcone').value = icone;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function openDeleteModal(id) {
            const form = document.getElementById('deleteForm');
            form.action = `/categories/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }
    </script>
</body>
</html>

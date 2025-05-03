<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des catégories - Anime & Manga</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:wght@400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8f9ff;
        }

        .modal {
            background-color: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(4px);
        }

        .table-container {
            overflow-x: auto;
            border-radius: 12px;
            box-shadow: 0 4px 20px rgba(107, 70, 193, 0.1);
        }

        table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        th {
            background-color: #8b5cf6;
            color: white;
            font-weight: 600;
            text-align: left;
            padding: 16px;
        }

        th:first-child {
            border-top-left-radius: 12px;
        }

        th:last-child {
            border-top-right-radius: 12px;
        }

        tr:nth-child(even) {
            background-color: #f5f3ff;
        }

        tr:nth-child(odd) {
            background-color: white;
        }

        td {
            padding: 16px;
            border-bottom: 1px solid #f0e7ff;
        }

        .btn-[#6b46c1] {
            background-color: #6b46c1;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-[#6b46c1]:hover {
            background-color: #7c3aed;
            transform: translateY(-2px);
        }

        .btn-secondary {
            background-color: transparent;
            border: 1px solid #6b46c1;
            color: #6b46c1;
            transition: all 0.3s ease;
        }

        .btn-secondary:hover {
            background-color: #f5f3ff;
            transform: translateY(-2px);
        }

        .btn-danger {
            background-color: #f87171;
            color: white;
            transition: all 0.3s ease;
        }

        .btn-danger:hover {
            background-color: #ef4444;
            transform: translateY(-2px);
        }

        input {
            border: 1px solid #e2e8f0;
            transition: all 0.3s ease;
        }

        input:focus {
            border-color: #8b5cf6;
            box-shadow: 0 0 0 3px rgba(139, 92, 246, 0.2);
            outline: none;
        }
    </style>
</head>

<body class="min-h-screen">
    @include('partials.header')
    <div class="max-w-7xl mx-auto pt-20 px-4 py-8">
        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-[#6b46c1]">Gestion des catégories</h1>
            <button onclick="document.getElementById('addModal').classList.remove('hidden')"
                class="btn-[#6b46c1] !rounded-button px-6 py-3 font-medium flex items-center whitespace-nowrap">
                <div class="w-5 h-5 flex items-center justify-center mr-2">
                    <i class="ri-add-line"></i>
                </div>
                Ajouter une catégorie
            </button>
        </div>

        <div class="table-container bg-white">
            <table>
                <thead>
                    <tr>
                        <th class="w-1/4 text-center">Nom</th>
                        <th class="w-1/4 text-center">Icône</th>
                        <th class="w-2/4 text-center">Actions</th>

                    </tr>
                </thead>
                <tbody>
                    @foreach ($categories as $cat)
                        <tr>
                            <td class="text-center">{{ $cat->nom }}</td>
                            <td class="text-center">
                                <div class="w-10 h-10 flex items-center justify-center mx-auto bg-violet-100 rounded-full">
                                    <i class="{{ $cat->icone }} text-[#6b46c1] text-2xl"></i>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-center gap-3">
                                    <button onclick="openEditModal({{ $cat->id }}, '{{ $cat->nom }}','{{ $cat->icone }}')"
                                        class="btn-secondary !rounded-button px-4 py-2 whitespace-nowrap flex items-center">
                                        <div class="w-5 h-5 flex items-center justify-center mr-1">
                                            <i class="ri-edit-line"></i>
                                        </div>
                                        Modifier
                                    </button>
                                    <button onclick="openDeleteModal({{ $cat->id }})"
                                        class="btn-danger !rounded-button px-4 py-2 whitespace-nowrap flex items-center">
                                        <div class="w-5 h-5 flex items-center justify-center mr-1">
                                            <i class="ri-delete-bin-line"></i>
                                        </div>
                                        Supprimer
                                    </button>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="addModal" class="hidden fixed inset-0 z-50 modal flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-[#6b46c1] mb-6">Ajouter une catégorie</h2>
                <form method="POST" action="{{ route('category.store') }}" class="space-y-6">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="nom" class="block text-sm font-medium text-gray-700 mb-1">Nom de la
                                catégorie</label>
                            <input type="text" name="nom" id="nom" placeholder="Ex: Shonen, Seinen, Romance..." required
                                class="w-full px-4 py-3 rounded border-none bg-violet-50 focus:bg-white">
                        </div>
                        <div>
                            <label for="icone" class="block text-sm font-medium text-gray-700 mb-1">Classe
                                d'icône</label>
                            <input type="text" name="icone" id="icone" placeholder="Ex: ri-sword-line, ri-fire-line..."
                                required class="w-full px-4 py-3 rounded border-none bg-violet-50 focus:bg-white">
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-8">
                        <button type="button" onclick="document.getElementById('addModal').classList.add('hidden')"
                            class="btn-secondary !rounded-button px-5 py-2.5 whitespace-nowrap">Annuler</button>
                        <button type="submit"
                            class="btn-[#6b46c1] !rounded-button px-5 py-2.5 whitespace-nowrap">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editModal" class="hidden fixed inset-0 z-50 modal flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-[#6b46c1] mb-6">Modifier la catégorie</h2>
                <form method="POST" id="editForm" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="editNom" class="block text-sm font-medium text-gray-700 mb-1">Nom de la
                                catégorie</label>
                            <input type="text" name="nom" id="editNom" required
                                class="w-full px-4 py-3 rounded border-none bg-violet-50 focus:bg-white">
                        </div>
                        <div>
                            <label for="editIcone" class="block text-sm font-medium text-gray-700 mb-1">Classe
                                d'icône</label>
                            <input type="text" name="icone" id="editIcone" required
                                class="w-full px-4 py-3 rounded border-none bg-violet-50 focus:bg-white">
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-8">
                        <button type="button" onclick="document.getElementById('editModal').classList.add('hidden')"
                            class="btn-secondary !rounded-button px-5 py-2.5 whitespace-nowrap">Annuler</button>
                        <button type="submit"
                            class="btn-[#6b46c1] !rounded-button px-5 py-2.5 whitespace-nowrap">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Modal Suppression -->
    <div id="deleteModal" class="hidden fixed inset-0 z-50 modal flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-red-500 mb-6">Supprimer cette catégorie </h2>
                <p class="text-gray-600 mb-6">Vous voulez Vraiment la suuprimer ?</p>
                <form method="POST" id="deleteForm" class="space-y-6">
                    @csrf
                    @method('DELETE')
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="document.getElementById('deleteModal').classList.add('hidden')"
                            class="btn-secondary !rounded-button px-5 py-2.5 whitespace-nowrap">Annuler</button>
                        <button type="submit"
                            class="btn-danger !rounded-button px-5 py-2.5 whitespace-nowrap">Supprimer</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id, nom, icone) {
            document.getElementById('editForm').action = `/categories/${id}`;
            document.getElementById('editNom').value = nom;
            document.getElementById('editIcone').value = icone;
            document.getElementById('editModal').classList.remove('hidden');
        }

        function openDeleteModal(id) {
            document.getElementById('deleteForm').action = `/categories/${id}`;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        // Fermer les modales en cliquant à l'extérieur
        document.addEventListener('DOMContentLoaded', function () {
            const modals = document.querySelectorAll('.modal');
            modals.forEach(modal => {
                modal.addEventListener('click', function (e) {
                    if (e.target === this) {
                        this.classList.add('hidden');
                    }
                });
            });
        });
    </script>
</body>

</html>
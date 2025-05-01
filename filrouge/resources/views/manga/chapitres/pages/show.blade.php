<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des Pages de Manga</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>

    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
    <style>

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9fafb;
        }

        .manga-card {
            transition: all 0.3s ease;
        }

        .manga-card:hover {
            transform: translateY(-5px);
        }

        .manga-image {
            transition: all 0.3s ease;
        }

        .manga-card:hover .manga-image {
            transform: scale(1.05);
        }

        .modal {
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
        }

        .modal.active {
            opacity: 1;
            visibility: visible;
        }

        .modal-content {
            transform: translateY(-20px);
            transition: all 0.3s ease;
        }

        .modal.active .modal-content {
            transform: translateY(0);
        }

        .file-upload-container {
            border: 2px dashed #d1d5db;
            transition: all 0.3s ease;
        }

        .file-upload-container:hover {
            border-color: #6d28d9;
        }
    </style>
</head>

<body>
    <div class="min-h-screen bg-gradient-to-b from-purple-50 to-pink-50">
        <header class="bg-white shadow-sm">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-6">
                <div class="flex justify-between items-center">
                    <h1 class="text-3xl font-bold text-gray-900">Gestion des Pages</h1>
                    <a href="{{ route('manga.chapitres.index', ['manga_id' => $chapitre->manga_id]) }}"
                        class="flex items-center text-[#9333ea] hover:text-[#9333ea]/80 font-medium transition-colors">
                        <div class="w-6 h-6 flex items-center justify-center mr-2">
                            <i class="ri-arrow-left-line"></i>
                        </div>
                        Retour aux chapitres
                    </a>
                </div>
                <div class="mt-2 flex items-center text-sm text-gray-500">
                    <div class="w-4 h-4 flex items-center justify-center mr-1">
                        <i class="ri-book-open-line"></i>
                    </div>
                    <span>Chapitre actuel : Chapitre {{ $chapitre->numero_chapitre ?? '?' }} -
                        {{ $chapitre->titre ?? 'Sans titre' }}</span>
                </div>
            </div>
        </header>
        <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
            @if($pages->isEmpty())
                <div class="flex flex-col items-center justify-center py-16 bg-white rounded-lg shadow-sm">
                    <div class="w-24 h-24 flex items-center justify-center text-gray-300 mb-4">
                        <i class="ri-file-list-3-line ri-5x"></i>
                    </div>
                    <p class="text-xl font-medium text-gray-700 mb-2">Aucune page disponible</p>
                    <p class="text-gray-500 mb-6">Ce chapitre ne contient pas encore de pages</p>
                    <a href="#"
                        class="px-5 py-2.5 bg-[#9333ea] text-white font-medium rounded-button shadow-sm hover:bg-[#9333ea]/90 transition-colors whitespace-nowrap">
                        Ajouter une page
                    </a>
                </div>
            @else
                <div class="bg-white rounded-lg shadow-sm p-6 mb-8">
                    <h2 class="text-xl font-semibold text-gray-800 mb-6">Pages du Chapitre</h2>
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">
                        @foreach($pages as $page)
                            <div class="manga-card bg-white rounded-lg overflow-hidden shadow-md border border-gray-100">
                                <div class="relative">
                                    <div
                                        class="absolute top-2 left-2 bg-purple-800 text-white text-sm font-medium px-2.5 py-1 rounded-full z-10">
                                        Page {{ $page->numero_page }}
                                    </div>
                                    <div class="h-64 overflow-hidden">
                                        <img src="{{ asset($page->contenu) }}" alt="Page {{ $page->numero_page }}"
                                            class="manga-image w-full h-full object-cover object-top">
                                    </div>
                                </div>
                                <div class="p-4">
                                    <div class="flex justify-between items-center mb-3">
                                        <a href="{{ route('manga.chapitres.pages.show', $page->chapitre_id) }}"
                                            class="text-[#9333ea] hover:text-[#9333ea]/80 font-medium flex items-center transition-colors">
                                            <div class="w-5 h-5 flex items-center justify-center mr-1">
                                                <i class="ri-eye-line"></i>
                                            </div>
                                            Afficher
                                        </a>
                                        <button
                                            onclick="openUpdateModal({{ $page->id }}, {{ $page->numero_page }}, '{{ asset($page->contenu) }}')"
                                            class="text-gray-700 hover:text-[#9333ea] flex items-center transition-colors">
                                            <div class="w-5 h-5 flex items-center justify-center mr-1">
                                                <i class="ri-edit-line"></i>
                                            </div>
                                            Modifier
                                        </button>
                                    </div>
                                    <form action="{{ route('manga.pages.destroy', $page->id) }}" method="POST"
                                        onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette page ?');"
                                        class="flex justify-center">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                            class="w-full px-4 py-2 bg-pink-50 text-pink-600 rounded-button hover:bg-pink-100 transition-colors flex items-center justify-center whitespace-nowrap">
                                            <div class="w-5 h-5 flex items-center justify-center mr-1">
                                                <i class="ri-delete-bin-line"></i>
                                            </div>
                                            Supprimer
                                        </button>
                                    </form>
                                </div>
                            </div>



                            <div id="modalOverlay" onclick="closeModal()"
            class="modal fixed inset-0 bg-black bg-opacity-50 z-40 flex items-center justify-center">
            <div id="updateModal"
                class="modal-content bg-white rounded-lg shadow-xl max-w-lg w-full mx-4 overflow-hidden"
                onclick="event.stopPropagation()">
                <div class="bg-purple-50 px-6 py-4 border-b border-purple-100">
                    <h2 class="text-xl font-semibold text-gray-800">Modifier la Page</h2>
                </div>
                <form action="{{ route('manga.pages.update', $page->id) }}" id="updateForm" method="POST"
                    enctype="multipart/form-data" class="p-6">
                    @csrf
                    <div class="mb-5">
                        <label for="numero_page" class="block text-sm font-medium text-gray-700 mb-1">Numéro de la page
                            :</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <div class="w-5 h-5 flex items-center justify-center text-gray-400">
                                    <i class="ri-hashtag"></i>
                                </div>
                            </div>
                            <input type="number" name="numero_page" id="numero_page" required min="1"
                                class="pl-10 block w-full rounded-md border-gray-300 shadow-sm focus:ring-[#9333ea] focus:border-[#9333ea] sm:text-sm h-10 border">
                        </div>
                    </div>
                    <div class="mb-5">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Image actuelle :</label>
                        <div class="border border-purple-200 rounded-md p-2 bg-purple-50">
                            <img id="current_image" src="" class="w-full h-64 object-contain rounded-md"
                                alt="Image actuelle">
                        </div>
                    </div>
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Nouvelle image (optionnel) :</label>
                        <div class="file-upload-container rounded-md p-4 text-center">
                            <div class="w-12 h-12 mx-auto flex items-center justify-center text-gray-400 mb-2">
                                <i class="ri-upload-cloud-line ri-2x"></i>
                            </div>
                            <p class="text-sm text-gray-500 mb-2">Glissez et déposez une image ou</p>
                            <label 
                                class="cursor-pointer text-[#9333ea] hover:text-[#9333ea]/80 font-medium">
                                Parcourir les fichiers
                            </label>
                            <input id="file-upload" name="contenu" type="file" class="hidden" accept="image/*">
                            <p id="file-name" class="text-sm text-gray-700 mt-2"></p>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 bg-purple-100 text-purple-700 rounded-button hover:bg-purple-200 transition-colors whitespace-nowrap">
                            Annuler
                        </button>
                        <button type="submit"
                            class="px-4 py-2 bg-[#9333ea] text-white rounded-button hover:bg-[#9333ea]/90 transition-colors whitespace-nowrap">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
                        @endforeach
                    </div>
                </div>
            @endif
        </main>


    </div>
    <script>
        function openUpdateModal(id, numero_page, image) {
    document.getElementById('numero_page').value = numero_page;
    document.getElementById('current_image').src = image;
    document.getElementById('updateForm').action = `/pages/${id}`;
    document.getElementById('modalOverlay').classList.add('active');
}

function closeModal() {
    document.getElementById('modalOverlay').classList.remove('active');
    document.getElementById('file-upload').value = '';
    document.getElementById('file-name').textContent = '';
}

document.addEventListener('DOMContentLoaded', function () {
    const fileUpload = document.getElementById('file-upload');
    const fileUploadContainer = document.querySelector('.file-upload-container');
    const fileNameDisplay = document.getElementById('file-name');

    fileUploadContainer.addEventListener('click', function () {
        fileUpload.click();
    });

    fileUpload.addEventListener('change', function () {
        if (fileUpload.files.length > 0) {
            const fileName = fileUpload.files[0].name;
            fileNameDisplay.textContent = fileName;
        }
    });+

    fileUploadContainer.addEventListener('dragover', function (e) {
        e.preventDefault();
        fileUploadContainer.classList.add('border-[#9333ea]');
    });

    fileUploadContainer.addEventListener('dragleave', function () {
        fileUploadContainer.classList.remove('border-[#9333ea]');
    });

    fileUploadContainer.addEventListener('drop', function (e) {
        e.preventDefault();
        fileUploadContainer.classList.remove('border-[#9333ea]');
        if (e.dataTransfer.files.length > 0) {
            fileUpload.files = e.dataTransfer.files;
            const fileName = e.dataTransfer.files[0].name;
            fileNameDisplay.textContent = fileName;
        }
    });
});

    </script>
</body>

</html>
<script src="https://cdn.tailwindcss.com"></script>

<div class="container mx-auto p-4">
    <h1 class="text-xl font-bold mb-4">Quiz pour le contenu : {{ $content->titre }}</h1>

    @if ($quiz === null)
        <button onclick="toggleModal('createModal')" class="bg-blue-600 text-white px-4 py-2 rounded mb-4">Créer un nouveau quiz</button>

        <div id="createModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg w-full max-w-md shadow-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Créer un quiz</h2>
                <form method="POST" action="{{ route('contents.quiz.store', $content) }}" enctype="multipart/form-data">
                    @csrf
                    <input type="text" name="titre" class="w-full border mb-2 p-2 rounded" placeholder="Titre" required>
                    <textarea name="description" class="w-full border mb-2 p-2 rounded" placeholder="Description" required></textarea>
                    <input type="file" name="photo" class="w-full border mb-2 p-2 rounded" required>

                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="toggleModal('createModal')" class="bg-gray-400 text-white px-3 py-1 rounded mr-2">Annuler</button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Créer</button>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="border rounded p-4 shadow mb-4">
            <h3 class="text-lg font-semibold">{{ $quiz->titre }}</h3>
            <p>{{ $quiz->description }}</p>
            @if (file_exists(public_path($quiz->photo)))
                <img src="{{ asset($quiz->photo) }}" width="150" alt="Image quiz" class="mt-2">
            @else
                <p class="text-red-600">Image non trouvée</p>
            @endif
            <p class="text-sm text-gray-500 mt-2"><strong>Par :</strong> {{ $quiz->user->name }}</p>

            <div class="mt-4 flex gap-2">
                <button onclick="toggleModal('editModal')" class="bg-yellow-500 text-white px-3 py-1 rounded">Modifier</button>
                <button onclick="confirmDelete({{ $quiz->id }})" class="bg-red-600 text-white px-3 py-1 rounded">Supprimer</button>
            </div>
        </div>

        <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center hidden z-50">
            <div class="bg-white rounded-lg w-full max-w-md shadow-lg p-6">
                <h2 class="text-lg font-semibold mb-4">Modifier le quiz</h2>
                <form method="POST" action="{{ route('quizzes.update', $quiz) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <input name="titre" value="{{ $quiz->titre }}" class="w-full border mb-2 p-2 rounded" required>
                    <textarea name="description" class="w-full border mb-2 p-2 rounded" required>{{ $quiz->description }}</textarea>
                    <input type="file" name="photo" class="w-full border p-2 rounded">

                    <div class="flex justify-end mt-4">
                        <button type="button" onclick="toggleModal('editModal')" class="bg-gray-400 text-white px-3 py-1 rounded mr-2">Annuler</button>
                        <button type="submit" class="bg-green-600 text-white px-4 py-2 rounded">Enregistrer</button>
                    </div>
                </form>
            </div>
        </div>

        <form id="deleteForm" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    @endif
</div>

<script>
    function toggleModal(id) {
        const modal = document.getElementById(id);
        modal.classList.toggle('hidden');
    }

    function confirmDelete(id) {
        if (confirm("Supprimer ce quiz ?")) {
            const form = document.getElementById('deleteForm');
            form.action = `/quizzes/${id}`;
            form.submit();
        }
    }
</script>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion des utilisateurs - Anime & Manga</title>
    <script src="https://cdn.tailwindcss.com/"></script>
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
        @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
        @endif

        <div class="flex justify-between items-center mb-8">
            <h1 class="text-3xl font-bold text-[#6b46c1]">Gestion des utilisateurs</h1>
            <button onclick="document.getElementById('createUserModal').classList.remove('hidden')"
                class="btn-[#6b46c1] !rounded-button px-6 py-3 font-medium flex items-center whitespace-nowrap">
                <div class="w-5 h-5 flex items-center justify-center mr-2">
                    <i class="ri-add-line"></i>
                </div>
                Ajouter un utilisateur
            </button>
        </div>

        <div class="table-container bg-white">
            <table>
                <thead>
                    <tr>
                        <th class="w-1/4 text-center">Nom</th>
                        <th class="w-1/4 text-center">Email</th>
                        <th class="w-1/4 text-center">Rôle</th>
                        <th class="w-1/4 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td class="text-center">{{ $user->name }}</td>
                        <td class="text-center">{{ $user->email }}</td>
                        <td class="text-center">{{ $user->role }}</td>
                        <td class="text-center flex gap-5">
                            <button onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', '{{ $user->role }}')"
                                class="btn-secondary !rounded-button px-4 py-2 whitespace-nowrap flex items-center ">
                                <div class="w-5 h-5 flex items-center justify-center mr-1">
                                    <i class="ri-edit-line"></i>
                                </div>
                            </button>
                            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger !rounded-button px-4 py-2 whitespace-nowrap flex items-center">
                                    <div class="w-5 h-5 flex items-center justify-center mr-1">
                                        <i class="ri-delete-bin-line"></i>
                                    </div>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <div id="createUserModal" class="hidden fixed inset-0 z-50 modal flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-[#6b46c1] mb-6">Ajouter un utilisateur</h2>
                <form method="POST" action="{{ route('users.store') }}" class="space-y-6">
                    @csrf
                    <div class="space-y-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                            <input type="text" name="name" id="name" required
                                class="w-full px-4 py-3 rounded border-none bg-violet-50 focus:bg-white">
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="email" required
                                class="w-full px-4 py-3 rounded border-none bg-violet-50 focus:bg-white">
                        </div>
                        <div>
                            <label for="role" class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
                            <select name="role" id="role" required
                                class="w-full px-4 py-3 rounded border-none bg-violet-50 focus:bg-white">
                                <option value="admin">Admin</option>
                                <option value="user">Utilisateur</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-8">
                        <button type="button" onclick="document.getElementById('createUserModal').classList.add('hidden')"
                            class="btn-secondary !rounded-button px-5 py-2.5 whitespace-nowrap">Annuler</button>
                        <button type="submit"
                            class="btn-[#6b46c1] !rounded-button px-5 py-2.5 whitespace-nowrap">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="editUserModal" class="hidden fixed inset-0 z-50 modal flex items-center justify-center p-4">
        <div class="bg-white rounded-lg shadow-xl w-full max-w-md transform transition-all">
            <div class="p-6">
                <h2 class="text-2xl font-bold text-[#6b46c1] mb-6">Modifier l'utilisateur</h2>
                <form method="POST" id="editUserForm" class="space-y-6">
                    @csrf
                    @method('PUT')
                    <div class="space-y-4">
                        <div>
                            <label for="editName" class="block text-sm font-medium text-gray-700 mb-1">Nom</label>
                            <input type="text" name="name" id="editName" required
                                class="w-full px-4 py-3 rounded border-none bg-violet-50 focus:bg-white">
                        </div>
                        <div>
                            <label for="editEmail" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                            <input type="email" name="email" id="editEmail" required
                                class="w-full px-4 py-3 rounded border-none bg-violet-50 focus:bg-white">
                        </div>
                        <div>
                            <label for="editRole" class="block text-sm font-medium text-gray-700 mb-1">Rôle</label>
                            <select name="role" id="editRole" required
                                class="w-full px-4 py-3 rounded border-none bg-violet-50 focus:bg-white">
                                <option value="admin">Admin</option>
                                <option value="user">Utilisateur</option>
                            </select>
                        </div>
                    </div>
                    <div class="flex justify-end space-x-3 mt-8">
                        <button type="button" onclick="document.getElementById('editUserModal').classList.add('hidden')"
                            class="btn-secondary !rounded-button px-5 py-2.5 whitespace-nowrap">Annuler</button>
                        <button type="submit"
                            class="btn-[#6b46c1] !rounded-button px-5 py-2.5 whitespace-nowrap">Modifier</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function openEditModal(id, name, email, role) {
            document.getElementById('editUserModal').classList.remove('hidden');
            document.getElementById('editUserForm').action = '/users/' + id;
            document.getElementById('editName').value = name;
            document.getElementById('editEmail').value = email;
            document.getElementById('editRole').value = role;
        }
    </script>
</body>

</html>

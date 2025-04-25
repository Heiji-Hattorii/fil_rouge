<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>蓮の花 - Inscription</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
    <style>

        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f9f9ff;
        }

        .title-font {
            font-family: 'Bangers', cursive;
        }

        .logo-font {
            font-family: 'Pacifico', serif;
        }

        .form-input {
            background-color: rgba(255, 255, 255, 0.9);
            border: 1px solid rgba(138, 43, 226, 0.3);
            transition: all 0.3s ease;
        }

        .form-input:focus {
            border-color: #8A2BE2;
            box-shadow: 0 0 0 3px rgba(138, 43, 226, 0.2);
        }

        .file-input-container {
            position: relative;
            overflow: hidden;
        }

        .file-input-container input[type="file"] {
            position: absolute;
            top: 0;
            left: 0;
            opacity: 0;
            width: 100%;
            height: 100%;
            cursor: pointer;
        }

        .preview-container {
            display: none;
            width: 100%;
            height: 120px;
            margin-top: 8px;
            border-radius: 8px;
            overflow: hidden;
            background-size: cover;
            background-position: center;
        }
    </style>
</head>

<body class="bg-[#f9f9ff]">
    <div class="min-h-screen flex flex-col md:flex-row">
        <div
            class="md:w-2/5 bg-gradient-to-br from-#a82974/90 to-#a82974/90 relative overflow-hidden flex items-center justify-center p-6 md:p-0">
            <div class="absolute inset-0"
                style="background-image: url('{{ asset('img/signup.jpg') }}'); background-size: cover; background-position: center;">
            </div>

            <div class="absolute inset-0 bg-purple-800 opacity-60"></div>
            <div class="relative z-10 text-white text-center max-w-md">
                <h1 class="logo-font text-4xl md:text-5xl mb-4">蓮の花</h1>
                <h2 class="title-font text-3xl md:text-4xl mb-6">L'UNIVERS DES ANIMES ET MANGAS</h2>
                <p class="mb-8 text-lg">Rejoignez notre communauté passionnée et partagez votre amour pour les animes et
                    mangas avec des milliers de fans.</p>
                <div class="space-y-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 flex items-center justify-center bg-white/20 rounded-full mr-4">
                            <i class="ri-user-heart-line text-xl"></i>
                        </div>
                        <p class="text-left">Plus de 50 000 membres actifs</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 flex items-center justify-center bg-white/20 rounded-full mr-4">
                            <i class="ri-discuss-line text-xl"></i>
                        </div>
                        <p class="text-left">Forums et discussions animés</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 flex items-center justify-center bg-white/20 rounded-full mr-4">
                            <i class="ri-calendar-event-line text-xl"></i>
                        </div>
                        <p class="text-left">Événements et conventions</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="md:w-3/5 bg-white p-6 md:p-10 flex items-center justify-center">
            <div class="w-full max-w-3xl">
                <div class="text-center mb-8">
                    <h2 class="title-font text-3xl text-gray-800 mb-2">REJOIGNEZ NOTRE COMMUNAUTÉ</h2>
                    <p class="text-gray-600">Créez votre compte et commencez votre aventure anime dès aujourd'hui</p>
                </div>
                <form action="{{ route('register') }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div class="space-y-4">
                            <h3 class="font-semibold text-lg text-gray-700 border-b border-gray-200 pb-2">Informations
                                Personnelles</h3>
                            <div class="space-y-1">
                                <label for="name" class="block text-sm font-medium text-gray-700">Nom</label>
                                <input type="text" name="name" id="name"
                                    class="form-input w-full px-4 py-3 rounded focus:outline-none" required
                                    value="{{ old('name') }}">
                                @error('name')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-1">
                                <label for="pseudo" class="block text-sm font-medium text-gray-700">Pseudo</label>
                                <input type="text" name="pseudo" id="pseudo"
                                    class="form-input w-full px-4 py-3 rounded focus:outline-none" required
                                    value="{{ old('pseudo') }}">
                                @error('pseudo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-1">
                                <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                <input type="email" name="email" id="email"
                                    class="form-input w-full px-4 py-3 rounded focus:outline-none" required
                                    value="{{ old('email') }}">
                                @error('email')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-1">
                                <label for="age" class="block text-sm font-medium text-gray-700">Âge</label>
                                <input type="number" name="age" id="age"
                                    class="form-input w-full px-4 py-3 rounded focus:outline-none border-none" required
                                    value="{{ old('age') }}">
                                @error('age')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                        <div class="space-y-4">
                            <h3 class="font-semibold text-lg text-gray-700 border-b border-gray-200 pb-2">Sécurité</h3>
                            <div class="space-y-1">
                                <label for="password" class="block text-sm font-medium text-gray-700">Mot de
                                    passe</label>
                                <div class="relative">
                                    <input type="password" name="password" id="password"
                                        class="form-input w-full px-4 py-3 rounded focus:outline-none" required>
                                    <button type="button" id="togglePassword"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                                        <div class="w-6 h-6 flex items-center justify-center">
                                            <i class="ri-eye-line"></i>
                                        </div>
                                    </button>
                                </div>
                                @error('password')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-1">
                                <label for="password_confirmation"
                                    class="block text-sm font-medium text-gray-700">Confirmer le mot de passe</label>
                                <div class="relative">
                                    <input type="password" name="password_confirmation" id="password_confirmation"
                                        class="form-input w-full px-4 py-3 rounded focus:outline-none" required>
                                    <button type="button" id="toggleConfirmPassword"
                                        class="absolute right-3 top-1/2 transform -translate-y-1/2 text-gray-500">
                                        <div class="w-6 h-6 flex items-center justify-center">
                                            <i class="ri-eye-line"></i>
                                        </div>
                                    </button>
                                </div>
                                @error('password_confirmation')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-1 mt-6">
                                <label for="bio" class="block text-sm font-medium text-gray-700">Biographie</label>
                                <textarea name="bio" id="bio" rows="4"
                                    class="form-input w-full px-4 py-3 rounded focus:outline-none resize-none"
                                    required>{{ old('bio') }}</textarea>
                                @error('bio')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="space-y-6">
                        <h3 class="font-semibold text-lg text-gray-700 border-b border-gray-200 pb-2">Photos</h3>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                            <div class="space-y-2">
                                <label for="profile_photo" class="block text-sm font-medium text-gray-700">Photo de
                                    profil</label>
                                <div class="file-input-container">
                                    <div
                                        class="bg-gray-50 border border-gray-300 border-dashed rounded-lg p-4 text-center cursor-pointer hover:bg-gray-100 transition-all">
                                        <div
                                            class="w-12 h-12 mx-auto flex items-center justify-center bg-#a82974/10 rounded-full mb-2">
                                            <i class="ri-user-add-line text-#a82974 text-xl"></i>
                                        </div>
                                        <p class="text-sm text-gray-600">Cliquez pour sélectionner une image</p>
                                        <p class="text-xs text-gray-500 mt-1">JPG, PNG ou GIF (max. 2MB)</p>
                                        <input type="file" name="profile_photo" id="profile_photo" accept="image/*"
                                            required>
                                    </div>
                                </div>
                                <div id="profile_preview" class="preview-container"></div>
                                @error('profile_photo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="space-y-2">
                                <label for="cover_photo" class="block text-sm font-medium text-gray-700">Photo de
                                    couverture</label>
                                <div class="file-input-container">
                                    <div
                                        class="bg-gray-50 border border-gray-300 border-dashed rounded-lg p-4 text-center cursor-pointer hover:bg-gray-100 transition-all">
                                        <div
                                            class="w-12 h-12 mx-auto flex items-center justify-center bg-#a82974/10 rounded-full mb-2">
                                            <i class="ri-image-add-line text-#a82974 text-xl"></i>
                                        </div>
                                        <p class="text-sm text-gray-600">Cliquez pour sélectionner une image</p>
                                        <p class="text-xs text-gray-500 mt-1">JPG, PNG ou GIF (max. 2MB)</p>
                                        <input type="file" name="cover_photo" id="cover_photo" accept="image/*"
                                            required>
                                    </div>
                                </div>
                                <div id="cover_preview" class="preview-container"></div>
                                @error('cover_photo')
                                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>
                    </div>
                    <div class="flex items-start mt-6">
                        <div class="flex items-center h-5">
                            <input id="terms" name="terms" type="checkbox"
                                class="h-4 w-4 text-#a82974 focus:ring-#a82974 border-gray-300 rounded" required>
                        </div>
                        <div class="ml-3 text-sm">
                            <label for="terms" class="font-medium text-gray-700">J'accepte les <a href="#"
                                    class="text-#a82974 hover:underline">conditions d'utilisation</a> et la <a href="#"
                                    class="text-#a82974 hover:underline">politique de confidentialité</a></label>
                        </div>
                    </div>
                    <div class="flex justify-center">
                        <button type="submit"
                            class="w-full md:w-1/2 bg-[#a82974] hover:bg-#a82974/90 text-white font-bold py-3 px-6 !rounded-button shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1 whitespace-nowrap">
                            S'inscrire
                        </button>
                    </div>
                    <div class="text-center mt-6">
                        <p class="text-gray-600">Déjà membre ? <a href="{{ route('login') }}"
                                class="text-#a82974 font-medium hover:underline">Connectez-vous</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            const togglePassword = document.getElementById('togglePassword');
            const passwordInput = document.getElementById('password');
            togglePassword.addEventListener('click', function () {
                const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                passwordInput.setAttribute('type', type);
                this.querySelector('i').className = type === 'password' ? 'ri-eye-line' : 'ri-eye-off-line';
            });
            const toggleConfirmPassword = document.getElementById('toggleConfirmPassword');
            const confirmPasswordInput = document.getElementById('password_confirmation');
            toggleConfirmPassword.addEventListener('click', function () {
                const type = confirmPasswordInput.getAttribute('type') === 'password' ? 'text' : 'password';
                confirmPasswordInput.setAttribute('type', type);
                this.querySelector('i').className = type === 'password' ? 'ri-eye-line' : 'ri-eye-off-line';
            });

            const profilePhotoInput = document.getElementById('profile_photo');
            const profilePreview = document.getElementById('profile_preview');
            profilePhotoInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        profilePreview.style.backgroundImage = `url('${e.target.result}')`;
                        profilePreview.style.display = 'block';
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });

            const coverPhotoInput = document.getElementById('cover_photo');
            const coverPreview = document.getElementById('cover_preview');
            coverPhotoInput.addEventListener('change', function () {
                if (this.files && this.files[0]) {
                    const reader = new FileReader();
                    reader.onload = function (e) {
                        coverPreview.style.backgroundImage = `url('${e.target.result}')`;
                        coverPreview.style.display = 'block';
                    }
                    reader.readAsDataURL(this.files[0]);
                }
            });
        });
    </script>
</body>

</html>
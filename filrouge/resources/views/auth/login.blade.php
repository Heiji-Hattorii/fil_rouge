
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>蓮の花 - Connexion</title>
    <script src="https://cdn.tailwindcss.com/3.4.16"></script>
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Bangers&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/remixicon/4.6.0/remixicon.min.css">
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
            border-color: #a82974;
            box-shadow: 0 0 0 3px rgba(138, 43, 226, 0.2);
        }
    </style>
</head>

<body>
    <div class="min-h-screen flex flex-col md:flex-row"> 
        <div
            class="md:w-2/5 bg-gradient-to-br from-[#a82974]/90 to-[#a82974]/90 relative overflow-hidden flex items-center justify-center p-6 md:p-0">
            <div class="absolute inset-0"
                style="background-image: url('{{ asset('img/signup.jpg') }}'); background-size: cover; background-position: center;">
            </div>

            <div class="absolute inset-0 bg-purple-800 opacity-60"></div>
            <div class="relative z-10 text-white text-center max-w-md">
                <h1 class="logo-font text-4xl md:text-5xl mb-4">AnimeManga</h1>
                <h2 class="title-font text-3xl md:text-4xl mb-6">BIENVENUE</h2>
                <p class="mb-8 text-lg">Connectez-vous pour accéder à votre univers anime et manga préféré.</p>
                <div class="space-y-6">
                    <div class="flex items-center">
                        <div class="w-10 h-10 flex items-center justify-center bg-white/20 rounded-full mr-4"> <i
                                class="ri-movie-line text-xl"></i> </div>
                        <p class="text-left">Des milliers d'animes à découvrir</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 flex items-center justify-center bg-white/20 rounded-full mr-4"> <i
                                class="ri-book-open-line text-xl"></i> </div>
                        <p class="text-left">Une bibliothèque manga immense</p>
                    </div>
                    <div class="flex items-center">
                        <div class="w-10 h-10 flex items-center justify-center bg-white/20 rounded-full mr-4"> <i
                                class="ri-team-line text-xl"></i> </div>
                        <p class="text-left">Une communauté passionnée</p>
                    </div>
                </div>
            </div>
        </div> 
        <div class="md:w-3/5 bg-white p-6 md:p-10 flex items-center justify-center">
            <div class="w-full max-w-md">
                <div class="text-center mb-12">
                    <h2 class="title-font text-3xl text-gray-800 mb-2">CONNEXION</h2>
                    <p class="text-gray-600">Accédez à votre compte 蓮の花</p>
                </div>
                <form action="{{ route('login') }}" method="POST" class="space-y-6"> @csrf <div class="space-y-4">
                        <div class="space-y-2"> <label for="email"
                                class="block text-sm font-medium text-gray-700">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"> <i
                                        class="ri-mail-line text-gray-400"></i> </div> <input type="email" name="email"
                                    id="email" class="form-input w-full pl-10 pr-4 py-3 rounded focus:outline-none"
                                    required value="{{ old('email') }}" placeholder="votre@email.com">
                            </div> @error('email') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="space-y-2"> <label for="password"
                                class="block text-sm font-medium text-gray-700">Mot de passe</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none"> <i
                                        class="ri-lock-line text-gray-400"></i> </div> <input type="password"
                                    name="password" id="password"
                                    class="form-input w-full pl-10 pr-10 py-3 rounded focus:outline-none" required
                                    placeholder="••••••••"> <button type="button" id="togglePassword"
                                    class="absolute inset-y-0 right-0 pr-3 flex items-center"> <i
                                        class="ri-eye-line text-gray-400"></i> </button>
                            </div> @error('password') <p class="text-red-500 text-xs mt-1">{{ $message }}</p> @enderror
                        </div>
                        <div class="flex items-center justify-between">
                            <div class="flex items-center"> <input id="remember" name="remember" type="checkbox"
                                    class="h-4 w-4 text-[#a82974] focus:ring-[#a82974] border-gray-300 rounded"> <label
                                    for="remember" class="ml-2 block text-sm text-gray-700">Se souvenir de moi</label>
                            </div> <a href="{{ route('password.request') }}" class="text-sm font-medium text-[#a82974] hover:text-[#a82974]/80">Mot de
                                passe oublié ?</a>
                        </div>
                    </div> <button type="submit"
                        class="bg-[#a82974] w-full hover:bg-[#a82974]/90 text-white font-bold py-3 px-6 !rounded-button shadow-lg hover:shadow-xl transition-all transform hover:-translate-y-1">
                        Se connecter </button>
                    <div class="relative my-8">
                        <div class="absolute inset-0 flex items-center">
                            <div class="w-full border-t border-gray-200"></div>
                        </div>
                        <div class="relative flex justify-center text-sm"> <span class="px-4 bg-white text-gray-500">Ou
                                continuez avec</span> </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4"> <button type="button"
                            class="flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-button text-gray-700 bg-white hover:bg-gray-50">
                            <i class="ri-google-fill text-xl mr-2 text-red-500"></i> Google </button> <button
                            type="button"
                            class="flex items-center justify-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-button text-gray-700 bg-white hover:bg-gray-50">
                            <i class="ri-discord-fill text-xl mr-2 text-indigo-500"></i> Discord </button> </div>
                    <div class="text-center mt-8">
                        <p class="text-gray-600">Pas encore membre ? <a href="{{ route('signup') }}"
                                class="text-[#a82974] font-medium hover:underline">Inscrivez-vous</a></p>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <script>
    document.addEventListener('DOMContentLoaded', function () { const togglePassword = document.getElementById('togglePassword'); 
        const passwordInput = document.getElementById('password'); 
        togglePassword.addEventListener('click', function () { const type = passwordInput.getAttribute('type') === 'password' ? 'text' : 'password'; 
        passwordInput.setAttribute('type', type); 
        this.querySelector('i').className = type === 'password' ? 'ri-eye-line text-gray-400' : 'ri-eye-off-line text-gray-400';
         });
          });
          </script>
</body>

</html>
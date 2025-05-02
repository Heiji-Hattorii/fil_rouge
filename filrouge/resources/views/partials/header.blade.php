<header class="bg-white shadow-sm fixed top-0 left-0 right-0 z-50">
    <div class="container mx-auto px-4 py-3 flex items-center justify-between">
        <div class="flex items-center">
            <a href="{{ route('welcome') }}" class="text-2xl font-['Pacifico'] font-bold text-[#8A2BE2] mr-8">蓮の花</a>
            <nav class="hidden md:flex space-x-6">
                @auth
                @if(Auth::user())
                <a href="{{ route('dashboard') }}" class="text-gray-700 hover:text-[#8A2BE2] font-medium">Dashboard</a>
                <a href="{{ route('content.index') }}" class="text-gray-700 hover:text-[#8A2BE2] font-medium">Contenus</a>
                <a href="{{ route('bibliotheques.index') }}" class="text-gray-700 hover:text-[#8A2BE2] font-medium">Bibliothèque</a>
                <a href="{{ route('rooms.index') }}" class="text-gray-700 hover:text-[#8A2BE2] font-medium">Salles</a>
                    @if(Auth::user()->role == 'admin')
                    <a href="{{ route('category.index') }}" class="text-gray-700 hover:text-[#8A2BE2] font-medium">Catégories</a>
                    <a href="{{ route('users.index') }}" class="text-gray-700 hover:text-[#8A2BE2] font-medium">Utilisateurs</a>
                    @endif
                @endif
                @endauth
            </nav>
        </div>
        <div class="flex items-center space-x-4">
            @guest
                <a href="{{ route('login') }}"
                    class="px-4 py-2 border border-[#8A2BE2] text-[#8A2BE2] hover:bg-[#8A2BE2] hover:text-white transition-colors duration-300 rounded-button whitespace-nowrap text-sm font-medium">Connexion</a>
                <a href="{{ route('signup') }}"
                    class="px-4 py-2 border border-[#8A2BE2] bg-[#8A2BE2] text-white hover:text-[#8A2BE2] hover:bg-white transition-colors duration-300 rounded-button whitespace-nowrap text-sm font-medium">Inscription</a>
            @endguest
            @auth
                <a href="{{ route('logout') }}"
                    class="px-4 py-2 border border-[#8A2BE2] bg-[#8A2BE2] text-white hover:text-[#8A2BE2] hover:bg-white transition-colors duration-300 rounded-button whitespace-nowrap text-sm font-medium"
                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Déconnexion</a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                    @csrf
                </form>
            @endauth
            <button class="md:hidden w-10 h-10 flex items-center justify-center text-gray-700">
                <i class="ri-menu-line text-2xl"></i>
            </button>
        </div>
    </div>
</header>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const menuButton = document.querySelector('.ri-menu-line').parentElement;
        const mobileNav = document.querySelector('nav');

        menuButton.addEventListener('click', function () {
            mobileNav.classList.toggle('hidden');
            mobileNav.classList.toggle('flex');
            mobileNav.classList.toggle('flex-col');
            mobileNav.classList.toggle('absolute');
            mobileNav.classList.toggle('top-16');
            mobileNav.classList.toggle('left-0');
            mobileNav.classList.toggle('right-0');
            mobileNav.classList.toggle('bg-white');
            mobileNav.classList.toggle('p-4');
        });
    });
</script>

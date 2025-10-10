<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Boutique - Cartologue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .card-hover:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="font-sans bg-gray-50">
  
   
    <!-- Navigation -->
    <nav class="bg-white shadow-lg fixed w-full z-50">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <div>
                        <a href="{{ route('accueil') }}" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-gray-500 text-2xl">Cartologue</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-1">

                        <a href="{{ route('accueil') }}" class="py-4 px-2 text-blue-500 border-b-4 border-blue-500 font-semibold">Accueil</a>
                        <a href="{{ route('boutique') }}" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Boutique</a>
                        <a href="{{ route('panier') }}" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Panier</a>
                        <a href="{{ route('contact') }}" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Contact</a>

                        
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-3">
                    <a href="{{ route('register') }}" class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-blue-500 hover:text-white transition duration-300">Connexion</a>
                    <a href="{{ route('login') }}" class="py-2 px-2 font-medium text-white bg-blue-500 rounded hover:bg-blue-600 transition duration-300">Inscription</a>
                </div>
                <div class="md:hidden flex items-center">
                    <button class="outline-none mobile-menu-button">
                        <i data-feather="menu" class="w-6 h-6 text-gray-500"></i>
                    </button>
                </div>
            </div>
        </div>
        <div class="hidden mobile-menu">
            <ul>
                <li><a href="{{ route('accueil') }}" class="block text-sm px-2 py-4 text-white bg-blue-500 font-semibold">Accueil</a></li>
                <li><a href="{{ route('boutique') }}" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">Boutique</a></li>
                <li><a href="{{ route('panier') }}" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">Panier</a></li>
                <li><a href="{{ route('contact') }}" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">Contact</a></li>
                <li><a href="{{ route('register') }}" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">Connexion</a></li>
                <li><a href="{{ route('login') }}" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">Inscription</a></li>
            </ul>
        </div>
    </nav>


    <!-- Shop Header -->
    <div class="bg-gray-800 text-white py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col md:flex-row justify-between items-center">
                <h1 class="text-3xl font-bold mb-4 md:mb-0" data-aos="fade-right">Notre collection de cartes</h1>
                <div class="flex items-center space-x-4" data-aos="fade-left">
                    <div class="relative">
                        <select class="block appearance-none bg-gray-700 border border-gray-600 text-white py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-600 focus:border-gray-500">
                            <option>Trier par</option>
                            <option>Prix croissant</option>
                            <option>Prix décroissant</option>
                            <option>Plus récent</option>
                            <option>Plus ancien</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                            <i data-feather="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                    <div class="relative">
                        <select class="block appearance-none bg-gray-700 border border-gray-600 text-white py-2 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-gray-600 focus:border-gray-500">
                            <option>Catégories</option>
                            <option>Cartes anciennes</option>
                            <option>Cartes modernes</option>
                            <option>Cartes personnalisées</option>
                            <option>Cartes topographiques</option>
                        </select>
                        <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-400">
                            <i data-feather="chevron-down" class="w-4 h-4"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Grid -->
    <section class="py-12 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-8">
                <!-- Product 1 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition-all card-hover" data-aos="fade-up">
                    <div class="relative">
                        <img src="http://static.photos/travel/640x360/4" alt="Carte ancienne" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                            -20%
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Carte du monde 1750</h3>
                        <p class="text-sm text-gray-600 mb-2">Reproduction historique</p>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-2">(24 avis)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg font-bold text-blue-600">€39.99</span>
                                <span class="text-sm text-gray-500 line-through ml-2">€49.99</span>
                            </div>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full transition duration-300">
                                <i data-feather="shopping-cart" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 2 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition-all card-hover" data-aos="fade-up" data-aos-delay="100">
                    <img src="http://static.photos/travel/640x360/5" alt="Carte topographique" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Alpes françaises</h3>
                        <p class="text-sm text-gray-600 mb-2">Carte détaillée pour randonnée</p>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-2">(18 avis)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-blue-600">€29.99</span>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full transition duration-300">
                                <i data-feather="shopping-cart" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 3 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition-all card-hover" data-aos="fade-up" data-aos-delay="200">
                    <img src="http://static.photos/travel/640x360/6" alt="Carte personnalisée" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Carte personnalisée</h3>
                        <p class="text-sm text-gray-600 mb-2">Créez votre propre carte</p>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-2">(32 avis)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-blue-600">À partir de €59.99</span>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full transition duration-300">
                                <i data-feather="shopping-cart" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 4 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition-all card-hover" data-aos="fade-up" data-aos-delay="300">
                    <div class="relative">
                        <img src="http://static.photos/travel/640x360/7" alt="Carte vintage" class="w-full h-48 object-cover">
                        <div class="absolute top-2 left-2 bg-green-500 text-white text-xs font-bold px-2 py-1 rounded">
                            Nouveau
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Paris 1900</h3>
                        <p class="text-sm text-gray-600 mb-2">Carte vintage de la capitale</p>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-2">(12 avis)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-blue-600">€45.99</span>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full transition duration-300">
                                <i data-feather="shopping-cart" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 5 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition-all card-hover" data-aos="fade-up">
                    <img src="http://static.photos/travel/640x360/8" alt="Carte maritime" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Méditerranée</h3>
                        <p class="text-sm text-gray-600 mb-2">Carte nautique détaillée</p>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-2">(15 avis)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-blue-600">€37.99</span>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full transition duration-300">
                                <i data-feather="shopping-cart" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 6 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition-all card-hover" data-aos="fade-up" data-aos-delay="100">
                    <img src="http://static.photos/travel/640x360/9" alt="Carte monde" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Monde politique</h3>
                        <p class="text-sm text-gray-600 mb-2">Carte mise à jour 2023</p>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-2">(27 avis)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-blue-600">€32.99</span>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full transition duration-300">
                                <i data-feather="shopping-cart" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 7 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition-all card-hover" data-aos="fade-up" data-aos-delay="200">
                    <div class="relative">
                        <img src="http://static.photos/travel/640x360/10" alt="Carte routière" class="w-full h-48 object-cover">
                        <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">
                            -15%
                        </div>
                    </div>
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">France routière</h3>
                        <p class="text-sm text-gray-600 mb-2">Toutes les routes et autoroutes</p>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-2">(19 avis)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <div>
                                <span class="text-lg font-bold text-blue-600">€25.49</span>
                                <span class="text-sm text-gray-500 line-through ml-2">€29.99</span>
                            </div>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full transition duration-300">
                                <i data-feather="shopping-cart" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Product 8 -->
                <div class="bg-white rounded-lg overflow-hidden shadow-md transition-all card-hover" data-aos="fade-up" data-aos-delay="300">
                    <img src="http://static.photos/travel/640x360/11" alt="Carte astronomique" class="w-full h-48 object-cover">
                    <div class="p-4">
                        <h3 class="text-lg font-semibold text-gray-800 mb-1">Carte du ciel</h3>
                        <p class="text-sm text-gray-600 mb-2">Étoiles et constellations</p>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-2">(21 avis)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-blue-600">€49.99</span>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full transition duration-300">
                                <i data-feather="shopping-cart" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Pagination -->
            <div class="flex justify-center mt-12" data-aos="fade-up">
                <nav class="flex items-center space-x-1">
                    <a href="#" class="px-3 py-1 rounded bg-blue-500 text-white">1</a>
                    <a href="#" class="px-3 py-1 rounded hover:bg-gray-200">2</a>
                    <a href="#" class="px-3 py-1 rounded hover:bg-gray-200">3</a>
                    <a href="#" class="px-3 py-1 rounded hover:bg-gray-200">4</a>
                    <a href="#" class="px-3 py-1 rounded hover:bg-gray-200">5</a>
                    <a href="#" class="px-3 py-1 rounded hover:bg-gray-200">
                        <i data-feather="chevron-right" class="w-4 h-4"></i>
                    </a>
                </nav>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-12 bg-blue-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4" data-aos="fade-up">Abonnez-vous à notre newsletter</h2>
            <p class="mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Recevez nos offres spéciales et découvrez nos nouvelles collections en avant-première</p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto" data-aos="fade-up" data-aos-delay="200">
                <input type="email" placeholder="Votre email" class="flex-grow px-4 py-2 rounded text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300">
                <button type="submit" class="bg-white text-blue-600 font-semibold px-6 py-2 rounded hover:bg-gray-100 transition duration-300">
                    S'abonner
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-8">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-semibold mb-4">Cartologue</h3>
                    <p class="text-gray-400">Votre boutique en ligne de cartes anciennes, modernes et personnalisées.</p>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Navigation</h4>
                    <ul class="space-y-2">
                        <li><a href="index.html" class="text-gray-400 hover:text-white transition duration-300">Accueil</a></li>
                        <li><a href="boutique.html" class="text-gray-400 hover:text-white transition duration-300">Boutique</a></li>
                        <li><a href="panier.html" class="text-gray-400 hover:text-white transition duration-300">Panier</a></li>
                        <li><a href="contact.html" class="text-gray-400 hover:text-white transition duration-300">Contact</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Compte</h4>
                    <ul class="space-y-2">
                        <li><a href="login.html" class="text-gray-400 hover:text-white transition duration-300">Connexion</a></li>
                        <li><a href="register.html" class="text-gray-400 hover:text-white transition duration-300">Inscription</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Mon compte</a></li>
                        <li><a href="#" class="text-gray-400 hover:text-white transition duration-300">Suivi de commande</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="font-semibold mb-4">Contact</h4>
                    <ul class="space-y-2">
                        <li class="flex items-center"><i data-feather="mail" class="w-4 h-4 mr-2"></i> <span class="text-gray-400">contact@cartologue.com</span></li>
                        <li class="flex items-center"><i data-feather="phone" class="w-4 h-4 mr-2"></i> <span class="text-gray-400">+33 1 23 45 67 89</span></li>
                        <li class="flex items-center"><i data-feather="map-pin" class="w-4 h-4 mr-2"></i> <span class="text-gray-400">123 Rue des Cartes, Paris</span></li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 flex flex-col md:flex-row justify-between items-center">
                <p class="text-gray-400 text-sm mb-4 md:mb-0">© 2023 Cartologue. Tous droits réservés.</p>
                <div class="flex space-x-6">
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i data-feather="facebook" class="w-5 h-5"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i data-feather="twitter" class="w-5 h-5"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i data-feather="instagram" class="w-5 h-5"></i></a>
                    <a href="#" class="text-gray-400 hover:text-white transition duration-300"><i data-feather="linkedin" class="w-5 h-5"></i></a>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Mobile menu toggle
        const btn = document.querySelector(".mobile-menu-button");
        const menu = document.querySelector(".mobile-menu");

        btn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });

        // Initialize AOS and Feather Icons
        document.addEventListener('DOMContentLoaded', function() {
            AOS.init({
                duration: 800,
                easing: 'ease-in-out',
                once: true
            });
            feather.replace();
        });
    </script>
</body>
</html>
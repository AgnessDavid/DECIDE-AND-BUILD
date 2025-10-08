<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Cartologue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <style>
        .hero-gradient {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        }
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
                        <a href="index.html" class="flex items-center py-4 px-2">
                            <span class="font-semibold text-gray-500 text-2xl">Cartologue</span>
                        </a>
                    </div>
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="index.html" class="py-4 px-2 text-blue-500 border-b-4 border-blue-500 font-semibold">Accueil</a>
                        <a href="boutique.html" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Boutique</a>
                        <a href="panier.html" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Panier</a>
                        <a href="contact.html" class="py-4 px-2 text-gray-500 font-semibold hover:text-blue-500 transition duration-300">Contact</a>
                    </div>
                </div>
                <div class="hidden md:flex items-center space-x-3">
                    <a href="login.html" class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-blue-500 hover:text-white transition duration-300">Connexion</a>
                    <a href="register.html" class="py-2 px-2 font-medium text-white bg-blue-500 rounded hover:bg-blue-600 transition duration-300">Inscription</a>
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
                <li><a href="index.html" class="block text-sm px-2 py-4 text-white bg-blue-500 font-semibold">Accueil</a></li>
                <li><a href="boutique.html" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">Boutique</a></li>
                <li><a href="panier.html" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">Panier</a></li>
                <li><a href="contact.html" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">Contact</a></li>
                <li><a href="login.html" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">Connexion</a></li>
                <li><a href="register.html" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">Inscription</a></li>
            </ul>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="hero-gradient text-white pt-24 pb-20">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-12 items-center">
                <div data-aos="fade-right">
                    <h1 class="text-4xl md:text-5xl font-bold mb-6">Explorez le monde à travers nos cartes</h1>
                    <p class="text-lg mb-8 text-gray-100">Découvrez notre collection exceptionnelle de cartes anciennes, modernes et personnalisées. Chaque carte raconte une histoire unique.</p>
                    <div class="flex flex-col sm:flex-row gap-4">
                        <a href="boutique.html" class="bg-white text-blue-600 font-semibold px-8 py-3 rounded-lg hover:bg-gray-100 transition duration-300 text-center">
                            Voir la boutique
                        </a>
                        <a href="contact.html" class="border-2 border-white text-white font-semibold px-8 py-3 rounded-lg hover:bg-white hover:text-blue-600 transition duration-300 text-center">
                            Nous contacter
                        </a>
                    </div>
                </div>
                <div data-aos="fade-left">
                    <img src="http://static.photos/travel/640x480/1" alt="Cartes vintage" class="rounded-lg shadow-2xl">
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-16" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Pourquoi choisir Cartologue ?</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">Nous offrons une expérience unique pour tous les passionnés de cartographie</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="bg-blue-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-feather="award" class="w-8 h-8 text-blue-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Qualité Premium</h3>
                    <p class="text-gray-600">Toutes nos cartes sont soigneusement sélectionnées et vérifiées pour garantir une qualité exceptionnelle</p>
                </div>
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="bg-green-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-feather="truck" class="w-8 h-8 text-green-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Livraison Rapide</h3>
                    <p class="text-gray-600">Expédition sous 24h avec un emballage sécurisé pour protéger vos précieuses cartes</p>
                </div>
                <div class="text-center p-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="bg-purple-100 w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <i data-feather="edit-3" class="w-8 h-8 text-purple-600"></i>
                    </div>
                    <h3 class="text-xl font-semibold mb-3">Personnalisation</h3>
                    <p class="text-gray-600">Créez des cartes sur mesure selon vos besoins et vos préférences esthétiques</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Featured Products -->
    <section class="py-20 bg-gray-50">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Nos cartes populaires</h2>
                <p class="text-gray-600">Découvrez notre sélection des meilleures ventes</p>
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-8">
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
                            <span class="text-xs text-gray-500 ml-2">(24)</span>
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
                        <p class="text-sm text-gray-600 mb-2">Carte détaillée</p>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-2">(18)</span>
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
                        <p class="text-sm text-gray-600 mb-2">Créez votre carte</p>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-2">(32)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-blue-600">€59.99</span>
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
                        <p class="text-sm text-gray-600 mb-2">Carte vintage</p>
                        <div class="flex items-center mb-3">
                            <div class="flex text-yellow-400">
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4 fill-current"></i>
                                <i data-feather="star" class="w-4 h-4"></i>
                            </div>
                            <span class="text-xs text-gray-500 ml-2">(12)</span>
                        </div>
                        <div class="flex justify-between items-center">
                            <span class="text-lg font-bold text-blue-600">€45.99</span>
                            <button class="bg-blue-500 hover:bg-blue-600 text-white p-2 rounded-full transition duration-300">
                                <i data-feather="shopping-cart" class="w-4 h-4"></i>
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="text-center mt-12" data-aos="fade-up">
                <a href="boutique.html" class="inline-block bg-blue-600 text-white font-semibold px-8 py-3 rounded-lg hover:bg-blue-700 transition duration-300">
                    Voir toutes les cartes
                </a>
            </div>
        </div>
    </section>

    <!-- Testimonials -->
    <section class="py-20 bg-white">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="text-center mb-12" data-aos="fade-up">
                <h2 class="text-3xl md:text-4xl font-bold text-gray-800 mb-4">Ce que disent nos clients</h2>
                <p class="text-gray-600">Des milliers de clients satisfaits à travers le monde</p>
            </div>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <div class="bg-gray-50 p-6 rounded-lg" data-aos="fade-up">
                    <div class="flex text-yellow-400 mb-4">
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                    </div>
                    <p class="text-gray-700 mb-4">"Une collection magnifique ! J'ai trouvé la carte parfaite pour décorer mon bureau. La qualité est exceptionnelle."</p>
                    <div class="flex items-center">
                        <div class="bg-blue-500 text-white rounded-full w-10 h-10 flex items-center justify-center font-semibold">
                            ML
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-800">Marie Laurent</p>
                            <p class="text-sm text-gray-600">Paris, France</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg" data-aos="fade-up" data-aos-delay="100">
                    <div class="flex text-yellow-400 mb-4">
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                    </div>
                    <p class="text-gray-700 mb-4">"Service impeccable et livraison rapide. Les cartes personnalisées sont parfaites pour offrir en cadeau !"</p>
                    <div class="flex items-center">
                        <div class="bg-green-500 text-white rounded-full w-10 h-10 flex items-center justify-center font-semibold">
                            PD
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-800">Pierre Dubois</p>
                            <p class="text-sm text-gray-600">Lyon, France</p>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 p-6 rounded-lg" data-aos="fade-up" data-aos-delay="200">
                    <div class="flex text-yellow-400 mb-4">
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                        <i data-feather="star" class="w-5 h-5 fill-current"></i>
                    </div>
                    <p class="text-gray-700 mb-4">"Passionnée de cartographie, j'ai trouvé mon bonheur chez Cartologue. Une vraie mine d'or pour les collectionneurs."</p>
                    <div class="flex items-center">
                        <div class="bg-purple-500 text-white rounded-full w-10 h-10 flex items-center justify-center font-semibold">
                            SB
                        </div>
                        <div class="ml-3">
                            <p class="font-semibold text-gray-800">Sophie Bernard</p>
                            <p class="text-sm text-gray-600">Bordeaux, France</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Newsletter -->
    <section class="py-16 bg-blue-600 text-white">
        <div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h2 class="text-3xl font-bold mb-4" data-aos="fade-up">Abonnez-vous à notre newsletter</h2>
            <p class="mb-8 max-w-2xl mx-auto" data-aos="fade-up" data-aos-delay="100">Recevez nos offres spéciales et découvrez nos nouvelles collections en avant-première</p>
            <form class="flex flex-col sm:flex-row gap-4 max-w-md mx-auto" data-aos="fade-up" data-aos-delay="200">
                <input type="email" placeholder="Votre email" class="flex-grow px-4 py-3 rounded-lg text-gray-800 focus:outline-none focus:ring-2 focus:ring-blue-300">
                <button type="submit" class="bg-white text-blue-600 font-semibold px-6 py-3 rounded-lg hover:bg-gray-100 transition duration-300">
                    S'abonner
                </button>
            </form>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
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
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier - Cartologue</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>
    <script src="https://unpkg.com/feather-icons"></script>
    <style>
        .transition-all {
            transition: all 0.3s ease;
        }
    </style>
</head>
<body class="font-sans bg-gray-50">
   
    <!-- Navigation -->
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
                    <a href="{{ route('login') }}" class="py-2 px-2 font-medium text-gray-500 rounded hover:bg-blue-500 hover:text-white transition duration-300">Connexion</a>
                    <a href="{{ route('register') }}" class="py-2 px-2 font-medium text-white bg-blue-500 rounded hover:bg-blue-600 transition duration-300">Inscription</a>
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


    <!-- Cart Header -->
    <div class="bg-gray-800 text-white py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 text-center">
            <h1 class="text-3xl font-bold mb-4" data-aos="fade-down">Votre panier</h1>
            <p class="text-gray-300 max-w-2xl mx-auto" data-aos="fade-down" data-aos-delay="100">
                Consultez et modifiez les articles de votre panier avant de passer commande
            </p>
        </div>
    </div>

    <!-- Cart Content -->
    <section class="py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex flex-col lg:flex-row gap-8">
                <!-- Cart Items -->
                <div class="lg:w-2/3" data-aos="fade-right">
                    <div class="bg-white rounded-lg shadow-md overflow-hidden">
                        <!-- Cart Header -->
                        <div class="bg-gray-100 px-6 py-4 border-b border-gray-200 hidden md:block">
                            <div class="grid grid-cols-12 gap-4">
                                <div class="col-span-6 font-semibold text-gray-700">Produit</div>
                                <div class="col-span-2 font-semibold text-gray-700 text-center">Prix</div>
                                <div class="col-span-2 font-semibold text-gray-700 text-center">Quantité</div>
                                <div class="col-span-2 font-semibold text-gray-700 text-right">Total</div>
                            </div>
                        </div>
                        
                        <!-- Cart Item 1 -->
                        <div class="p-4 md:p-6 border-b border-gray-200">
                            <div class="flex flex-col md:flex-row md:items-center">
                                <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                                    <img src="http://static.photos/travel/200x200/1" alt="Carte ancienne" class="w-20 h-20 object-cover rounded">
                                </div>
                                <div class="flex-grow md:grid md:grid-cols-12 md:gap-4">
                                    <div class="md:col-span-5 mb-2 md:mb-0">
                                        <h3 class="font-semibold text-gray-800">Carte du monde 1750</h3>
                                        <p class="text-sm text-gray-600">Reproduction historique</p>
                                    </div>
                                    <div class="md:col-span-2 flex items-center justify-center mb-2 md:mb-0">
                                        <span class="text-gray-700">€39.99</span>
                                    </div>
                                    <div class="md:col-span-2 flex items-center justify-center mb-4 md:mb-0">
                                        <div class="flex items-center border border-gray-300 rounded">
                                            <button class="px-2 py-1 text-gray-600 hover:bg-gray-100">
                                                <i data-feather="minus" class="w-4 h-4"></i>
                                            </button>
                                            <span class="px-3 py-1">1</span>
                                            <button class="px-2 py-1 text-gray-600 hover:bg-gray-100">
                                                <i data-feather="plus" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2 flex items-center justify-end">
                                        <span class="font-semibold text-gray-800">€39.99</span>
                                    </div>
                                    <div class="md:col-span-1 flex items-center justify-end">
                                        <button class="text-red-500 hover:text-red-700">
                                            <i data-feather="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Cart Item 2 -->
                        <div class="p-4 md:p-6 border-b border-gray-200">
                            <div class="flex flex-col md:flex-row md:items-center">
                                <div class="flex-shrink-0 mb-4 md:mb-0 md:mr-6">
                                    <img src="http://static.photos/travel/200x200/2" alt="Carte topographique" class="w-20 h-20 object-cover rounded">
                                </div>
                                <div class="flex-grow md:grid md:grid-cols-12 md:gap-4">
                                    <div class="md:col-span-5 mb-2 md:mb-0">
                                        <h3 class="font-semibold text-gray-800">Alpes françaises</h3>
                                        <p class="text-sm text-gray-600">Carte détaillée pour randonnée</p>
                                    </div>
                                    <div class="md:col-span-2 flex items-center justify-center mb-2 md:mb-0">
                                        <span class="text-gray-700">€29.99</span>
                                    </div>
                                    <div class="md:col-span-2 flex items-center justify-center mb-4 md:mb-0">
                                        <div class="flex items-center border border-gray-300 rounded">
                                            <button class="px-2 py-1 text-gray-600 hover:bg-gray-100">
                                                <i data-feather="minus" class="w-4 h-4"></i>
                                            </button>
                                            <span class="px-3 py-1">2</span>
                                            <button class="px-2 py-1 text-gray-600 hover:bg-gray-100">
                                                <i data-feather="plus" class="w-4 h-4"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="md:col-span-2 flex items-center justify-end">
                                        <span class="font-semibold text-gray-800">€59.98</span>
                                    </div>
                                    <div class="md:col-span-1 flex items-center justify-end">
                                        <button class="text-red-500 hover:text-red-700">
                                            <i data-feather="trash-2" class="w-5 h-5"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Cart Actions -->
                        <div class="p-4 md:p-6 flex justify-between items-center">
                            <a href="{{ route('boutique') }}" class="flex items-center text-blue-500 hover:text-blue-700">
                                <i data-feather="arrow-left" class="w-4 h-4 mr-2"></i>
                                Continuer vos achats
                            </a>
                            <button class="text-red-500 hover:text-red-700">
                                <i data-feather="trash-2" class="w-5 h-5 mr-2"></i>
                                Vider le panier
                            </button>
                        </div>
                    </div>
                </div>
                
                <!-- Order Summary -->
                <div class="lg:w-1/3" data-aos="fade-left" data-aos-delay="100">
                    <div class="bg-white rounded-lg shadow-md p-6">
                        <h2 class="text-xl font-semibold mb-4">Récapitulatif de commande</h2>
                        
                        <div class="space-y-4 mb-6">
                            <div class="flex justify-between">
                                <span class="text-gray-600">Sous-total</span>
                                <span class="font-semibold">€99.97</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-gray-600">Livraison</span>
                                <span class="font-semibold">Gratuite</span>
                            </div>
                            <div class="flex justify-between border-t border-gray-200 pt-4">
                                <span class="text-lg font-semibold">Total</span>
                                <span class="text-lg font-bold text-blue-600">€99.97</span>
                            </div>
                        </div>
                        
                        <div class="mb-6">
                            <label for="promo" class="block text-sm font-medium text-gray-700 mb-2">Code promo</label>
                            <div class="flex">
                                <input type="text" id="promo" placeholder="Entrez votre code" class="flex-grow px-4 py-2 border border-gray-300 rounded-l focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                                <button class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-r transition duration-300">
                                    Appliquer
                                </button>
                            </div>
                        </div>
                        
                        <a href="checkout.html" class="block w-full bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 px-4 rounded text-center transition duration-300">
                            Passer la commande
                        </a>
                        
                        <div class="mt-6 text-center">
                            <p class="text-sm text-gray-600">Ou</p>
                            <button class="mt-2 w-full bg-gray-100 hover:bg-gray-200 text-gray-800 font-semibold py-3 px-4 rounded flex items-center justify-center transition duration-300">
                                <i data-feather="credit-card" class="w-5 h-5 mr-2"></i>
                                Payer avec Stripe
                            </button>
                        </div>
                    </div>
                </div>
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
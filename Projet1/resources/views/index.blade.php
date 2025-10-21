<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <title>Accueil - Cartologue</title>

  <!-- Tailwind CDN -->
  <script src="https://cdn.tailwindcss.com"></script>
  <!-- AOS -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet" />
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <!-- Feather icons -->
  <script src="https://cdn.jsdelivr.net/npm/feather-icons/dist/feather.min.js"></script>

  <style>
    .hero-gradient { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); }
    .card-hover:hover { transform: translateY(-6px); box-shadow: 0 12px 30px rgba(0,0,0,0.08); }
    .transition-all { transition: all .25s ease; }
    /* flyout cart */
    .flyout-enter { transform: translateX(100%); }
    .flyout-enter-active { transform: translateX(0); transition: transform .28s ease-out;}
    .flyout-leave { transform: translateX(0); }
    .flyout-leave-active { transform: translateX(100%); transition: transform .22s ease-in;}
    /* simple badge */
    .badge-yellow { background: linear-gradient(90deg,#f6c84c,#f59e0b); }
  </style>
</head>
<body class="font-sans bg-gray-50 text-gray-800">

  <!-- HEADER / NAV with SEARCH + CART -->
  <header class="bg-white shadow fixed w-full z-50">
    <div class="max-w-6xl mx-auto px-4">
      <div class="flex items-center justify-between h-16">
        <div class="flex items-center gap-6">
          <a href="{{ route('accueil') }}" class="flex items-center">
            <span class="text-2xl font-semibold text-gray-700">Cartologue</span>
          </a>

          <!-- Main nav (desktop) -->
          <nav class="hidden md:flex items-center gap-3">
            <a href="{{ route('accueil') }}" class="py-2 px-3 text-blue-600 border-b-2 border-blue-600 font-semibold">Accueil</a>
            <a href="{{ route('boutique') }}" class="py-2 px-3 hover:text-blue-600">Boutique</a>
           <!-- <a href="{{ route('panier') }}" class="py-2 px-3 hover:text-blue-600">Panier</a> --> 
            <a href="{{ route('contact') }}" class="py-2 px-3 hover:text-blue-600">Contact</a>
          </nav>
        </div>

        <!-- Search -->
        <div class="flex-1 max-w-xl px-4 hidden md:block">
          <div class="relative">
            <input id="searchInput" type="search" placeholder="Rechercher une carte, lieu, époque..." class="w-full rounded-full border border-gray-200 px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-200" />
            <button id="searchBtn" class="absolute right-1 top-1/2 -translate-y-1/2 bg-blue-600 hover:bg-blue-700 text-white rounded-full p-2">
              <i data-feather="search" class="w-4 h-4"></i>
            </button>

            <!-- search suggestions (simulated) -->
            <div id="searchSuggestions" class="hidden absolute left-0 right-0 mt-2 bg-white border border-gray-200 rounded-lg shadow-lg overflow-hidden z-50">
              <ul id="suggestList" class="divide-y"></ul>
            </div>
          </div>
        </div>

        <!-- Right actions -->
  
          <!-- Cart button -->
          <button id="cartToggle" aria-label="Ouvrir le panier" class="relative p-2 rounded-full hover:bg-gray-100">
            <i data-feather="shopping-cart" class="w-5 h-5 text-gray-700"></i>
            <span id="cartCount" class="absolute -top-1 -right-1 bg-red-500 text-white text-xs rounded-full px-1.5">0</span>
          </button>

      <div class="flex items-center gap-3">
          <div class="hidden md:flex items-center gap-2">
            <a href="{{ route('login') }}" class="px-3 py-1 text-gray-600 hover:bg-gray-100 rounded">Connexion</a>
            <a href="{{ route('register') }}" class="px-3 py-1 bg-blue-600 text-white rounded hover:bg-blue-700">Inscription</a>
          </div>


          <!-- Mobile menu -->
          <div class="md:hidden">
            <button id="mobileBtn" class="p-2 rounded hover:bg-gray-100">
              <i data-feather="menu" class="w-5 h-5"></i>
            </button>
          </div>
        </div>
      </div>
    </div>

    <!-- mobile menu -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
      <div class="px-4 py-3 flex flex-col gap-2">
        <a href="{{ route('accueil') }}" class="py-2">Accueil</a>
        <a href="{{ route('boutique') }}" class="py-2">Boutique</a>
        <a href="{{ route('panier') }}" class="py-2">Panier</a>
        <a href="{{ route('contact') }}" class="py-2">Contact</a>
      </div>
    </div>
  </header>

  <!-- FLYOUT CART (slide-over) -->
  <aside id="flyoutCart" class="fixed top-0 right-0 h-full w-full md:w-96 bg-white shadow-2xl z-60 transform translate-x-full">
    <div class="flex flex-col h-full">
      <div class="flex items-center justify-between p-4 border-b">
        <h3 class="text-lg font-semibold">Panier</h3>
        <button id="closeCart" class="p-2 rounded hover:bg-gray-100"><i data-feather="x"></i></button>
      </div>

      <div class="p-4 flex-1 overflow-auto" id="cartItemsContainer">
        <!-- cart items injected here -->
        <p id="emptyMsg" class="text-center text-gray-500 mt-12">Votre panier est vide.</p>
      </div>

      <div class="p-4 border-t">
        <div class="flex items-center justify-between mb-3">
          <span class="text-gray-600">Sous-total</span>
          <span id="cartSubtotal" class="font-semibold">€0.00</span>
        </div>
        <div class="flex gap-2">
          <a href="{{ route('panier') }}" class="flex-1 text-center py-2 border border-gray-200 rounded hover:bg-gray-50">Voir le panier</a>
          <a href="{{ route('panier') }}" class="flex-1 text-center py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Passer à la caisse</a>
        </div>
      </div>
    </div>
  </aside>

  <!-- Page container -->
  <main class="pt-24">

    <!-- HERO (existing) -->
    <section class="hero-gradient text-white pt-12 pb-12">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 items-center">
          <div data-aos="fade-right">
            <h1 class="text-4xl md:text-5xl font-bold mb-4">Explorez le monde à travers nos cartes</h1>
            <p class="text-lg mb-6 text-gray-100">Collections anciennes, topographiques, modernes et personnalisées — chaque carte raconte une histoire.</p>
            <div class="flex gap-3">
              <a href="{{ route('boutique') }}" class="bg-white text-blue-600 px-6 py-3 rounded-lg font-semibold hover:bg-gray-100">Voir la boutique</a>
              <a href="{{ route('contact') }}" class="border-2 border-white px-6 py-3 rounded-lg hover:bg-white hover:text-blue-600">Nous contacter</a>
            </div>
          </div>
          <div class="flex justify-center" data-aos="fade-left">
            <img src="http://static.photos/travel/640x480/1" alt="Cartes vintage" class="rounded-lg shadow-2xl w-full max-w-md object-cover">
          </div>
        </div>
      </div>
    </section>

    <!-- PROMO / NOUVEAUTÉS (carousel simple) -->
    <section class="py-8 bg-white">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold">Promotions & Nouveautés</h2>
          <div class="flex gap-2 items-center">
            <button id="prevPromo" class="p-2 rounded hover:bg-gray-100"><i data-feather="chevron-left"></i></button>
            <button id="nextPromo" class="p-2 rounded hover:bg-gray-100"><i data-feather="chevron-right"></i></button>
          </div>
        </div>

        <div id="promoCarousel" class="relative overflow-hidden">
          <div id="promoTrack" class="flex gap-4 transition-transform duration-500">
            <!-- Slide 1 -->
            <div class="min-w-full md:min-w-1/2 lg:min-w-1/3 bg-gradient-to-r from-blue-600 to-indigo-600 text-white rounded-lg p-8 flex items-center gap-6">
              <div>
                <h3 class="text-xl font-bold">-30% sur la sélection vintage</h3>
                <p class="mt-2">Sélection limitée — reproduction d'anciennes cartes.</p>
                <a href="{{ route('boutique') }}" class="inline-block mt-4 px-4 py-2 bg-white text-blue-600 rounded">J'en profite</a>
              </div>
              <img src="http://static.photos/travel/320x200/2" alt="Promo vintage" class="hidden md:block w-40 rounded">
            </div>

            <!-- Slide 2 -->
            <div class="min-w-full md:min-w-1/2 lg:min-w-1/3 bg-white rounded-lg p-8 flex items-center gap-6 border">
              <div>
                <h3 class="text-xl font-bold text-indigo-700">Nouvelles cartes personnalisées</h3>
                <p class="mt-2 text-gray-600">Créez une carte unique pour offrir ou décorer.</p>
                <a href="{{ route('boutique') }}" class="inline-block mt-4 px-4 py-2 bg-indigo-700 text-white rounded">Créer ma carte</a>
              </div>
              <img src="http://static.photos/travel/320x200/3" alt="Custom" class="hidden md:block w-40 rounded">
            </div>

            <!-- Slide 3 -->
            <div class="min-w-full md:min-w-1/2 lg:min-w-1/3 bg-yellow-50 rounded-lg p-8 flex items-center gap-6 border">
              <div>
                <h3 class="text-xl font-bold text-yellow-700">Livraison express 24h</h3>
                <p class="mt-2 text-gray-600">Pour la France métropolitaine — emballage premium inclus.</p>
                <a href="{{ route('contact') }}" class="inline-block mt-4 px-4 py-2 bg-yellow-500 text-white rounded">Plus d'infos</a>
              </div>
              <img src="http://static.photos/travel/320x200/4" alt="Delivery" class="hidden md:block w-40 rounded">
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- CATEGORIES -->
    <section class="py-12 bg-gray-50">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-8" data-aos="fade-up">
          <h2 class="text-2xl font-bold">Parcourir par catégorie</h2>
          <p class="text-gray-600">Trouvez la carte parfaite selon style, époque ou usage</p>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <!-- Cat 1 -->
          <a href="{{ route('boutique') }}" class="block bg-white rounded-lg overflow-hidden card-hover transition-all" data-aos="fade-up">
            <img src="http://static.photos/travel/640x360/8" alt="Anciennes" class="w-full h-40 object-cover">
            <div class="p-4">
              <h3 class="font-semibold">Cartes anciennes</h3>
              <p class="text-sm text-gray-500">Reproductions et éditions rares</p>
            </div>
          </a>

          <!-- Cat 2 -->
          <a href="{{ route('boutique') }}" class="block bg-white rounded-lg overflow-hidden card-hover transition-all" data-aos="fade-up" data-aos-delay="100">
            <img src="http://static.photos/travel/640x360/9" alt="Topographiques" class="w-full h-40 object-cover">
            <div class="p-4">
              <h3 class="font-semibold">Cartes topographiques</h3>
              <p class="text-sm text-gray-500">Détails géographiques & reliefs</p>
            </div>
          </a>

          <!-- Cat 3 -->
          <a href="{{ route('boutique') }}" class="block bg-white rounded-lg overflow-hidden card-hover transition-all" data-aos="fade-up" data-aos-delay="200">
            <img src="http://static.photos/travel/640x360/10" alt="Modernes" class="w-full h-40 object-cover">
            <div class="p-4">
              <h3 class="font-semibold">Cartes modernes</h3>
              <p class="text-sm text-gray-500">Designs épurés et contemporains</p>
            </div>
          </a>

          <!-- Cat 4 -->
          <a href="{{ route('boutique') }}" class="block bg-white rounded-lg overflow-hidden card-hover transition-all" data-aos="fade-up" data-aos-delay="300">
            <img src="http://static.photos/travel/640x360/11" alt="Personnalisées" class="w-full h-40 object-cover">
            <div class="p-4">
              <h3 class="font-semibold">Cartes personnalisées</h3>
              <p class="text-sm text-gray-500">Votre lieu, votre design</p>
            </div>
          </a>
        </div>
      </div>
    </section>

    <!-- BREADCRUMB + PRODUCTS (featured) -->
    <section class="py-10 bg-white">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <!-- breadcrumb -->
        <nav class="text-sm text-gray-500 mb-4" aria-label="breadcrumb">
          <ol class="list-reset flex">
            <li><a href="{{ route('accueil') }}" class="hover:underline">Accueil</a></li>
            <li><span class="mx-2">/</span></li>
            <li class="text-gray-700">Cartes populaires</li>
          </ol>
        </nav>

        <div class="flex items-center justify-between mb-6">
          <h2 class="text-2xl font-bold">Nos cartes populaires</h2>
          <a href="{{ route('boutique') }}" class="text-blue-600 hover:underline">Voir tout</a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
          <!-- PRODUCT SAMPLE - each Add button triggers JS to add to cart -->
          <article class="bg-white rounded-lg shadow-sm overflow-hidden card-hover" data-product='{"id":1,"name":"Carte du monde 1750","price":39.99,"image":"http://static.photos/travel/640x360/4"}'>
            <div class="relative">
              <img src="http://static.photos/travel/640x360/4" alt="Carte 1" class="w-full h-48 object-cover">
              <div class="absolute top-2 right-2 bg-red-500 text-white text-xs font-bold px-2 py-1 rounded">-20%</div>
            </div>
            <div class="p-4">
              <h3 class="font-semibold mb-1">Carte du monde 1750</h3>
              <p class="text-sm text-gray-500 mb-3">Reproduction historique</p>
              <div class="flex items-center justify-between">
                <div>
                  <div class="text-lg font-bold text-blue-600">€39.99</div>
                  <div class="text-sm line-through text-gray-400">€49.99</div>
                </div>
                <button class="addToCartBtn bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full" title="Ajouter au panier">
                  <i data-feather="shopping-cart" class="w-4 h-4"></i>
                </button>
              </div>
            </div>
          </article>

          <!-- Product 2 -->
          <article class="bg-white rounded-lg shadow-sm overflow-hidden card-hover" data-product='{"id":2,"name":"Alpes françaises","price":29.99,"image":"http://static.photos/travel/640x360/5"}' data-aos="fade-up" data-aos-delay="100">
            <img src="http://static.photos/travel/640x360/5" alt="Carte 2" class="w-full h-48 object-cover">
            <div class="p-4">
              <h3 class="font-semibold mb-1">Alpes françaises</h3>
              <p class="text-sm text-gray-500 mb-3">Carte détaillée</p>
              <div class="flex items-center justify-between">
                <div class="text-lg font-bold text-blue-600">€29.99</div>
                <button class="addToCartBtn bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full">
                  <i data-feather="shopping-cart" class="w-4 h-4"></i>
                </button>
              </div>
            </div>
          </article>

          <!-- Product 3 -->
          <article class="bg-white rounded-lg shadow-sm overflow-hidden card-hover" data-product='{"id":3,"name":"Carte personnalisée","price":59.99,"image":"http://static.photos/travel/640x360/6"}' data-aos="fade-up" data-aos-delay="200">
            <img src="http://static.photos/travel/640x360/6" alt="Carte 3" class="w-full h-48 object-cover">
            <div class="p-4">
              <h3 class="font-semibold mb-1">Carte personnalisée</h3>
              <p class="text-sm text-gray-500 mb-3">Créez votre carte</p>
              <div class="flex items-center justify-between">
                <div class="text-lg font-bold text-blue-600">€59.99</div>
                <button class="addToCartBtn bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full">
                  <i data-feather="shopping-cart" class="w-4 h-4"></i>
                </button>
              </div>
            </div>
          </article>

          <!-- Product 4 -->
          <article class="bg-white rounded-lg shadow-sm overflow-hidden card-hover" data-product='{"id":4,"name":"Paris 1900","price":45.99,"image":"http://static.photos/travel/640x360/7"}' data-aos="fade-up" data-aos-delay="300">
            <img src="http://static.photos/travel/640x360/7" alt="Carte 4" class="w-full h-48 object-cover">
            <div class="p-4">
              <h3 class="font-semibold mb-1">Paris 1900</h3>
              <p class="text-sm text-gray-500 mb-3">Carte vintage</p>
              <div class="flex items-center justify-between">
                <div class="text-lg font-bold text-blue-600">€45.99</div>
                <button class="addToCartBtn bg-blue-600 hover:bg-blue-700 text-white p-2 rounded-full">
                  <i data-feather="shopping-cart" class="w-4 h-4"></i>
                </button>
              </div>
            </div>
          </article>
        </div>
      </div>
    </section>

    <!-- TRUST LOGOS -->
    <section class="py-8 bg-white">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="text-center mb-6">
          <h3 class="text-xl font-semibold">Ils nous font confiance</h3>
          <p class="text-gray-500 text-sm">Médias, partenaires et fournisseurs</p>
        </div>
        <div class="flex items-center justify-center gap-8 flex-wrap">
          <img src="http://static.photos/travel/120x60/12" alt="logo 1" class="h-10 grayscale opacity-80">
          <img src="http://static.photos/travel/120x60/13" alt="logo 2" class="h-10 grayscale opacity-80">
          <img src="http://static.photos/travel/120x60/14" alt="logo 3" class="h-10 grayscale opacity-80">
          <img src="http://static.photos/travel/120x60/15" alt="logo 4" class="h-10 grayscale opacity-80">
        </div>
      </div>
    </section>

    <!-- DELIVERY & PAYMENT (rassurance) -->
    <section class="py-12 bg-gray-50">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
          <div class="bg-white p-6 rounded-lg text-center card-hover" data-aos="fade-up">
            <div class="flex justify-center mb-4">
              <i data-feather="truck" class="w-8 h-8 text-green-600"></i>
            </div>
            <h4 class="font-semibold mb-2">Livraison 24-48h</h4>
            <p class="text-sm text-gray-500">Emballage sécurisé & suivi de colis</p>
          </div>

          <div class="bg-white p-6 rounded-lg text-center card-hover" data-aos="fade-up" data-aos-delay="100">
            <div class="flex justify-center mb-4">
              <i data-feather="shield" class="w-8 h-8 text-blue-600"></i>
            </div>
            <h4 class="font-semibold mb-2">Paiement sécurisé</h4>
            <p class="text-sm text-gray-500">Cartes, PayPal, Mobile Money — 3D Secure</p>
          </div>

          <div class="bg-white p-6 rounded-lg text-center card-hover" data-aos="fade-up" data-aos-delay="200">
            <div class="flex justify-center mb-4">
              <i data-feather="rotate-cw" class="w-8 h-8 text-indigo-600"></i>
            </div>
            <h4 class="font-semibold mb-2">Retours sous 30 jours</h4>
            <p class="text-sm text-gray-500">Procédure simple et remboursement rapide</p>
          </div>
        </div>
      </div>
    </section>

    <!-- FAQ / CHAT QUICK (simple interactions) -->
    <section class="py-12 bg-white">
      <div class="max-w-6xl mx-auto px-4 sm:px-6">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
          <!-- FAQ -->
          <div data-aos="fade-up">
            <h3 class="text-2xl font-bold mb-4">Questions fréquentes</h3>
            <div class="space-y-3">
              <details class="p-4 border rounded-lg">
                <summary class="font-semibold cursor-pointer">Comment retourner un produit ?</summary>
                <p class="mt-2 text-sm text-gray-600">Contactez le support ou suivez la procédure dans votre compte. Retours gratuits sous 30 jours.</p>
              </details>

              <details class="p-4 border rounded-lg">
                <summary class="font-semibold cursor-pointer">Quels modes de paiement acceptez-vous ?</summary>
                <p class="mt-2 text-sm text-gray-600">Cartes bancaires, PayPal, et certains pays : Mobile Money.</p>
              </details>

              <details class="p-4 border rounded-lg">
                <summary class="font-semibold cursor-pointer">Faites-vous des impressions sur mesure ?</summary>
                <p class="mt-2 text-sm text-gray-600">Oui — nos cartes personnalisées sont imprimées sur papier haut de gamme. Contactez-nous pour un devis.</p>
              </details>
            </div>
          </div>

          <!-- Quick chat (simulated) -->
          <div data-aos="fade-up" class="bg-gray-50 rounded-lg p-6">
            <h3 class="text-2xl font-bold mb-4">Chat & Support rapide</h3>
            <p class="text-gray-600 mb-4">Besoin d'aide ? Envoie-nous un message et nous te répondrons rapidement.</p>

            <form id="quickChat" class="space-y-3">
              <input type="text" id="chatName" placeholder="Ton nom" class="w-full px-4 py-2 border rounded" required />
              <input type="email" id="chatEmail" placeholder="Ton email" class="w-full px-4 py-2 border rounded" required />
              <textarea id="chatMessage" rows="4" placeholder="Message" class="w-full px-4 py-2 border rounded" required></textarea>
              <div class="flex gap-2">
                <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded">Envoyer</button>
                <button type="button" id="openWhatsapp" class="bg-green-500 text-white px-4 py-2 rounded">WhatsApp</button>
              </div>
              <p id="chatNotice" class="text-sm text-green-600 hidden">Message envoyé — nous reviendrons vers toi bientôt.</p>
            </form>
          </div>
        </div>
      </div>
    </section>

    <!-- NEWSLETTER (existing, kept) -->
    <section class="py-12 bg-blue-600 text-white">
      <div class="max-w-4xl mx-auto px-4 sm:px-6 text-center">
        <h2 class="text-2xl font-bold mb-3">Abonnez-vous à notre newsletter</h2>
        <p class="mb-6 text-gray-100">Recevez nos offres spéciales et découvrez nos nouvelles collections en avant-première</p>
        <form class="max-w-md mx-auto flex gap-2" onsubmit="event.preventDefault(); alert('Merci — formulaire simulateur');">
          <input type="email" placeholder="Votre email" class="flex-1 px-4 py-2 rounded" required />
          <button class="bg-white text-blue-600 px-4 py-2 rounded">S'abonner</button>
        </form>
      </div>
    </section>

    <!-- FOOTER (enrichi) -->
    <footer class="bg-gray-900 text-gray-300 py-12">
      <div class="max-w-6xl mx-auto px-4 sm:px-6 grid grid-cols-1 md:grid-cols-4 gap-8">
        <div>
          <h4 class="text-white text-lg font-semibold mb-3">Cartologue</h4>
          <p class="text-sm">Boutique en ligne de cartes anciennes, topographiques et personnalisées.</p>
          <div class="mt-4 flex gap-2">
            <img src="http://static.photos/travel/60x40/visa" alt="visa" class="h-6">
            <img src="http://static.photos/travel/60x40/mastercard" alt="mc" class="h-6">
            <img src="http://static.photos/travel/60x40/paypal" alt="pp" class="h-6">
          </div>
        </div>

        <div>
          <h5 class="text-white font-semibold mb-2">Navigation</h5>
          <ul class="space-y-2 text-sm">
            <li><a href="{{ route('boutique') }}" class="hover:underline">Boutique</a></li>
            <li><a href="{{ route('contact') }}" class="hover:underline">Contact</a></li>
            <li><a href="#" class="hover:underline">FAQ</a></li>
            <li><a href="#" class="hover:underline">Blog</a></li>
          </ul>
        </div>

        <div>
          <h5 class="text-white font-semibold mb-2">Entreprise</h5>
          <ul class="space-y-2 text-sm">
            <li><a href="#" class="hover:underline">À propos</a></li>
            <li><a href="#" class="hover:underline">Mentions légales</a></li>
            <li><a href="#" class="hover:underline">CGV</a></li>
            <li><a href="#" class="hover:underline">Politique de confidentialité</a></li>
          </ul>
        </div>

        <div>
          <h5 class="text-white font-semibold mb-2">Contact</h5>
          <p class="text-sm">contact@cartologue.com</p>
          <p class="text-sm mt-1">+33 1 23 45 67 89</p>
          <p class="text-sm mt-2">123 Rue des Cartes, Paris</p>
          <div class="mt-4 flex gap-3">
            <a href="#" class="text-gray-400 hover:text-white"><i data-feather="facebook" class="w-5 h-5"></i></a>
            <a href="#" class="text-gray-400 hover:text-white"><i data-feather="instagram" class="w-5 h-5"></i></a>
            <a href="#" class="text-gray-400 hover:text-white"><i data-feather="linkedin" class="w-5 h-5"></i></a>
          </div>
        </div>
      </div>

      <div class="border-t border-gray-800 mt-8 pt-6 text-center text-sm text-gray-500">
        © <span id="year"></span> Cartologue — Tous droits réservés.
      </div>
    </footer>
  </main>

  <!-- SCRIPTS -->
  <script>
    // init AOS + feather
    document.addEventListener('DOMContentLoaded', function() {
      AOS.init({ duration: 700, once: true });
      feather.replace();
      document.getElementById('year').textContent = new Date().getFullYear();
    });

    /* MOBILE MENU */
    const mobileBtn = document.getElementById('mobileBtn');
    const mobileMenu = document.getElementById('mobileMenu');
    mobileBtn?.addEventListener('click', () => mobileMenu.classList.toggle('hidden'));

    /* PROMO CAROUSEL (simple) */
    (function() {
      const track = document.getElementById('promoTrack');
      const prev = document.getElementById('prevPromo');
      const next = document.getElementById('nextPromo');
      let index = 0;
      const slides = track.children;
      const total = slides.length;

      function show(i) {
        const w = track.parentElement.clientWidth;
        // move track by index * parent width
        track.style.transform = `translateX(-${i * w}px)`;
      }

      prev?.addEventListener('click', () => { index = (index - 1 + total) % total; show(index); });
      next?.addEventListener('click', () => { index = (index + 1) % total; show(index); });
      window.addEventListener('resize', () => show(index));
      // auto rotate every 6s
      setInterval(() => { index = (index + 1) % total; show(index); }, 6000);
    })();

    /* SEARCH SUGGESTIONS (simulé) */
    (function() {
      const input = document.getElementById('searchInput');
      const suggestions = document.getElementById('searchSuggestions');
      const list = document.getElementById('suggestList');
      if (!input) return;
      const sample = ['Carte du monde', 'Paris 1900', 'Alpes françaises', 'Carte personnalisée', 'Carte topographique'];
      input.addEventListener('input', (e) => {
        const v = e.target.value.trim();
        if (!v) { suggestions.classList.add('hidden'); return; }
        const items = sample.filter(s => s.toLowerCase().includes(v.toLowerCase())).slice(0,5);
        list.innerHTML = items.map(it => `<li class="px-3 py-2 hover:bg-gray-100 cursor-pointer">${it}</li>`).join('') || `<li class="px-3 py-2 text-gray-500">Aucun résultat</li>`;
        suggestions.classList.remove('hidden');
      });
      // click suggestion
      list.addEventListener('click', (e) => {
        if (e.target.matches('li')) {
          input.value = e.target.textContent.trim();
          suggestions.classList.add('hidden');
        }
      });
      // hide on outside click
      document.addEventListener('click', (e) => {
        if (!input.contains(e.target) && !suggestions.contains(e.target)) suggestions.classList.add('hidden');
      });
    })();

    /* FLYOUT CART LOGIC (simple front-end mock) */
    (function() {
      const cartToggle = document.getElementById('cartToggle');
      const flyout = document.getElementById('flyoutCart');
      const closeCart = document.getElementById('closeCart');
      const cartCount = document.getElementById('cartCount');
      const cartItemsContainer = document.getElementById('cartItemsContainer');
      const cartSubtotal = document.getElementById('cartSubtotal');
      let cart = []; // {id,name,price,qty,image}

      function renderCart() {
        cartItemsContainer.innerHTML = '';
        if (cart.length === 0) {
          document.getElementById('emptyMsg').classList.remove('hidden');
        } else {
          document.getElementById('emptyMsg')?.classList.add('hidden');
          cart.forEach(item => {
            const node = document.createElement('div');
            node.className = 'flex items-center gap-3 mb-4';
            node.innerHTML = `
              <img src="${item.image}" alt="${item.name}" class="w-16 h-12 object-cover rounded">
              <div class="flex-1">
                <div class="font-semibold text-sm">${item.name}</div>
                <div class="text-xs text-gray-500">€${item.price.toFixed(2)}</div>
                <div class="mt-2 flex items-center gap-2">
                  <button data-action="dec" data-id="${item.id}" class="px-2 py-1 border rounded text-sm">-</button>
                  <span class="text-sm">${item.qty}</span>
                  <button data-action="inc" data-id="${item.id}" class="px-2 py-1 border rounded text-sm">+</button>
                  <button data-action="remove" data-id="${item.id}" class="ml-3 text-red-500 text-sm">Supprimer</button>
                </div>
              </div>
            `;
            cartItemsContainer.appendChild(node);
          });
        }

        // subtotal & count
        const subtotal = cart.reduce((s,i)=> s + i.price * i.qty, 0);
        cartSubtotal.textContent = `€${subtotal.toFixed(2)}`;
        cartCount.textContent = cart.reduce((s,i)=> s + i.qty, 0);
      }

      // open/close
      function openCart() {
        flyout.style.transform = 'translateX(0)';
        flyout.style.right = '0';
      }
      function close() {
        flyout.style.transform = 'translateX(100%)';
      }
      cartToggle?.addEventListener('click', openCart);
      closeCart?.addEventListener('click', close);

      // add to cart buttons (from product cards)
      document.querySelectorAll('.addToCartBtn').forEach(btn => {
        btn.addEventListener('click', (e) => {
          const article = btn.closest('article');
          if (!article) return;
          const product = JSON.parse(article.getAttribute('data-product'));
          const exist = cart.find(i => i.id === product.id);
          if (exist) exist.qty++;
          else cart.push({...product, qty:1});
          renderCart();
        });
      });

      // delegate cart item buttons
      cartItemsContainer.addEventListener('click', (e) => {
        const action = e.target.closest('button')?.dataset?.action;
        const id = +e.target.closest('button')?.dataset?.id;
        if (!action) return;
        const idx = cart.findIndex(i => i.id === id);
        if (idx === -1) return;
        if (action === 'inc') cart[idx].qty++;
        if (action === 'dec') { cart[idx].qty = Math.max(1, cart[idx].qty - 1); }
        if (action === 'remove') cart.splice(idx,1);
        renderCart();
      });

      // initial render
      renderCart();

      // allow opening cart programmatically when adding
      window.openCart = openCart;
    })();

    /* QUICK CHAT form simulated */

    (function() {
      const form = document.getElementById('quickChat');
      form?.addEventListener('submit', (e) => {
        e.preventDefault();
        document.getElementById('chatNotice').classList.remove('hidden');
        setTimeout(() => document.getElementById('chatNotice').classList.add('hidden'), 4500);
        form.reset();
      });

      document.getElementById('openWhatsapp')?.addEventListener('click', () => {
        window.open('https://wa.me/33123456789?text=Bonjour%20Cartologue%20-%20j%27ai%20une%20question', '_blank');
      });
    })();

    /* small accessibility: close flyout on Esc */
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') document.getElementById('flyoutCart').style.transform = 'translateX(100%)';
    });
  </script>
</body>
</html>

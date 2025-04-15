<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Infotools</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        <!-- Lien vers ton fichier CSS -->
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @livewireStyles
        @livewireScripts

    </head>
    
    <body>
        <!-- Header -->
        <header class="header">
            <div class="container flex justify-between items-center py-4">
            <a href="{{ url('/') }}">
                <img src="{{ asset('logo.png') }}" alt="Logo Infotools" class="h-20 w-auto">
            </a>
                @if (Route::has('login'))
                    <nav class="nav space-x-4">
                        @auth
                        
                            <a href="{{ url('/dashboard') }}" class="nav-link">Dashboard</a>
                        @else
                            <a href="{{ route('login') }}" class="nav-link">Se connecter</a>
                            @if (Route::has('register'))
                                <a href="{{ route('register') }}" class="nav-link">S'inscrire</a>
                            @endif
                        @endauth
                    </nav>
                @endif
            </div>
        </header>

        <flux:separator /> <br>

        <!-- Section Présentation -->
        <section class="products">
            <h1 class="title">Bienvenue sur infotools</h1>
            <p class="description">Infotools est une entreprise spécialisée dans le développement de logiciels sur mesure et la mise en place d'infrastructures informatiques adaptées.<br>
                Grâce à une équipe passionnée et expérimentée, nous accompagnons les entreprises dans leur transformation numérique en leur proposant des solutions innovantes, performantes et sécurisées.<br>
                Notre objectif : simplifier la gestion de votre activité grâce à des outils efficaces, tout en assurant un suivi personnalisé à chaque étape de votre projet.</p>
            <div style="padding: 5px;"></div>
            <flux:separator />
        </section>

        <div style="padding: 15px;"></div>

        <!-- Section Derniers Produits -->
        <section class="products">
        <flux:badge color="lime" size="xs">Nouveau</flux:badge>
            <h1 class="title">Nos produits</h1>
            <p class="description">Découvrez nos derniers produits actuels.</p>
            
            <div style="padding: 5px;"></div>
            <flux:separator />
            <div style="padding: 10px;"></div>

            <div class="products-list">
                @foreach ($products as $product)
                    <div class="product-card">
                        <!-- <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nom_produit }}" class="product-image"> -->
                        <h3 class="product-name">{{ $product->nom_produit }}</h3>
                        <p class="product-description">{{ $product->description }}</p>
                        <span class="product-price">{{ $product->prix }} €</span>
                        <!-- <a href="#" class="product-link">Voir le produit</a> -->
                    </div>
                @endforeach
            </div>
        </section>

        <footer class="presentation">
            <p class="footer-text">© 2025 Infotools. Tous droits réservés.</p>
        </footer>

    </body>
</html>

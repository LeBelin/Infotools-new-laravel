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
    </head>
<body>
    <!-- Header avec navigation -->
    <header class="header">
        @if (Route::has('login'))
            <nav class="nav">
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
    </header>

    <!-- Section Présentation -->
    <section class="presentation">
        <h1 class="title">Bienvenue sur notre boutique</h1>
        <p class="description">Découvrez nos derniers produits et offres exclusives.</p>
    </section>

    <!-- Section Derniers Produits -->
    <section class="products">
        <h2 class="products-title">Derniers Produits</h2>
        <div class="products-list">
            @foreach ($products as $product)
                <div class="product-card">
                    <img src="{{ asset('storage/' . $product->image) }}" alt="{{ $product->nom_produit }}" class="product-image">
                    <h3 class="product-name">{{ $product->nom_produit }}</h3>
                    <p class="product-description">{{ $product->description }}</p>
                    <span class="product-price">{{ $product->prix }} €</span>
                    <a href="#" class="product-link">Voir le produit</a>
                </div>
            @endforeach
        </div>
    </section>

    <footer>
        <p class="footer-text">© 2025 Infotools. Tous droits réservés.</p>
    </footer>

</body>
</html>

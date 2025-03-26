<head>
    <!-- CSS directement dans la vue -->
<style>
    .products {
        padding: 20px;
        background-color: #f9f9f9;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    .products-title {
        font-size: 24px;
        font-weight: bold;
        color: #333;
        margin-bottom: 20px;
        text-align: center;
    }

    .products-list {
        display: -webkit-box;
        grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
        gap: 20px;
        padding: 0;
        list-style: none;
    }

    .product-card {
        background-color: #fff;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        padding: 15px;
        text-align: center;
        transition: transform 0.3s ease;
    }

    .product-card:hover {
        transform: translateY(-5px);
    }

    .product-name {
        font-size: 18px;
        font-weight: bold;
        color: #333;
        margin-bottom: 10px;
    }

    .product-price {
        font-size: 16px;
        color: #e74c3c;
        font-weight: bold;
    }

    .product-card a {
        display: inline-block;
        margin-top: 10px;
        padding: 8px 16px;
        background-color: #3498db;
        color: #fff;
        text-decoration: none;
        border-radius: 4px;
        transition: background-color 0.3s;
    }

    .product-card a:hover {
        background-color: #2980b9;
    }
</style>
</head>

<x-layouts.app :title="__('Dashboard')">
<div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Tableau de bord</flux:heading>
        <flux:subheading size="lg" class="mb-6">Bonjours, <flux:badge color="sky">{{ auth()->user()->name }}</flux:badge></flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="p-4 text-center">
                    <span class="text-2xl font-bold">Bienvenue, {{ auth()->user()->name }}</span>
                </div>
            </div>

            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="p-4 text-center">
                    <p class="text-gray-600">Nombre de Clients :</p>
                    <span class="text-2xl font-bold">{{ $clientCount }}</span>
                    <p class="text-gray-600">Nombre de Produits :</p>
                    <span class="text-2xl font-bold">{{ $produitCount }}</span>
                    <p class="text-gray-600">Nombre de Commande :</p>
                    <span class="text-2xl font-bold">{{ $commandeCount }}</span>
                    <p class="text-gray-600">Nombre de Facture :</p>

                    <p class="text-gray-600">Nombre de Rendez vous :</p>

                </div>
            </div>

            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <section class="products">
                    <h2 class="products-title">Les 3 derniers produits</h2>
                    <div class="products-list">
                        @foreach ($products as $product)
                            <div class="product-card">
                            
                                <h3 class="product-name">{{ $product->nom_produit }}</h3>
                                <span class="product-price">{{ $product->prix }} €</span>
                            </div>
                        @endforeach
                    </div>
                </section>
            </div>

        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            Les derniers rendez-vous
        </div>
    </div>
</x-layouts.app>

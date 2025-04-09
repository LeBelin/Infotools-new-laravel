<head>
    <!-- CSS directement dans la vue -->
<style>
    .products {
        padding: 20px;
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
        color: #51a2ff;
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





    .rendezvous-section {
    padding: 2rem;
    background-color: #f9fafb;
}

.rendezvous-title {
    font-size: 1.8rem;
    font-weight: bold;
    margin-bottom: 1.5rem;
    color: #111827;
}

.rendezvous-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
    gap: 1.5rem;
}

.rendezvous-card {
    background-color: white;
    border-radius: 1rem;
    padding: 1.5rem;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
    transition: transform 0.2s ease;
}

.rendezvous-card:hover {
    transform: translateY(-5px);
}

.rendezvous-client {
    font-size: 1.25rem;
    font-weight: 600;
    color: #2563eb;
    margin-bottom: 0.5rem;
}

.rendezvous-date,
.rendezvous-time,
.rendezvous-description {
    font-size: 0.95rem;
    color: #374151;
    margin-bottom: 0.3rem;
}

</style>
</head>

<x-layouts.app :title="__('Dashboard')">

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            
            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <div class="p-4 text-center">
                    <span class="text-2xl font-bold">Bienvenue, <flux:badge color="sky" size="lg">{{ auth()->user()->name }}</flux:badge></span>
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
                    <p class="text-gray-600">Nombre de Rendez vous :</p>
                    <span class="text-2xl font-bold">{{ $rdvCount }}</span>

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
            
        <section class="rendezvous-section">
    <h2 class="rendezvous-title">Les 3 derniers rendez-vous</h2>
    <div class="rendezvous-grid">
        @foreach($rendezvous as $rdv)
            <div class="rendezvous-card">
                <h3 class="rendezvous-client">{{ $rdv->client->nom }}</h3>
                <p class="rendezvous-date">📅 {{ $rdv->date_rendez_vous }}</p>
                <p class="rendezvous-time">⏰ {{ $rdv->heure_rendez_vous }}</p>
                <p class="rendezvous-description">{{ $rdv->description }}</p>
            </div>
        @endforeach
    </div>
</section>

        </div>
    </div>
</x-layouts.app>

<head>
    <!-- CSS directement dans la vue -->
<style>
.stat-icon svg.icon {
    width: 28px;
    height: 28px;
    stroke:rgb(36, 124, 246); /* Gris neutre */
}


.stats-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
    gap: 10px;
    padding: 10px 10px;
}

.stat-card {
    border-radius: 16px;
    padding: 24px;
    text-align: center;
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.stat-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 25px rgba(0, 0, 0, 0.1);
}

.stat-icon {
    background-color: #edf2f7;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    padding: 12px;
    margin-bottom: 12px;
}

.stat-title {
    color: #718096;
    font-size: 14px;
    margin-bottom: 4px;
}

.stat-value {
    font-size: 28px;
    font-weight: bold;
    color: #2d3748;
}




.products-section {
    padding: 1.5rem;
    background-color: #f9fafb;
    border-radius: 0.75rem;
}

.products-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #111827;
    margin-bottom: 1rem;
    text-align: center;
}

.products-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(150px, 1fr));
    gap: 1rem;
}

.product-card {
    padding: 1rem;
    background-color: white;
    border-radius: 0.75rem;
    box-shadow: 0 2px 6px rgba(0, 0, 0, 0.05);
    text-align: center;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border: 1px solid #e5e7eb;
}

.product-card:hover {
    transform: translateY(-4px);
    box-shadow: 0 6px 12px rgba(0, 0, 0, 0.08);
}

.product-name {
    font-size: 1.1rem;
    font-weight: 500;
    color: #374151;
    margin-bottom: 0.5rem;
}

.product-price {
    font-size: 1.25rem;
    font-weight: bold;
    color: #10b981; /* vert émeraude */
}
@media (prefers-color-scheme: dark) {
    .products-section {
        background-color: #1f2937;
    }

    .products-title {
        color: #f9fafb;
    }

    .product-card {
        background-color: #111827;
        border-color: #374151;
    }

    .product-name {
        color: #f3f4f6;
    }

    .product-price {
        color: #6ee7b7;
    }
}






.rendezvous-section {
    padding: 1.5rem;
    background-color: #f3f4f6;
    border-radius: 0.75rem;
    overflow-x: auto;
}

.rendezvous-title {
    font-size: 1.5rem;
    font-weight: 600;
    color: #111827;
    margin-bottom: 1rem;
    text-align: center;
}

.rendezvous-table-wrapper {
    overflow-x: auto;
}

.rendezvous-table {
    width: 100%;
    border-collapse: collapse;
    background-color: white;
    border-radius: 0.5rem;
    overflow: hidden;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
}

.rendezvous-table th,
.rendezvous-table td {
    padding: 1rem;
    text-align: left;
    border-bottom: 1px solid #e5e7eb;
}

.rendezvous-table th {
    background-color: #e5e7eb;
    font-weight: 600;
    color: #374151;
}

.rendezvous-table td {
    color: #4b5563;
}

.rendezvous-table tr:last-child td {
    border-bottom: none;
}
@media (prefers-color-scheme: dark) {
    .rendezvous-section {
        background-color: #1f2937;
    }

    .rendezvous-title {
        color: #f9fafb;
    }

    .rendezvous-table {
        background-color: #111827;
    }

    .rendezvous-table th {
        background-color: #374151;
        color: #d1d5db;
    }

    .rendezvous-table td {
        color: #d1d5db;
        border-color: #374151;
    }
}


</style>
</head>

<x-layouts.app :title="__('Dashboard')">
<div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Commerciaux</flux:heading>
        <flux:subheading size="lg" class="mb-6"><span class="text-2xl font-bold">Bienvenue, <flux:badge color="sky" size="lg">{{ auth()->user()->name }}</flux:badge></span></flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <div class="grid auto-rows-min gap-4 md:grid-cols-3">
            



    <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-icon">
                    <!-- Icon: Users -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 110-8 4 4 0 010 8zm6 4a4 4 0 100-8 4 4 0 000 8z" />
                    </svg>
                </div>
                <div class="stat-title">Clients</div>
                <div class="stat-value">{{ $clientCount }}</div>
            </div>


            <div class="stat-card">
                <div class="stat-icon">
                    <!-- Icon: Package -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12v7a2 2 0 01-2 2H6a2 2 0 01-2-2v-7m16 0L12 3 4 12m16 0H4" />
                    </svg>
                </div>
                <div class="stat-title">Produits</div>
                <div class="stat-value">{{ $produitCount }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <!-- Icon: Shopping Cart -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h14l-1.35 6.78a2 2 0 01-1.97 1.72H7a2 2 0 01-2-2V6h16m-5 12a1 1 0 100 2 1 1 0 000-2zm-9 0a1 1 0 100 2 1 1 0 000-2z" />
                    </svg>
                </div>
                <div class="stat-title">Commandes</div>
                <div class="stat-value">{{ $commandeCount }}</div>
            </div>

            <div class="stat-card">
                <div class="stat-icon">
                    <!-- Icon: Calendar -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                    </svg>
                </div>
                <div class="stat-title">Rendez-vous</div>
                <div class="stat-value">{{ $rdvCount }}</div>
            </div>
        </div>
    </div>



        <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <section class="products-section">
                <h2 class="products-title">Les 3 derniers produits</h2>
                <div class="products-grid">
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
                <div class="rendezvous-table-wrapper">
                    <table class="rendezvous-table">
                        <thead>
                            <tr>
                                <th>Client</th>
                                <th>Date</th>
                                <th>Heure</th>
                                <th>Description</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($rendezvous as $rdv)
                                <tr>
                                    <td>{{ $rdv->client->nom }}</td>
                                    <td><flux:badge color="amber">{{ \Carbon\Carbon::parse($rdv->date_rendez_vous)->locale('fr')->isoFormat('D MMMM YYYY') }}</flux:badge></td>
                                    <td><flux:badge color="green">{{ \Carbon\Carbon::parse($rdv->heure_rendez_vous)->locale('fr')->isoFormat('HH:mm') }}</flux:badge></td>
                                    <td>{{ $rdv->description }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </section>

        </div>

    </div>
</x-layouts.app>

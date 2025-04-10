<x-layouts.app :title="__('Dashboard')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Commerciaux</flux:heading>
        <flux:subheading size="lg" class="mb-6">
            <span class="text-2xl font-bold">Bienvenue, <flux:badge color="sky" size="lg">{{ auth()->user()->name }}</flux:badge></span>
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">
        <!-- Stats Section -->
<div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
    <section class="flex items-center justify-between p-4">
        <h2 class="text-lg font-semibold">Statistiques</h2>
    </section>
    <div class="flex flex-wrap gap-4">
        <!-- Clients -->
        <div class="flex flex-col items-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300 ease-in-out w-full sm:w-1/2 md:w-1/4">
            <div class="stat-icon bg-blue-100 p-4 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 110-8 4 4 0 010 8zm6 4a4 4 0 100-8 4 4 0 000 8z" />
                </svg>
            </div>
            <div class="text-sm text-gray-600 mb-2">Clients</div>
            <div class="text-2xl font-bold text-gray-800">{{ $clientCount }}</div>
        </div>

        <!-- Produits -->
        <div class="flex flex-col items-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300 ease-in-out w-full sm:w-1/2 md:w-1/4">
            <div class="stat-icon bg-green-100 p-4 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon h-7 w-7 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12v7a2 2 0 01-2 2H6a2 2 0 01-2-2v-7m16 0L12 3 4 12m16 0H4" />
                </svg>
            </div>
            <div class="text-sm text-gray-600 mb-2">Produits</div>
            <div class="text-2xl font-bold text-gray-800">{{ $produitCount }}</div>
        </div>

        <!-- Commandes -->
        <div class="flex flex-col items-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300 ease-in-out w-full sm:w-1/2 md:w-1/4">
            <div class="stat-icon bg-yellow-100 p-4 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon h-7 w-7 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h14l-1.35 6.78a2 2 0 01-1.97 1.72H7a2 2 0 01-2-2V6h16m-5 12a1 1 0 100 2 1 1 0 000-2zm-9 0a1 1 0 100 2 1 1 0 000-2z" />
                </svg>
            </div>
            <div class="text-sm text-gray-600 mb-2">Commandes</div>
            <div class="text-2xl font-bold text-gray-800">{{ $commandeCount }}</div>
        </div>

        <!-- Rendez-vous -->
        <div class="flex flex-col items-center p-6 bg-white rounded-xl shadow-md hover:shadow-lg transition duration-300 ease-in-out w-full sm:w-1/2 md:w-1/4">
            <div class="stat-icon bg-red-100 p-4 rounded-full mb-4">
                <svg xmlns="http://www.w3.org/2000/svg" class="icon h-7 w-7 text-red-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                </svg>
            </div>
            <div class="text-sm text-gray-600 mb-2">Rendez-vous</div>
            <div class="text-2xl font-bold text-gray-800">{{ $rdvCount }}</div>
        </div>
    </div>
</div>


<!-- Les 3 derniers produits Section -->
<div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
    <section class="products-section p-6">
        <h2 class="text-2xl font-semibold text-center mb-4">Les 3 derniers produits</h2>
        <div class="flex justify-center items-center">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach ($products as $product)
                    <div class="bg-white p-4 rounded-lg shadow-md hover:shadow-lg transition duration-300 ease-in-out">
                        <h3 class="text-lg font-semibold text-gray-800">{{ $product->nom_produit }}</h3>
                        <span class="text-lg text-green-600 font-bold">{{ $product->prix }} €</span>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
</div>



<!-- Les 3 derniers rendez-vous Section -->
<div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
    <section class="rendezvous-section p-6">
        <h2 class="text-2xl font-semibold text-center mb-4">Les 3 derniers rendez-vous</h2>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white rounded-lg shadow-md" style="width: 100%;">
                <thead>
                    <tr class="text-left bg-gray-100">
                        <th class="px-4 py-2 text-sm text-gray-600">Client</th>
                        <th class="px-4 py-2 text-sm text-gray-600">Date</th>
                        <th class="px-4 py-2 text-sm text-gray-600">Heure</th>
                        <th class="px-4 py-2 text-sm text-gray-600">Description</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rendezvous as $rdv)
                        <tr class="border-t border-gray-200">
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $rdv->client->nom }}</td>
                            <td class="px-4 py-2 text-sm text-gray-600">
                                <flux:badge color="amber">{{ \Carbon\Carbon::parse($rdv->date_rendez_vous)->locale('fr')->isoFormat('D MMMM YYYY') }}</flux:badge>
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-600">
                                <flux:badge color="green">{{ \Carbon\Carbon::parse($rdv->heure_rendez_vous)->locale('fr')->isoFormat('HH:mm') }}</flux:badge>
                            </td>
                            <td class="px-4 py-2 text-sm text-gray-800">{{ $rdv->description }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </section>
</div>

    </div>
</x-layouts.app>

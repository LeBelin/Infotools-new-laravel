<x-layouts.app :title="__('Dashboard')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Tableau de bord</flux:heading>
        <flux:subheading size="lg" class="mb-6">
            <span class="text-2xl font-bold">Bienvenue, <flux:badge color="sky" size="lg">{{ auth()->user()->name }}</flux:badge></span>
        </flux:subheading>
        <flux:separator variant="subtle" />
    </div>

    <div class="flex h-full w-full flex-1 flex-col gap-4 rounded-xl">

        <!-- Boîte des 3 prochains rendez-vous (Gauche) -->
        <div class="rendezvous-box w-1/2 p-4 bg-white inline-block">
            <h2 class="text-2xl font-semibold mb-6 text-gray-900 dark:text-white">Les 3 prochains rendez-vous</h2>
            <flux:separator />
            <div style="padding: 10px;"></div>
            @php
                $prochainsRdv = $rendezvous->filter(function ($rdv) {
                    return \Carbon\Carbon::parse($rdv->date_rendez_vous)->isAfter(\Carbon\Carbon::now());
                })
                ->sortBy(function ($rdv) {
                    return \Carbon\Carbon::parse($rdv->date_rendez_vous)->addHours(\Carbon\Carbon::parse($rdv->heure_rendez_vous)->hour)
                    ->addMinutes(\Carbon\Carbon::parse($rdv->heure_rendez_vous)->minute);
                })
                ->take(3);
            @endphp

            <!-- Affichage horizontal des rendez-vous -->
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full">
                @foreach($prochainsRdv as $rdv)
                    <div class="flux-card min-w-[260px] px-6 border border-neutral-200 dark:border-neutral-700 hover:bg-zinc-50 dark:hover:bg-zinc-700 p-4 rounded-lg transition-all duration-300">
                        <flux:heading class="flex items-center gap-2 text-gray-900 dark:text-white">
                            <span class="font-semibold text-lg">Rendez vous avec {{ $rdv->client->nom }}</span>
                            <flux:icon name="calendar-search" class="ml-auto text-zinc-400" variant="micro" />
                        </flux:heading>
                        <flux:text class="mt-2 text-gray-600 dark:text-zinc-300">
                            <strong>Le {{ \Carbon\Carbon::parse($rdv->date_rendez_vous)->locale('fr')->isoFormat('D MMMM YYYY') }} à
                             {{ \Carbon\Carbon::parse($rdv->heure_rendez_vous)->locale('fr')->isoFormat('HH:mm') }}</strong> 
                        </flux:text>

                        <flux:separator />

                        <flux:text class="mt-2 text-gray-600 dark:text-zinc-300">
                            {{ $rdv->description }}
                        </flux:text>

                        <flux:text class="mt-2 text-gray-600 dark:text-zinc-300">
                            Commercial concernée : {{ $rdv->commercial->nom }}
                        </flux:text>
                    </div>
                @endforeach
            </div>
        </div>

        <!-- Boîte des 3 derniers produits (Droite) -->
        <div class="products-box w-1/2 p-4 bg-white inline-block">
            <h2 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Les 3 derniers produits</h2>
            <flux:separator />
            <div style="padding: 10px;"></div>
            <div class="flex justify-center items-center">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4 w-full ">
                    @foreach ($products as $product)
                        <div class="bg-white p-4 rounded-lg border border-neutral-200 dark:border-neutral-700 ease-in-out hover:bg-zinc-50 dark:hover:bg-zinc-700 transition duration-300">
                            <h3 class="text-lg font-semibold text-gray-800">{{ $product->nom_produit }}</h3>
                            <span class="text-lg text-green-600 font-bold">{{ $product->prix }} €</span>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>





        <!-- Stats Section -->
        <div class="relative overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <section class="flex items-center justify-between p-4">
                <h2 class="text-lg font-semibold">Statistiques</h2>
            </section>
            <div class="flex flex-wrap">
                <!-- Clients -->
                <div class="flex flex-col items-center p-6 bg-white ease-in-out w-full sm:w-1/2 md:w-1/4">
                    <div class="stat-icon bg-blue-100 p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon h-7 w-7 text-blue-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a4 4 0 00-4-4h-1M9 20H4v-2a4 4 0 014-4h1m4-4a4 4 0 110-8 4 4 0 010 8zm6 4a4 4 0 100-8 4 4 0 000 8z" />
                        </svg>
                    </div>
                    <div class="text-sm text-gray-600 mb-2">Clients</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $clientCount }}</div>
                </div>

                <!-- Produits -->
                <div class="flex flex-col items-center p-6 bg-white ease-in-out w-full sm:w-1/2 md:w-1/4">
                    <div class="stat-icon bg-green-100 p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon h-7 w-7 text-green-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 12v7a2 2 0 01-2 2H6a2 2 0 01-2-2v-7m16 0L12 3 4 12m16 0H4" />
                        </svg>
                    </div>
                    <div class="text-sm text-gray-600 mb-2">Produits</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $produitCount }}</div>
                </div>

                <!-- Commandes -->
                <div class="flex flex-col items-center p-6 bg-white ease-in-out w-full sm:w-1/2 md:w-1/4">
                    <div class="stat-icon bg-yellow-100 p-4 rounded-full mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon h-7 w-7 text-yellow-500" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h14l-1.35 6.78a2 2 0 01-1.97 1.72H7a2 2 0 01-2-2V6h16m-5 12a1 1 0 100 2 1 1 0 000-2zm-9 0a1 1 0 100 2 1 1 0 000-2z" />
                        </svg>
                    </div>
                    <div class="text-sm text-gray-600 mb-2">Commandes</div>
                    <div class="text-2xl font-bold text-gray-800">{{ $commandeCount }}</div>
                </div>

                <!-- Rendez-vous -->
                <div class="flex flex-col items-center p-6 bg-white ease-in-out w-full sm:w-1/2 md:w-1/4">
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

    </div>
</x-layouts.app>

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
                    <span class="text-2xl font-bold">{{ $factureCount }}</span>
                    <p class="text-gray-600">Nombre de Rendez vous :</p>
                    <span class="text-2xl font-bold">{{ $rendezvousCount }}</span>
                </div>
            </div>

            <div class="relative aspect-video overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
                <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
                Produits phares
            </div>

        </div>
        <div class="relative h-full flex-1 overflow-hidden rounded-xl border border-neutral-200 dark:border-neutral-700">
            <x-placeholder-pattern class="absolute inset-0 size-full stroke-gray-900/20 dark:stroke-neutral-100/20" />
            Les derniers rendez-vous
        </div>
    </div>
</x-layouts.app>

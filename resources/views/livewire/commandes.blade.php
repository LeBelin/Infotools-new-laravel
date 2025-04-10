<div>
    <flux:modal.trigger name="create-commande">
        <flux:button variant="primary">Ajouter une commande</flux:button>
    </flux:modal.trigger>

    <livewire:commande-create />
    <livewire:commande-edit />

    @if($showSuccessMessage)
        <div style="padding: 5px;"></div>
        <flux:callout variant="success" icon="check-circle" heading="Commande supprimée avec succès !" />
        <div style="padding: 5px;"></div>
    @endif

    <flux:modal name="delete-commande" class="min-w-[22rem]">
        <div class="space-y-6">
            @if($commandeName)
                <div>
                    <flux:heading size="lg">Supprimer la commande : {{ $commandeName }} ?</flux:heading>
                    <flux:subheading>
                        <p>Cette action est irréversible.</p>
                        <p>Vérifiez bien la commande avant de supprimer !</p>
                    </flux:subheading>
                </div>
            @endif
            <div class="flex gap-2">
                <flux:spacer />
                <flux:modal.close>
                    <flux:button variant="ghost">Annuler</flux:button>
                </flux:modal.close>
                <flux:button type="submit" variant="danger" wire:click="destroy">Supprimer la commande</flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Barre de recherche -->
    <div style="padding: 5px;"></div>
    <flux:input kbd="⌘K" icon="magnifying-glass" placeholder="Search..." type="text" id="search" />
    <div style="padding: 5px;"></div>

    <script>
        document.getElementById('search').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("tbody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });
    </script>

    <!-- Tableau des commandes -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th class="px-6 py-3">ID</th>
                    <th class="px-6 py-3">Client</th>
                    <th class="px-6 py-3">Produits</th>
                    <th class="px-6 py-3">Montant total</th>
                    <th class="px-6 py-3">Facture</th>
                    <th class="px-6 py-3">Créée le</th>
                    <th class="px-6 py-3">Modifiée le</th>
                    <th class="px-6 py-3">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($commandes as $commande)
                    <tr class="odd:bg-white even:bg-gray-50 border-b dark:border-gray-700 dark:bg-gray-800">
                        <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">
                            <flux:badge color="Zinc">{{ $commande->id }}</flux:badge>
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ $commande->client->nom }}
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            <ul class="list-disc list-inside">
                                @foreach($commande->produits as $produit)
                                    <li>
                                        {{ $produit->nom_produit }} — 
                                        {{ $produit->pivot->quantite }} × {{ number_format($produit->pivot->prix_unitaire, 2) }} €
                                    </li>
                                @endforeach
                            </ul>
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            <flux:badge color="lime">{{ number_format($commande->montant_total, 2) }} €</flux:badge>
                        </td>
                        <td class="px-6 py-2">
    <!-- Remplacer le wire:click par un lien vers la route de la facture -->
    <a href="{{ route('commande.facture', $commande->id) }}">
        <flux:button size="sm" icon="arrow-down-tray">Facture</flux:button>
    </a>
</td>

                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($commande->created_at)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($commande->updated_at)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}
                        </td>
                        <td class="px-6 py-2">
                            <flux:button variant="primary" size="sm" wire:click="edit({{ $commande->id }})">Modifier</flux:button>
                            <flux:button variant="danger" size="sm" wire:click="delete({{ $commande->id }})">Supprimer</flux:button>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

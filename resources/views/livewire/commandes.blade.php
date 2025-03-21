
<div>

    <flux:modal.trigger name="create-commande">
        <flux:button variant="primary">Ajouter une commande</flux:button>
    </flux:modal.trigger>
    <!-- crée le client dans le dossier livewire -->
    <livewire:commande-create />
    <!-- edit le client dans le dossier livewire -->
    <livewire:commande-edit />


    @if($showSuccessMessage)
        <div style="padding: 5px;"></div>
        <flux:callout variant="success" icon="check-circle" heading="Commande supprimé avec succès !" />
        <div style="padding: 5px;"></div>
    @endif

    <flux:modal name="delete-commande" class="min-w-[22rem]">
        <div class="space-y-6">
        @if($commandeName)
            <div>
                <flux:heading size="lg">Supprimer la commande : {{ $commandeName }} ?</flux:heading>

                <flux:subheading>
                    <p>Si vous le suprimmer vous ne pourrez pas revenir en arriere.</p>
                    <p>Attention a suprimmer le bon !</p>
                </flux:subheading>
            </div>
        @endif
            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Annulez</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="destroy()">Suprrimer le commande</flux:button>
            </div>
        </div>
    </flux:modal>



    <!-- Barre de recherche -->
    <div style="padding: 5px;"></div>
    <flux:input kbd="⌘K" icon="magnifying-glass" placeholder="Search..." type="text" id="search"/>
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

    <!-- Tableau des produit -->
    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">

            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Clients concerné</th>
                    <th scope="col" class="px-6 py-3">Produit concerné</th>
                    <th scope="col" class="px-6 py-3">Quantité</th>
                    <th scope="col" class="px-6 py-3">Montant</th>
                    <th scope="col" class="px-6 py-3">Date de création</th>
                    <th scope="col" class="px-6 py-3">Date de mise a jours</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($commandes as $commande)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-6 py-2 font-medium text-gray-900 dark:text-white"><flux:badge color="Zinc">{{ $commande->id }}</flux:badge></td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $commande->client->nom }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $commande->produit->nom_produit }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300"><flux:badge color="cyan">{{ $commande->quantite }}</flux:badge></td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300"><flux:badge color="lime">{{ $commande->montant }} €</flux:badge></td>
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

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
    <flux:input kbd="⌘K" icon="magnifying-glass" placeholder="Rechercher..." type="text" id="search" />
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
    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="background-color:#f0f7ff;">
                <tr>
                <th class="px-6 py-3 text-left">
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                            <flux:icon name="hash" class="w-4 h-4" />
                            <span>ID</span>
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left">
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                            <flux:icon name="user" class="w-4 h-4" />
                            <span>Client</span>
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left">
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                            <flux:icon name="shopping-basket" class="w-4 h-4" />
                            <span>Produits</span>
                        </div>
                    </th>
                    <th class="px-6 py-3 text-left">
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                            <flux:icon name="euro" class="w-4 h-4" />
                            <span>Montant total</span>
                        </div>
                    </th>
                
                    <!-- <th class="px-6 py-3">Facture</th> -->
                    <th class="px-6 py-3 text-left">
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                            <flux:icon name="calendar-search" class="w-4 h-4" />
                            <span>Date</span>
                        </div>
                    </th>

                    <th class="px-6 py-3 text-left">
                        <div class="flex items-center gap-2 text-gray-600 dark:text-gray-300">
                        
                            <span></span>
                        </div>
                    </th>
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

                        <td class="px-6 py-2 text-gray-700 dark:text-gray-300">
    <div class="grid gap-2">
        @foreach($commande->produits as $produit)
            <div class="flex justify-between items-center bg-white dark:bg-neutral-800 border border-gray-200 dark:border-neutral-700 rounded-xl px-4 py-2 shadow-sm hover:shadow-md transition-shadow">
                <div class="flex flex-col">
                    <span class="font-semibold text-sm text-gray-800 dark:text-white">
                        {{ $produit->nom_produit }}
                    </span>
                </div>
                <div class="text-xs bg-blue-100 dark:bg-blue-800 text-blue-800 dark:text-blue-100 px-3 py-1 rounded-full font-medium">
                    {{ $produit->pivot->quantite }} × {{ number_format($produit->pivot->prix_unitaire, 2) }} € 
                </div>
            </div>
        @endforeach
    </div>
</td>



                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            <flux:badge color="lime">{{ number_format($commande->montant_total, 2) }} <flux:icon.euro variant="micro"/></flux:badge>
                        </td>

                        <!-- <td class="px-6 py-2">
                            <a href="{{ route('commande.facture', $commande->id) }}">
                                <flux:button size="sm" icon="arrow-down-tray">Facture</flux:button>
                            </a>
                        </td> -->

                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            Crée le :<br>
                            {{ \Carbon\Carbon::parse($commande->created_at)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}
                            <br><br>Modifiée le :<br>
                                {{ \Carbon\Carbon::parse($commande->updated_at)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}

                        </td>
                        <td class="px-6 py-2">
                            <flux:dropdown>
                                <flux:button icon="ellipsis" variant="primary"></flux:button>

                                <flux:menu>
                                    <a href="{{ route('commande.facture', $commande->id) }}" target="_blank">
                                        <flux:menu.item icon="arrow-down-tray" kbd="€">Facture</flux:menu.item>
                                    </a>
                                    
                                    <flux:menu.separator />

                                    <flux:menu.item icon="pencil-square" kbd="✍️" wire:click="edit({{ $commande->id }})">Modifier</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger" kbd="❌" wire:click="delete({{ $commande->id }})">Supprimer</flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

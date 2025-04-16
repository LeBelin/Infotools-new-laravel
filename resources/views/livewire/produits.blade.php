<div>
    <flux:modal.trigger name="create-produit">
        <flux:button variant="primary">Ajouter un produit</flux:button>
    </flux:modal.trigger>
    <!-- crée le client dans le dossier livewire -->
    <livewire:produit-create />
    <!-- edit le client dans le dossier livewire -->
    <livewire:produit-edit />


    @if($showSuccessMessage)
        <div style="padding: 5px;"></div>
        <flux:callout variant="success" icon="check-circle" heading="Produit supprimé avec succès !" />
        <div style="padding: 5px;"></div>
    @endif
    
    <!-- Modal supression du produit -->
    <flux:modal name="delete-produit" class="min-w-[22rem]">
        <div class="space-y-6">
        @if($produitId)
            <div>
                <flux:heading size="lg">Supprimer le produit : {{ $produitName }} ?</flux:heading>

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

                <flux:button type="submit" variant="danger" wire:click="destroy()">Suprrimer le produit</flux:button>
            </div>
        </div>
    </flux:modal>

    <!-- Affiche les informations du produit demandées -->
    <flux:modal name="show-produit" class="min-w-[22rem]">
        <div class="space-y-6">
            @if($showProduit)
                <div class="space-y-4">
                    <flux:heading size="lg">Informations du produit</flux:heading>

                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left">
                            <tbody class="divide-y divide-gray-100">
                                <tr>
                                    <th class="px-4 py-2 font-medium text-gray-600 w-1/3">Nom</th>
                                    <td class="px-4 py-2">{{ $showProduit->nom_produit }}</td>
                                </tr>
                                <tr>
                                    <th class="px-4 py-2 font-medium text-gray-600">Description</th>
                                    <td class="px-4 py-2">{{ $showProduit->description }}</td>
                                </tr>
                                <tr>
                                    <th class="px-4 py-2 font-medium text-gray-600">Prix</th>
                                    <td class="px-4 py-2"><flux:badge color="lime">{{ $showProduit->prix }} €</flux:badge></td>
                                </tr>
                                <tr>
                                    <th class="px-4 py-2 font-medium text-gray-600">Stock</th>
                                    <td class="px-4 py-2">{{ $showProduit->stock }}</td>
                                </tr>
                                <tr>
                                    <th class="px-4 py-2 font-medium text-gray-600">Créé le</th>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($showProduit->created_at)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}</td>
                                </tr>
                                <tr>
                                    <th class="px-4 py-2 font-medium text-gray-600">Modifier le</th>
                                    <td class="px-4 py-2">{{ \Carbon\Carbon::parse($showProduit->updated_at)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <p class="text-center text-gray-500">Produit introuvable.</p>
            @endif

            <div class="flex justify-end">
                <flux:modal.close>
                    <flux:button variant="filled">Fermer</flux:button>
                </flux:modal.close>
            </div>
        </div>
    </flux:modal>


    <!-- Barre de recherche -->
    <div style="padding: 5px;"></div>
    <flux:input kbd="⌘K" icon="magnifying-glass" placeholder="Rechercher..." type="text" id="search"/>
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
    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="background-color:#f0f7ff;">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Nom</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Prix</th>
                    <th scope="col" class="px-6 py-3">Stock</th>
                    <th scope="col" class="px-6 py-3">Date de création</th>
                    <th scope="col" class="px-6 py-3">Date de mise à jour</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($produits as $produit)
                    <tr class="odd:bg-white even:bg-gray-50 border-b dark:border-gray-700 dark:bg-gray-800">
                        <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">
                            <flux:badge color="Zinc">{{ $produit->id }}</flux:badge>
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ $produit->nom_produit }}
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ $produit->description }}
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            <flux:badge color="lime">{{ $produit->prix }} €</flux:badge>
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            <flux:badge color="cyan">{{ $produit->stock }}</flux:badge>
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($produit->created_at)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($produit->updated_at)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}
                        </td>
                        <td class="px-6 py-2">
                            <flux:dropdown>
                            <flux:button icon:trailing="chevron-down" variant="primary">Options</flux:button>
                                <flux:menu>
                                    <flux:menu.item icon="search" kbd="👀" wire:click="show({{ $produit->id }})">Voir</flux:menu.item>
                                    <flux:menu.item icon="pencil-square" kbd="✏️" wire:click="edit({{ $produit->id }})">Modifier</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger" kbd="🗑️" wire:click="delete({{ $produit->id }})">Supprimer</flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

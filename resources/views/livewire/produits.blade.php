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
                    <th scope="col" class="px-6 py-3">Nom</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Prix</th>
                    <th scope="col" class="px-6 py-3">Stock</th>
                    <th scope="col" class="px-6 py-3">Date de création</th>
                    <th scope="col" class="px-6 py-3">Date de mise a jours</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>

            <tbody>
                @foreach($produits as $produit)
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-6 py-2 font-medium text-gray-900 dark:text-white"><flux:badge color="Zinc">{{ $produit->id }}</flux:badge></td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $produit->nom_produit }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $produit->description }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300"><flux:badge color="lime">{{ $produit->prix }} €</flux:badge></td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300"><flux:badge color="cyan">{{ $produit->stock }}</flux:badge></td>
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
                                <flux:menu.item icon="pencil-square" kbd="✏️" wire:click="edit({{ $produit->id }})">Modifier</flux:menu.item>
                                <flux:menu.item icon="trash" variant="danger" kbd="🗑️" wire:click="delete({{ $produit->id }})">Supprimer</flux:menu.item>
                            </flux:menu>
                        </flux:dropdown>

                        <!-- <flux:button variant="primary" size="sm" wire:click="edit({{ $produit->id }})">Modifier</flux:button>
                        <flux:button variant="danger" size="sm" wire:click="delete({{ $produit->id }})">Supprimer</flux:button> -->
                    </td>
                </tr>
                @endforeach
            </tbody>

        </table>
    </div>
</div>

<div>


    <flux:modal name="edit-commande" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Modifier la commande</flux:heading>
                <flux:subheading>Modifiez les détails de la commande</flux:subheading>
            </div>

            <!-- Client -->
            <div>
                <label for="client_id">Client concerné</label>
                <select wire:model="client_id" id="client_id" class="form-select w-full">
                    <option value="">Sélectionner un client</option>
                    @foreach($clients ?? [] as $client)
                        <option value="{{ $client->id }}">{{ $client->nom }}</option>
                    @endforeach

                </select>
            </div>

<!-- Produits dynamiques -->
<div class="space-y-4">
            @foreach($produits ?? [] as $index => $p)
                <div class="grid grid-cols-12 gap-2 items-end">
                    <div class="col-span-6">
                        <label>Produit</label>
                        <select wire:model="produits.{{ $index }}.produit_id" class="form-select w-full">
                            <option value="">Sélectionner</option>
                            @foreach($produitList as $produit)
                                <option value="{{ $produit->id }}">{{ $produit->nom_produit }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-span-3">
                        <label>Quantité</label>
                        <input type="number" min="1" wire:model="produits.{{ $index }}.quantite" class="form-input w-full" />
                    </div>
                    <div class="col-span-2">
                        <label>Prix</label>
                        <input type="text" disabled wire:model="produits.{{ $index }}.prix_unitaire" class="form-input w-full bg-gray-100" />
                    </div>
                    <div class="col-span-1">
                    <flux:button size="sm"  color="red" wire:click="removeProduit({{ $index }})">🗑️</flux:button>

                    </div>
                </div>
            @endforeach

            </div>

            <flux:button wire:click="addProduit">+ Ajouter un produit</flux:button>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="update">Modifier la commande</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

<div>


    <flux:modal name="create-commande" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Ajouter une commande</flux:heading>
                <flux:subheading>Remplissez les informations pour créer une nouvelle commande.</flux:subheading>
            </div>

              <!-- Sélecteur de client -->
              <div class="mb-4">
                    <label for="client_id" class="block text-gray-700">Client</label>
                    <select id="client_id" wire:model="client_id" class="form-select mt-1 block w-full">
                        <option value="">Sélectionner un client</option>
                        @foreach($clients as $client)
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

            <!-- Total -->
            <div>
                <label>Montant total</label>
                <input type="text" disabled class="form-input w-full bg-gray-100" wire:model="montant_total" />
            </div>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="submit">Ajouter la commande</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

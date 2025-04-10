<div>
    <flux:modal name="create-commande" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Ajouter une commande</flux:heading>
                <flux:subheading>Remplissez les informations pour créer une nouvelle commande.</flux:subheading>
            </div>

            <!-- Sélecteur de client -->
            <flux:fieldset>
                <div class="space-y-6">
                    <flux:select label="Client" wire:model="client_id">
                        <option value="">Sélectionner un client</option>
                        @foreach($clients as $client)
                            <option value="{{ $client->id }}">{{ $client->nom }}</option>
                        @endforeach
                    </flux:select>
                </div>
            </flux:fieldset>

            <!-- Produits dynamiques -->
            <flux:fieldset>
                <div class="space-y-6">
                    @foreach($produits ?? [] as $index => $p)
                        <div class="flex items-center gap-2">
                            <!-- Sélecteur de produit -->
                            <div class="flex-1">
                                <flux:select label="Produit" wire:model="produits.{{ $index }}.produit_id">
                                    <option value="">Sélectionner un produit</option>
                                    @foreach($produitList as $produit)
                                        <option value="{{ $produit->id }}">{{ $produit->nom_produit }}</option>
                                    @endforeach
                                </flux:select>
                            </div>

                            <!-- Liste déroulante pour la quantité -->
                            <div class="flex-1">
                                <flux:select 
                                    label="Quantité" 
                                    wire:model="produits.{{ $index }}.quantite"
                                >
                                    @for ($i = 1; $i <= 10; $i++) <!-- Quantités de 1 à 10 -->
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </flux:select>
                            </div>

                            <!-- Prix -->
                            <div class="flex-1">
                                <flux:input
                                    type="text"
                                    label="Prix"
                                    disabled
                                    wire:model="produits.{{ $index }}.prix_unitaire"
                                    class="w-full bg-gray-100"
                                />
                            </div>

                            <!-- Bouton supprimer -->
                            <div>
                                <flux:button
                                    size="sm"
                                    color="red"
                                    wire:click="removeProduit({{ $index }})"
                                >🗑️</flux:button>
                            </div>
                        </div>
                    @endforeach
                </div>
            </flux:fieldset>



            <flux:button wire:click="addProduit">+ Ajouter un produit</flux:button>

            <!-- Total -->
            <div>
                <label>Montant total</label>
                <input
                    type="text"
                    disabled
                    class="form-input w-full bg-gray-100"
                    wire:model="montant_total"
                />
            </div>

            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="submit">Ajouter la commande</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

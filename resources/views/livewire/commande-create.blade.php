<div>
    <flux:modal name="create-commande" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Ajouter une commande</flux:heading>
                <flux:subheading>Remplissez les informations pour créer une nouvelle commande.</flux:subheading>
            </div>

            <flux:separator />
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
                    <div class="flex flex-wrap gap-6 lg:gap-8">
                        <!-- Sélecteur de produit (plus large) -->
                        <div class="flex-none basis-[250px]">
                            <flux:select label="Produit" wire:model="produits.{{ $index }}.produit_id">
                                <option value="">Sélectionner un produit</option>
                                @foreach($produitList as $produit)
                                    <option value="{{ $produit->id }}">{{ $produit->nom_produit }}</option>
                                @endforeach
                            </flux:select>
                        </div>

                        <!-- Liste déroulante pour la quantité (plus petit) -->
                        <div class="flex-1 basis-[80px]">
                            <flux:select 
                                label="Quantité" 
                                wire:model="produits.{{ $index }}.quantite"
                            >
                                @for ($i = 1; $i <= 10; $i++) <!-- Quantités de 1 à 10 -->
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </flux:select>
                        </div>
                        
                        <!-- Prix (plus petit) -->
                        <div class="flex-1 basis-[80px]">
                            <flux:input
                                readonly 
                                variant="filled"
                                type="text"
                                label="Prix"
                                wire:model="produits.{{ $index }}.prix_unitaire"
                                class="w-full bg-gray-100"
                            />
                        </div>
                        
                        <flux:separator vertical class="my-2" />

                        <!-- Bouton supprimer -->
                        <div class="flex items-end">
                            <flux:button
                                wire:click="removeProduit({{ $index }})"
                            >🗑️</flux:button>
                        </div>

                    </div>
                    <flux:separator />
                    @endforeach
                </div>
            </flux:fieldset>


            <flux:button wire:click="addProduit">+ Ajouter un produit</flux:button>

            <flux:fieldset>
                <div class="space-y-6">
                    <!-- Affichage du montant total -->
                    <div class="flex flex-col">
                        <label class="text-lg font-semibold">Montant total</label>
                        <flux:input
                            readonly 
                            variant="filled"
                            type="text"
                            disabled
                            wire:model="montant_total"
                        />
                    </div>
                </div>
            </flux:fieldset>


            <div class="flex">
                <flux:spacer />
                <flux:button type="submit" variant="primary" wire:click="submit">Ajouter la commande</flux:button>
            </div>
        </div>
    </flux:modal>
</div>

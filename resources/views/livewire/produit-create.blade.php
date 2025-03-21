<div>

    @if($showSuccessMessage)
    <div style="padding: 5px;"></div>
        <flux:callout variant="success" icon="check-circle" heading="Produit ajouté avec succès !" />
    <div style="padding: 5px;"></div>
    @endif

    <flux:modal name="create-produit" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Ajouter un produit</flux:heading>
                <flux:subheading>Remplisser le formulaire pour ajouté un produit !</flux:subheading>
            </div>

            <flux:input wire:model="nom_produit" label="Nom du produit" placeholder="Nom du produit" />
            <flux:textarea wire:model="description" label="Description" placeholder="Description" />
            <flux:input wire:model="prix" label="Prix" placeholder="50" />
            <flux:input wire:model="stock" label="Nombre de produits" placeholder="122" />

            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="submit">Ajouter le produit</flux:button>
            </div>

        </div>
    </flux:modal>

</div>
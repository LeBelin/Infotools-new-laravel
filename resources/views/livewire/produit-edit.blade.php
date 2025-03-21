<div>
    
    @if($showSuccessMessage)
    <div style="padding: 5px;"></div>
        <flux:callout variant="success" icon="check-circle" heading="Produit modifié avec succès !" />
    <div style="padding: 5px;"></div>
    @endif


    <flux:modal name="edit-produit" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Modifier le produit</flux:heading>
                <flux:subheading>Modifier les informations du produit comme il se doit</flux:subheading>
            </div>

            <flux:input wire:model="nom_produit" label="Nom" placeholder="Nom" />
            <flux:textarea wire:model="description" label="description" placeholder="description" />
            <flux:input wire:model="prix" label="prix" placeholder="prix" />
            <flux:input wire:model="stock" label="stock" placeholder="stock" />


            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="update">Modifier le produits</flux:button>
            </div>
        </div>
    </flux:modal>

</div>

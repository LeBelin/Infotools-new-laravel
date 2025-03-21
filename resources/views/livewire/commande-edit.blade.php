<div>
    
    @if($showSuccessMessage)
    <div style="padding: 5px;"></div>
        <flux:callout variant="success" icon="check-circle" heading="Commande modifié avec succès !" />
    <div style="padding: 5px;"></div>
    @endif


    <flux:modal name="edit-commande" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Modifier la commande</flux:heading>
                <flux:subheading>Modifier les informations de la commande comme il se doit</flux:subheading>
            </div>

            <flux:input wire:model="client_id" label="Client concerné" placeholder="Client concerné" />
            <flux:textarea wire:model="produit_id" label="Produit concerné" placeholder="Produit concerné" />
            <flux:input wire:model="quantite" label="Quantité" placeholder="Quantité" />
            <flux:input wire:model="montant" label="Montant" placeholder="Montant" />


            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="update">Modifier le produits</flux:button>
            </div>
        </div>
    </flux:modal>

</div>

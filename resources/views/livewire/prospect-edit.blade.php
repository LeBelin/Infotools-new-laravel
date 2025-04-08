<div>
    
    @if($showSuccessMessage)
    <div style="padding: 5px;"></div>
        <flux:callout variant="success" icon="check-circle" heading="Prospect modifié avec succès !" />
        <div style="padding: 5px;"></div>
    @endif


    <flux:modal name="edit-prospect" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Modifier le prospect</flux:heading>
                <flux:subheading>Modifier les informations du prospect comme il se doit</flux:subheading>
            </div>

            <flux:input wire:model="nom" label="Nom" placeholder="Nom" />
            <flux:input wire:model="email" label="Mail" placeholder="Mail" />
            <flux:input wire:model="telephone" label="Téléphone" placeholder="Téléphone" />
            <flux:textarea wire:model="adresse" label="Adresse" placeholder="Adresse" />



            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="update">Modifier le prospect</flux:button>
            </div>
        </div>
    </flux:modal>

</div>

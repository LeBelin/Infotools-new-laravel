<div>
    
    @if($showSuccessMessage)
    <div style="padding: 5px;"></div>
        <flux:callout variant="success" icon="check-circle" heading="Commercial modifié avec succès !" />
        <div style="padding: 5px;"></div>
    @endif


    <flux:modal name="edit-commercial" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Modifier le commercial</flux:heading>
                <flux:subheading>Modifier les informations du commercial comme il se doit</flux:subheading>
            </div>

            <flux:input wire:model="nom" label="Nom" placeholder="Nom" />
            <flux:input wire:model="email" label="Mail" placeholder="Mail" />
            <flux:input wire:model="telephone" label="Téléphone" placeholder="Téléphone" mask="99 99 99 99 99" value="0716123456" />
            <flux:textarea wire:model="adresse" label="Adresse" placeholder="Adresse" />



            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="update">Modifier le commercial</flux:button>
            </div>
        </div>
    </flux:modal>

</div>
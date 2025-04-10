<div>

    @if($showSuccessMessage)
    <div style="padding: 5px;"></div>
        <flux:callout variant="success" icon="check-circle" heading="Prospect ajouté avec succès !" />
    <div style="padding: 5px;"></div>
    @endif

    <flux:modal name="create-prospect" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Crée un prospect</flux:heading>
                <flux:subheading>Remplisser le formulaire pour crée un prospect !</flux:subheading>
            </div>

            <flux:input wire:model="nom" label="Nom" placeholder="Nom" />
            <flux:input wire:model="email" label="Mail" placeholder="Mail" />
            <flux:input wire:model="telephone" label="Téléphone" placeholder="Téléphone" mask="99 99 99 99 99" value="0716123456" />
            <flux:textarea wire:model="adresse" label="Adresse" placeholder="Adresse" />



            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="submit">Ajouter le prospect</flux:button>
            </div>
        </div>
    </flux:modal>

</div>

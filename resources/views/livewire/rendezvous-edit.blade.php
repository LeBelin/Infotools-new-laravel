<div>
    
    @if($showSuccessMessage)
    <div style="padding: 5px;"></div>
        <flux:callout variant="success" icon="check-circle" heading="Rendez Vous modifié avec succès !" />
    <div style="padding: 5px;"></div>
    @endif


    <flux:modal name="edit-rendezvous" class="md:w-150">
        <div class="space-y-6">
            <div>
                <flux:heading size="lg">Modifier le Rendez Vous</flux:heading>
                <flux:subheading>Modifier les informations du Rendez Vous comme il se doit</flux:subheading>
            </div>

            <form>
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

                <!-- Sélecteur de la date -->
                <div class="mb-4">
                    <label for="date_rendez_vous" class="block text-gray-700">Date</label>
                    <input type="date" id="date_rendez_vous" wire:model="date_rendez_vous" class="form-input mt-1 block w-full" placeholder="Sélectionner la date" />
                </div>

                <!-- Sélecteur de l'heure -->
                <div class="mb-4">
                    <label for="heure_rendez_vous" class="block text-gray-700">Heure du rendez-vous</label>
                    <input type="time" id="heure_rendez_vous" wire:model="heure_rendez_vous" class="form-input mt-1 block w-full" placeholder="Sélectionner l'heure" />
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="block text-gray-700">Description</label>
                    <textarea id="description" wire:model="description" class="form-textarea mt-1 block w-full" placeholder="Description"></textarea>
                </div>
            </form>


            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="update">Modifier le rendez vous</flux:button>
            </div>
        </div>
    </flux:modal>

</div>

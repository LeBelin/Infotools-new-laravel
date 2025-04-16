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

                <!-- Sélecteur de commercial -->
                <flux:fieldset>
                    <div class="space-y-6">
                        <flux:select label="Commercial" wire:model="commercial_id">
                            <option value="">Sélectionner un commercial</option>
                            @foreach($commerciaux as $commercial)
                                <option value="{{ $commercial->id }}">{{ $commercial->nom }}</option>
                            @endforeach
                        </flux:select>
                    </div>
                </flux:fieldset>

                <!-- Sélecteur de la date -->
                <flux:input type="date" label="Date" wire:model="date_rendez_vous" max="2999-12-31" />

                <!-- Sélecteur de l'heure -->
                <div class="mb-6">
                    <label for="heure_rendez_vous" class="block mb-2">Heure du rendez-vous</label>
                    <input
                        type="time"
                        id="heure_rendez_vous"
                        wire:model="heure_rendez_vous"
                        class="form-input mt-1 block w-full py-2 px-4 bg-white border border-gray-300 rounded-lg shadow-sm focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition duration-200 ease-in-out"
                        placeholder="Sélectionner l'heure"
                    />
                </div>

                <!-- Description -->
                <flux:textarea wire:model="description" label="Description" placeholder="Description" />
            </form>


            <div class="flex">
                <flux:spacer />

                <flux:button type="submit" variant="primary" wire:click="update">Modifier le rendez vous</flux:button>
            </div>
        </div>
    </flux:modal>

</div>

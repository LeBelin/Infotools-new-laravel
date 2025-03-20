<div>

    <flux:modal.trigger name="create-client">
        <flux:button>Crée un client</flux:button>
    </flux:modal.trigger>
    <!-- crée le client dans le dossier livewire -->
    <livewire:client-create />
    <!-- edit le client dans le dossier livewire -->
    <livewire:client-edit />

    
    <flux:modal name="delete-client" class="min-w-[22rem]">
        <div class="space-y-6">
        @if($clientId)
            <div>
                <flux:heading size="lg">Supprimer le client : {{ $clientName }}?</flux:heading>

                <flux:subheading>
                    <p>Si vous le suprimmer vous ne pourrez pas revenir en arriere.</p>
                    <p>Attention a suprimmer le bon !</p>
                </flux:subheading>
            </div>
        @endif
            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Annulez</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="destroy()">Suprrimer le client</flux:button>
            </div>
        </div>
    </flux:modal>
    

    <div class="overflow-x-auto">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Nom</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Téléphone</th>
                    <th scope="col" class="px-6 py-3">Adresse</th>
                </tr>
            </thead>
            <tbody>
                @foreach($clients as $client)
               
                <tr class="odd:bg-white odd:dark:bg-gray-900 even:bg-gray-50 even:dark:bg-gray-800 border-b dark:border-gray-700">
                    <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">{{ $client->id }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $client->nom }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $client->email }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $client->telephone }}</td>
                    <td class="px-6 py-2 text-gray-600 dark:text-gray-300">{{ $client->adresse }}</td>
                    <td class="px-6 py-2">
                    <flux:button variant="primary" size="sm" wire:click="edit({{ $client->id }})">Modifier</flux:button>
                    <flux:button variant="danger" size="sm" wire:click="delete({{ $client->id }})">Supprimer</flux:button>
                    </td>
                </tr>

                @endforeach
            </tbody>
        </table>
    </div>
</div>

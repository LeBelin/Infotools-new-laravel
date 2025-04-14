
<div>

    <flux:modal.trigger name="create-rendezvous">
        <flux:button variant="primary">Ajouter un rendez vous</flux:button>
    </flux:modal.trigger>
    <!-- crée le client dans le dossier livewire -->
    <livewire:rendezvous-create />
    <!-- edit le client dans le dossier livewire -->
    <livewire:rendezvous-edit />


    @if($showSuccessMessage)
        <div style="padding: 5px;"></div>
        <flux:callout variant="success" icon="check-circle" heading="Rendez vous supprimé avec succès !" />
        <div style="padding: 5px;"></div>
    @endif

    <!-- Modal de suppression -->
    <flux:modal name="delete-rendezvous" class="min-w-[22rem]">
        <div class="space-y-6">
            @if(isset($rendezvousId))
                <div>
                    <flux:heading size="lg">Supprimer le rendez-vous : {{ $rendezvousName }} ?</flux:heading>

                    <flux:subheading>
                        <p>Si vous le supprimez, vous ne pourrez pas revenir en arrière.</p>
                        <p>Assurez-vous de supprimer le bon rendez-vous !</p>
                    </flux:subheading>
                </div>
            @endif
            <div class="flex gap-2">
                <flux:spacer />

                <flux:modal.close>
                    <flux:button variant="ghost">Annulez</flux:button>
                </flux:modal.close>

                <flux:button type="submit" variant="danger" wire:click="destroy()">Suprrimer le rendez vous</flux:button>
            </div>
        </div>
    </flux:modal>



    <!-- Barre de recherche -->
    <div style="padding: 5px;"></div>
    <flux:input kbd="⌘K" icon="magnifying-glass" placeholder="Search..." type="text" id="search"/>
    <div style="padding: 5px;"></div>
    
    <script>
        document.getElementById('search').addEventListener('keyup', function () {
            let filter = this.value.toLowerCase();
            let rows = document.querySelectorAll("tbody tr");

            rows.forEach(row => {
                let text = row.innerText.toLowerCase();
                row.style.display = text.includes(filter) ? "" : "none";
            });
        });
    </script>

    <!-- Tableau des rendez vous -->
    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="background-color:#f0f7ff;">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Clients concerné</th>
                    <th scope="col" class="px-6 py-3">Date</th>
                    <th scope="col" class="px-6 py-3">Heure</th>
                    <th scope="col" class="px-6 py-3">Description</th>
                    <th scope="col" class="px-6 py-3">Date de création</th>
                    <th scope="col" class="px-6 py-3">Date de mise à jour</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($rendezvous as $rendezvous)
                    <tr class="odd:bg-white even:bg-gray-50 border-b dark:border-gray-700 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">
                            <flux:badge color="Zinc">{{ $rendezvous->id }}</flux:badge>
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ $rendezvous->client->nom }}
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            <flux:badge color="amber">
                                {{ \Carbon\Carbon::parse($rendezvous->date_rendez_vous)->locale('fr')->isoFormat('D MMMM YYYY') }}
                            </flux:badge>
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            <flux:badge color="green">
                                {{ \Carbon\Carbon::parse($rendezvous->heure_rendez_vous)->locale('fr')->isoFormat('HH:mm') }}
                            </flux:badge>
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ $rendezvous->description }}
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($rendezvous->created_at)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($rendezvous->updated_at)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}
                        </td>
                        <td class="px-6 py-2">
                            <flux:dropdown>
                                <flux:button icon:trailing="chevron-down" variant="primary">Options</flux:button>
                                <flux:menu>
                                    <flux:menu.item icon="pencil-square" kbd="✏️" wire:click="edit({{ $rendezvous->id }})">Modifier</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger" kbd="🗑️" wire:click="delete({{ $rendezvous->id }})">Supprimer</flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

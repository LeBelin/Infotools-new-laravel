
<div>

    <flux:modal.trigger name="create-prospect">
        <flux:button variant="primary">Crée un prospect</flux:button>
    </flux:modal.trigger>
    <!-- crée le prospect dans le dossier livewire -->
    <livewire:prospect-create />
    <!-- edit le prospect dans le dossier livewire -->
    <livewire:prospect-edit />


    @if($showSuccessMessage)
        <div style="padding: 5px;"></div>
        <flux:callout variant="success" icon="check-circle" heading="Prospect supprimé avec succès !" />
        <div style="padding: 5px;"></div>
    @endif

    <flux:modal name="delete-prospect" class="min-w-[22rem]">
        <div class="space-y-6">
        @if($prospectId)
            <div>
                <flux:heading size="lg">Supprimer le prospect : {{ $prospectName }} ?</flux:heading>

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

                <flux:button type="submit" variant="danger" wire:click="destroy()">Suprrimer le prospect</flux:button>
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

    <!-- Tableau des prospects -->
    <div class="overflow-x-auto rounded-xl border border-gray-200 dark:border-gray-700">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400" style="background-color:#f0f7ff;">
                <tr>
                    <th scope="col" class="px-6 py-3">ID</th>
                    <th scope="col" class="px-6 py-3">Nom</th>
                    <th scope="col" class="px-6 py-3">Email</th>
                    <th scope="col" class="px-6 py-3">Téléphone</th>
                    <th scope="col" class="px-6 py-3">Adresse</th>
                    <th scope="col" class="px-6 py-3">Date de création</th>
                    <th scope="col" class="px-6 py-3">Date de mise à jour</th>
                    <th scope="col" class="px-6 py-3">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prospects as $prospect)
                    <tr class="odd:bg-white even:bg-gray-50 border-b dark:border-gray-700 dark:bg-gray-800 hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-200">
                        <td class="px-6 py-2 font-medium text-gray-900 dark:text-white">
                            <flux:badge color="Zinc">{{ $prospect->id }}</flux:badge>
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ $prospect->nom }}
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ $prospect->email }}
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            <flux:badge color="zinc">{{ $prospect->telephone }}</flux:badge>
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ $prospect->adresse }}
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($prospect->created_at)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}
                        </td>
                        <td class="px-6 py-2 text-gray-600 dark:text-gray-300">
                            {{ \Carbon\Carbon::parse($prospect->updated_at)->locale('fr')->isoFormat('D MMMM YYYY à HH:mm') }}
                        </td>
                        <td class="px-6 py-2">
                            <flux:dropdown>
                                <flux:button icon:trailing="chevron-down" variant="primary">Options</flux:button>
                                <flux:menu>
                                    <flux:menu.item icon="pencil-square" kbd="✏️" wire:click="edit({{ $prospect->id }})">Modifier</flux:menu.item>
                                    <flux:menu.item icon="trash" variant="danger" kbd="🗑️" wire:click="delete({{ $prospect->id }})">Supprimer</flux:menu.item>
                                </flux:menu>
                            </flux:dropdown>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>

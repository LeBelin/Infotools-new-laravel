<x-layouts.app :title="__('Factures')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Factures</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Gérer les factures') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <livewire:factures />
</x-layouts.app>

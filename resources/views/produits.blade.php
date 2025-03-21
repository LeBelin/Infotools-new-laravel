<x-layouts.app :title="__('Produits')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Produits</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Gérer les produits') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <livewire:produits />
</x-layouts.app>

<x-layouts.app :title="__('Commandes')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Commandes</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Gérer les commandes') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <livewire:commandes />
</x-layouts.app>

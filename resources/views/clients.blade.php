<x-layouts.app :title="__('Clients')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Clients</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Gérer les clients') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <livewire:clients />
</x-layouts.app>

<x-layouts.app :title="__('Commerciaux')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Commerciaux</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Gérer les Commerciaux') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <livewire:commerciaux />
</x-layouts.app>

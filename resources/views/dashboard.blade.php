<x-layouts.app :title="__('Dashboard')">
<div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Tableau de bord</flux:heading>
        <flux:subheading size="lg" class="mb-6">Bonjours, <flux:badge color="sky">{{ auth()->user()->name }}</flux:badge></flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <livewire:dashboard />
</x-layouts.app>


<x-layouts.app :title="__('Rendez-vous')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Rendez-vous</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Gérer les Rendez-vous') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <livewire:rendez_vous />
</x-layouts.app>

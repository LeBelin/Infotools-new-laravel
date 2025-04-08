<x-layouts.app :title="__('Prospects')">
    <div class="relative mb-6 w-full">
        <flux:heading size="xl" level="1">Prospects</flux:heading>
        <flux:subheading size="lg" class="mb-6">{{ __('Gérer les Prospect') }}</flux:subheading>
        <flux:separator variant="subtle" />
    </div>
    <livewire:prospects />
</x-layouts.app>

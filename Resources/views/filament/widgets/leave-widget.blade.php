<x-filament::widget>
    <x-filament::card>
        <div
            {{ $attributes->class([
                'w-10 h-10 rounded-full bg-gray-200 bg-cover bg-center',
                'dark:bg-gray-900' => config('filament.dark_mode'),
            ]) }}
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
        </svg>
        <h2 class="text-lg sm:text-xl font-bold tracking-tight">Leave Widget</h2>
    </x-filament::card>
</x-filament::widget>

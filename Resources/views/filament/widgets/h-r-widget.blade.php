<x-filament::widget>
    <x-filament::card>
        @php
            $user = \Filament\Facades\Filament::auth()->user();
        @endphp
        {{-- Widget content --}}
        <div class="h-12 flex items-center space-x-4 rtl:space-x-reverse">
            <x-hr::employee-avatar :user="$user" />
            <div>
                <h2 class="text-lg sm:text-xl font-bold tracking-tight">
                   Human Resources
                </h2>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>

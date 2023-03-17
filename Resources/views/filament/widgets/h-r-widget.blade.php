<x-filament::widget>
    <x-filament::card>
        @php
            $user = \Filament\Facades\Filament::auth()->user();
        @endphp
        {{-- Widget content --}}
        <div class="h-12 flex items-center space-x-4 rtl:space-x-reverse">
            <svg class="h-5 w-5 shrink-0" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"></path>
            </svg>
            <div>
                <h2 class="text-lg sm:text-xl font-bold tracking-tight">
                   Human Resources
                </h2>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>

<x-filament::widget>
    <x-filament::card>
        {{-- Widget content --}}
        <div class="h-12 flex items-center space-x-4 rtl:space-x-reverse">
            <x-hr::employee-avatar :user="$user" />
            <div>
                <h2 class="text-lg sm:text-xl font-bold tracking-tight">
                    {{ \Lam::getEmployeeName($user)}}
                </h2>
            </div>
        </div>
    </x-filament::card>
</x-filament::widget>

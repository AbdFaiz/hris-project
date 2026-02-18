<x-filament-panels::page>
    <x-filament::section>
        <form wire:submit.prevent="submit">
            {{ $this->form }}
        </form>

        <div class="mt-6 flex justify-end">
            <x-filament::button wire:click="exportPdf" color="danger" icon="heroicon-o-document-arrow-down">
                Export PDF
            </x-filament::button>
        </div>
    </x-filament::section>

    <x-filament::section class="mt-6">
        @if(count($positions) > 0)
            <div class="flex flex-col items-center overflow-x-auto">
                {{-- Contoh Sederhana Hierarki --}}
                @foreach($positions as $pos)
                    <div class="p-4 mb-4 border rounded-lg bg-white dark:bg-gray-800 shadow-sm w-64 text-center">
                        <div class="font-bold text-primary-600 uppercase">{{ $pos->name }}</div>
                        <div class="text-xs text-gray-500">{{ $pos->unit?->name }}</div>
                        <hr class="my-2">
                        @foreach($pos->employees as $emp)
    <div class="text-sm font-medium">{{ $emp->full_name }}</div> {{-- Ganti ke full_name --}}
@endforeach
                    </div>
                    @if(!$loop->last)
                        <div class="h-8 w-0.5 bg-gray-300 dark:bg-gray-600"></div>
                    @endif
                @endforeach
            </div>
        @else
            <div class="text-center py-10 text-gray-400">
                Please select a division to view the structure.
            </div>
        @endif
    </x-filament::section>
</x-filament-panels::page>

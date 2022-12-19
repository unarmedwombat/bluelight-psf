<x-filament::page>
    <form wire:submit.prevent="update" method="POST">
        @csrf
        <div class="bg-white p-6">
            <div class="text-2xl mb-6">{{ $framework->fullTitle }}</div>
            <div class="flex mb-4">
                <div class="w-64 shrink-0"></div>
                <div class="w-full flex">
                @foreach($framework->regions as $region)
                    <div class="w-1/10 px-1 flex-grow-0 flex justify-between items-end h-16">
                        <div class="text-center leading-tight w-full">{{ $region->title }}</div>
                    </div>
                @endforeach
                </div>
            </div>
            @foreach ($framework->lots as $lot)
            <div class="flex items-center">
                <div class="text-lg w-64 shrink-0">
                    {{ $lot->fullTitle }}
                </div>
                <div class="w-full flex">
                @foreach($framework->regions as $region)
                    <div class="w-1/10 text-center">
                        <input type="checkbox" wire:click="toggle({{$lot->id}},{{$region->id}})" {{ ($opps[$lot->id][$region->id] == 1) ? 'checked' : '' }}>
                    </div>
                @endforeach
                </div>
            </div>
           <div class="w-12 h-8"></div>
        @endforeach
            <div class="my-6 flex justify-between">
                <div class="space-x-6">
                    <button type="submit" class="inline-flex items-center justify-center font-medium tracking-tight rounded-sm focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset text-white hover:text-gray-800 bg-primary-400 hover:bg-primary-300 focus:bg-primary-300 focus:ring-offset-primary-500 h-9 px-4">Save</button>
                    <a class="inline-flex items-center justify-center font-medium tracking-tight rounded-sm focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset text-gray-800 bg-white border border-gray-300 hover:bg-gray-50 focus:ring-primary-600 focus:text-primary-600 focus:bg-primary-50 focus:border-primary-600 h-9 px-4" href="https://bl.dsctest.co.uk/admin/frameworks/{{ $framework->id }}/edit">Cancel</a>
                </div>
                <div class="space-x-6">
                    <button type="button" wire:click="setAllOn" class="inline-flex items-center justify-center font-medium tracking-tight rounded-sm focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset text-gray-800 bg-warning-400 hover:bg-warning-300 focus:bg-warning-300 focus:ring-offset-warning-400 h-9 px-4">set all on</button>
                    <button type="button" wire:click="setAllOff" class="inline-flex items-center justify-center font-medium tracking-tight rounded-sm focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset text-white bg-danger-600 hover:bg-danger-500 focus:bg-danger-700 focus:ring-offset-danger-700 h-9 px-4">set all off</button>
                </div>
            </div>
        </div>
    </form>
</x-filament::page>

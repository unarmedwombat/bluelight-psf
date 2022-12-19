<x-filament::page>
    <form wire:submit.prevent="update" method="POST">
        @csrf
        <div class="bg-white p-6">
            <div class="text-2xl mb-6 font-bold">{{ $contractor->title }}</div>
            <div class="flex flex-col">

@foreach($contractor->frameworks as $framework)
                <div class="mb-8">
                    <div class="space-y-2 pt-4 @if(!$loop->first) border-t-2 border-gray-400 @endif">
                        <div class="flex border-b border-gray-200">
                            <div class="text-lg leading-tight pb-2 w-1/4 shrink-0">{{ $framework->fullTitle }}</div>
                            <div class="flex w-3/4 pb-2">
    @foreach($framework->regions as $region)
                                <div class="w-1/10 px-2 text-sm text-center shrink-0">{{ $region->title }}</div>
    @endforeach
                            </div>
                        </div>

    @foreach($framework->lots as $lot)

        @php $candidates = $contractor->opportunities->intersect($lot->opportunities); $here = '' @endphp
        @if ($candidates->count() || $showAll)
                        <div class="flex">
                            <div class="px-4 w-1/4 shrink-0">{{ $lot->fullTitle }}</div>
                            <div class="flex w-3/4">
            @foreach($framework->regions as $region)
                                <div class="w-1/10 px-2 text-center shrink-0">
                @php
                    foreach($candidates as $opportunity) {
                        if($opportunity->region_id == $region->id) {
                            $here = 'checked';
                            break;
                        } else {
                            $here = '';
                        }
                    }
                    echo '<input type="checkbox" wire:click="toggleOpportunity('.$lot->id.', '.$region->id.')" '.$here.'>';
                @endphp
                                </div>
            @endforeach
                            </div>
                        </div>
        @endif
    @endforeach
                    </div>

                </div>

@endforeach

                <div class="space-x-6">
{{--                    <button type="button" wire:click="setAllOn" class="inline-flex items-center justify-center font-medium tracking-tight rounded-sm focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset text-gray-800 bg-warning-400 hover:bg-warning-300 focus:bg-warning-300 focus:ring-offset-warning-400 h-9 px-4">set all on</button>--}}
{{--                    <button type="button" wire:click="setAllOff" class="inline-flex items-center justify-center font-medium tracking-tight rounded-sm focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset text-white bg-danger-600 hover:bg-danger-500 focus:bg-danger-700 focus:ring-offset-danger-700 h-9 px-4">set all off</button>--}}
                </div>
            </div>
        </div>
    </form>
</x-filament::page>

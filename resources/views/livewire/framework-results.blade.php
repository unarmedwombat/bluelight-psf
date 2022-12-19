<div class="border-y border-gray-600">
@if(count($results))
    <div x-data="{ fw: '' }" class="divide-y divide-gray-600 mb-8 pt-1">
    @foreach($results as $organisation)
        <div class="organisation text-xl text-white mb-4 pt-2">{{ $organisation['organisation']['title'] }}
        @foreach($organisation['frameworks'] as $framework)
            <div
                class="cursor-pointer mr-16 px-4 text-base text-white transition hover:text-primary mt-2 flex justify-between"
                :class="fw == '{{ $framework['id'] }}' ? 'active' : ''"
                @click="fw = '{{ $framework['id'] }}'"
                wire:click="$emit('getFramework', {{ $framework['id'] }}, {{ $budget }}, {{ $region->id }})"
                wire:key="framework-key-{{ $framework['id'] }}">
                <div>{{ $framework['title'] }}</div>
                <div class="flex items-center"><svg class="w-3 transition-transform" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 326.45 376.95"><polygon fill="currentColor" points="0,0 326.45,188.48 0,376.95 "/></svg></div>
{{--            @foreach($framework['lots'] as $lot)--}}
{{--                <div class=" ml-8 text-xl text-white">{{ $lot['full_title'] }}</div>--}}
{{--            @endforeach--}}
            </div>
        @endforeach
        </div>
    @endforeach
    </div>
@else
        <div class="text-xl text-white my-4">No frameworks match your criteria</div>
@endif
</div>

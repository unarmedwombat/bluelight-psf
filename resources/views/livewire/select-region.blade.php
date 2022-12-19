<div class="w-full grid grid-cols-5 grid-rows-2 bg-primary gap-px">
    @foreach($regions as $region)
    <button
        class="aspect-square hover:bg-primary-500 focus:bg-primary flex justify-center items-center p-6 focus:text-gray-800 text-xl 2xl:text-2xl font-bold text-center {{ ($regionId === $region->id) ? 'bg-primary text-gray-800 hover:bg-primary' : 'bg-primary-900 text-white' }}"
        wire:click="selectRegionId({{ $region->id }})"
    >{{ $region->title }}</button>
@endforeach
</div>

<div class="flex">
    <div class="w-5/6 pr-11 pt-6 pb-4">
        <input type="range" min="0" max="99" value="50" class="w-full" id="budget-slider">
    </div>
    <div class="w-1/6 flex justify-end items-center">
        <input type="text" wire:model="budget" id="budget-value" class="w-full grow-0 pl-8 text-xl text-gray-600 font-bold currency-input">
    </div>
</div>

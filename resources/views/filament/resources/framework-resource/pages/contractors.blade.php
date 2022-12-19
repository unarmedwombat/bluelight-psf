<x-filament::page>
    <form wire:submit.prevent="update" method="POST">
        @csrf
        <div class="bg-white p-6">
            <div class="text-2xl mb-6">{{ $framework->fullTitle }}</div>
            <div class="flex mb-4 w-full">
                <div class="w-1/2">
                    <div class="text-xl font-bold">Existing contractors</div>
                    <div>
    @foreach($oldContractors as $title => $id)
                        <div class="flex w-full mt-2 items-center">
                            <button type="button" onclick="confirm('Are you sure you want to remove the contractor from this framework?') || event.stopImmediatePropagation()" wire:click="detach({{ $id }})" class="inline-flex items-center justify-center font-medium tracking-tight rounded-sm focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset text-danger-600 border-danger-600 border hover:bg-danger-500 hover:text-white focus:bg-danger-500 focus:text-white focus:ring-offset-danger-600 h-6 px-2 mr-8">detach</button>
                            <div class="text-lg">{{ $title }}</div>
                        </div>
    @endforeach
                    </div>
                </div>
                <div class="w-1/2">
                    <div class="text-xl font-bold">Add contractor</div>
                    <div class="mt-4 flex items-center">
                        <label for="add-contractor" class="text-lg w-24">Contractor:</label>
                        <select wire:model="addContractor" id="add-contractor">
                            <option value="">select...</option>
    @foreach($newContractors as $title => $id)
                            <option value="{{ $id }}">{{ $title }}</option>
    @endforeach
                        </select>
                    </div>
                    <button type="button" wire:click="attach" class="mt-8 ml-24 inline-flex items-center justify-center font-medium text-lg tracking-tight rounded-sm focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset text-white bg-primary-400 hover:bg-primary-500 focus:bg-primary-500 focus:ring-offset-primary-400 h-8 px-4 mr-8">attach</button>
                </div>
            </div>
        </div>
    </form>
</x-filament::page>

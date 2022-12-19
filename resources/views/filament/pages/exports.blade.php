<x-filament::page>
    <div class="border border-gray-300 shadow-sm bg-white rounded-sm p-8 space-y-6" x-data="{ islots: @entangle('lots') }">
        <div class="text-xl">Export an Excel spreadsheet template for subsequent upload</div>
        <form wire:submit.prevent="download" x-data="{ table: 0 }" class="space-y-6" method="post">
            @csrf
            <div>
                <label for="type" class="mr-4">Select type of template to download: </label>
                <select wire:model="type" id="type" required>
                    <option value="">select...</option>
                    <option value="clients">Clients</option>
                    <option value="organisations">Organisations</option>
                    <option value="frameworks">Frameworks</option>
                    <option value="lots">Lots</option>
{{--                    <option value="opportunities">Opportunities</option>--}}
                    <option value="contractors">Contractors</option>
{{--                    <option value="candidates">Candidates</option>--}}
                </select>
                @error('type')<div class="text-danger-600">{{ $message }}</div>@enderror
            </div>
            <div x-show="islots">
                <label for="framework" class="mr-4">Select framework: </label>
                <select wire:model="framework" id="framework">
                    <option value="">select...</option>
                @foreach($frameworks as $key => $value)
                    <option value="{{ $key }}">{{ $value }}</option>
                @endforeach
                </select>
                @error('framework')<div class="text-danger-600">{{ $message }}</div>@enderror
            </div>
            <button type="submit" class="inline-flex items-center justify-center font-medium tracking-tight rounded-sm focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset text-white hover:text-gray-800 bg-primary-400 hover:bg-primary-300 focus:bg-primary-300 focus:ring-offset-primary-500 h-9 px-4">download</button>
        </form>
    </div>
</x-filament::page>

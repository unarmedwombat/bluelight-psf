<x-filament::page>
    <div class="border border-gray-300 shadow-sm bg-white rounded-sm p-8 space-y-6" x-data="{ isCandidates: @entangle('candidates') }">
        <div class="text-xl">Import an Excel spreadsheet to the database</div>
        <form wire:submit.prevent="upload" x-data="{ table: 0 }" class="space-y-6" method="post">
            @csrf
            <div>
                <label for="type" class="mr-4">Select type of data to import: </label>
                <select wire:model="type" id="type" required>
                    <option value="">select...</option>
                    <option value="clients">Clients</option>
                    <option value="organisations">Organisations</option>
                    <option value="frameworks">Frameworks</option>
{{--                    <option value="lots">Lots</option>--}}
{{--                    <option value="opportunities">Opportunities</option>--}}
                    <option value="contractors">Contractors</option>
                    <option value="candidates">Candidates</option>
                </select>
            </div>

            <div x-show="isCandidates">
                <label for="framework" class="mr-4">Select framework: </label>
                <select wire:model="framework" id="framework">
                    <option value="">select...</option>
                    @foreach($frameworks as $key => $value)
                        <option value="{{ $key }}">{{ $value }}</option>
                    @endforeach
                </select>
                @error('framework')<div class="text-danger-600">{{ $message }}</div>@enderror
            </div>

            <div class="text-blue-600 flex space-x-4 items-center " x-show="table == 'organisations'">
                <div class="font-bold w-24">Columns:</div>
                <div>title, overview, social values, benefits & notes, contact name, position, phone, email</div>
            </div>
            <div class="text-blue-600 flex space-x-4 items-center" x-show="table == 'frameworks'">
                <div class="font-bold w-24">Columns:</div>
                <div>title, organisation ID, web address, expiry, extension options, award notice title, award notice URL, call-off routes, contract types, levy, fee notes, contact name, position, phone, email</div>
            </div>
            <div class="text-blue-600 flex space-x-4 items-center" x-show="table == 'lots'">
                <div class="font-bold w-24">Columns:</div>
                <div>title, framework ID, minimum value, maximum value</div>
            </div>
            <div class="text-blue-600 flex space-x-4 items-center" x-show="table == 'opportunities'">
                <div class="font-bold w-24">Columns:</div>
                <div>region ID, lot ID</div>
            </div>
            <div class="text-blue-600 flex space-x-4 items-center" x-show="table == 'contractors'">
                <div class="font-bold w-24">Columns:</div>
                <div>title, website URL, contact name, position, phone, email, comments</div>
            </div>
            <div class="text-blue-600 flex space-x-4 items-center" x-show="table == 'candidates'">
                <div class="font-bold w-24">Columns:</div>
                <div>opportunity ID, contractor ID</div>
            </div>
            <div>
                <label for="file" class="mr-4">File to upload:</label>
                <input wire:model="file" type="file" name="file" id="file">
            </div>
            <button type="submit" class="inline-flex items-center justify-center font-medium tracking-tight rounded-sm focus:outline-none focus:ring-offset-2 focus:ring-2 focus:ring-inset text-white hover:text-gray-800 bg-primary-400 hover:bg-primary-300 focus:bg-primary-300 focus:ring-offset-primary-500 h-9 px-4">import</button>
        </form>
    </div>
</x-filament::page>

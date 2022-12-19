<div>
    <x-lwa::autocomplete
        name="contractor-title"
        placeholder="start typing supplier name (leave blank to include all suppliers)"
        wire:model-text="title"
        wire:model-id="contractorId"
        wire:model-results="contractors"
        :options="[
            'text'=> 'title',
            'allow-new'=> 'false',
        ]" />
</div>

<?php

namespace App\Http\Livewire;

use App\Models\Contractor;
use Asantibanez\LivewireSelect\LivewireSelect;
use Illuminate\Support\Collection;

class ContractorSelect extends LivewireSelect
{
    public function options($searchTerm = null): Collection
    {
        $this->optionsValues = Contractor::query()
            ->when($searchTerm, function ($query, $searchTerm) {
                $query->where('title', 'like', "%$searchTerm%");
            })
            ->orderBy('title')
            ->get()
            ->map(function (Contractor $contractor) {
                return [
                    'value' => $contractor->id,
                    'description' => $contractor->title,
                ];
        });

        return $this->optionsValues;
    }

    public function selectedOption($value = null)
    {
        $contractor = Contractor::find($value);

        return [
            'value' => optional($contractor)->id,
            'description' => optional($contractor)->title
        ];
    }

    public function styles(): array
    {
        return [
            'default' => 'p-2 rounded border w-full appearance-none',

            'searchSelectedOption' => 'p-2 rounded border w-full bg-white flex items-center',
            'searchSelectedOptionTitle' => 'w-full text-gray-900 text-left',
            'searchSelectedOptionReset' => 'h-4 w-4 text-gray-500',

            'search' => 'relative',
            'searchInput' => 'p-2 rounded border w-full rounded',
            'searchOptionsContainer' => 'absolute top-0 left-0 mt-12 w-full z-10',

            'searchOptionItem' => 'p-3 hover:bg-primary-600 hover:text-white cursor-pointer text-sm',
            'searchOptionItemActive' => 'bg-primary-600 text-white font-medium',
            'searchOptionItemInactive' => 'bg-white text-gray-600',

            'searchNoResults' => 'p-8 w-full bg-white border text-center text-xs text-gray-600',
        ];
    }
}

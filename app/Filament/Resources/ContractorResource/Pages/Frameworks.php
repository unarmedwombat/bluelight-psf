<?php

namespace App\Filament\Resources\ContractorResource\Pages;

use App\Filament\Resources\ContractorResource;
use App\Models\Contractor;
use App\Models\Opportunity;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Builder;

class Frameworks extends Page
{
    protected static string $resource = ContractorResource::class;

    protected static string $view = 'filament.resources.contractor-resource.pages.frameworks';

    public Contractor $contractor;

    public array $oppArray;

    public $showAll = false;

    public function mount(Contractor $record)
    {
        $this->contractor = $record->load('frameworks.regions', 'frameworks.lots.opportunities');

        $oppArray = $record->opportunities->pluck('lot_id', 'id')->toarray();

    }

    public function showAllLots()
    {
        $this->showAll = true;
    }

    public function toggleOpportunity($lot, $region)
    {
        $opportunity = Opportunity::where('lot_id', $lot)->where('region_id', $region)->firstOrCreate(
            ['lot_id' => $lot, 'region_id' => $region]
        );
        if ($this->contractor->opportunities->find($opportunity->id)) {
            $this->contractor->opportunities()->detach($opportunity->id);
        } else {
            $this->contractor->opportunities()->attach($opportunity->id);
        }
    }

    protected function getActions(): array
    {
        return [ButtonAction::make('show all lots')->action('showAllLots')];
    }

}

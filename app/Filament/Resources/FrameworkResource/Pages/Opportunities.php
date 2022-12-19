<?php

namespace App\Filament\Resources\FrameworkResource\Pages;

use App\Filament\Resources\FrameworkResource;
use App\Models\Framework;
use Filament\Resources\Pages\Page;

class Opportunities extends Page
{
    protected static string $resource = FrameworkResource::class;

    protected static string $view = 'filament.resources.framework-resource.pages.opportunities';

    public Framework $framework;

    public array $opps;

    public function mount(Framework $record)
    {
        $this->framework = $record->load('regions', 'lots.opportunities');

        foreach ($this->framework->lots as $lot) {
            foreach ($this->framework->regions as $region) {
                $lotop[$region->id] = 0;
            }
            foreach ($lot->opportunities as $opportunity) {
                $lotop[$opportunity->region_id] = 1;
            }
            $this->opps[$lot->id] = $lotop;
        }
    }

    public function toggle($lot, $region)
    {
        $this->opps[$lot][$region] = abs($this->opps[$lot][$region] - 1);
    }

    public function update()
    {
        foreach ($this->opps as $lotKey => $lotValue) {
            $lot = $this->framework->lots->find($lotKey);
            $lot->regions()->sync(array_keys($lotValue, 1, true));
        }

    }

    public function setAllOn()
    {
        foreach ($this->opps as $lotKey => $lotValue) {
            foreach ($lotValue as $regionKey => $regionValue) {
                $this->opps[$lotKey][$regionKey] = 1;
            }
        }
    }

    public function setAllOff()
    {
        foreach ($this->opps as $lotKey => $lotValue) {
            foreach ($lotValue as $regionKey => $regionValue) {
                $this->opps[$lotKey][$regionKey] = 0;
            }
        }
    }
}

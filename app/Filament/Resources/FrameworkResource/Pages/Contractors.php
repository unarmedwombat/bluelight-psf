<?php

namespace App\Filament\Resources\FrameworkResource\Pages;

use App\Filament\Resources\FrameworkResource;
use App\Models\Contractor;
use App\Models\Framework;
use Filament\Resources\Pages\Page;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

class Contractors extends Page
{
    protected static string $resource = FrameworkResource::class;

    protected static string $view = 'filament.resources.framework-resource.pages.contractors';

    public Framework $framework;

    public Contractor $contractor;

    public array $newContractors;

    public array $oldContractors;

    public $addContractor;

    public function mount(Framework $record)
    {
        $this->framework = $record;

        if ($this->framework->has('contractors')) {
            $this->oldContractors = $this->framework->contractors()->pluck('contractors.id', 'contractors.title')->toArray();
            ksort($this->oldContractors);
        }

        $this->newContractors = Contractor::whereDoesntHave('frameworks', function(Builder $query) use ($record) {
            $query->where('frameworks.id', $record->id);
        })->pluck('id', 'title')->toArray();
        ksort($this->newContractors);
    }

    public function detach($id) {
        $this->framework->load('lots.opportunities');
        DB::transaction(function () use ($id) {
            foreach($this->framework->lots as $lot) {
                foreach($lot->opportunities as $opportunity) {
                    $opportunity->contractors()->detach($id);
                }
            }
            $this->framework->contractors()->detach($id);
        });

        if ($this->framework->has('contractors')) {
            $this->oldContractors = $this->framework->contractors()->pluck('contractors.id', 'contractors.title')->toArray();
            ksort($this->oldContractors);
        }

        $this->notify('success', 'Contractor successfully attached');

    }

    public function attach() {
        $this->framework->contractors()->attach($this->addContractor);

        $this->oldContractors = $this->framework->contractors()->pluck('contractors.id', 'contractors.title')->toArray();
        ksort($this->oldContractors);

        $this->notify('success', 'Contractor successfully attached');
    }

}

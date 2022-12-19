<?php

namespace App\Http\Livewire;

use App\Models\Contractor;
use App\Models\Lot;
use App\Models\Opportunity;
use App\Models\Region;
use Livewire\Component;

class FrameworkResults extends Component
{
    public $region;
    public $budget;
    public $contractor;

    public $framework = null;

    public $opportunities;

    public $results = [];

    public $go = false;

    protected $listeners = [
        'showFrameworks',
        'regionIdUpdated',
        'budgetUpdated',
        'contractorUpdated',
    ];

    protected $rules = [
        'region.title' => '',
        'opportunities.*.id' => '',
    ];

    public function mount()
    {
        $this->opportunities = collect();
    }

    public function render()
    {
        if ($this->go) {
            return view('livewire.framework-results');
        } else {
            return view('livewire.framework-start');
        }
    }

    public function showFrameworks()
    {
        $this->go = true;
        $lots =  Lot::where('min_value', '<=', $this->budget)
            ->where('max_value', '>=', $this->budget)
            ->whereHas('opportunities', function($q) {
                return $q->where('region_id', $this->region->id); })
            ->orderBy('framework_id')
            ->pluck('id')
            ->toArray();
        $opQuery  =  Opportunity::with('lot.framework.organisation', 'contractors')
            ->whereIn('lot_id', $lots)
            ->where('region_id', $this->region->id);
        if ($this->contractor) $opQuery->wherehas('contractors', function ($q) {
            return $q->where('contractors.id', $this->contractor);
        });

        $this->opportunities = $opQuery->get();

        $results = [];
        $org = null;
        $fw = null;
        $framework = null;
        foreach ($this->opportunities as $opp) {
            if ($org != $opp->lot->framework->organisation->title) {
                $results[$opp->lot->framework->organisation->title]['organisation'] = $opp->lot->framework->organisation->makeHidden(['created_at', 'updated_at'])->toArray();
                if (!is_null($framework)) $results[$org]['frameworks'][$fw] = $framework;
                $fw = $opp->lot->framework->title;
                $framework = $opp->lot->framework->withoutRelations()->makeHidden(['created_at', 'updated_at', 'deleted_at', 'updated_by_id', 'deleted_by_id', 'levy', 'fee_notes'])->toArray();
                $framework['lots'] = [];
                $org = $opp->lot->framework->organisation->title;
            } else if ($fw != $opp->lot->framework->title) {
                $results[$org]['frameworks'][$fw] = $framework;
                $fw = $opp->lot->framework->title;
                $framework = $opp->lot->framework->withoutRelations()->makeHidden(['created_at', 'updated_at', 'deleted_at', 'updated_by_id', 'deleted_by_id', 'levy', 'fee_notes'])->toArray();
                $framework['lots'] = [];
            }
            $framework['lots'][] = $opp->lot->withoutRelations()->makeHidden(['created_at', 'updated_at', 'updated_by_id'])->toArray();
        }
        if ($framework) $results[$org]['frameworks'][$fw] = $framework;

        $this->results = $results;

        $this->render();
    }

    public function clearFrameworks()
    {
        $this->framework = null;
        $this->go = false;
    }

    public function getFrameworks()
    {
        $this->render();
    }

    public function regionIdUpdated(Region $region)
    {
        $this->region = $region;
        $this->clearFrameworks();
    }

    public function budgetUpdated($budget)
    {
        $this->budget = cleanNumber($budget);
        $this->clearFrameworks();
    }

    public function contractorUpdated($contractorId)
    {
        $this->contractor = $contractorId;
        $this->clearFrameworks();
    }
}

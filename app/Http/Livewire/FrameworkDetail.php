<?php

namespace App\Http\Livewire;

use App\Models\Framework;
use App\Models\Lot;
use App\Models\Region;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class FrameworkDetail extends Component
{
    public $framework;
    public $lots;
    public $otherLots = [];
    public $suppliers = [];
    public $alert;

    public $region;
    public $budget;

    protected $listeners = [
        'getFramework',
        'clearFramework',
        'regionIdUpdated' => 'clearFramework',
        'budgetUpdated' => 'clearFramework',
        'contractorUpdated' => 'clearFramework',
    ];

//    public function mount($framework, $budget, $region) {
//        $this->lots = Lot::with('framework.organisation', 'opportunities.contractors')
//            ->where('framework_id', $framework)
//            ->where('min_value', '<=', $budget)
//            ->where('max_value', '>=', $budget)
//            ->whereHas('opportunities', function($q) use ($region) {
//                return $q->where('region_id', $region); })
//            ->orderBy('title')
//            ->orderBy('min_value')
//            ->get();
//        $this->framework = $this->lots->first()->framework;
//    }
//
    public function render()
    {
        return view('livewire.framework-detail');
    }

    public function getFramework($framework, $budget, Region $region)
    {
        $this->region = $region;
        $this->budget = $budget;

        $this->alert = null;

        $this->lots = Lot::with('framework.organisation')
            ->with('opportunities.contractors')
            ->where('framework_id', $framework)
            ->where('min_value', '<=', $budget)
            ->where('max_value', '>=', $budget)
            ->whereHas('opportunities', function($q) use ($region) {
                return $q->where('region_id', $region->id); })
            ->orderBy('title')
            ->orderBy('min_value')
            ->get();
        $inLots = $this->lots->pluck('id')->toArray();
        $this->framework = $this->lots->first()->framework;
        $this->otherLots = [];
        foreach ($this->framework->lots as $lot) {
            if (!in_array($lot->id, $inLots)) {
                $this->otherLots[$lot->min_value / 10000] = $lot->fullTitle;
            }
        }
//        if (count($this->otherLots) > 1) {
//            sort($this->otherLots);
//        }

        $this->suppliers = [];
        foreach ($this->lots as $lot) {
            foreach ($lot->opportunities as $opp) {
                if ($opp->region_id === $this->region->id) {
                    $entry = [];
                    foreach ($opp->contractors as $supplier) {
                        $entry[$supplier->title] = $supplier->toArray();
                    }
                    ksort($entry);
                    $this->suppliers[$lot->fulltitle] = $entry;
                }
            }
        }
        return view('livewire.framework-detail');
    }

    public function clearFramework()
    {
        $this->framework = null;
    }

    public function download()
    {
        $pdf = PDF::loadView('pdf.framework-detail', [
            'framework' => $this->framework,
            'region' => $this->region,
            'budget' => $this->budget,
            'lots' => $this->lots,
            'suppliers' => $this->suppliers,
            'otherLots' => $this->otherLots,
            'alert' => $this->alert,
            ])->output();

        return response()->streamDownload(
            fn () => print($pdf), $this->framework->title . '.pdf'
        );
    }
}

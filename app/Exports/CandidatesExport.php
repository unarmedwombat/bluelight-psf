<?php

namespace App\Exports;

use App\Imports\Sheets\CandidatesSheet;
use App\Models\Framework;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CandidatesExport implements WithMultipleSheets
{
    public Framework $framework;
    public $regions;

    public function __construct(Framework $framework) {
        $this->regions = Region::orderBy('id')->pluck('title', 'id');
        $framework->load('lots.opportunities.candidates.contractors');
        $this->framework = $framework;
    }

    public function sheets(): array
    {
        $sheets = [];
        foreach ($this->framework->lots as $lot) {
            $sheets[] = new CandidatesSheet($lot, $this->regions);
        }
        return $sheets;
    }
}

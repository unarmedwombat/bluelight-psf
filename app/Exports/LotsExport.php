<?php

namespace App\Exports;

use App\Exports\Sheets\LotsSheet;
use App\Models\Lot;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class LotsExport implements WithMultipleSheets, ShouldAutoSize
{
    public int $framework_id;

    public function __construct(int $framework_id)
    {
        $this->framework_id = $framework_id;
    }

    public function sheets(): array
    {
        $sheets = [];
        $lots = Lot::with(['regions' => function($q) {
            $q->orderBy('id');
        }])->where('framework_id', $this->framework_id)->get();

        foreach ($lots as $lot) {
            $sheets[] = new LotsSheet($lot);
        }

        return $sheets;
    }
}

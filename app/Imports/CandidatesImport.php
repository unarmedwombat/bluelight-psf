<?php

namespace App\Imports;

use App\Imports\Sheets\CandidatesSheet;
use App\Models\Framework;
use Filament\Facades\Filament;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Concerns\SkipsUnknownSheets;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class CandidatesImport implements WithMultipleSheets, SkipsUnknownSheets
{
    public int $lot;
    public array $regions;
    public Framework $framework;

    public function __construct(Framework $framework)
    {
        $framework->load('lots.opportunities');
        $this->framework = $framework;
        foreach ($framework->regions as $region) {
            $this->regions[$region->id] = $region->title;
        }
    }

    public function sheets(): array
    {
        $sheets = [];
        DB::beginTransaction();

        try {

            $this->framework->contractors()->sync([]);
            foreach ($this->framework->lots as $lot) {
                foreach ($lot->opportunities as $opp) {
                    $opp->contractors()->sync([]);
                }
            }

            foreach ($this->framework->lots as $lot) {
                $sheets[$lot->uniqueTitle] = new CandidatesSheet($lot, $this->regions);
            }
            DB::commit();
            Log::info('Import successful');
//            \Filament\Facades\Filament::notify('success', 'Import completed');
        }
        catch(\Exception $exp) {
            DB::rollBack();
            Log::error($exp);
//            \Filament\Facades\Filament::notify('danger', 'Import failed - database rolled back');
        }

        return $sheets;
    }

    public function onUnknownSheet($sheetName)
    {
        //
    }
}

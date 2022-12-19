<?php

namespace App\Imports\Sheets;

use App\Models\Candidate;
use App\Models\ContractorFramework;
use App\Models\Lot;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CandidatesSheet implements ToCollection, WithHeadingRow
{
    public Lot $lot;
    public array $regions;
    public array $opps;

    public function __construct(Lot $lot, array $regions)
    {
        $this->lot = $lot;
        $this->regions = $regions;
        $this->opps = $lot->opportunities->pluck('id', 'region_id')->toArray();
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if($row['contractor_id']) {
                $link = ContractorFramework::firstOrCreate([
                    'contractor_id' => $row['contractor_id'],
                    'framework_id' => $this->lot->framework_id,
                ]);
                foreach ($this->opps as $key => $value) {
                    $region = Str::slug($this->regions[$key], '_');
                    if ($row[$region]) {
                        Candidate::create([
                            'opportunity_id' => $value,
                            'contractor_id' => $row['contractor_id'],
                        ]);
                    }
                }
            }
        }
    }
}

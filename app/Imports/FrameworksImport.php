<?php

namespace App\Imports;

use App\Models\Framework;
use App\Models\Region;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class FrameworksImport implements ToCollection, WithHeadingRow
{
    public array $regions;

    public function __construct()
    {
        $this->regions = Region::pluck('slug', 'id')->toArray();
    }

    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            DB::transaction(function () use ($row) {
                $framework = Framework::create([
                    'title' => $row['framework_title'],
                    'organisation_id' => $row['org_id'],
                    'is_dps' => ($row['is_dps']) ? 1 : 0,
                    'url' => $row['url'],
                    'expiry' => Date::excelToDateTimeObject($row['expiry']),
                    'extension_options' => $row['extension_options'],
                    'award_notice_title' => $row['award_notice_title'],
                    'award_notice_url' => $row['award_notice_url'],
                    'calloff_routes' => $row['calloff_routes'],
                    'contract_types' => $row['contract_types'],
                    'levy' => (is_numeric($row['levy'])) ? ($row['levy'] * 100) . '%' : $row['levy'],
                    'fee_notes' => $row['fee_notes'],
                ]);

                foreach ($this->regions as $key => $value) {
                    if (strtolower($row[$value]) == 'yes') {
                        $framework->regions()->attach($key);
                    }
                }
            });
        }
    }
}

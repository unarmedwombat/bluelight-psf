<?php

namespace App\Exports;

use App\Models\Organisation;
use App\Models\Region;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class FrameworksExport implements FromCollection, WithMapping, WithHeadings
{
    public function collection()
    {
        return Organisation::all();
    }

    public function map($row): array
    {
        return [
            $row->id,
            $row->title,
            $row->org_id,
            $row->organisation,
            $row->framework_title,
            $row->is_dps,
            $row->url,

        ];
    }

    public function headings(): array
    {
        return array_merge(
            [
                'org_id',
                'organisation',
                'framework_title',
                'is_dps',
                'url',
            ],
            Region::orderBy('id')->pluck('slug', 'id')->toArray(),
            [
                'expiry',
                'extension_options',
                'award_notice_title',
                'award_notice_url',
                'calloff_routes',
                'contract_types',
                'levy',
                'fee_notes',
            ],
        );
    }
}

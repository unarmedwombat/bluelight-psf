<?php

namespace App\Exports;

use App\Models\Organisation;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrganisationsExport implements FromCollection, WithMapping, WithHeadings
{

    public function collection()
    {
        return Organisation::all();
    }

    public function map($row): array
    {
        return [
            //
        ];
    }

    public function headings(): array
    {
        return [
            'title',
            'overview',
            'social_values',
            'benefits',
            'contact_name',
            'job_title',
            'phone',
            'email',
        ];
    }
}

<?php

namespace App\Exports;

use App\Models\Contractor;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ContractorsExport implements FromCollection, WithMapping, WithHeadings
{

    public function collection()
    {
        return Contractor::orderBy('title')->get();
    }

    public function map($row): array
    {
        return [
            'title' => $row['title'],
            'id' => $row['id'],
            'url' => $row['url'],
            'contact_name' => $row['contact_name'],
            'job_title' => $row['job_title'],
            'phone' => $row['phone'],
            'email' => $row['email'],
            'alert' => ($row['alert']) ? 'Y' : '',
            'comments' => $row['comments'],
            'internal_notes' => $row['internal_notes'],
        ];
    }

    public function headings(): array
    {
        return [
            'title',
            'id',
            'url',
            'contact_name',
            'job_title',
            'phone',
            'email',
            'alert',
            'comments',
            'internal_notes',
        ];
    }
}

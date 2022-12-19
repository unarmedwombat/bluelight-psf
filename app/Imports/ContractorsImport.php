<?php

namespace App\Imports;

use App\Models\Contractor;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ContractorsImport implements ToCollection, WithHeadingRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            Contractor::updateOrCreate(
                ['id' => $row['id']],
                [
                    'title' => $row['title'],
                    'url' => $row['url'],
                    'contact_name' => $row['contact_name'],
                    'job_title' => $row['job_title'],
                    'phone' => $row['phone'],
                    'email' => $row['email'],
                    'alert' => ($row['alert']) ? 1 : 0,
                    'comments' => $row['comments'],
                    'internal_notes' => $row['internal_notes'],
                ]
            );
        }
    }
}

<?php

namespace App\Imports;

use App\Models\Organisation;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class OrganisationsImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Organisation([
            'title' => $row['title'],
            'overview' => $row['overview'],
            'social_values' => $row['social_values'],
            'benefits' => $row['benefits'],
            'contact' => $row['contact_name'],
            'job_title' => $row['job_title'],
            'phone' => $row['phone'],
            'email' => $row['email'],
        ]);
    }
}

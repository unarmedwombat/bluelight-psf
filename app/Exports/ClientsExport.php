<?php

namespace App\Exports;

use App\Models\Client;
use App\Models\Region;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ClientsExport implements FromCollection, WithMapping, WithHeadings
{
    protected array $regions;

    public function __construct()
    {
        $this->regions = Region::pluck('title', 'id')->toArray();
    }
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return Client::orderBy('title')->get();
    }

    public function headings(): array
    {
        return [
            'title',
            'id',
            'address',
            'url',
            'category',
            'region',
        ];
    }

    public function map($row): array
    {
        return [
            'title' => $row['title'],
            'id' => $row['id'],
            'address' => $row['address'],
            'url' => $row['url'],
            'category' => $row['category'],
            'region' => $this->regions[$row['region_id']],
        ];
    }
}

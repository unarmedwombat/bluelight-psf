<?php

namespace App\Exports\Sheets;

use App\Models\Lot;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithTitle;

class CandidatesSheet implements FromCollection, WithMapping, WithHeadings, WithTitle
{
    public Lot $lot;
    public array $regions;

    public function __construct(Lot $lot, array $regions)
    {
        $this->lot = $lot;
        $this->regions = $regions;
    }

    public function collection()
    {
        return $this->lot;
    }

    public function map($row): array
    {
        return [
            $row
        ];
    }

    public function headings(): array
    {
        return array_merge([$this->lot->fullTitle, 'contractor_id'], $this->lot->regions->pluck('title')->toArray());
    }

    public function title(): string
    {
        return $this->lot->uniqueTitle;
    }
}

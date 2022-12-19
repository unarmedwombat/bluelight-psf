<?php

namespace App\Imports;

use App\Models\Client;
use App\Models\Region;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ClientsImport implements ToCollection, WithHeadingRow
{
    public array $regions;
    public function __construct()
    {
        $this->regions = Region::pluck('slug', 'id')->toArray();
    }
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        foreach ($collection as $row) {
            if (is_numeric($row['region'])) {
                $region_id = ($row['region'] > 0 && $row['region'] <= count($this->regions))
                    ? $row['region']
                    : null;
            } else {
                $region_id = array_search(Str::slug($row['region']), $this->regions, true);
                if ($region_id === false) $region_id = null;
            }

            Client::updateOrCreate(
                ['id' => $row['id']],
                [
                    'title' => $row['title'],
                    'address' => $row['address'],
                    'url' => $row['url'],
                    'category' => (strToUpper($row['category']) === 'BL') ? 'BL' : Str::title($row['category']),
                    'region_id' => $region_id,
                ]
            );
        }
    }
}

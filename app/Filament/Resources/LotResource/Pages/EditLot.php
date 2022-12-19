<?php

namespace App\Filament\Resources\LotResource\Pages;

use App\Filament\Resources\LotResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditLot extends EditRecord
{
    protected static string $resource = LotResource::class;

    protected function getRedirectUrl(): ?string
    {
        $this->notify('success', 'Changes saved');
        return $this->getResource()::getUrl('edit', $this->record);
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $data['min_value'] = number_format($data['min_value']);
        $data['max_value'] = number_format($data['max_value']);

        return $data;
    }
}

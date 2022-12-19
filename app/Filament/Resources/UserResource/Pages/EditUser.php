<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Hash;

class EditUser extends EditRecord
{
    protected static string $resource = UserResource::class;

    protected function getRedirectUrl(): ?string
    {
        $this->notify('success', 'Changes saved');
        return $this->getResource()::getUrl('edit', $this->record);
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if ($data['password'] == '') {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        return $data;
    }
}

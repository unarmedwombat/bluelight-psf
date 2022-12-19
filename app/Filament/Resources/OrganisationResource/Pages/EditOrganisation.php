<?php

namespace App\Filament\Resources\OrganisationResource\Pages;

use App\Filament\Resources\OrganisationResource;
use Filament\Resources\Pages\EditRecord;

class EditOrganisation extends EditRecord
{
    protected static string $resource = OrganisationResource::class;

    protected function getRedirectUrl(): ?string
    {
        $this->notify('success', 'Changes saved');
        return $this->getResource()::getUrl('edit', $this->record);
    }

}

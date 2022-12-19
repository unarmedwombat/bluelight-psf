<?php

namespace App\Filament\Resources\ContractorResource\Pages;

use App\Filament\Resources\ContractorResource;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;

class EditContractor extends EditRecord
{
    protected static string $resource = ContractorResource::class;

    protected function getActions(): array
    {
        return array_merge(parent::getActions(), [
            ButtonAction::make('frameworks')->action('frameworks'),
        ]);
    }

    public function frameworks() {
        return redirect()->to('/admin/contractors/'.$this->record->id.'/frameworks');
    }

    protected function getRedirectUrl(): ?string
    {
        $this->notify('success', 'Changes saved');
        return $this->getResource()::getUrl('edit', $this->record);
    }

}

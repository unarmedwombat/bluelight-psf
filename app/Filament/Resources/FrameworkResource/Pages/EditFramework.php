<?php

namespace App\Filament\Resources\FrameworkResource\Pages;

use App\Filament\Resources\FrameworkResource;
use Filament\Resources\Pages\EditRecord;
use Filament\Pages\Actions\ButtonAction;

class EditFramework extends EditRecord
{
    protected static string $resource = FrameworkResource::class;

    protected function getActions(): array
    {
        return array_merge(parent::getActions(), [
            ButtonAction::make('opportunities')->action('opportunities'),
            ButtonAction::make('contractors')->action('contractors'),
        ]);
    }

    public function opportunities() {
        return redirect()->to('/admin/frameworks/'.$this->record->id.'/opportunities');
    }

    public function contractors() {
        return redirect()->to('/admin/frameworks/'.$this->record->id.'/contractors');
    }

    protected function getRedirectUrl(): ?string
    {
        $this->notify('success', 'Changes saved');
        return $this->getResource()::getUrl('edit', $this->record);
    }

}

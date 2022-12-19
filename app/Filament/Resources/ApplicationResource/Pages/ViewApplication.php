<?php

namespace App\Filament\Resources\ApplicationResource\Pages;

use App\Filament\Resources\ApplicationResource;
use Filament\Pages\Actions\ButtonAction;
use Filament\Resources\Pages\EditRecord;
use Filament\Resources\Pages\Page;
use Filament\Resources\Pages\ViewRecord;

class ViewApplication extends EditRecord
{
    protected static string $resource = ApplicationResource::class;

//    protected static string $view = 'filament.resources.application-resource.pages.view-application';

    protected function getForms(): array
    {
        return array_merge(parent::getForms(), [
            'form' => $this->makeForm()
                ->model($this->record)
                ->schema($this->getResourceForm()->getSchema())
                ->statePath('data'),
        ]);
    }

    protected function getActions(): array
    {
        return array_merge(parent::getActions(), [
            ButtonAction::make('create_user')->action('createUser'),
        ]);
    }

    public function createUser()
    {
        dd($this->record);
    }

}

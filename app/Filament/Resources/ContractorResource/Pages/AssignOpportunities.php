<?php

namespace App\Filament\Resources\ContractorResource\Pages;

use App\Filament\Resources\ContractorResource;
use Filament\Resources\Pages\Page;

class AssignOpportunities extends Page
{
    protected static string $resource = ContractorResource::class;

    protected static string $view = 'filament.resources.contractor-resource.pages.assign-opportunities';
}

<?php

namespace App\Filament\Resources\VisaRequirementResource\Pages;

use App\Filament\Resources\VisaRequirementResource;
use Filament\Actions;
use Filament\Resources\Pages\ManageRecords;

class ManageVisaRequirements extends ManageRecords
{
    protected static string $resource = VisaRequirementResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

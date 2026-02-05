<?php

namespace App\Filament\Resources\PartnerResource\Pages;

use App\Filament\Resources\PartnerResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePartner extends CreateRecord
{
    protected static string $resource = PartnerResource::class;

    protected function mutateFormDataBeforeCreate(array $data): array
    {
        if (empty($data['logo_path']) && !empty($data['logo_url'])) {
            $data['logo_path'] = $data['logo_url'];
        }

        unset($data['logo_url']);

        return $data;
    }
}

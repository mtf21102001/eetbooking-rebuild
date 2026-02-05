<?php

namespace App\Filament\Resources\TeamMemberResource\Pages;

use App\Filament\Resources\TeamMemberResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTeamMember extends EditRecord
{
    protected static string $resource = TeamMemberResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (empty($data['image_path']) && !empty($data['image_url'])) {
            $data['image_path'] = $data['image_url'];
        }

        unset($data['image_url']);

        return $data;
    }
}

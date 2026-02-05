<?php

namespace App\Filament\Resources\TransferBookingResource\Pages;

use App\Filament\Resources\TransferBookingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTransferBooking extends EditRecord
{
    protected static string $resource = TransferBookingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

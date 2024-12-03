<?php

namespace App\Filament\Resources\ManagementUserResource\Pages;

use App\Filament\Resources\ManagementUserResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditManagementUser extends EditRecord
{
    protected static string $resource = ManagementUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

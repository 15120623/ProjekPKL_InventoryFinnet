<?php

namespace App\Filament\Resources\ManagementUserResource\Pages;

use App\Filament\Resources\ManagementUserResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListManagementUsers extends ListRecords
{
    protected static string $resource = ManagementUserResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}

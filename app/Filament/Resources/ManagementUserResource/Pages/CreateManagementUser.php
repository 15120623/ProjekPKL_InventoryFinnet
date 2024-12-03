<?php

namespace App\Filament\Resources\ManagementUserResource\Pages;

use App\Filament\Resources\ManagementUserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateManagementUser extends CreateRecord
{
    protected static string $resource = ManagementUserResource::class;
}

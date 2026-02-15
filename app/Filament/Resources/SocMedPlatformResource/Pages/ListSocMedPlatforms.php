<?php

namespace App\Filament\Resources\SocMedPlatformResource\Pages;

use App\Filament\Resources\SocMedPlatformResource;
use Filament\Resources\Pages\ListRecords;

class ListSocMedPlatforms extends ListRecords
{
    protected static string $resource = SocMedPlatformResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}

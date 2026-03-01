<?php

namespace App\Filament\Resources\TechnologyResource\Pages;

use App\Filament\Resources\TechnologyResource;
use Filament\Resources\Pages\CreateRecord;

class CreateTechnology extends CreateRecord
{
    protected static string $resource = TechnologyResource::class;

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'Teknologi berhasil ditambahkan';
    }

    /**
     * Pastikan hanya 1 item yang menjadi highlight saat create.
     */
    protected function mutateFormDataBeforeCreate(array $data): array
    {
        return TechnologyResource::mutateFormDataBeforeCreate($data);
    }
}

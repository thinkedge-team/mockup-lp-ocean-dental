<?php

namespace App\Filament\Resources\TechnologyResource\Pages;

use App\Filament\Resources\TechnologyResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditTechnology extends EditRecord
{
    protected static string $resource = TechnologyResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make()->label('Hapus Teknologi'),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }

    protected function getSavedNotificationTitle(): ?string
    {
        return 'Teknologi berhasil diperbarui';
    }

    /**
     * Pastikan hanya 1 item yang menjadi highlight saat edit.
     */
    protected function mutateFormDataBeforeSave(array $data): array
    {
        if (! empty($data['is_highlight'])) {
            // Nonaktifkan highlight lain, kecuali record ini sendiri
            \App\Models\Technology::where('is_highlight', true)
                ->where('id', '!=', $this->record->id)
                ->update(['is_highlight' => false]);
        }

        return $data;
    }
}

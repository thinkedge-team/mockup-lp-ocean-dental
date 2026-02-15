<?php

namespace App\Filament\Resources\SettingResource\Pages;

use App\Filament\Resources\SettingResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditSetting extends EditRecord
{
    protected static string $resource = SettingResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    protected function mutateFormDataBeforeFill(array $data): array
    {
        $type = $data['type'] ?? 'text';

        $value = $data['value'] ?? '';

        if ($type === 'image') {
            $data['image_value'] = $value;
            $data['original_image'] = $value;
        } elseif ($type === 'textarea') {
            $data['textarea_value'] = $value;
        } elseif ($type === 'boolean') {
            $data['boolean_value'] = ($value === 'true' || $value === true);
        }

        return $data;
    }

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $type = $this->record->type;

        if ($type === 'image') {
            if (! empty($data['image_value'])) {
                $image = $data['image_value'];

                if (is_array($image)) {
                    $image = reset($image);
                }

                $data['value'] = $image;
            }
        } elseif ($type === 'textarea') {
            $data['value'] = $data['textarea_value'] ?? '';
        } elseif ($type === 'boolean') {
            $data['value'] = isset($data['boolean_value'])
                ? ($data['boolean_value'] ? 'true' : 'false')
                : 'false';
        }

        unset($data['image_value'], $data['textarea_value'], $data['boolean_value'], $data['original_image']);

        return $data;
    }
}

<?php

namespace App\Filament\Clusters\BukuMenu\Resources\MenuResource\Pages;

use App\Filament\Clusters\BukuMenu\Resources\MenuResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditMenu extends EditRecord
{
    protected static string $resource = MenuResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }
}

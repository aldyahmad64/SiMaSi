<?php

namespace App\Filament\Resources\PendudukResource\Pages;

use App\Filament\Resources\PendudukResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;

class EditPenduduk extends EditRecord
{
    protected static string $resource = PendudukResource::class;

    protected static ?string $title = 'Ubah Data Penduduk';

    protected function getHeaderActions(): array
    {
        return [
            // Actions\DeleteAction::make(),
        ];
    }

    protected function getRedirectUrl(): string
    {
        return static::getResource()::getUrl('index');
    }

    public function getFormActions(): array
    {
        return [
            \Filament\Actions\Action::make('save')
                ->label('Simpan')
                ->action(fn() => $this->create())
                ->keyBindings(['command+s', 'ctrl+s']),
            \Filament\Actions\Action::make('cancel')
                ->label('Batal')
                ->color('gray')
                ->url(fn(): string => static::getResource()::getUrl('index'))
        ];
    }
}

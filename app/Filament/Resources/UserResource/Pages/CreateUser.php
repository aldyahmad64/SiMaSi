<?php

namespace App\Filament\Resources\UserResource\Pages;

use App\Filament\Resources\UserResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateUser extends CreateRecord
{
    protected static string $resource = UserResource::class;

    protected static bool $canCreateAnother = false;

    protected static ?string $title = 'Buat User';

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

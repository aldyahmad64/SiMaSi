<?php

namespace App\Filament\Resources\PendudukResource\Pages;

use App\Filament\Resources\PendudukResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreatePenduduk extends CreateRecord
{
    protected static string $resource = PendudukResource::class;

    protected static bool $canCreateAnother = false;

    protected static ?string $title = 'Buat Data Penduduk';

    protected function afterCreate(): void
    {
        $penduduk = $this->record;
        \Filament\Notifications\Notification::make()
            ->title('Penduduk')
            ->body("Data baru ditambahkan dengan nomor NIK : {$penduduk->nik}")
            ->success()
            ->actions([
                \Filament\Notifications\Actions\Action::make('view')
                    ->label('Lihat Data')
                    ->button()
                    ->url(route('filament.admin.resources.penduduks.view', $penduduk))
                    ->markAsRead(),
            ])
            ->sendToDatabase(\App\Models\User::role('operator')->get());
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

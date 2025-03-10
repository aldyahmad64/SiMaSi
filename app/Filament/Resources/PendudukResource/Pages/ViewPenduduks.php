<?php

namespace App\Filament\Resources\PendudukResource\Pages;

use App\Filament\Resources\PendudukResource;
use Filament\Actions;
use Filament\Resources\Pages\ViewRecord;

class ViewPenduduks extends ViewRecord
{
    protected static string $resource = PendudukResource::class;

    protected static ?string $title = 'Detail Penduduk';

    protected function getActions(): array
    {
        return [
            Actions\Action::make('kembali')
                ->url(static::getResource()::getUrl('index')),
        ];
    }
}

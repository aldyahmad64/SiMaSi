<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('test', function () {
    \Filament\Notifications\Notification::make()
        ->title('Judul')
        ->body('Ini adalah body')
        ->success()
        ->actions([
            \Filament\Notifications\Actions\Action::make('view')
                ->button()
                ->markAsRead(),
        ])
        ->sendToDatabase(\App\Models\User::role('operator')->get());
});
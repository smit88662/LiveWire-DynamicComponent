<?php

namespace App\Filament\Resources\UniversityResource\Pages;

use App\Filament\Resources\UniversityResource;
use Filament\Actions;
use Filament\Notifications\Notification;
use Filament\Resources\Pages\CreateRecord;

class CreateUniversity extends CreateRecord
{
    protected static string $resource = UniversityResource::class;

    public function getRedirectUrl(): string
    {
        return url('admin/universities');
    }

    // message when user perform university creation
    protected function getCreatedNotification(): ?Notification
    {
        return Notification::make()
            ->success()
            ->title('University Created')
            ->body('The University has been successfully created');
    }
}

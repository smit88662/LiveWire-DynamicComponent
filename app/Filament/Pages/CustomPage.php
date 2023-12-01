<?php

namespace App\Filament\Pages;

use Filament\Pages\Page;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class CustomPage extends Page implements HasForms
{
    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    public ?array $data = [];

    protected static string $view = 'filament.pages.custom-page';
    use InteractsWithForms;
}

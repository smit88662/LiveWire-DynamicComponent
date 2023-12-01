<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use Filament\Forms\Form;
use Hamcrest\Description;
use App\Models\University;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;

use function Laravel\Prompts\multiselect;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\MultiSelect;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\UniversityResource\Pages;
use App\Filament\Resources\UniversityResource\RelationManagers;

class UniversityResource extends Resource
{
    protected static ?string $model = University::class;

    protected static ?string $navigationIcon = 'heroicon-o-academic-cap';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('University Detailes')
                    ->description('Fill the university form detailes')
                    ->collapsible()
                    ->schema([
                        TextInput::make('university_name'),
                        Select::make('university_type')->options(config('type'))->searchable(),
                        TextInput::make('university_email')
                            ->type('email'),
                        TextInput::make('university_contact'),
                        TextInput::make('university_person'), TextInput::make('university_website')
                    ]),

                Section::make('Academic Detailes')
                    ->description('Fill the acdemic form detailes')
                    ->collapsible()
                    ->schema([
                        MultiSelect::make('branch')->options(config('branch'))->searchable(),
                        MultiSelect::make('academicprograms')->options(config('academicprograms'))->searchable(),

                    ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('university_name')
                    // this way we can provide individual search
                    // ->searchable(isIndividual: true)
                    ->sortable(),
                TextColumn::make('university_type')
                    // sort ascending or descending
                    ->sortable(),
                TextColumn::make('university_email'),
                TextColumn::make('university_contact'),
                TextColumn::make('created_at')
                    // if you want to keep column toggable
                    ->toggleable(isToggledHiddenByDefault: true)
            ])
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make()
                    ->successNotification(
                        Notification::make()
                            ->success()
                            ->title('University Deleted')
                            ->body('The University has been successfully Deleted')
                    ),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    // public static function infoList(InfoList $infoList): InfoList
    // {
    //     return $infoList
    //         ->schema([
    //             TextEntry::make('Section')
    //                 ->schema([
    //                     TextEntry::make('university_type'),
    //                     TextEntry::make('university_email'),
    //                 ])
    //         ]);
    // }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListUniversities::route('/'),
            'create' => Pages\CreateUniversity::route('/create'),
            'edit' => Pages\EditUniversity::route('/{record}/edit'),
        ];
    }
}

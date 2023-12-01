<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\College;
use Filament\Forms\Form;
use App\Models\University;
use Filament\Tables\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CollegeResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CollegeResource\RelationManagers;
use App\Filament\Resources\CollegeResource\RelationManagers\StudentsRelationManager;

class CollegeResource extends Resource
{
    protected static ?string $model = College::class;
    protected static ?string $navigationIcon = 'heroicon-o-book-open';
    protected static ?string $navigationGroup = 'ALl Univerisities';


    // name email contact person website
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('college_name'),
                Select::make('university_name')
                    ->options(University::all()->pluck('university_name', 'id'))
                    ->searchable(),
                TextInput::make('college_email'),
                TextInput::make('college_contact'),
                TextInput::make('college_person'),
                TextInput::make('college_website'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('college_name'),
                TextColumn::make('universities.university_name'),
                TextColumn::make('college_email'),
                TextColumn::make('college_contact'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            StudentsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListColleges::route('/'),
            'create' => Pages\CreateCollege::route('/create'),
            'edit' => Pages\EditCollege::route('/{record}/edit'),
        ];
    }
}

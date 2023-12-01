<?php

namespace App\Filament\Resources;

use Filament\Forms;
use Filament\Tables;
use App\Models\College;
use App\Models\Student;
use Filament\Forms\Get;
use Filament\Forms\Form;
use App\Models\University;
use Filament\Tables\Table;
use Filament\Infolists\Infolist;
use Filament\Resources\Resource;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Filament\Infolists\Components\TextEntry;
use Illuminate\Database\Eloquent\Collection;
use App\Filament\Resources\StudentResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\StudentResource\RelationManagers;
use Filament\Tables\Filters\SelectFilter;

class StudentResource extends Resource
{
    protected static ?string $model = Student::class;

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

    protected static ?string $navigationGroup = 'ALl Univerisities';
    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Personal Information')
                    ->description('Student Personal Information')
                    ->schema([
                        FileUpload::make('student_image')
                            ->enableOpen(),
                        TextInput::make('student_name'),
                        TextInput::make('student_email'),
                        TextInput::make('student_address'),
                        TextInput::make('student_contact'),
                    ]),

                Section::make('Academic Information')
                    ->description('Academic Detailes')
                    ->schema([
                        Select::make('university_name')
                            ->options(University::all()->pluck('university_name', 'id'))
                            ->searchable(),
                        Select::make('college_name')
                            ->options(College::all()->pluck('college_name', 'id'))
                            ->searchable()
                    ]),
                Section::make('Achievement')
                    ->description('Students Achievement')
                    ->schema([
                        FileUpload::make('student_certificate_image')
                            ->multiple()
                            ->enableOpen(),
                    ]),


            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('student_name'),
                TextColumn::make('colleges.college_name')
                    ->label('College Name'),
                TextColumn::make('universities.university_name')
                    ->label('University Name'),
                // to fetch image in view table use this
                ImageColumn::make('student_image')
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('student_contact')->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('student_email')->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('university_name')
                    ->relationship('universities', 'university_name')
                    ->searchable()
                    ->label('University Filter')
                    ->preload()
                    // it will applies when you use filter it will shows in header
                    ->indicator('University'),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\DeleteAction::make(),
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
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListStudents::route('/'),
            'create' => Pages\CreateStudent::route('/create'),
            'edit' => Pages\EditStudent::route('/{record}/edit'),
        ];
    }
}

<?php

namespace App\Filament\Resources\CollegeResource\RelationManagers;

use Filament\Forms;
use Filament\Tables;
use App\Models\College;
use Filament\Forms\Form;
use App\Models\University;
use Filament\Tables\Table;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\FileUpload;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Resources\RelationManagers\RelationManager;

class StudentsRelationManager extends RelationManager
{
    protected static string $relationship = 'students';

    public function form(Form $form): Form
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

    public function table(Table $table): Table
    {
        return $table
            ->recordTitleAttribute('student_name')
            ->columns([
                Tables\Columns\TextColumn::make('students.student_name')
                    ->label('Student Name'),
                Tables\Columns\TextColumn::make('student_email'),
                Tables\Columns\TextColumn::make('colleges.college_name'),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make(),
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }
}

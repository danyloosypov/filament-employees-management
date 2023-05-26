<?php

namespace App\Filament\Resources\DepartmentResource\RelationManagers;

use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeesRelationManager extends RelationManager
{
    protected static string $relationship = 'employees';

    protected static ?string $recordTitleAttribute = 'firstname';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('firstname')
                    ->required()
                    ->maxLength(255),

                TextInput::make('lastname')
                    ->required()
                    ->maxLength(255),

                DatePicker::make('birth_date')
                    ->required(),
                
                TextInput::make('country')
                    ->required()
                    ->maxLength(255),

                TextInput::make('city')
                    ->required()
                    ->maxLength(255),

                TextInput::make('address')
                    ->required()
                    ->maxLength(255),
                
                TextInput::make('zip_code')
                    ->required()
                    ->maxLength(255),
                
                DatePicker::make('date_hired')
                    ->required(),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('firstname'),
                Tables\Columns\TextColumn::make('lastname'),
                TextColumn::make('birth_date')
                    ->dateTime()->sortable(),
                TextColumn::make('country')->sortable()->searchable(),
                TextColumn::make('city')->sortable()->searchable(),
                TextColumn::make('address')->sortable()->searchable(),
                TextColumn::make('zip_code')->sortable()->searchable(),
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
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }    
}

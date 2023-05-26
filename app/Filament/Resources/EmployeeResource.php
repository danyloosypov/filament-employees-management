<?php

namespace App\Filament\Resources;

use App\Filament\Resources\EmployeeResource\Pages;
use App\Filament\Resources\EmployeeResource\RelationManagers;
use App\Filament\Resources\EmployeeResource\RelationManagers\TasksRelationManager;
use App\Models\Employee;
use Filament\Forms;
use Filament\Forms\Components\BelongsToSelect;
use Filament\Forms\Components\Card;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;
    protected static ?string $recordTitleAttribute = 'firstname';

    protected static ?string $navigationGroup = 'Employees';

    protected static ?string $navigationIcon = 'heroicon-o-user-group';

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

                    BelongsToSelect::make('department_id')
                        ->relationship('department', 'name'),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('firstname')->sortable()->searchable(),
                TextColumn::make('lastname')->sortable()->searchable(),
                TextColumn::make('birth_date')
                    ->dateTime()->sortable(),
                TextColumn::make('country')->sortable()->searchable(),
                TextColumn::make('city')->sortable()->searchable(),
                TextColumn::make('address')->sortable()->searchable(),
                TextColumn::make('zip_code')->sortable()->searchable(),
                TextColumn::make('department.name')
                    ->label('Department')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('created_at')
                    ->dateTime()->sortable(),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }
    
    public static function getRelations(): array
    {
        return [
            TasksRelationManager::class,
        ];
    }
    
    public static function getPages(): array
    {
        return [
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }    
}

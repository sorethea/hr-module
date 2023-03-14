<?php

namespace Modules\HR\Filament\Resources;

use Modules\HR\Filament\Resources\DepartmentResource\Pages;
use Modules\HR\Filament\Resources\DepartmentResource\RelationManagers;
use Modules\HR\Models\Department;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DepartmentResource extends Resource
{
    protected static ?string $model = Department::class;

    protected static function getNavigationIcon(): string
    {
        return config('hr.models.Department.icon');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('hr.hr-navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make("name")
                        ->unique("departments","name",fn($record)=>$record)
                        ->required(),
                    Forms\Components\BelongsToSelect::make("company")
                        ->relationship("company","name")
                        ->searchable()
                        ->required(),
                    Forms\Components\Toggle::make("is_group")
                        ->default(false),
                ])
                    ->columnSpan(2)
                    ->columns(2),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")
                    ->searchable(),
                Tables\Columns\TextColumn::make("company")
                    ->searchable(),
                Tables\Columns\BooleanColumn::make("is_group"),
                Tables\Columns\ToggleColumn::make("active"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
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
            'index' => Pages\ListDepartments::route('/'),
            'create' => Pages\CreateDepartment::route('/create'),
            'edit' => Pages\EditDepartment::route('/{record}/edit'),
        ];
    }
}

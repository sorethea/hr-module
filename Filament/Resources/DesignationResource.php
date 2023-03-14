<?php

namespace Modules\HR\Filament\Resources;

use Modules\HR\Filament\Resources\DesignationResource\Pages;
use Modules\HR\Filament\Resources\DesignationResource\RelationManagers;
use Modules\HR\Models\Designation;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class DesignationResource extends Resource
{
    protected static ?string $model = Designation::class;
    protected static function getNavigationIcon(): string
    {
        return config('hr.models.Designation.icon');
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
                        ->unique("designations","name",fn($record)=>$record)
                        ->required(),
                    Forms\Components\Textarea::make("description")
                        ->nullable(),
                ]),

            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable(),
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
            'index' => Pages\ListDesignations::route('/'),
            'create' => Pages\CreateDesignation::route('/create'),
            'edit' => Pages\EditDesignation::route('/{record}/edit'),
        ];
    }
}

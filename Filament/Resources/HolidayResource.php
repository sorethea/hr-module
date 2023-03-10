<?php

namespace Modules\HR\Filament\Resources;

use Modules\HR\Filament\Resources\HolidayResource\Pages;
use Modules\HR\Filament\Resources\HolidayResource\RelationManagers;
use Modules\HR\Models\Holiday;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class HolidayResource extends Resource
{
    protected static ?string $model = Holiday::class;

    protected static function getNavigationIcon(): string
    {
        return config('hr.models.Holiday.icon');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('hr.leave-navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make("name")
                        ->unique(fn($record)=>$record)
                        ->required(),
                    Forms\Components\TextInput::make("total_holidays")
                        ->default(0)
                        ->disabled(),
                    Forms\Components\DatePicker::make("from_date")
                        ->required(),
                    Forms\Components\DatePicker::make("to_date")
                        ->required(),
                ])->columns(2)->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make("name")->searchable(),
                Tables\Columns\TextColumn::make("from_date")->searchable(),
                Tables\Columns\TextColumn::make("to_date")->searchable(),
                Tables\Columns\TextColumn::make("total_holidays"),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            RelationManagers\HolidayDatesRelationManager::class,
        ];
    }


    public static function getPages(): array
    {
        return [
            'index' => Pages\ListHolidays::route('/'),
            'create' => Pages\CreateHoliday::route('/create'),
            'edit' => Pages\EditHoliday::route('/{record}/edit'),
            'view' => Pages\ViewHoliday::route('/{record}'),
        ];
    }
}

<?php

namespace Modules\HR\Filament\Resources\HolidayResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class HolidayDatesRelationManager extends RelationManager
{
    protected static string $relationship = 'holidayDates';

    protected static ?string $recordTitleAttribute = 'name';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('name')
                    ->label('Description')
                    ->required()
                    ->maxLength(255),
                Forms\Components\DatePicker::make('holiday_date')
                    ->required(),
                Forms\Components\Toggle::make("half_day")
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('Description')->searchable(),
                Tables\Columns\TextColumn::make('holiday_date'),
                Tables\Columns\BooleanColumn::make("half_day"),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\Action::make("weekly_holiday")
                    ->button()
                    ->color('success')
                    ->label("New weekly holiday")
                    ->action(function (){
                        info(json_encode($this->getRelationship()));
                    })
                    ->form([
                        Forms\Components\Group::make([
                            Forms\Components\Select::make("weekly_off")
                                ->options([
                                    "Monday",
                                    "Tuesday",
                                    "Wednesday",
                                    "Thursday",
                                    "Friday",
                                    "Saturday",
                                    "Sunday",
                                ])
                                ->searchable()
                                ->required(),
                            Forms\Components\Toggle::make("half_day")
                                ->default(false),
                        ])->columns(2)
                    ]),
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

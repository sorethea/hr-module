<?php

namespace Modules\HR\Filament\Resources\HolidayResource\RelationManagers;

use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\RelationManagers\RelationManager;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;
use function Termwind\render;

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
                    ->action(function (RelationManager $livewire, array $data){
                        $holiday = $livewire->ownerRecord;
                        \Holiday::generateWeekDayHolidays($holiday,$data["half_day"],$data["weekly_off"]);
                        $livewire->render();
                    })
                    ->form([
                        Forms\Components\Group::make([
                            Forms\Components\Select::make("weekly_off")
                                ->options(\Holiday::getDayOfWeekList())
                                ->searchable()
                                ->required(),
                            Forms\Components\Toggle::make("half_day")
                                ->default(false),
                        ])->columns(2)
                    ]),
                Tables\Actions\CreateAction::make()->after(fn()=>redirect(request()->header("Referer"))),
            ])
            ->actions([
                Tables\Actions\EditAction::make()->after(function (){
                    render(request()->header("Referer"));
                    //redirect(request()->header("Referer"));
                }),
                Tables\Actions\DeleteAction::make()->after(function (){
                    redirect(request()->header("Referer"));
                }),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make()->after(function (){
                    redirect(request()->header("Referer"));
                }),
            ])
            ->defaultSort('id','desc');
    }
}

<?php

namespace Modules\HR\Filament\Resources;

use Modules\HR\Filament\Resources\LeaveTypeResource\Pages;
use Modules\HR\Filament\Resources\LeaveTypeResource\RelationManagers;
use Modules\HR\Models\LeaveType;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class LeaveTypeResource extends Resource
{
    protected static ?string $model = LeaveType::class;

    protected static function getNavigationIcon(): string
    {
        return config('hr.models.LeaveType.icon');
    }

    protected static function getNavigationGroup(): ?string
    {
        return config('hr.navigation.name');
    }

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\Card::make([
                    Forms\Components\TextInput::make("name")
                        ->unique('leave_types','name',fn($record)=>$record)
                        ->required(),
                    Forms\Components\TextInput::make("max_allocation_allowed")
                        ->default(0),
                    Forms\Components\TextInput::make("applicable_after")
                        ->helperText("Working days")
                        ->default(0),
                    Forms\Components\TextInput::make("max_consecutive_allowed")
                        ->default(0),
                    Forms\Components\Toggle::make("carry_forward")->default(false),
                    Forms\Components\Toggle::make("without_pay")->default(false),
                    Forms\Components\Toggle::make("allow_encashment")->default(false),
                    Forms\Components\Toggle::make("earned_leave")->default(false),
                ])->columns(2)->columnSpan(2),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //
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
            'index' => Pages\ListLeaveTypes::route('/'),
            'create' => Pages\CreateLeaveType::route('/create'),
            'edit' => Pages\EditLeaveType::route('/{record}/edit'),
        ];
    }
}

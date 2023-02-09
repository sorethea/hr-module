<?php

namespace Modules\HR\Filament\Resources;

use Modules\HR\Filament\Resources\EmployeeResource\Pages;
use Modules\HR\Filament\Resources\EmployeeResource\RelationManagers;
use Modules\HR\Models\Employee;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Modules\HR\Settings\HRSetting;
use Spatie\LaravelSettings\Settings;

class EmployeeResource extends Resource
{
    protected static ?string $model = Employee::class;

    protected static function getNavigationIcon(): string
    {
        return config('hr.models.Employee.icon');
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
                    Forms\Components\TextInput::make("first_name")
                        ->required(),
                    Forms\Components\TextInput::make("last_name")
                        ->required(),
                    Forms\Components\Toggle::make("is_system_user")
                        ->reactive()
                        ->default(false),

                    Forms\Components\TextInput::make("email")
                        ->visible(fn(\Closure $get)=>$get("is_system_user"))
                        ->required(),
                    Forms\Components\TextInput::make("password")
                        ->password()
                        ->required()
                        ->visible(fn(\Closure $get)=>$get("is_system_user"))
                        ->same("password_confirmation"),
                    Forms\Components\TextInput::make("password_confirmation")
                        ->password()
                        ->visible(fn(\Closure $get)=>$get("is_system_user"))
                        ->required(),
                    Forms\Components\Toggle::make("active")
                        ->default(true),
                    Forms\Components\Select::make("gender")
                        ->options(app(HRSetting::class)->gender)
                        ->required(),
                    Forms\Components\DatePicker::make("date_of_birth")
                        ->required(),
                    Forms\Components\DatePicker::make("date_of_joining")
                        ->required(),
                ])->columns(2),
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
            'index' => Pages\ListEmployees::route('/'),
            'create' => Pages\CreateEmployee::route('/create'),
            'edit' => Pages\EditEmployee::route('/{record}/edit'),
        ];
    }
}

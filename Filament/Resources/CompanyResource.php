<?php

namespace Modules\HR\Filament\Resources;

use Modules\HR\Filament\Resources\CompanyResource\Pages;
use Modules\HR\Filament\Resources\CompanyResource\RelationManagers;
use Modules\HR\Models\Company;
use Filament\Forms;
use Filament\Resources\Form;
use Filament\Resources\Resource;
use Filament\Resources\Table;
use Filament\Tables;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class CompanyResource extends Resource
{
    protected static ?string $model = Company::class;

    protected static function getNavigationIcon(): string
    {
        return config('hr.models.Company.icon');
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
                        ->unique("companies","name",fn($record)=>$record)
                        ->required(),
                    Forms\Components\TextInput::make("abbr")
                        ->unique("companies","abbr",fn($record)=>$record)
                        ->required(),
                    Forms\Components\BelongsToSelect::make("parent")
                        ->relationship("parent","name")
                        ->createOptionForm([
                            Forms\Components\Card::make([
                                Forms\Components\TextInput::make("name")
                                    ->unique("companies","name",fn($record)=>$record)
                                    ->required(),
                                Forms\Components\TextInput::make("abbr")
                                    ->unique("companies","abbr",fn($record)=>$record)
                                    ->required(),
                            ]),
                        ])
                        ->nullable(),
                    Forms\Components\TextInput::make("domain")
                        ->nullable(),
                    Forms\Components\Toggle::make("is_group"),
                    Forms\Components\MarkdownEditor::make("description")
                        ->columnSpan(2)
                        ->nullable(),
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
            'index' => Pages\ListCompanies::route('/'),
            'create' => Pages\CreateCompany::route('/create'),
            'edit' => Pages\EditCompany::route('/{record}/edit'),
        ];
    }
}
